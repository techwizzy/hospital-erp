<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Refund extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->lang->load('en_admin');
		//$this->load->helper(array('url','language'));
        $this->load->model('refund_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');

	}

     /*
  *Display the refund requests notifications
  *
  */
  public function show_refund_notifications()
  {
   
    $this->data['itemdata']= $this->refund_model->get_refund_requests();
    $this->data['title'] = 'Refund requests'; 
    $this->render_page('refund/refund_requests', $this->data);
  }

    /*
  *Display the refunds
  */
  public function show_refunds()
  {
   
    $this->data['itemdata']= $this->refund_model->get_refunds();
    $this->data['title'] = 'Refunds'; 
    $this->render_page('refund/refunds', $this->data);
  }
  

   /*
  *Display a single refund object
  */
   public function show_refund($value)
   {
      $this->data['title'] = 'Refund'; 
      $this->data['row']=$this->refund_model->get_refund_object($value)->row();
      $this->data['itemdata']= $this->refund_model->get_refund_items1($value)->result();
      $this->render_page('refund/refund_view', $this->data);
   }

    /*
  *Display the the approve/reject refund view
  *
  */
    public function show_approve_view($id)
    {
    $this->data['row']= $this->refund_model->get_refund_object($id)->row();
    $this->data['itemdata']= $this->refund_model->get_refund_items($id)->result();
    $this->data['title'] = 'Approve'; 
    $this->render_page('refund/approve_view', $this->data);
    }

     /*
  *Approve the refund function
  *
  */
  public function approve_refund_request()
   {
      #pick the approval request of a single line of item
       $date=date('Y-m-d');
       $primary_key=$this->input->post('id');
       $qty=$this->input->post('qty');
      #package the request in an array
      $data_array=array(
                         'approved_by'  =>$this->session->userdata('fullname'),
                         'date_approved'=>$date,
                         'status'       =>'approved'
                       );

      $filter_data=array('refund_id'=>$primary_key);
      #call 1: approve_refund function
      $this->refund_model->approve_refund($filter_data,$data_array);
      #call 2: record_refund_transaction
      $data1=array('bill_no' =>$this->input->post('bill_no'),
                   'file_no' =>$this->input->post('file_no'),
                   'amount_paid'=>$this->input->post('sub_total'),
                   'payment_method'=>'cash',
                   'patient_name'=>$this->input->post('patient_name'),
                   'date_paid'=>$date,
                   'username'=>$this->session->userdata('username'),
                   'status'=>'Refund',

                   );
      $this->refund_model->record_refund_transaction($data1);
      $bill_data=array('status'=>'Refund');
      $this->refund_model->update_patient_bill($bill_data,$primary_key);
      $this->refund_model->update_bill_transactions($bill_data,$primary_key);
      #call 4: if its not a service ? positive_stock_adjust
      $item_type=$this->refund_model->get_item_type($this->input->post('item_code'));
      if($item_type=='inventory item'){
        $this->refund_model->positive_stock_adjust($filter_data,$qty);
      }
      $this->session->set_flashdata('message', 'You have successfully approved refund item');
      redirect('refund/show_approve_view/'.$primary_key, 'refresh'); 
   } 


  public function close_request()
  {
    $date=date('Y-m-d');
    $primary_key=$this->input->post('id');
    #function call: update_refund_request
     $this->data_array=array(
                         'approved_by'  =>$this->session->userdata('fullname'),
                         'date_approved'=>$date,
                         'status'       =>'approved'
                       );

      $filter_data=array('refund_id'=>$primary_key);
    $this->refund_model->update_refund_request($filter_data,$this->data_array);
    redirect('refund/show_refund_notifications/'.$primary_key, 'refresh'); 
  }

  /*
  *Display the refund report 
  *
  */ 
  public function show_refund_report()
  {
    $from=date('Y-m-d',strtotime($this->input->post('from')));
    $to=date('Y-m-d',strtotime($this->input->post('to')));
    $status=$this->input->post('status');
    $this->data['reportdata']= $this->refund_model->get_custom_refund_report($from,$to,$status);
    $this->data['title'] = 'Refund Report'; 
    $this->data['main_content'] = 'refund/refund_report';
    $this->load->view('includes/notemplate', $this->data);
  }
 /*
  *Display the report filter
  *
  */ 
  public function show_refund_filter()
  {
    $this->data['title'] = 'Refund Report'; 
    $this->data['main_content'] = 'refund/refund_filter';
    $this->load->view('includes/template', $this->data);
  }

  
  public function get_patient_bills()
    { 

    $this->data['title'] = 'Patient bills';

    if (isset($_POST) && !empty($_POST))
      {
         $from=date('Y-m-d 00:00:00',strtotime($this->input->post("start")));
         $to=date('Y-m-d 00:00:00',strtotime($this->input->post("end")));
         $this->data['bill_data']=$this->refund_model->get_daterange_sales($from,$to)->result();
         $this->data['total_bill']=$this->refund_model->get_daterange_sum($from,$to)->row();
      }else{
          $this->data['bill_data']=$this->refund_model->get_all_sales()->result();
          $this->data['total_bill']=$this->refund_model->get_today_sum()->row();
        }
          $this->render_page('refund/sales', $this->data);


    }
        function today_patient_bills()
    { 

          $this->data['title'] = 'Patient bills'; 
          $this->data['bill_data']=$this->refund_model->get_today_sales();
          $this->data['main_content'] = 'refund/today_bill_list';
          $this->load->view('includes/table_template', $this->data);

    }
         function weekly_patient_bills()
    { 

          $this->data['title'] = 'Patient bills'; 
          $this->data['bill_data']=$this->refund_model->get_weekly_sales();
          $this->data['main_content'] = 'refund/weekly_bill_list';
          $this->load->view('includes/table_template', $this->data);

    }
          function monthly_patient_bills()
    { 

          $this->data['title'] = 'Patient bills'; 
          $this->data['bill_data']=$this->refund_model->get_monthly_sales();
          $this->data['main_content'] = 'refund/monthly_bill_list';
          $this->load->view('includes/table_template', $this->data);

    }
	     function cashier_patient_bills()
    { 

          $this->data['title'] = 'Patient bills'; 
		      $this->data['clerks']=$this->refund_model->get_clerks();
          $this->data['bill_data']=$this->refund_model->get_all_sales();
          $this->data['bill_total']= $this->refund_model->get_sum_sales();
          $this->data['main_content'] = 'refund/cashier_sales';
          $this->load->view('includes/template', $this->data);

    }
         function cashier_patient_bill_filter()
    { 

          $name=$this->input->post('clerk');
          $date=date('Y-m-d', strtotime($this->input->post('date')));
  
          $this->data['title'] = 'Patient bills'; 
          $this->data['clerks']=$this->refund_model->get_clerks();
          $this->data['bill_data']= $this->refund_model->get_sales($name,$date);
          $this->data['bill_total']= $this->refund_model->get_total_sales($name,$date);
          $this->data['main_content'] = 'refund/cashier_sales';
          $this->load->view('includes/template', $this->data);

    }

  function create_backup(){
                    // Load the DB utility class
            $this->load->dbutil();

            // Backup your entire database and assign it to a variable
            $backup =& $this->dbutil->backup();

            // Load the file helper and write the file to your server
            $this->load->helper('file');
            write_file('backups/'."".date("Y-m-d_H-i-s").'.zip',$backup);
        
          $this->data['title'] = ' Backups'; 
         
          $this->data['main_content'] = 'refund/backup';
          $this->load->view('includes/template', $this->data);
  }
  public function view_bill($value)
  {
              $this->data['title'] = 'Bill';
              $this->data['order']=$this->refund_model->get_this_sale_order_details($value)->row();//get the order details data
              $this->data['product_data']=$this->refund_model->get_this_sale_order_items($value)->result();//get the purchase order items data
             // $this->data['tprice_data']=$this->purchase_model-> get_this_sale_order_total($value);//get the purchase order total
              $this->data['main_content'] = 'refund/this_bill';
              $this->load->view('includes/template', $this->data);
  }
    public function view_this_bill($value)
  {
              $this->data['title'] = 'Bill';
              $this->data['row']=$this->refund_model->get_this_sale_order_details($value)->row();//get the order details data
              $this->data['bill']=$this->refund_model->get_this_sale_order_bill($value);//get the order details data
              $this->data['product_data']=$this->refund_model->get_this_sale_order_items($value)->result();//get the purchase order items data
              $this->render_page('refund/this_bill', $this->data);
  }

     public function view_payments($value)
  {
              $this->data['title'] = 'Bill';
              $this->data['row']=$this->refund_model->get_this_sale_order_details($value)->row();//get the order details data
              $this->data['pay']=$this->refund_model->get_this_sale_order_details($value)->result();//get the order details data
              $this->data['bill']=$this->refund_model->get_this_sale_order_bill($value);//get the order details data
              $this->render_page('refund/bill_payments', $this->data);
  }
  public function void_bill($id)
  {
    //create data array for the update
     //$id=$this->input->post('id');
      //TODO: load in array
      $this->data=array(
      'status'=>'void',
      'balance'=>'0',
      'void_by'=>$this->session->userdata('fullname'));
      //TODO: store in db
       $this->refund_model->update_patient_bill($this->data,$id);
       //$this->refund_model->update_bill_transactions($this->data,$id);

        //TODO: return an appropriate message
       $this->session->set_flashdata('message',  ' Bill successfully recorded as void');

       //TODO: refresh page
       redirect('refund/view_this_bill/'.$id,'refresh');

  }

    function display_new_diagnosis()
       { 
          $this->data['title'] = 'Diagnosis'; 
          $this->data['main_content'] = 'refund/new_diagnosis';
          $this->load->view('includes/template', $this->data);

      }
       function add_new_diagnosis(){
       $this->load->library('form_validation');
       $this->form_validation->set_error_delimiters('<div style="color:red" class="alert alert-danger">', '</div>');
       $this->form_validation->set_rules('d', 'code',  'required');
      
      if ($this->form_validation->run() == FALSE)
        {
          $this->display_new_diagnosis();
        }else{
           
      //TODO: load in array
      $this->data=array(
      'diagnosis_code'=>$this->input->post('d'),
      'diagnosis_name'=>$this->input->post('note')
       );
       $this->refund_model->save_diagnosis($this->data);
      //TODO: return an appropriate message
       $this->session->set_flashdata('msg',   ' Diagnosis record successfully saved');

       //TODO: refresh page
       redirect('refund/display_new_diagnosis','refresh');
      }
     }
        function edit_diagnosis($id)
    { 
          $this->data['title'] = 'Edit Dosage'; 
          $this->data['categorydata']=$this->refund_model->get_this_diagnosis($id);
          $this->data['main_content'] = 'refund/edit_diagnosis';
          $this->load->view('includes/template', $this->data);

    }
     function edit_diagnosis_record(){
      
       $nid=$this->input->post('catid');
      //TODO: load in array
      $this->data=array(
      'diagnosis_code'=>$this->input->post('d'),
      'diagnosis_name'=>$this->input->post('note')
      
      );
      //TODO: store in db
       $this->refund_model->update_diagnosis_data($this->data,$nid);
        //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('catname'). ' record successfully edited');

       //TODO: refresh page
       redirect('refund/edit_diagnosis/'.$nid,'refresh');
  }
     function display_drug_diagnosis()
    { 

          $this->data['title'] = 'Drug Diagnosis'; 
           $this->data['categorydata']=$this->refund_model->get_diagnosis();
          $this->data['main_content'] = 'refund/diagnosis_list';
          $this->load->view('includes/table_template', $this->data);

    }
       
        function load_custom_sales()
    { 
          $this->data['title'] = 'Custom sales'; 
          $this->data['main_content'] = 'refund/custom_sales';
         
          $this->load->view('includes/template', $this->data);
   }
       function load_yearly_sales()
    { 
          $this->data['title'] = 'Custom sales'; 
          $this->data['main_content'] = 'refund/yearly_sales';
          $this->data['stock']=$this->refund_model->get_yearly_sales();
          $this->load->view('includes/graphtemplate', $this->data);
   }
   public function generate_custom_report()
   {
         
          $type=$this->input->post('graph');
          $ptype=$this->input->post('ptype');
          $from=date('Y-m-d', strtotime($this->input->post('from')));
          $to=date('Y-m-d', strtotime($this->input->post('to')));
          #generating a graph report for the sales report of all the patients(outpatient and inpatient)
          if($type=='graph'){
             if($ptype=='All'){
                $this->data['stock']=$this->refund_model->get_custom_sales($from,$to);
              }elseif($ptype=='Inpatient'){
                $this->data['stock']=$this->refund_model->get_inpatient_sales($from,$to);
              }
                elseif($ptype=='Clinic'){
                $this->data['stock']=$this->refund_model->get_clinic_sales($from,$to);
              }
              elseif($ptype=='Outpatient'){
                $this->data['stock']=$this->refund_model->get_outpatient_sales($from,$to);
              }
                $this->data['title'] = 'select'; 
                $this->data['main_content'] = 'refund/sales_graph';
                $this->load->view('includes/graphtemplate', $this->data);

          }elseif($type=='summary'){
            if($ptype=='All'){
                $this->data['stock']=$this->refund_model->get_custom_sales($from,$to);
              }elseif($ptype=='Inpatient'){
                $this->data['stock']=$this->refund_model->get_inpatient_sales($from,$to);
              }
               elseif($ptype=='Clinic'){
                $this->data['stock']=$this->refund_model->get_clinic_sales($from,$to);
              }
              elseif($ptype=='Outpatient'){
                $this->data['stock']=$this->refund_model->get_outpatient_sales($from,$to);
              }
            $this->data['title'] = 'select'; 
            $this->data['main_content'] = 'refund/sales_summary';
            $this->load->view('includes/table_template', $this->data);
          }elseif($type=='detailed'){
             if($ptype=='All'){
                $this->data['stock']=$this->refund_model->get_custom_sales_report($from,$to);
              }elseif($ptype=='Inpatient'){
                $this->data['stock']=$this->refund_model->get_inpatient_sales_report($from,$to);
              }
               elseif($ptype=='Clinic'){
                $this->data['stock']=$this->refund_model->get_clinic_sales_report($from,$to);
              }
              elseif($ptype=='Outpatient'){
                $this->data['stock']=$this->refund_model->get_outpatient_sales_report($from,$to);
              }
            $this->data['title'] = 'select'; 
            $this->data['main_content'] = 'refund/sales_detail';
            $this->load->view('includes/table_template', $this->data);

          } 
   }
         function load_today_sales_report()
    { 
          $this->data['title'] = 'Today sales'; 
           $this->data['main_content'] = 'refund/today_bill_list_report';
          $this->data['bill_data']=$this->refund_model->get_today_sales();
          $this->data['totals']=$this->refund_model->get_today_sales_totals();
          $this->load->view('includes/no_template', $this->data);
   }
}