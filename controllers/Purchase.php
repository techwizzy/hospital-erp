<?php

class Purchase extends MY_Controller 
{
/*

*All the purchase ordering transactions 
*Supplier management and payment
*
*/

	 public function __construct()
    {

	   
        parent::__construct();
        $this->data['site_name'] = $this->config->item( 'site_name' ); 
        $this->load->model('purchase_model');
        $this->load->library('cart');
        $this->load->library(array('ion_auth','form_validation'));
        $this->lang->load('en_admin');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        if (!$this->ion_auth->logged_in())
        {
          // redirect them to the login page
          redirect('auth/login', 'refresh');
        }
 
	  }
   //display register new order
   function index()
    { 
          $this->data['title'] = 'Purchase';
          $this->render_page('purchases/new_order', $this->data);

    }
    //display all pending orders
   function all_pending_orders()
    {
          $this->data['title'] = 'Purchase Orders'; 
          $this->data['purchase_data']=$this->purchase_model->get_pending_orders();
          $this->render_page('purchases/pending', $this->data);
    }
       function all_pending_orders_accounts()
    {
          $this->data['title'] = 'Pending Orders'; 
          $this->data['purchase_data']=$this->purchase_model->get_pending_orders();
          $this->data['main_content'] = 'purchases/pending_accounts';
          $this->load->view('includes/template', $this->data);
    }
       function all_pending_orders_store()
    {
          $this->data['title'] = 'Pending Orders'; 
          $this->data['purchase_data']=$this->purchase_model->get_pending_orders();
          $this->data['main_content'] = 'purchases/pending_store';
          $this->load->view('includes/template', $this->data);
    }
    //display all unpaid orders
   function load_unpaid()
    {
          $this->data['title'] = 'Unpaid Orders'; 
          $this->data['main_content'] = 'purchase/unpaid';
          $this->load->view('includes/table_template', $this->data);
    }
    //load the view of new supplier
    function load_new_supplier(){
        $this->data['title'] = 'New Supplier'; 
       
        $this->render_page('purchases/new_supplier', $this->data);
   }
    function load_new_supplier_accounts(){
        $this->data['title'] = 'New Supplier'; 
        $this->data['main_content'] = 'purchases/new_supplier_accounts';
        $this->load->view('includes/template', $this->data);
   }
    function load_new_supplier_store(){
        $this->data['title'] = 'New Supplier'; 
        $this->data['main_content'] = 'purchases/new_supplier_store';
        $this->load->view('includes/template', $this->data);
   }
   //load the view of editing a supplier
   function load_edit_supplier($id){
        $this->data['title'] = 'Edit Supplier';
        $this->data['s']=$this->purchase_model->get_particular_supplier($id)->row();
        $this->render_page('purchases/edit_supplier', $this->data);
   }
      function load_edit_supplier_accounts($id){
        $this->data['title'] = 'Edit Supplier';
        $this->data['supplier_data']=$this->purchase_model->get_particular_supplier($id);
        $this->data['main_content'] = 'purchases/edit_supplier_accounts';
        $this->render_page('includes/template', $this->data);
   }
 function load_edit_supplier_store($id){
        $this->data['title'] = 'Edit Supplier';
        $this->data['supplier_data']=$this->purchase_model->get_particular_supplier($id);
        $this->data['main_content'] = 'purchases/edit_supplier_store';
        $this->load->view('includes/template', $this->data);
   }
   //load the view of all suppliers
  function view_suppliers()
  {    
        $this->data['title'] = 'All Suppliers';
        $this->data['data']=$this->purchase_model->get_supplier_details();
        $this->render_page('purchases/suppliers_list', $this->data);
  } 
    function view_suppliers_accounts()
  {    
        $this->data['title'] = 'All Suppliers';
        $this->data['supplier_data']=$this->purchase_model->get_supplier_details();
        $this->data['main_content'] = 'purchases/supplier_list_accounts';
        $this->load->view('includes/table_template', $this->data);
  } 
    function view_suppliers_store()
  {    
        $this->data['title'] = 'All Suppliers';
        $this->data['supplier_data']=$this->purchase_model->get_supplier_details();
        $this->data['main_content'] = 'purchases/supplier_list_store';
        $this->load->view('includes/table_template', $this->data);
  } 
    function view_supplier_report()
  {    
        $this->data['title'] = 'All Suppliers';
        $this->data['supplier_data']=$this->purchase_model->get_supplier_details();
        $this->data['main_content'] = 'purchases/supplier_list_report';
        $this->load->view('includes/no_template', $this->data);
  } 
     function view_supplier_report_accounts()
  {    
        $this->data['title'] = 'All Suppliers';
        $this->data['supplier_data']=$this->purchase_model->get_supplier_details();
        $this->data['main_content'] = 'purchases/supplier_list_report_accounts';
        $this->load->view('includes/notemplate', $this->data);
  }  
     function view_supplier_report_store()
  {    
        $this->data['title'] = 'All Suppliers';
        $this->data['supplier_data']=$this->purchase_model->get_supplier_details();
        $this->data['main_content'] = 'purchases/supplier_list_report_store';
        $this->load->view('includes/no_template', $this->data);
  }   
  //save a new supplier record
    function record_new_supplier()
     { 
 
          //validate the variables
            //TODO: parse the info
              $this->load->library('form_validation');
              $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
             
              $this->form_validation->set_rules('pin', 'Pin Number',  'required|alpha_numeric');
              $this->form_validation->set_rules('sname', 'Supplier name',  'required');
              $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
              $this->form_validation->set_rules('phone', 'Phone Number', 'required|min_length[10]|max_length[12]');
              $this->form_validation->set_rules('account', 'Bank Account', 'xss_clean|numeric');

              if ($this->form_validation->run() == FALSE)
              {
                $this->load_new_supplier();

              }
              else
              {
                //parse the variables
                $pin=$this->input->post('pin');
                $sname=$this->input->post('sname');
                $regDate=date('Y-m-d', strtotime($this->input->post('sdate')));
                $bparticulars=$this->input->post('particulars');
                $bacount=$this->input->post('account');
                $phone = $this->input->post('phone');
                $address=$this->input->post('address');
                $notes=$this->input->post('notes');
                $email=$this->input->post('email');

               $supplierD=array(
               'Pin'=>$pin,
               'Supplier_name'=>$sname,
               'Address'=>$address,
               'Phone'=>$phone,
               'Supplier_since'=>$regDate,
               'Bank_particulars'=>$bparticulars,
               'Bank_account'=>$bacount,
               'Email'=>$email,
               'Note'=>$notes
          );
            $this->purchase_model->save_supplier($supplierD);
            $this->session->set_flashdata('msg',  'record successfully saved');

            redirect('purchase/load_new_supplier','refresh');
 }
}
 function record_new_supplier_accounts()
     { 
 
          //validate the variables
            //TODO: parse the info
              $this->load->library('form_validation');
              $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
             
              $this->form_validation->set_rules('pin', 'Pin Number',  'required|alpha_numeric');
              $this->form_validation->set_rules('sname', 'Supplier name',  'required');
              $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
              $this->form_validation->set_rules('phone', 'Phone Number', 'required|min_length[10]|max_length[12]');
              $this->form_validation->set_rules('account', 'Bank Account', 'xss_clean|numeric');

              if ($this->form_validation->run() == FALSE)
              {
                $this->load_new_supplier();

              }
              else
              {
                //parse the variables
                $pin=$this->input->post('pin');
                $sname=$this->input->post('sname');
                $regDate=date('Y-m-d', strtotime($this->input->post('sdate')));
                $bparticulars=$this->input->post('particulars');
                $bacount=$this->input->post('account');
                $phone = $this->input->post('phone');
                $address=$this->input->post('address');
                $notes=$this->input->post('notes');
                $email=$this->input->post('email');

               $supplierD=array(
               'Pin'=>$pin,
               'Supplier_name'=>$sname,
               'Address'=>$address,
               'Phone'=>$phone,
               'Supplier_since'=>$regDate,
               'Bank_particulars'=>$bparticulars,
               'Bank_account'=>$bacount,
               'Email'=>$email,
               'Note'=>$notes
          );
            $this->purchase_model->save_supplier($supplierD);
            $this->session->set_flashdata('msg',  'record successfully saved');

            redirect('purchase/load_new_supplier_accounts','refresh');
 }
}
  //edit supplier details
       function edit_supplier_details()
        { 
         //parse the variables
            $pin=$this->input->post('pin');
            $sname=$this->input->post('sname');
            $regDate=$this->input->post('sdate');
            $bparticulars=$this->input->post('particulars');
            $bacount=$this->input->post('account');
            $phone = $this->input->post('phone');
            $address=$this->input->post('address');
            $notes=$this->input->post('notes');
            $email=$this->input->post('email');
        
             $this->data=array(
             'Pin'=>$pin,
             'Supplier_name'=>$sname,
             'Address'=>$address,
             'Phone'=>$phone,
             'Supplier_since'=>$regDate,
             'Bank_particulars'=>$bparticulars,
             'Bank_account'=>$bacount,
             'Email'=>$email,
             'Note'=>$notes
          );
          $this->purchase_model->update_supplier($this->data,$pin);
          $this->session->set_flashdata('msg',  'record successfully edited');
          redirect('purchase/load_edit_supplier/'.$pin,'refresh'); 
   
    
 }

