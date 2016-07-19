<?php

class Report extends MY_Controller
{
/*

*All the purchase ordering transactions 
*Supplier management and payment
*
*/

  function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->lang->load('en_admin');
		//$this->load->helper(array('url','language'));
        $this->load->model('report_model');
         $this->load->model('payroll_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->load->library('cart');
		$this->lang->load('auth');
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

	}

	public function overview_chart()
	{
	
	  if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			$this->data['message']='You must be an administrator to view this page.';
			$this->load->view('auth/404', $this->data);
		}else{
			     $this->data['stock']=$this->report_model->getStockTotal(); 
			     $this->data['service']=$this->report_model->getTotalServiceItems();
			     $this->data['invent']=$this->report_model->getTotalInventoryItems();
				 $this->render_page('reports/index', $this->data);
		}
	}
  
     public function get_reorder_items(){
  	            $this->data['title'] = "Reorder Report";
                $this->data['items']=$this->report_model->getReorderItems()->result();
			    $this->load->view('reports/reorder_report', $this->data);
    }
    public function get_products_report(){
                $this->data['title'] = "Products Report";
                $this->data['items']=$this->report_model->getProducts();
			    $this->load->view('reports/products_report', $this->data);
    }
    public function get_categories_report(){
                $this->data['title'] = "Categories Report";
                $this->data['items']=$this->report_model->getCategories();
			    $this->load->view('reports/categories_report', $this->data);
			  
    }
     public function get_daily_sales_report(){
     	         $start=date('Y-m-d');
			     $end=date('Y-m-d');
                $this->data['title'] = "Daily sales Report";
                $this->data['chatData'] = $this->report_model->getDailyChartData();
                 $this->data['Idata'] = $this->report_model->getTotalPaidAmountInpatient($start, $end);
                 $this->data['Odata'] = $this->report_model->getTotalPaidAmountOutpatient($start, $end);
                 $this->data['Cdata'] = $this->report_model->getTotalPaidAmountClinic($start, $end);
			    $this->render_page('reports/daily_sales', $this->data);
			    
    }
     public function get_monthly_sales_report(){
     	         $start=date('Y-m-01');
			     $end=date('Y-m-t');
                $this->data['title'] = "Daily sales Report";
                $this->data['chatData'] = $this->report_model->getChartData();
                 $this->data['Idata'] = $this->report_model->getTotalPaidAmountInpatient($start, $end);
                 $this->data['Odata'] = $this->report_model->getTotalPaidAmountOutpatient($start, $end);
                 $this->data['Cdata'] = $this->report_model->getTotalPaidAmountClinic($start, $end);
			    $this->render_page('reports/monthly_sales', $this->data);
			    
    }

     public function get_sales_report(){
                 $this->data['title'] = "Daily sales Report";
     	         $start=date('Y-m-d', strtotime($this->input->post('from')));
			     $end=date('Y-m-d', strtotime($this->input->post('to')));
                 $method=$this->input->post('pay_type');

                 if ($this->input->post('report_type')=='Clinic') {
                     $type='Clinic';
                     if ($this->input->post('pay_type')=='All') {
                          $this->data['sales'] = $this->report_model->getCustomSales($start,$end,$type);
                     }else{
                          $this->data['sales'] = $this->report_model->getCustomSales($start,$end,$type,$method);
                     } 
                 }
                 
                   elseif ($this->input->post('report_type')=='Inpatient') {
                      $type='Inpatient';
                     if ($this->input->post('pay_type')=='All') {
                         
                          $this->data['sales'] = $this->report_model->getCustomSales($start,$end,$type);
                     }else{
                          $this->data['sales'] = $this->report_model->getCustomSales($start,$end,$type,$method);
                     } 
                 } 

                  elseif ($this->input->post('report_type')=='Outpatient') {
                      $type='Outpatient';
                     if ($this->input->post('pay_type')=='All') {
                         
                          $this->data['sales'] = $this->report_model->getCustomSales($start,$end,$type);
                     }else{
                          $this->data['sales'] = $this->report_model->getCustomSales($start,$end,$type,$method);
                     } 
                 }
                 else{
                      if ( $this->input->post('pay_type')=='All') {
                         
                          $this->data['sales'] = $this->report_model->getCustomSales($start,$end);
                     }else{
                          $this->data['sales'] = $this->report_model->getCustomSales($start,$end,$method);
                     } 
                 }

                 $this->load->view('reports/custom_sales', $this->data);
			    
    }

    public function get_clerks_sales()
    {
                 $this->data['title'] = "Clerk sales Report";
                 $start=date('Y-m-d', strtotime($this->input->post('from')));
                 $end=date('Y-m-d', strtotime($this->input->post('to')));
                 $clerk=$this->input->post('clerk_name');
                 if($clerk=='ALL'){
                   $this->data['sales'] = $this->report_model->getClerkSales($start,$end); 
                 }else{
                 $this->data['sales'] = $this->report_model->getClerkSales($start,$end,$clerk);
                 }
                 $this->load->view('reports/custom_sales', $this->data);
    }
      public function get_purchase_report(){
     	         $start=date('Y-m-d', strtotime($this->input->post('from')));
                 $end=date('Y-m-d', strtotime($this->input->post('to')));
                 $this->data['title'] = "Purchases Report";
                 $this->data['purchases'] = $this->report_model->getPurchases($start, $end)->result();
                 $this->load->view('reports/purchase_report', $this->data);
			    
    }
    public function get_suppliers_report(){
     	     
                 $this->data['title'] = "Suppliers report";
                 $this->data['users'] = $this->report_model->getSuppliers();
                 $this->load->view('reports/suppliers_report', $this->data);
			    
    }
        public function get_staff_report(){
     	     
                 $this->data['title'] = "Staff Report";
                 $this->data['users'] = $this->report_model->getStaff()->result();
                 $this->load->view('reports/staff_report', $this->data);
			    
    }
        public function get_diagnostic_report(){
     	         
                 $this->data['title'] = "Diagnostic Report";
                 $this->data['rows'] = $this->report_model->get_diagnosis();
                 $this->render_page('reports/diagnostic_form', $this->data);
			    
    }
     public function generate_diagnostic_report()
   {
          $this->data['title'] = "Diagnostic Report";
          $this->output->enable_profiler(TRUE);
          $this->load->dbutil();
          $this->load->helper('file');
          $this->load->helper('download');

            //variables to filter
            $from=date('Y-m-d', strtotime($this->input->post('from')));
            $to=date('Y-m-d', strtotime($this->input->post('to')));
            $type=$this->input->post('patient_type');
            $status=$this->input->post('status');
            $diagnosis=$this->input->post('diagnosis');
            $this->data['start']=date('Y-m-d', strtotime($this->input->post('from')));
            $this->data['end']=date('Y-m-d', strtotime($this->input->post('to')));
        
        /*inpatient*/  
          if($type=='Inpatient'){

           //$report =$this->report_model->get_patient_diagnosis($from,$to,$type,$diagnosis,$status);
           /*  pass it to db utility function  */
          // $new_report = $this->dbutil->csv_from_result($report);
          /*  Now use it to write file. write_file helper function will do it */
             //write_file('downloads/reports/diagnosis_report.csv',$new_report);
              if($status=='ALL'){
               $this->data['bill_data']=$this->report_model->get_patient_diagnosis($from,$to,'Inpatient');
              }
             elseif($status=='ALL' ||$status=='DEAD'||$status=='ALIVE'  && $diagnosis=='all'){
               $this->data['bill_data']=$this->report_model->get_patient_diagnosis($from,$to,'Inpatient');
              }

            else{
             $this->data['bill_data']=$this->report_model->get_patient_diagnosis($from,$to,'Inpatient',$diagnosis,$status);
             }
            
            $this->load->view('reports/patient_diagnosis', $this->data);
          }
      /*end of inpatient */


          elseif($type=='Outpatient'){
           
            
              /* get the object   */
          // $report =$this->report_model->get_patient_diagnosis($from,$to,$type,$diagnosis,$status);
           /*  pass it to db utility function  */
           //$new_report = $this->dbutil->csv_from_result($report);
          /*  Now use it to write file. write_file helper function will do it */
           //write_file('downloads/reports/diagnosis_report.csv',$new_report);
            if($status=='ALL'){
               $this->data['bill_data']=$this->report_model->get_patient_diagnosis($from,$to,$type);
              }
             elseif($status=='ALL' ||$status=='DEAD'||$status=='ALIVE'  && $diagnosis=='all'){
               $this->data['bill_data']=$this->report_model->get_patient_diagnosis($from,$to,$type);
              }

              else{
             $this->data['bill_data']=$this->report_model->get_patient_diagnosis($from,$to,$type,$diagnosis,$status);
             }
            $this->load->view('reports/patient_diagnosis', $this->data);
          }


          elseif($type=='All'){
           //$this->load->view('reports/patient_diagnosis', $this->data);
              /* get the object   */
           $report =$this->report_model->get_patient_diagnosis($from,$to);
           /*  pass it to db utility function  */
           $new_report = $this->dbutil->csv_from_result($report);
          /*  Now use it to write file. write_file helper function will do it */
           write_file('downloads/reports/diagnosis_report.csv',$new_report);
            $this->data['bill_data']=$this->report_model->get_patient_diagnosis($from,$to);
           $this->load->view('reports/patient_diagnosis', $this->data);
         
          }
            
   }







      public function get_diagnosis_report(){
                 $start=date('2015-11-01');
                 $end=date('2015-11-t');
                 $this->data['title'] = "Diagnostic Report";
                 $this->data['rows'] = $this->report_model-> getDiagnosis($start, $end);
                 $this->render_page('reports/diagnosis_report', $this->data);
                
    }
          public function get_patient_report(){
     	         $this->data['title'] = "Patient Report";
                 $from=date('Y-m-d', strtotime($this->input->post('from')));
                 $to=date('Y-m-d', strtotime($this->input->post('to')));
                 $this->data['data'] = $this->report_model->patient_analytics($start, $end)->result();
                 $this->load->view('reports/patient_report', $this->data);
			    
    }
      public function get_payslip_report(){
     	         $start=date('2016-01-01');
			     $end=date('Y-m-d');
                 $this->data['title'] = "Payslip Report";
                 $this->data['payslip'] = $this->report_model->getPayrollData($start, $end);
                 $this->render_page('reports/payslip_report', $this->data);
			    
    }
     public function get_Banksheet_report(){
     	         $start=date('2016-01-01');
			     $end=date('Y-m-d');
			     $bank='';
                 $this->data['title'] = "Payslip Report";
                 $this->data['payslip'] = $this->report_model->get_filtered_salary_transfers($start, $end);
                 $this->render_page('reports/diagnostic_report', $this->data);
			    
    }
  
       public function get_statutory_report(){
                  $from=date('Y-m-d', strtotime($this->input->post('from')));
                  $to=date('Y-m-d', strtotime($this->input->post('to')));
               
                 $this->data['title'] = "Statutory Report";
                 $this->data['payslip'] = $this->report_model->getPayrollData($start, $end);
                 $this->load->view('reports/statutory_report', $this->data);
                
     }
       public function get_insurance_report(){
                 $from=date('Y-m-d', strtotime($this->input->post('from')));
                  $to=date('Y-m-d', strtotime($this->input->post('to')));
                 $this->data['title'] = "Insurance Report";
                 $this->data['user'] = $this->report_model->getInsuranceData($start, $end);
                 $this->load->view('reports/insurance_report', $this->data);
            }
      
       public function get_salaries_report(){
               
                 $this->data['title'] = "Salaries Report";
                 $this->data['salaries'] = $this->payroll_model->getSalaries();
                 $this->load->view('reports/salaries_report', $this->data);
            }
      
        public function get_deduction_report(){
                $from=date('Y-m-d', strtotime($this->input->post('from')));
                  $to=date('Y-m-d', strtotime($this->input->post('to')));
                 $this->data['title'] = "Deduction Report";
                 $where="Date_deducted between '$start' and '$end' ";
                 $this->data['salaries'] = $this->payroll_model->getDeductions($where);
                 $this->load->view('reports/deductions_report', $this->data);
            }
         public function get_loan_report(){
                 $from=date('Y-m-d', strtotime($this->input->post('from')));
                  $to=date('Y-m-d', strtotime($this->input->post('to')));
                 $this->data['title'] = "Loans Report";
                 $this->data['salaries'] = $this->report_model->getLoanData($start, $end);
                 $this->load->view('reports/loans_report', $this->data);
            }
        public function get_gratuity_report(){
                 $start=date('2016-01-01');
                 $end=date('Y-m-d');
                 $year=date('Y');
                 $this->data['title'] = "Salaries Report";
                 $this->data['salaries'] = $this->report_model->getGratuityData($year);
                 $this->load->view('reports/gratuity_report', $this->data);
            }

            public function generate_sales_report()
            {
              $this->data['title'] = "Generate sales report";
              //$this->data['clerks'] = $this->report_model->getClerks();
              $this->render_page('reports/sales_form', $this->data);
             
            }
             public function generate_clerks_report()
            {
              $this->data['title'] = "Generate clerks sales report";
              $this->data['clerks'] = $this->report_model->getClerks();
              $this->render_page('reports/clerks_form', $this->data);
             
            }
              public function generate_purchase_report()
            {
              $this->data['title'] = "Generate purchase report";
              //$this->data['clerks'] = $this->report_model->getClerks();
              $this->render_page('reports/purchase_form', $this->data);
             
            }
                public function generate_patient_report()
            {
              $this->data['title'] = "Generate purchase report";
              //$this->data['clerks'] = $this->report_model->getClerks();
              $this->render_page('reports/patient_form', $this->data);
             
            }
                public function generate_statutory_report()
            {
              $this->data['title'] = "Generate statutory report";
              //$this->data['clerks'] = $this->report_model->getClerks();
              $this->render_page('reports/statutory_form', $this->data);
             
            }
                  public function generate_insurance_report()
                    {
                      $this->data['title'] = "Generate insurance report";
                      //$this->data['clerks'] = $this->report_model->getClerks();
                      $this->render_page('reports/insurance_form', $this->data);
                     
                    }
                   public function generate_deduction_report()
                    {
                      $this->data['title'] = "Generate deduction report";
                      //$this->data['clerks'] = $this->report_model->getClerks();
                      $this->render_page('reports/deduction_form', $this->data);
                     
                    }
                  public function generate_loans_report()
                    {
                      $this->data['title'] = "Generate Loans report";
                      //$this->data['clerks'] = $this->report_model->getClerks();
                      $this->render_page('reports/loan_form', $this->data);
                     
                    }
              
}