 function edit_supplier_details_accounts()
        { 
         //parse the variables
            $pin=$this->input->post('pin');
            $sname=$this->input->post('sname');
            $regDate=$this->input->post('sdate');
            $bparticulars=$this->input->post('particulars');
            $bacount=$this->input->post('account');
            $phone = $this->input->post('phone');
            $address=$this->input->post('address');
            $notes=$this->input->post('notes');
            $email=$this->input->post('email');
        
             $this->data=array(
             'Pin'=>$pin,
             'Supplier_name'=>$sname,
             'Address'=>$address,
             'Phone'=>$phone,
             'Supplier_since'=>$regDate,
             'Bank_particulars'=>$bparticulars,
             'Bank_account'=>$bacount,
             'Email'=>$email,
             'Note'=>$notes
          );
          $this->purchase_model->update_supplier($this->data,$pin);
          $this->session->set_flashdata('msg',  'record successfully edited');
          redirect('purchase/load_edit_supplier_accounts/'.$pin,'refresh'); 
   
    
 }

 //creating a new purchase  order
 //TODO: load the purchase order screen
    function  new_purchase_order(){
          $this->data['title'] = 'New Purchase Order'; 
          $this->data['purchaseID']=$this->purchase_model->generate_purchaseid(); 
         
          $this->render_page('purchases/new_order', $this->data);
    }
    //get the last purchase order number
    function generate_purchase_number(){
      $this->purchase_model->generate_purchaseid();
    }
 //TODO: Create the purchase order - insert into purchase order and purchase order lines
 //                                - status changes to pending
  
 //add the purchase line to the order
   function add_to_cart(){

           //validate variables 
          $this->load->library('form_validation');
          $this->form_validation->set_rules('product', 'Product name', 'required');
          $this->form_validation->set_rules('qty', 'Quantity', 'required|numeric');
        
          if ($this->form_validation->run() == FALSE)
          {
            $this->new_purchase_order();

          }
          else
          {
          //parse the variables
           $product = $this->input->post('product');
           $price =$this->input->post('price');
           $pcode =$this->input->post('pcode');
           $unit=$this->input->post('unit');
           $psku=$this->purchase_model->get_sku($product);
           $no=$this->input->post('code');
           $sname = $this->input->post('agent');
           $name = $this->input->post('supplier');
           $edate=$this->input->post('edate');
           //record the purchase data into a session
           $this->session->set_userdata("orderNo","$no");
           $this->session->set_userdata("user","$sname");
           $this->session->set_userdata("supplier","$name");
           $this->session->set_userdata("expected","$edate");
           $quantity= $this->input->post('qty');
           $this->data = array(
                     'id'      =>$psku,
                     'qty'     => $quantity,
                     'price'   => $price,
                     'name'    => $product,    
                     'options' => array('code'=>$pcode)
           );

          $this->cart->insert($this->data);//insert the purchase line into the order
          $this->new_purchase_order();//return to the purchase screen to add more items
        }
      }
  //updating a purchase line in the purchase order
     function cart_update() {
            $key = $this->input->post('rowToken');
            $qtyValue = $this->input->post('updateQty');
            $this->data = array(
              'rowid' => $key,
              'qty' => $qtyValue
            );
            
             $this->cart->update($this->data);
             $this->new_purchase_order();
        }

   function cart_unset() {
    
    $this->cart->destroy();
    
  }
//remove item from the purchase order
  function remove_item($rowid) {
          if ($rowid=="all"){
            $this->cart->destroy();
           }else{
            $this->data = array(
              'rowid'   => $rowid,
              'qty'     => 0
            );

            $this->cart->update($this->data);
          }
          
          redirect('purchase/new_purchase_order');
        } 
 //cancel the whole purchase order
  function cart_empty() {
            $this->cart->destroy();
            $this->new_purchase_order();
          }

  function create_purchase_request(){

           //validate variables 
          $this->load->library('form_validation');
          $this->form_validation->set_rules('supplier', 'Supplier name', 'required');
                
          if ($this->form_validation->run() == FALSE)
          {
            $this->new_purchase_order();
          
          }
          else
          {
          //parse the variables
            $orderNo=$this->purchase_model->generate_purchaseid(); 
            $agent = $this->input->post('agent');
            $supplier = $this->input->post('supplier');
            $cartTotal=$this->input->post('total');
            $edate=date('Y-m-d', strtotime($this->input->post('ex_date')));
            $date=date('Y-m-d');
            
              if ($cart = $this->cart->contents()):
                foreach ($cart as $item):
                      foreach ($this->cart->product_options($item['rowid']) as $option_name => $option_value): 

                                $code=$option_value; //get the option values
                                
                            endforeach; 
                 //create the purchase lines array
                  $purchase_items = array(
                             'Order_no'=>$orderNo,
                             'Supplier'=>$supplier,
                             'Date_ordered' =>$date,
                             'Delivery_date' =>$edate,
                             'Product' =>$item['name'],
                             'Qty'=> $item['qty'],
                             'Unit'=>'pieces',
                             'Received'=>'0',
                             'Unit_cost'=>$item['price'],
                             'Total_price'=>$item['subtotal'],
                             'Note'=>'purchase item'
                  );    
                  $unit='pieces';
                  $this->purchase_model->insert_purchase_items($purchase_items);
                  $this->purchase_model->update_inventory($item['name'],$item['qty'],$unit,$code,$item['price']);
                endforeach;
              endif;
                  
           //Prepare purchase order Details for saving
              $status='pending'; //the status remains pending until the order is authorized
              $order_data=array(
                   'Order_no'=>$orderNo,
                   'Supplier'=>$supplier,
                   'Date_created'=>$date,
                   'Status'=>$status,
                   'Total_value'=>$cartTotal
                   );

              $this->purchase_model->insert_order_summary($order_data);
              $array_items = array( 'supplier' => '','expected' =>'');//unset the order details
              $this->session->unset_userdata($array_items);
              $this->cart_unset();  //unset the order items
              $this->session->set_flashdata('msg', 'Purchase order request sent');
              redirect('purchase/new_purchase_order','refresh');
              
          } 
    }
 //TODO: Load the purchase order screen for authorization
 /*
   *allow for authorization */
  function load_approve_purchase_order($d)
      {  
            
              $this->data['title'] = 'Approve Purchase order';
              $this->data['row']=$this->purchase_model->get_this_purchase_order_details($d)->row();//get the order details data
              $this->data['product_data']=$this->purchase_model->get_this_purchase_order_items($d);//get the purchase order items data
              $this->data['tprice_data']=$this->purchase_model-> get_this_purchase_order_total($d);//get the purchase order total
              $this->render_page('purchases/confirm_order', $this->data);
      }
 function get_rejection($d)
  {  
        
              $this->data['title'] = 'Approve Purchase order';
              $this->data['order']=$this->purchase_model->get_this_purchase_order_details($d);//get the order details data
              $this->data['product_data']=$this->purchase_model->get_this_purchase_order_items($d);//get the purchase order items data
              $this->data['tprice_data']=$this->purchase_model-> get_this_purchase_order_total($d);//get the purchase order total
              $this->data['main_content'] = 'purchases/reject_order';
              $this->load->view('includes/template', $this->data);
  }
   function approve_pending_order($id)
      {  
            $status='processed';
            $update_data=array('status'=>$status);
            $this->purchase_model->confirm_order_summary($update_data,$id);
            $this->session->set_flashdata('msg', 'You have successfully approved this order');
            redirect('purchase/load_approve_purchase_order/'.$id, 'refresh'); 
      }
     /*allow for cancellation/rejection*/

   function cancel_pending_order($id)
      {  
          
            $status='cancelled';
            $order_data=array('Status'=>$status);
            $this->purchase_model->cancel_order_summary($order_data,$id);
            $this->session->set_flashdata('msg', 'this order has been cancelled');
            redirect('purchase/load_approve_purchase_order/'.$id, 'refresh');  
      }

   /*once authorized the order is ready to print*/
 function load_purchase_order_print($no){
              $this->data['title'] = 'Print Purchase order';
              $this->data['order']=$this->purchase_model->get_this_purchase_order_details($d);//get the order details data
              $this->data['product_data']=$this->purchase_model->get_this_purchase_order_items($d);//get the purchase order items data
              $this->data['tprice_data']=$this->purchase_model-> get_this_purchase_order_total($d);//get the purchase order total
              $this->data['main_content'] = 'purchase/print_purchase_order';
              $this->load->view('includes/template', $this->data); 
    }
 
 /*Receiving purchase order
  //load all approved purchase orders */
   function load_incoming_stock()
      { 
        $this->data['title'] = 'Incoming Purchases';
        $this->data['incoming']=$this->purchase_model->get_purchase_orders();
        $this->data['main_content'] = 'purchases/expected';
        $this->load->view('includes/template', $this->data);
      }
    
 /*Load the GRN screen*/
function load_grn($d)
      {  
            $this->data['title'] = 'Goods Received Note';
            $this->data['row']=$this->purchase_model->get_this_purchase_order_details($d)->row();//get the order details data;
            $this->data['pData']=$this->purchase_model->get_items_received($d);
            $this->data['tprice_data']=$this->purchase_model->get_this_purchase_order_total($d);//get the purchase order total
            $this->render_page('purchases/receive_order', $this->data);
      }
 /*Allow for items to be added to the stock*/
 function add_to_inventory(){
  //parse form variables
    $product = $this->input->post('product');
    $cat=$this->purchase_model->get_cat($product);
    $id=$this->input->post('code');
    $name="Purchase of goods";
    $amount=$this->input->post('value');
    $quantity= $this->input->post('updateQty');
    $note=$this->input->post('description');
    $date=date('Y-m-d');
    $this->purchase_model->add_incoming_stock($product,$quantity,$cat);
    $this->purchase_model->update_incoming_order($product,$quantity,$id,$note);//Affect the purchase order
    //$this->purchase_model->update_inventory($product,$quantity,$unit);
     $this->data_debit=array(
             'Reference'=>$id,
             'Account_name'=>'Purchases',
             'Description'=>$name,
             'T_date'=>$date,
             'Amount'=>$amount,
             'Type'=>'Cost of goods',
             'Debit'=>$amount
            );
          $this->purchase_model->insert_transaction($this->data_debit);
          $this->data_credit=array(
             'Reference'=>$id,
             'Account_name'=>'Accounts payable',
             'Description'=>$name,
             'T_date'=>$date,
             'Amount'=>$amount,
             'Type'=>'Liabilities',
             'Credit'=>$amount
            );
          $this->purchase_model->insert_transaction($this->data_credit);  
     $this->load_grn($id);
   
   }
 
 /*create the GRN receipt view*/
  function load_grn_print($d)
      {  
            $this->data['title'] = 'Goods Received Note Receipt';
            $this->data['order']=$this->purchase_model->get_this_purchase_order_details($d);//get the order details data;
            $this->data['pData']=$this->purchase_model->get_each_purchase_orderd($d);
            $this->data['tprice_data']=$this->purchase_model->get_items_received($d);//get the purchase order total
            $this->data['main_content'] = 'purchase/grn_receipt';
            $this->load->view('includes/template', $this->data);
      }
 /*Post to the books
   *Debit the inventory account*/
 function debit_inventory_account($id){
     $this->data=array('Reference'=>'',
                 'Account_name'=>'purchase',
                 'Description'=>'',
                 'T_date'=>'',
                 'Amount'=>'',
                 'Type'=>'',
                 'Debit'=>'',
                 'Credit'=>'');
     $this->purchase_model->record_this_transaction();
   }
   /*Credit the accounts payable
   */
   function credit_accounts_payable($id){
     $this->data=array('Reference'=>'',
                 'Account_name'=>'accounts_payable',
                 'Description'=>'',
                 'T_date'=>'',
                 'Amount'=>'',
                 'Type'=>'',
                 'Debit'=>'',
                 'Credit'=>'');
     $this->purchase_model->record_this_transaction();
   }
//load the products in the autocomplete of the purchase order
  function load_product()
    {
      if (isset($_GET['term'])){
        $q = strtolower($_GET['term']);
        $this->purchase_model->get_products($q);
      }
    }
  function load_supplier(){
   if (isset($_GET['term'])){
      $q = strtolower($_GET['term']);
      $this->purchase_model->get_suppliers($q);
    }
  }
 
 //load supplier invoices
  function get_unpaid_purchase_orders()
  { 
        $this->data['title'] = 'Unpaid Supplier Invoices';
        $this->data['purchase_data']=$this->purchase_model->get_unpaid_porders();
        $this->data['main_content'] = 'purchases/unpaid';
        $this->load->view('includes/template', $this->data);
  }
    function get_unpaid_purchase_orders_accounts()
  { 
        $this->data['title'] = 'Unpaid Supplier Invoices';
        $this->data['purchase_data']=$this->purchase_model->get_unpaid_porders();
        $this->data['main_content'] = 'purchases/unpaid_accounts';
        $this->load->view('includes/template', $this->data);
  }
  //pay supplier

  function each_order_payment($d)
    {  
         $this->data['title'] = 'Pay Supplier Invoices'; 
         $this->data['row']=$this->purchase_model->get_this_purchase_order_details($d)->row();//get the order details data;
         $this->data['pData']=$this->purchase_model->get_items_received($d);
         $this->data['tprice_data']=$this->purchase_model->get_this_purchase_order_total($d);//get the purchase order total
         $this->render_page('purchases/pay_supplier', $this->data);
    }
      function each_order_payment_accounts($d)
    {  
         $this->data['title'] = 'Pay Supplier Invoices'; 
         $this->data['order']=$this->purchase_model->get_this_purchase_order_details($d);//get the order details data;
         $this->data['pData']=$this->purchase_model->get_items_received($d);
         $this->data['tprice_data']=$this->purchase_model->get_this_purchase_order_total($d);//get the purchase order total
         $this->data['main_content'] = 'purchases/pay_supplier_accounts';
         $this->load->view('includes/template', $this->data);
    }
     public function update_order(){
       
          $name=$this->input->post('supplier');
          $orderNo=$this->input->post('orderno');
          $amountpaid = $this->input->post('amount');
          $init = $this->input->post('initial');
          $paid=$this->input->post('paid');
          $mode = $this->input->post('mode');
          $notes = $this->input->post('description');
          $refno= $this->input->post('refno');
           $ref_no= $this->input->post('ref_no');
          $initial=($init-$paid);
           $total=($paid+$amountpaid);
          $balance=($init-$total);
         
          $datevalue=$this->input->post('paydate');
          $date=date('Y-m-d',strtotime($datevalue));
          $type='purchase';

            $payment_data=array(
             'Amount_paid'=>$total,
             'Balance'=>$balance,
             //'Payment_Type'=>$mode,
             'Date_paid'=>$date,
             'Reference'=>$refno,
             'Note'=>$notes
             
          );
          $sdata=array(
             'Supplier_name'=>$name,
             'Payment_Type'=>$mode,
             'Order_no'=>$orderNo,
             'Amount'=>$amountpaid,
             'Date_paid'=>$date,
             'Note'=>$notes,
             'Bank_particulars'=>$refno,
             'Bank_no'=>$ref_no,
          );

          if($this->purchase_model->insert_pay_transaction($sdata)==TRUE){  
         // $this->purchase_model->insert_transaction($this->data_credit);  
          $this->purchase_model->update_order_summary($payment_data,$orderNo);
           $this->session->set_flashdata('msg',  'payment successfully added');
          }
          redirect('purchase/view_this_order/'.$orderNo, 'refresh');

    
          ///print the payment receipt
    }
      public function update_order_accounts(){
          
                  //validate variables 
          $this->load->library('form_validation');
          $this->form_validation->set_rules('refno', 'Cheque number', 'required|numeric');
          $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
        
          if ($this->form_validation->run() == FALSE)
          {
            $this->each_order_payment($this->input->post('orderno'));

          }
          else
          {
          $name=$this->input->post('supplier');
          $orderNo=$this->input->post('orderno');
          $amountpaid = $this->input->post('amount');
          $init = $this->input->post('initial');
          $paid=$this->input->post('paid');
          $mode = $this->input->post('mode');
          $notes = $this->input->post('description');
          $refno= $this->input->post('refno');
          $initial=($init-$paid);
          $balance=($initial-$amountpaid);
          $total=($paid+$amountpaid);
          $datevalue=$this->input->post('paydate');
          $date=date('Y-m-d',strtotime($datevalue));
          $type='purchase';

            $payment_data=array(
             'Amount_paid'=>$total,
             'Balance'=>$balance,
             //'Payment_Type'=>$mode,
             'Date_paid'=>$date,
             'Reference'=>$refno,
             'Note'=>$notes
             
          );
              $this->data_debit=array(
             'Reference'=>$orderNo,
             'Account_name'=>'Accounts payable',
             'Description'=>$name,
             'T_date'=>$date,
             'Amount'=>$amountpaid,
             'Type'=>'Liabilities',
             'method'=>'Bank',
             'Debit'=>$amountpaid
            );
          $this->purchase_model->insert_transaction($this->data_debit);
          $this->data_credit=array(
             'Reference'=>$orderNo,
             'Account_name'=>'Bank',
             'Description'=>$name,
             'T_date'=>$date,
             'Amount'=>$amountpaid,
             'Type'=>'Assets',
             'method'=>'Bank',
             'Credit'=>$amountpaid
            );
          $this->purchase_model->insert_transaction($this->data_credit);  
          $this->purchase_model->update_order_summary($payment_data,$orderNo);
          $this->load_payment_invoice_accounts($orderNo);

        }
          ///insert into supllier payments

          ///print the payment receipt
    }
      function load_payment_invoice($d)
      {  
            
               $this->data['title'] = 'Pay Supplier Invoice'; 
               $this->data['order']=$this->purchase_model->get_this_purchase_order_details($d);//get the order details data;
               $this->data['pData']=$this->purchase_model->get_items_received($d);
               $this->data['tprice_data']=$this->purchase_model->get_this_purchase_order_total($d);//get the purchase order total  $this->data['main_content'] = 'purchases/pay_receipt';
               $this->data['main_content'] = 'purchases/pay_receipt';
               $this->load->view('includes/no_template', $this->data);
      }
        function load_payment_invoice_accounts($d)
      {  
            
               $this->data['title'] = 'Pay Supplier Invoice'; 
               $this->data['order']=$this->purchase_model->get_this_purchase_order_details($d);//get the order details data;
               $this->data['pData']=$this->purchase_model->get_items_received($d);
               $this->data['tprice_data']=$this->purchase_model->get_this_purchase_order_total($d);//get the purchase order total  $this->data['main_content'] = 'purchases/pay_receipt';
               $this->data['main_content'] = 'purchases/pay_receipt_Accounts';
               $this->load->view('includes/notemplate', $this->data);
      }

      public function supplierpin_taken()
        {
        $spin = trim($_POST['spin']);
        // if the supplierpin exists echo a '1' indicating true
        if ($this->purchase_model->supplierpin_exists($spin)) {
          echo '1';
        }
    }


      public function suppliername_taken()
        {
        $sname = trim($_POST['sname']);
        // if the supplierpin exists echo a '1' indicating true
        if ($this->purchase_model->suppliername_exists($sname)) {
          echo '1';
        }
    }
/*Adjusting Stock
*load the adjust stock screen
*load the new adjust request screen
*create the adjust stock request
*load the adjust stock request
*create the approval of adjusting stock request
*if approved 
        *affect the inventory
        *credit the inventory
        *Debit  the product cost account

*if disapproved affect nothing
*/

/*Buying and Monitoring sales
  *load the new expense screen
  *record the new expense into the journal
    *Debit the expense account
    *credit the cash account
  *create the expense receipt view
*/

   //display register new purchase order for the store manager
   function new_purchase_order_store()
    { 
          $this->data['title'] = 'New Purchase Order';
          $this->data['main_content'] = 'purchases/new_order_store';
          $this->load->view('includes/template', $this->data);

    }

    function record_new_supplier_store()
     { 
 
          //validate the variables
            //TODO: parse the info
              $this->load->library('form_validation');
              $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
             
              $this->form_validation->set_rules('pin', 'Pin Number',  'required|alpha_numeric');
              $this->form_validation->set_rules('sname', 'Supplier name',  'required');
              $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
              $this->form_validation->set_rules('phone', 'Phone Number', 'required|min_length[10]|max_length[12]');
              $this->form_validation->set_rules('account', 'Bank Account', 'xss_clean|numeric');

              if ($this->form_validation->run() == FALSE)
              {
                $this->load_new_supplier();

              }
              else
              {
                //parse the variables
                $pin=$this->input->post('pin');
                $sname=$this->input->post('sname');
                $regDate=date('Y-m-d', strtotime($this->input->post('sdate')));
                $bparticulars=$this->input->post('particulars');
                $bacount=$this->input->post('account');
                $phone = $this->input->post('phone');
                $address=$this->input->post('address');
                $notes=$this->input->post('notes');
                $email=$this->input->post('email');

               $supplierD=array(
               'Pin'=>$pin,
               'Supplier_name'=>$sname,
               'Address'=>$address,
               'Phone'=>$phone,
               'Supplier_since'=>$regDate,
               'Bank_particulars'=>$bparticulars,
               'Bank_account'=>$bacount,
               'Email'=>$email,
               'Note'=>$notes
          );
            $this->purchase_model->save_supplier($supplierD);
            $this->session->set_flashdata('msg',  'record successfully saved');

            redirect('purchase/load_new_supplier_store','refresh');
 }
}

 function edit_supplier_details_store()
        { 
         //parse the variables
            $pin=$this->input->post('pin');
            $sname=$this->input->post('sname');
            $regDate=$this->input->post('sdate');
            $bparticulars=$this->input->post('particulars');
            $bacount=$this->input->post('account');
            $phone = $this->input->post('phone');
            $address=$this->input->post('address');
            $notes=$this->input->post('notes');
            $email=$this->input->post('email');
        
             $this->data=array(
             'Pin'=>$pin,
             'Supplier_name'=>$sname,
             'Address'=>$address,
             'Phone'=>$phone,
             'Supplier_since'=>$regDate,
             'Bank_particulars'=>$bparticulars,
             'Bank_account'=>$bacount,
             'Email'=>$email,
             'Note'=>$notes
          );
          $this->purchase_model->update_supplier($this->data,$pin);
          $this->session->set_flashdata('msg',  'record successfully edited');
          redirect('purchase/load_edit_supplier_store/'.$pin,'refresh'); 
   
    
 }
  function add_to_cart_store(){

           //validate variables 
          $this->load->library('form_validation');
          $this->form_validation->set_rules('product', 'Product name', 'required');
          $this->form_validation->set_rules('qty', 'Quantity', 'required|numeric');
        
          if ($this->form_validation->run() == FALSE)
          {
            $this->new_purchase_order_store();

          }
          else
          {
          //parse the variables
           $product = $this->input->post('product');
           $price =$this->input->post('price');
           $unit=$this->input->post('unit');
           $psku=$this->purchase_model->get_sku($product);
           $no=$this->input->post('code');
           $sname = $this->input->post('agent');
           $name = $this->input->post('supplier');
           $edate=$this->input->post('edate');
           //record the purchase data into a session
           $this->session->set_userdata("orderNo","$no");
           $this->session->set_userdata("user","$sname");
           $this->session->set_userdata("supplier","$name");
           $this->session->set_userdata("expected","$edate");
           $quantity= $this->input->post('qty');
           $this->data = array(
                     'id'      =>$psku,
                     'qty'     => $quantity,
                     'price'   => $price,
                     'name'    => $product,    
                     'options' => array('Unit' => $unit)
           );

          $this->cart->insert($this->data);//insert the purchase line into the order
          $this->new_purchase_order_store();//return to the purchase screen to add more items
        }
      }
function create_purchase_request_store(){

           //validate variables 
          $this->load->library('form_validation');
          $this->form_validation->set_rules('supplier', 'Supplier name', 'required');
                
          if ($this->form_validation->run() == FALSE)
          {
            $this->new_purchase_order_store();
          
          }
          else
          {
          //parse the variables
           $orderNo=$this->purchase_model->generate_purchaseid(); 
            $agent = $this->input->post('agent');
            $supplier = $this->input->post('supplier');
            $cartTotal=$this->input->post('total');
            $edate=$this->input->post('ex_date');
            $date=date('Y-m-d');
            
              if ($cart = $this->cart->contents()):
                foreach ($cart as $item):
                      foreach ($this->cart->product_options($item['rowid']) as $option_name => $option_value): 

                                $unit=$option_value; //get the option values

                            endforeach; 
                 //create the purchase lines array
                  $purchase_items = array(
                             'Order_no'=>$orderNo,
                             'Supplier'=>$supplier,
                             'Date_ordered' =>$date,
                             'Delivery_date' =>$edate,
                             'Product' =>$item['name'],
                             'Qty'=> $item['qty'],
                             'Unit'=>$unit,
                             'Unit_cost'=>$item['price'],
                             'Total_price'=>$item['subtotal']
                  );    

                  $this->purchase_model->insert_purchase_items($purchase_items);
                  $this->purchase_model->update_inventory($item['name'],$item['qty'],$unit,$item['price']);
                endforeach;
              endif;
                  
           //Prepare purchase order Details for saving
              $status='pending'; //the status remains pending until the order is authorized
              $order_data=array(
                   'Order_no'=>$orderNo,
                   'Supplier'=>$supplier,
                   'Date_created'=>$date,
                   'Status'=>$status,
                   'Total_value'=>$cartTotal
                   );

              $this->purchase_model->insert_order_summary($order_data);
              $array_items = array('supplier' => '','expected' =>'');//unset the order details
              $this->session->unset_userdata($array_items);
              $this->cart_unset();  //unset the order items
              $this->session->set_flashdata('msg', 'Purchase order request sent');
              redirect('purchase/new_purchase_order_store','refresh');
              
          } 
    }
         function cart_update_store() {
            $key = $this->input->post('rowToken');
            $qtyValue = $this->input->post('updateQty');
            $this->data = array(
              'rowid' => $key,
              'qty' => $qtyValue
            );
            
             $this->cart->update($this->data);
             $this->new_purchase_order();
        }

      function set_approved_purchase_order_list(){
          $this->data['title'] = 'Approved Purchase Orders';
          $this->data['purchase_data']=$this->purchase_model->get_approved_purchase_orders(); 
          $this->data['main_content'] = 'purchases/approved_purchase_orders';
          $this->load->view('includes/template', $this->data);
      }
     
      function set_approved_purchase_order_list_accounts(){
          $this->data['title'] = 'Approved Purchase Orders';
          $this->data['purchase_data']=$this->purchase_model->get_approved_purchase_orders(); 
          $this->data['main_content'] = 'purchases/approved_purchase_orders_accounts';
          $this->load->view('includes/template', $this->data);
      }

      function set_approved_purchase_order_list_store(){
          $this->data['title'] = 'Approved Purchase Orders';
          $this->data['purchase_data']=$this->purchase_model->get_approved_purchase_orders(); 
          $this->data['main_content'] = 'purchases/approved_purchase_orders_store';
          $this->load->view('includes/template', $this->data);
      }
      function set_received_purchase_order_list(){
          $this->data['title'] = 'Received Purchase Orders';
          $this->data['purchase_data']=$this->purchase_model->get_received_purchase_orders(); 
          $this->data['main_content'] = 'purchases/received_purchase_orders';
          $this->load->view('includes/template', $this->data);
      }

      function view_this_approved_purchase_order($id){
          $this->data['title'] = 'This Purchase Order';
          $this->data['purchase_data']=$this->purchase_model->get_this_approved_purchase_order($id); 
          $this->data['purchase_total']=$this->purchase_model->get_this_approved_purchase_order_total($id); 
          $this->data['main_content'] = 'purchases/purchase_order';
          $this->load->view('includes/no_template', $this->data);
      }
      function view_this_approved_purchase_order_accounts($id){
          $this->data['title'] = 'This Purchase Order';
          $this->data['purchase_data']=$this->purchase_model->get_this_approved_purchase_order($id); 
          $this->data['purchase_total']=$this->purchase_model->get_this_approved_purchase_order_total($id); 
          $this->data['main_content'] = 'purchases/purchase_order_accounts';
          $this->load->view('includes/no_template', $this->data);
      }
         function view_this_approved_purchase_order_store($id){
          $this->data['title'] = 'This Purchase Order';
          $this->data['purchase_data']=$this->purchase_model->get_this_approved_purchase_order($id); 
          $this->data['purchase_total']=$this->purchase_model->get_this_approved_purchase_order_total($id); 
          $this->data['main_content'] = 'purchases/purchase_order_store';
          $this->load->view('includes/no_template', $this->data);
      }
        function view_this_received_purchase_order($id){
          $this->data['title'] = 'This Purchase Order';
          $this->data['purchase_data']=$this->purchase_model->get_this_received_purchase_order($id); 
          $this->data['purchase_total']=$this->purchase_model->get_this_received_purchase_order_total($id); 
          $this->data['main_content'] = 'purchases/purchase_order';
          $this->load->view('includes/no_template', $this->data);
      }
      function view_this_order($id){
             $this->data['title'] = 'This Purchase order';
              $this->data['row']=$this->purchase_model->get_this_purchase_order_details($id)->row();//get the order details data
              $this->data['product_data']=$this->purchase_model->get_this_purchase_order_items($id);//get the purchase order items data
              $this->data['tprice_data']=$this->purchase_model-> get_this_purchase_order_total($id);//get the purchase order total
              $this->render_page('purchases/this_order', $this->data);
      }
         function view_order_payments($id){
             $this->data['title'] = 'This Purchase order';
              $this->data['row']=$this->purchase_model->get_this_purchase_order_details($id)->row();//get the order details data
              $this->data['pay']=$this->purchase_model->getPayments($id);//get the purchase order items data
              $this->data['tprice_data']=$this->purchase_model-> get_this_purchase_order_total($id);//get the purchase order total
              $this->render_page('purchases/order_payments', $this->data);
      }
      //load supplier invoices
  function get_unpaid_supplier_report()
  { 
        $this->data['title'] = 'Unpaid Supplier Report';
        $this->data['purchase_data']=$this->purchase_model->get_unpaid_porders();
        $this->data['purchase_total']=$this->purchase_model->get_unpaid_porders_total();
        $this->data['main_content'] = 'purchases/unpaid_report';
        $this->load->view('includes/no_template', $this->data);
  }
  //load supplier invoices
  function get_paid_purchase_orders()
  { 
        $this->data['title'] = 'Unpaid Supplier Invoices';
        $this->data['purchase_data']=$this->purchase_model->get_paid_porders();
        $this->data['main_content'] = 'purchases/paid';
        $this->load->view('includes/template', $this->data);
  }
   function printOrder($id){
             $this->data['title'] = 'This Purchase order';
              $this->data['row']=$this->purchase_model->get_this_purchase_order_details($id)->row();//get the order details data
              $this->data['product_data']=$this->purchase_model->get_this_purchase_order_items($id);//get the purchase order items data
              $this->data['tprice_data']=$this->purchase_model-> get_this_purchase_order_total($id);//get the purchase order total
              $this->load->view('purchases/print', $this->data);
      }
   
}