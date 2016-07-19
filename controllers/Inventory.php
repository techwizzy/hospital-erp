<?php

class Inventory extends MY_Controller 
{


	 public function __construct()
    {

	      parent::__construct();
        $this->data['site_name'] = $this->config->item( 'site_name' ); 
        $this->load->model('inventory_model');
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
   //display register inventory view
   function index()
    { 
          $this->data['title'] = 'Inventory'; 
          $this->data['main_content'] = 'inventory/new_product_category';
          $this->load->view('includes/template', $this->data);

    }
    //load new product cateory store
      function new_product_category_store()
       { 
          $this->data['title'] = 'Inventory'; 
          $this->data['main_content'] = 'inventory/new_store_product_category';
          $this->load->view('includes/template', $this->data);

      }
       function load_dashboard()
    { 
          $this->data['title'] = 'Inventory'; 
          $this->data['main_content'] = 'inventory/dashboard';
          $this->data['stock_total']=$this->inventory_model->get_stock_total();
          $this->data['stock']=$this->inventory_model->get_stock();
          $this->data['requests']=$this->inventory_model->get_refunds();
          $this->load->view('includes/graphtemplate', $this->data);
   }
    
    // list all product categories
    function load_productCategories()
    { 

          $this->data['title'] = 'Categories'; 
           $this->data['categorydata']=$this->inventory_model->get_category();
          $this->data['main_content'] = 'inventory/category_list';
          $this->load->view('includes/table_template', $this->data);

    }
    
    // add new product to the inventory
    function new_products()
    { 
          $this->data['categorydata']=$this->inventory_model->get_category();
          $this->data['productdata']=$this->inventory_model->get_allProducts();
          $this->data['title'] = 'Products'; 
          $this->render_page('inventory/new_product', $this->data);

    }
        function new_services()
    { 
          $this->data['categorydata']=$this->inventory_model->get_category();
          $this->data['productdata']=$this->inventory_model->get_allProducts();
          $this->data['title'] = 'services'; 
          $this->render_page('inventory/new_service', $this->data);

    }
   
    // list all products
    function productList()
    { 
          $this->data['title'] = 'List of Products'; 
          $this->data['productdata']=$this->inventory_model->get_allProducts();
          $this->data['categorydata']=$this->inventory_model->get_category();
          $this->render_page('inventory/product_list', $this->data);

    }
        function serviceList()
    { 
          $this->data['title'] = 'List of services'; 
          $this->data['productdata']=$this->inventory_model->get_allServices();
          $this->data['categorydata']=$this->inventory_model->get_category();
          $this->render_page('inventory/service_list', $this->data);

    }
     
    //edit product category
     function edit_category($id)
    { 
          $this->data['title'] = 'Edit Category'; 
          $this->data['categorydata']=$this->inventory_model->get_this_category($id);
          $this->data['main_content'] = 'inventory/edit_category';
          $this->load->view('includes/template', $this->data);

    }
     
    // edit product details
    function edit_product($id)
    { 
          $this->data['title'] = 'Edit Product'; 
           $this->data['categorydata']=$this->inventory_model->get_category();
           $this->data['row']=$this->inventory_model->get_this_product($id)->row();
           $this->render_page('inventory/edit_product', $this->data);
 
    }
    function edit_service($id)
    { 
          $this->data['title'] = 'Edit Service'; 
           $this->data['categorydata']=$this->inventory_model->get_category();
           $this->data['row']=$this->inventory_model->get_this_service($id)->row();
          $this->render_page('inventory/edit_service', $this->data);

    }
   
  
  //load all approved purchase orders */
   function load_incoming_stock()
      { 
        $this->data['title'] = 'Incoming Purchases';
        $this->data['incoming']=$this->inventory_model->get_purchase_orders();
        $this->data['main_content'] = 'inventory/expected';
        $this->load->view('includes/template', $this->data);
      }
    //load all approved purchase orders */
   function load_incoming_stock_store()
      { 
        $this->data['title'] = 'Incoming Purchases';
        $this->data['incoming']=$this->inventory_model->get_purchase_orders();
        $this->data['main_content'] = 'inventory/expected_store';
        $this->load->view('includes/template', $this->data);
      }

  //adjsutment screen
     function load_adjustment_screen()
    {     $this->data['stock_total']=$this->inventory_model->get_stock_total();
          $this->data['stock']=$this->inventory_model->get_stock();
          $this->data['title'] = 'Counter Inventory'; 
          $this->data['main_content'] = 'inventory/adjustment_index';
          $this->load->view('includes/table_template', $this->data);

    }

  //adjsutment screen store
     function load_adjustment_screen_store()
    {     $this->data['stock_total']=$this->inventory_model->get_stock_total();
          $this->data['stock']=$this->inventory_model->get_stock();
          $this->data['title'] = 'Counter Inventory'; 
          $this->data['main_content'] = 'inventory/adjustment_index_store';
          $this->load->view('includes/table_template', $this->data);

    }
    //view all inventory products
     function load_inventory()
    { 
        $this->data['title'] = 'Master Inventory Report'; 
        $this->data['stock_total']=$this->inventory_model->get_stock_total();
        $this->data['stock']=$this->inventory_model->get_stock();
        $this->data['main_content'] = 'inventory/master_inventory';
        $this->load->view('includes/template', $this->data);

    }
  
 /*Load the GRN screen*/
function load_grn($d)
      {  
            $this->data['title'] = 'Goods Received Note';
            $this->data['order']=$this->inventory_model->get_this_purchase_order_details($d);//get the order details data;
            $this->data['pData']=$this->inventory_model->get_items_received($d);
            $this->data['tprice_data']=$this->inventory_model->get_this_purchase_order_total($d);//get the purchase order total
            $this->data['main_content'] = 'inventory/recieve_order';
            $this->load->view('includes/template', $this->data);
      }
   /*Load the GRN screen*/
function load_grn_store($d)
      {  
            $this->data['title'] = 'Goods Received Note';
            $this->data['order']=$this->inventory_model->get_this_purchase_order_details($d);//get the order details data;
            $this->data['pData']=$this->inventory_model->get_items_received($d);
            $this->data['tprice_data']=$this->inventory_model->get_this_purchase_order_total($d);//get the purchase order total
            $this->data['main_content'] = 'inventory/recieve_order_store';
            $this->load->view('includes/template', $this->data);
      }
 /*Allow for items to be added to the stock*/
 function add_to_invent(){
  //parse form variables
    $product = $this->input->post('product');
    $supplier= $this->input->post('supplier');
    $cat=$this->inventory_model->get_cat($product);
    $id=$this->input->post('code');
    $name="Purchase of goods";
    $amount=$this->input->post('value');
    $quantity= $this->input->post('updateQty');
    $note=$this->input->post('description');
    $date=date('Y-m-d');
    $this->inventory_model->add_incoming_stock($product,$quantity,$cat);
    $this->inventory_model->update_incoming_order($product,$quantity,$id,$note);//Affect the purchase order
   // $this->inventory_model->insert_transaction($this->data_credit);  
    redirect('purchase/load_grn/'.$id,'refresh');
   
   }
  
 
 /*create the GRN receipt view*/
  function load_grn_print($d)
      {  
            $this->data['title'] = 'Goods Received Note Receipt';
            $this->data['order']=$this->inventory_model->get_this_purchase_order_details($d);//get the order details data;
            $this->data['pData']=$this->inventory_model->get_items_already_received($d);
            $this->data['tprice_data']=$this->inventory_model->get_grn_total($d);;//get the purchase order total
            $this->data['main_content'] = 'inventory/grn_receipt';
            $this->load->view('includes/no_template', $this->data);
      }
 
    //autofill adjustment details
    function load_stock_details($id){
  $this->data['stock']=$this->inventory_model->get_stock_data($id);
   $this->data['main_content'] = 'inventory/adjust';
   $this->load->view('includes/template', $this->data);
}
    //autofill adjustment details
    function load_stock_details_store($id){
  $this->data['stock']=$this->inventory_model->get_stock_data($id);
   $this->data['main_content'] = 'inventory/adjust_store';
   $this->load->view('includes/template', $this->data);
}
function load_adjustment_stock_request(){
  
   $this->data['main_content'] = 'inventory/adjustment_request';
   $this->load->view('includes/template', $this->data);
}
function adjust_request(){
            $orderno=$this->input->post('orderno');
            $product= $this->input->post('product');
            $qty= $this->input->post('updateQty');
            $date=date('Y-m-d');
            $status='pending';
            $user=$this->input->post('user');
            $note= $this->input->post('description');
         
             $this->data=array(
             'Order_no '=>$orderno,
             'Product_name'=>$product,
             'Qty'=>$qty,
             'Date_adjusted'=>$date,
             'Status'=>$status,
             'Requested_by'=>$user,
             'Note'=>$note,
             );
            $this->inventory_model->insert_defect_record($this->data);
             $this->session->set_flashdata('msg', 'You have successfully Sent Request to the manager <br/> to approve the removal of ' .$qty. 'pieces of'  .$product.  'from inventory');
          redirect('inventory/load_stock_details/'.$orderno, 'refresh'); 
           

}
function adjust_request_Store(){
            $orderno=$this->input->post('orderno');
            $product= $this->input->post('product');
            $qty= $this->input->post('updateQty');
            $date=date('Y-m-d');
            $status='pending';
            $user=$this->input->post('user');
            $note= $this->input->post('description');
         
             $this->data=array(
             'Order_no '=>$orderno,
             'Product_name'=>$product,
             'Qty'=>$qty,
             'Date_adjusted'=>$date,
             'Status'=>$status,
             'Requested_by'=>$user,
             'Note'=>$note,
             );
            $this->inventory_model->insert_defect_record($this->data);
             $this->session->set_flashdata('msg', 'You have successfully Sent Request to the manager <br/> to approve the removal of ' .$qty. 'pieces of'  .$product.  'from inventory');
          redirect('inventory/load_stock_details_store/'.$orderno, 'refresh'); 
           

}
public function load_adjust_requests_screen(){

        $this->data['stock']=$this->inventory_model->get_defect_requests();
        $this->data['main_content'] = 'inventory/approve_adjustment';
        $this->load->view('includes/template', $this->data);

  }

function load_adjust_request_details($id){
  $this->data['stock']=$this->inventory_model->get_defect_data($id);
   $this->data['main_content'] = 'inventory/approve_adjust';
   $this->load->view('includes/template', $this->data);
}
function load_reject_request_details($id){
  $this->data['stock']=$this->inventory_model->get_defect_data($id);
   $this->data['main_content'] = 'inventory/reject_adjust';
   $this->load->view('includes/template', $this->data);
}
function choose_counter_inventory()
  {         
            
           $id=$this->input->post('selected_counter');
           $this->data['counterdata']=$this->inventory_model->get_allCounters();
           $this->data['counterinventory']=$this->inventory_model->get_this_counterInventory($id);
            $this->data['main_content'] = 'inventory/chosen_counter';
            $this->load->view('includes/template', $this->data);
  }
function choose_counter_inventory_store()
  {         
            
           $id=$this->input->post('selected_counter');
           $this->data['counterdata']=$this->inventory_model->get_allCounters();
           $this->data['counterinventory']=$this->inventory_model->get_this_counterInventory($id);
            $this->data['main_content'] = 'inventory/chosen_counter_store';
            $this->load->view('includes/template', $this->data);
  }

  function choose_counter_inventory_cashier()
  {         
            
            $id=$this->input->post('selected_counter');
            //set session data for this counter
            $countername=$this->inventory_model->get_counter($id);
            $this->session->set_userdata("Counterbar","$countername");
            $this->session->set_userdata("Counter","$id");
            $this->data['counterdata']=$this->inventory_model->get_allCounters();
            $this->data['counterinventory']=$this->inventory_model->get_this_counterInventory($id);
            $this->data['main_content'] = 'inventory/chosen_counter_cashier';
            $this->load->view('includes/template', $this->data);
  }
    function counter_inventory_cashier($id)
  {         
            
            $this->data['counterdata']=$this->inventory_model->get_allCounters();
            $this->data['counterinventory']=$this->inventory_model->get_this_counterInventory($id);
            $this->data['main_content'] = 'inventory/chosen_counter_cashier';
            $this->load->view('includes/template', $this->data);
  }
   
  function add_newCategory(){
    
    $this->load->library('form_validation');
      //TODO: parse the info
    $this->form_validation->set_error_delimiters('<div style="color:red" class="alert alert-danger">', '</div>');

    $this->form_validation->set_rules('category', 'Category',  'required|alpha');
    

    if ($this->form_validation->run() == FALSE)
    {
      $this->index();
    }else{
       
      //TODO: load in array
      $this->data=array(
      'Category_name'=>$this->input->post('category'),
      'Note'=>$this->input->post('description')
       );
       $this->inventory_model->save_category($this->data);
      //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('category').  ' category record successfully saved');

       //TODO: refresh page
       redirect('inventory/index','refresh');
      }
     }
     function add_newCategory_store(){
    
    $this->load->library('form_validation');
      //TODO: parse the info
    $this->form_validation->set_error_delimiters('<div style="color:red" class="alert alert-danger">', '</div>');

    $this->form_validation->set_rules('category', 'Category',  'required|alpha');
    

    if ($this->form_validation->run() == FALSE)
    {
      $this->new_product_category_store();
    }else{
       
      //TODO: load in array
      $this->data=array(
      'Category_name'=>$this->input->post('category'),
      'Note'=>$this->input->post('description')
       );
       $this->inventory_model->save_category($this->data);
      //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('category').  ' category record successfully saved');

       //TODO: refresh page
       redirect('inventory/new_product_category_store','refresh');
      }
     }
     function edit_category_record(){
      
       $nid=$this->input->post('catid');
      //TODO: load in array
      $this->data=array(
      'Category_name'=>$this->input->post('catname'),
      'Note'=>$this->input->post('note')
      
      );
      //TODO: store in db
       $this->inventory_model->update_category_data($this->data,$nid);
        //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('catname'). ' record successfully edited');

       //TODO: refresh page
       redirect('inventory/edit_category/'.$nid,'refresh');
  }
  function edit_category_record_store(){
      
       $nid=$this->input->post('catid');
      //TODO: load in array
      $this->data=array(
      'Category_name'=>$this->input->post('catname'),
      'Note'=>$this->input->post('note')
      
      );
      //TODO: store in db
       $this->inventory_model->update_category_data($this->data,$nid);
        //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('catname'). ' record successfully edited');

       //TODO: refresh page
       redirect('inventory/edit_category_store/'.$nid,'refresh');
  }
  function add_newProduct()
     {
      $this->load->library('form_validation');
      //TODO: parse the info
    $this->form_validation->set_error_delimiters('<div style="color:red" class="alert alert-danger">', '</div>');

    $this->form_validation->set_rules('productname', 'Product name','required');
    $this->form_validation->set_rules('pcode', 'Product code','required|alpha_numeric');
    $this->form_validation->set_rules('sprice', 'Cost ','required|numeric');
   
    if ($this->form_validation->run() == FALSE)
    {
      $this->new_products();
    }else{
     
       $id=$this->input->post('product_id');
      //TODO: load in array
    $this->data=array(
      'Product_name'=>$this->input->post('productname'),
      'Code'=>$this->input->post('pcode'),
      'Category'=>$this->input->post('pcat'),
      'Type'=>$this->input->post('ptype'),
      'Sprice'=>$this->input->post('sprice'),
      'Reorder_level'=>$this->input->post('reorder'),
      'Notes'=>$this->input->post('notes')
      );
      
      //TODO: store in db
       $this->inventory_model->save_product($this->data);
 
      
         //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('productname'). ' record successfully saved');

       //TODO: refresh page
       redirect('inventory/new_products','refresh');
      }
     }
     function add_newService()
     {
      $this->load->library('form_validation');
      //TODO: parse the info
    $this->form_validation->set_error_delimiters('<div style="color:red"', '</div>');

    $this->form_validation->set_rules('productname', 'Product name','required');
    $this->form_validation->set_rules('pcode', 'Product code','required|alpha_numeric');
    $this->form_validation->set_rules('sprice', 'Cost ','required|numeric');
   
    if ($this->form_validation->run() == FALSE)
    {
      $this->new_services();
    }else{
     
       $id=$this->input->post('product_id');
      //TODO: load in array
    $this->data=array(
      'Product_name'=>$this->input->post('productname'),
      'item_code'=>$this->input->post('pcode'),
      'Type'=>$this->input->post('ptype'),
      'Selling_price'=>$this->input->post('sprice'),
      );
      
      //TODO: store in db
       $this->inventory_model->save_service($this->data);
 
      
         //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('productname'). ' record successfully saved');

       //TODO: refresh page
       redirect('inventory/new_services','refresh');
      }
     }
     function add_newProduct_store()
     {
      $this->load->library('form_validation');
      //TODO: parse the info
    $this->form_validation->set_error_delimiters('<div style="color:red" class="alert alert-danger">', '</div>');

    $this->form_validation->set_rules('productname', 'Product name','required');
    $this->form_validation->set_rules('pcode', 'Product code','required|alpha_numeric');
    $this->form_validation->set_rules('csize', 'Carton size','required|numeric');
    $this->form_validation->set_rules('reorder', 'Reorder Level','required|numeric');
    if ($this->form_validation->run() == FALSE)
    {
      $this->new_products_store();
    }else{
     
       $id=$this->input->post('product_id');
      //TODO: load in array
      $this->data=array(
      'Product_name'=>$this->input->post('productname'),
      'ProductImage'=>$this->input->post('picname'),
      'Code'=>$this->input->post('pcode'),
      'Category'=>$this->input->post('pcat'),
      'Carton_size'=>$this->input->post('csize'),
      'Bprice'=>$this->input->post('bprice'),
      'Vat'=>$this->input->post('vat'),
      'CL'=>$this->input->post('cl'),
      'Sprice'=>$this->input->post('sprice'),
      'Markup'=>$this->input->post('markup'),
      'Reorder_level'=>$this->input->post('reorder'),
      'Status'=>$this->input->post('status'),
      'Notes'=>$this->input->post('notes')
       

      );
      
      //TODO: store in db
       $this->inventory_model->save_product($this->data);
       //mkdir for the user
      
          $path = "images/$id/";

         if(!is_dir($path)) //create the folder if it's not already exists
          {
           mkdir($path,0755,TRUE);
             //upload image
   
           $this->do_upload($id);
          } 
     
      
         //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('productname'). ' record successfully saved');

       //TODO: refresh page
       redirect('inventory/new_products_store','refresh');
      }
     }
     function do_upload($id) {
        $name=$id;
        $config = array(
          'allowed_types' => 'jpg|jpeg|gif|png',
          'upload_path' => $this->gallery_path,
          'max_size' => 2000
        );
        
        $this->load->library('upload', $config);
        $this->upload->do_upload();
        $image_data = $this->upload->data();
        
        $config = array(
          'source_image' => $image_data['full_path'],
          'new_image' => $this->gallery_path . '/$name',
          'maintain_ration' => true,
          'width' => 150,
          'height' => 100
        );
        
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        
      }
      /*function checkPcode(){
         $codeinput=$this->input->post('pcode');
         $count=1;
         foreach ($productdata as result() => $row) {
           # code...
          $codedb=$row->Code;
          $count++;
         }
      if ($codeinput===$codedb) {
        # code...
        return $this->session->set_flashdata('msg', $this->input->post('productname'). ' is already in the database');
      }

      }*/
      function edit_product_record(){
      
       $nid=$this->input->post('pid');
      //TODO: load in array
    $this->data=array(
      'Product_name'=>$this->input->post('productname'),
      'Code'=>$this->input->post('pcode'),
      'Category'=>$this->input->post('pcat'),
      'Type'=>$this->input->post('ptype'),
      'Sprice'=>$this->input->post('sprice'),
      'Reorder_level'=>$this->input->post('reorder'),
      'Notes'=>$this->input->post('notes')
      );
      //TODO: store in db
       $this->inventory_model->update_product_data($this->data,$nid);
        //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('productname'). ' record successfully edited');

       //TODO: refresh page
       redirect('inventory/edit_product/'.$nid,'refresh');
  }
     function edit_service_record(){
      
       $nid=$this->input->post('pid');
      //TODO: load in array
      $this->data=array(
      'Product_name'=>$this->input->post('productname'),
      'item_code'=>$this->input->post('pcode'),
    
      'Type'=>$this->input->post('ptype'),
      'Selling_price'=>$this->input->post('sprice'),
 
      );
      //TODO: store in db
       $this->inventory_model->update_service_data($this->data,$nid);
        //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('productname'). ' record successfully edited');

       //TODO: refresh page
       redirect('inventory/edit_service/'.$nid,'refresh');
  }
    function edit_product_record_store(){
      
       $nid=$this->input->post('pid');
      //TODO: load in array
         $this->data=array(
      'Product_name'=>$this->input->post('productname'),
      'Code'=>$this->input->post('pcode'),
      'Category'=>$this->input->post('pcat'),
      'Type'=>$this->input->post('ptype'),
      'Sprice'=>$this->input->post('sprice'),
      'Reorder_level'=>$this->input->post('reorder'),
      'Notes'=>$this->input->post('notes')
      );
      
      //TODO: store in db
       $this->inventory_model->update_product_data($this->data,$nid);
        //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('productname'). ' record successfully edited');

       //TODO: refresh page
       redirect('inventory/edit_product_store/'.$nid,'refresh');
  }
   function delete_product($id){
   $this->inventory_model->delete_this_product($id);
    $this->session->set_flashdata('msg', $this->input->post('productname'). ' record successfully deleted');

   redirect('inventory/productList');
  }
    
    function check_product_availablity()
{
    $this->load->model('inventory_model');
    $get_result = $this->My_model->check_product_availablity();
    
    if(!$get_result )
    echo '<span style="color:#f00">product already in use. </span>';
    else
    echo '<span style="color:#0c0">product Available</span>';
} 
//add  new counter
function add_newCounter()
     {
    $this->load->library('form_validation');
      //TODO: parse the info
    $this->form_validation->set_error_delimiters('<div style="color:red" class="alert alert-danger">', '</div>');

    $this->form_validation->set_rules('countername','Counter name', 'required');
   
    if ($this->form_validation->run() == FALSE)
    {
      $this->load_counter();
    }else{
     
       $id=$this->input->post('counter_id');
      //TODO: load in array
      $this->data=array(
      'Title'=>$this->input->post('countername'),
      'Note'=>$this->input->post('note')
      );
      
      //TODO: store in db
       $this->inventory_model->save_new_counter($this->data);
     
     
      
         //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('countername'). ' record successfully saved');

       //TODO: refresh page
       redirect('inventory/load_counter','refresh');
      }
     }  
function add_newCounter_store()
     {
    $this->load->library('form_validation');
      //TODO: parse the info
    $this->form_validation->set_error_delimiters('<div style="color:red" class="alert alert-danger">', '</div>');

    $this->form_validation->set_rules('countername','Counter name', 'required');
   
    if ($this->form_validation->run() == FALSE)
    {
      $this->load_counter_store();
    }else{
     
       $id=$this->input->post('counter_id');
      //TODO: load in array
      $this->data=array(
      'Title'=>$this->input->post('countername'),
      'Note'=>$this->input->post('note')
      );
      
      //TODO: store in db
       $this->inventory_model->save_new_counter($this->data);
     
     
      
         //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('countername'). ' record successfully saved');

       //TODO: refresh page
       redirect('inventory/load_counter_store','refresh');
      }
     }  

     function delete_counter($id){
   $this->inventory_model->delete_this_counter($id);
    $this->session->set_flashdata('msg', $this->input->post('countername'). ' record successfully deleted');

   redirect('inventory/allCounters');
  }   
  
  function delete_counter_store($id){
   $this->inventory_model->delete_this_counter($id);
    $this->session->set_flashdata('msg', $this->input->post('countername'). ' record successfully deleted');

   redirect('inventory/allCounters_store');
  }   
  
  // display counter edit page 
  function load_editCounter($id){
  $this->data['counterdata']=$this->inventory_model->get_this_counter($id);
   $this->data['main_content'] = 'inventory/edit_counter';
   $this->load->view('includes/template', $this->data);

  }
    function load_editCounter_store($id){
  $this->data['counterdata']=$this->inventory_model->get_this_counter($id);
   $this->data['main_content'] = 'inventory/edit_counter_store';
   $this->load->view('includes/template', $this->data);

  }
  //update counter details after update
  function update_counterDetails(){
$id=$this->input->post('counterid');
      //TODO: load in array
      $this->data=array(
      'Title'=>$this->input->post('countername'),
      'Note'=>$this->input->post('note')
      );
      //TODO: store in db
       $this->inventory_model->update_counter($this->data,$id);
        //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('countername'). ' record successfully edited');

       //TODO: refresh page
       redirect('inventory/allCounters','refresh');

  }
    function update_counterDetails_store(){
      $id=$this->input->post('counterid');
      //TODO: load in array
      $this->data=array(
      'Title'=>$this->input->post('countername'),
      'Note'=>$this->input->post('note')
      );
      //TODO: store in db
       $this->inventory_model->update_counter($this->data,$id);
        //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('countername'). ' record successfully edited');

       //TODO: refresh page
       redirect('inventory/allCounters_store','refresh');

  }
  //cart functions/////////////////////////////////////////////////////////////////////
  function add_to_cart(){
     $product = $this->input->post('product');
     $price =$this->input->post('price');
     $unit=$this->input->post('unit');
     $cat=$this->input->post('cat');
     $psku=$this->inventory_model->get_sku($product);
  
    $no=$this->input->post('code');
    $sname = $this->input->post('agent');
    $name = $this->input->post('counter');
    $cid = $this->input->post('cid');
    //$date=date('Y-m-d');
    $this->session->set_userdata("orderNo","$no");
    $this->session->set_userdata("salesperson","$sname");
    $this->session->set_userdata("counter","$name");
    $this->session->set_userdata("cid","$cid");
     $quantity= $this->input->post('qty');

    //validate quantity in stock
 
     $availqty=$this->inventory_model->validate_stock_quantity($product);

      if($quantity <= $availqty){
     $this->data = array(
               'id'      =>$psku,
               'qty'     => $quantity,
               'price'   => $price,
               'name'    => $product,    
               'options' => array('Cat'=>$cat)
     );
 
    $this->cart->insert($this->data);
       }else{
               $this->session->set_flashdata('message', 'Attention!  stock is not enough to process this order! Available qauntity is   ' .$availqty.' items');
       
    }
   redirect('inventory/counterRequest','refresh');

  }
    function cart_update() {
    $key = $this->input->post('rowToken');
    $qtyValue = $this->input->post('updateQty');
    $this->data = array(
      'rowid' => $key,
      'qty' => $qtyValue
    );
    
    $this->cart->update($this->data);
      redirect('counter/index');
  }
  function cart_empty() {
    
    $this->cart->destroy();
     redirect('inventory/counterRequest');
  }
   function cart_unset() {
    
    $this->cart->destroy();
    
  }

   public function save_order()
  {        

            $orderNo=$this->inventory_model->generate_stockorderid();
            $agent = $this->input->post('agent');
            $counter = $this->input->post('counter');
            $cid= $this->input->post('cid');
            $note=$this->input->post('description');
            $date=date('Y-m-d');
            
    if ($cart = $this->cart->contents()):
      foreach ($cart as $item):
            foreach ($this->cart->product_options($item['rowid']) as $option_name => $option_value): 

                      $unit=$option_value; 
                      
                  endforeach; 
        $order_detail = array(
                   'Order_no'=>$orderNo,
                   'Date_moved'=>$date,
                   'Product' =>$item['name'],
                   'Qty'=> $item['qty'],
                   'Unit_price'=>$item['price'],
                   'Unit'=>$unit,
                   'Total_price'=>$item['subtotal'],
                   'Counter'=>$cid
        );    

        $this->inventory_model->insert_order_detail($order_detail);
        //$this->purchase_model->update_inventory($item['name'],$item['qty'],$unit,$item['price']);
      endforeach;
    endif;
        
        //update stock
        $status='pending';
       
        $order_data=array(
             'Order_no'=>$orderNo,
             'Status'=>$status,
             'Counter'=>$cid,
             'Date_created'=>$date,
             'Created_by'=>$agent,
             'Note'=>$note,
             
           
          );
        $this->inventory_model->insert_order_summary($order_data);
        $array_items = array('orderNo' => '', 'counter' => '','cid' => '', 'note'=>'');
        $this->session->unset_userdata($array_items);
        $this->cart_unset();
        redirect('inventory/counterRequest', 'refresh');
     
  }
  function load_counter_detail(){
   if (isset($_GET['term'])){
      $q = strtolower($_GET['term']);
      $this->inventory_model->get_counters($q);
    }
  }
  ///end of supplier
    function load_product() // just for sample
  {
     
  
    if (isset($_GET['term'])){
      $q = strtolower($_GET['term']);
      $this->inventory_model->get_products($q);
    }
  }
  function approve_adjustment_request(){
            $id=$this->input->post('id');
            $orderno=$this->input->post('orderno');
            $product= $this->input->post('product');
            $qty= $this->input->post('qty');
            $date=date('Y-m-d');
            $status='approved';
            $user=$this->input->post('approver');
            $note= $this->input->post('note');
         
             $this->data=array(
             'Status'=>$status,
             'Confirmed_by'=>$user,
             'Confirm_note'=>$note,
             );
            $this->inventory_model->update_defect_record($this->data,$id);
            $this->inventory_model->deduct_defected_items($orderno,$qty);
            $this->session->set_flashdata('msg', 'You have successfully <br/> Approved the removal of ' .$qty. ' pieces of '  .$product.  ' from inventory');
            redirect('inventory/load_adjust_request_details/'.$orderno, 'refresh'); 
}
function reject_adjustment_request(){
            $id=$this->input->post('id');
            $orderno=$this->input->post('orderno');
            $product= $this->input->post('product');
            $qty= $this->input->post('qty');
            $date=date('Y-m-d');
            $status='rejected';
            $user=$this->input->post('approver');
            $note= $this->input->post('note');
         
             $this->data=array(
             'Status'=>$status,
             'Confirmed_by'=>$user,
             'Confirm_note'=>$note,
             );
            $this->inventory_model->update_defect_record($this->data,$id);
            
            $this->session->set_flashdata('msg', 'You have successfully <br/> Rejected the removal of ' .$qty. ' pieces of '  .$product.  ' from inventory');
            redirect('inventory/load_reject_request_details/'.$orderno, 'refresh'); 
}

      public function category_taken()
        {
        $cname = trim($_POST['category']);
        // if the supplierpin exists echo a '1' indicating true
        if ($this->inventory_model->category_exists($cname)) {
          echo '1';
        }
    }

      public function pcode_taken()
        {
        $cname = trim($_POST['pcode']);
        // if the supplierpin exists echo a '1' indicating true
        if ($this->inventory_model->pcode_exists($cname)) {
          echo '1';
        }
    }
      public function countername_taken()
        {
        $cname = trim($_POST['category']);
        // if the supplierpin exists echo a '1' indicating true
        if ($this->inventory_model->counter_exists($cname)) {
          echo '1';
        }
    }

      function sales_per_counter(){
          $id=$this->input->post('selected_counter');
          $this->data['title'] = 'select'; 
          $this->data['counterdata']=$this->inventory_model->get_this_counter($id);
          $this->data['sales']=$this->inventory_model->sales_perCounter($id);
          $this->data['weekly_sales']=$this->inventory_model->get_weekly_sales_perCounter($id);
          $this->data['totals']=$this->inventory_model->get_dairly_salessum($id);
          $this->data['main_content'] = 'inventory/sales_perCounter';
          $this->load->view('includes/template', $this->data);
    }
         function sales_per_counter_cashier($id){
          //$id=$this->input->post('selected_counter');
          $this->data['title'] = 'select'; 
          $this->data['counterdata']=$this->inventory_model->get_this_counter($id);
          $this->data['sales']=$this->inventory_model->sales_perCounter($id);
          $this->data['weekly_sales']=$this->inventory_model->get_weekly_sales_perCounter($id);
          $this->data['totals']=$this->inventory_model->get_dairly_salessum($id);
          $this->data['main_content'] = 'inventory/sales_perCounter';
          $this->load->view('includes/template', $this->data);
    }
    function sales_per_counterWeekly($id){
          //$id=$this->input->post('selected_counter');
          $this->data['title'] = 'select'; 
           $date=date('m,Y');
          $no_of_days=days_in_month($date);          
          $this->data['counterdata']=$this->inventory_model->get_this_counter($id);
          //$this->data['sales']=$this->inventory_model->sales_perCounter($id);
          $this->data['sales']=$this->inventory_model->get_weekly_sales_perCounter($id);
          $this->data['totals']=$this->inventory_model->get_weekly_salessum($id);
          $this->data['main_content'] = 'inventory/sales_perCounter';
          $this->load->view('includes/template', $this->data);
    }
  function sales_per_counterWeekly_cashier($id){
          //$id=$this->input->post('selected_counter');
          $this->data['title'] = 'select'; 
           $date=date('m,Y');
          $no_of_days=days_in_month($date);          
          $this->data['counterdata']=$this->inventory_model->get_this_counter($id);
          //$this->data['sales']=$this->inventory_model->sales_perCounter($id);
          $this->data['sales']=$this->inventory_model->get_weekly_sales_perCounter($id);
          $this->data['totals']=$this->inventory_model->get_weekly_salessum($id);
          $this->data['main_content'] = 'inventory/sales_perCounter_cashier';
          $this->load->view('includes/template', $this->data);
    }
    function sales_per_counterWeekly_cashier_report($id){
          //$id=$this->input->post('selected_counter');
          $this->data['title'] = 'select'; 
          $date=date('m,Y');
          $no_of_days=days_in_month($date);          
          $this->data['counterdata']=$this->inventory_model->get_this_counter($id);
          //$this->data['sales']=$this->inventory_model->sales_perCounter($id);
          $this->data['sales']=$this->inventory_model->get_weekly_sales_perCounter($id);
          $this->data['totals']=$this->inventory_model->get_weekly_salessum($id);
          $this->data['main_content'] = 'inventory/counter_sales_weekly';
          $this->load->view('includes/no_template', $this->data);
    }
   function sales_per_counterMonthly($id){
          //$id=$this->input->post('selected_counter');
          $this->data['title'] = 'select'; 
           $date=date('m,Y');
          $no_of_days=days_in_month($date);
          $this->data['counterdata']=$this->inventory_model->get_this_counter($id);
          //$this->data['sales']=$this->inventory_model->sales_perCounter($id);
          $this->data['sales']=$this->inventory_model->get_monthly_sales_perCounter($id);
          $this->data['totals']=$this->inventory_model->get_monthly_salessum($id);
          $this->data['main_content'] = 'inventory/sales_perCounter';
          $this->load->view('includes/template', $this->data);
    }
       function sales_per_counterMonthly_cashier($id){
          //$id=$this->input->post('selected_counter');
          $this->data['title'] = 'select'; 
           $date=date('m,Y');
          $no_of_days=days_in_month($date);
          $this->data['counterdata']=$this->inventory_model->get_this_counter($id);
          //$this->data['sales']=$this->inventory_model->sales_perCounter($id);
          $this->data['sales']=$this->inventory_model->get_monthly_sales_perCounter($id);
          $this->data['totals']=$this->inventory_model->get_monthly_salessum($id);
          $this->data['main_content'] = 'inventory/sales_perCounter_cashier';
          $this->load->view('includes/template', $this->data);
    }
    function Counter_select()
    { 
          $this->data['title'] = 'select'; 
          $this->data['counterdata']=$this->inventory_model->get_allCounters();
          $this->data['main_content'] = 'inventory/Selection_counter';
          $this->load->view('includes/template', $this->data);

    }
         function unpaid_sales()
    { 
          $this->data['title'] = 'Unpaid'; 
          $this->data['main_content'] = 'inventory/unpaid_sales';
          $this->data['sales']=$this->inventory_model->check_unpaid_orders();
          $this->load->view('includes/template', $this->data);
   }
     function get_counter_daily_moved_stock($id)
  {         
            $date=date('Y-m-d'); 
            $this->data['title'] = 'Daily stock';
            $this->data['counterinventory']=$this->inventory_model->get_this_stock_moved($id,$date);
            $this->data['main_content'] = 'inventory/counter_stock';
            $this->load->view('includes/template', $this->data);
  } 
       function  get_received_counter_stock()
  {         
            $id=$this->session->userdata('Counter');
            $date=date('Y-m-d',strtotime($this->input->post('filterdate')));
            $this->data['title'] = 'Received stock';
            $this->data['counterinventory']=$this->inventory_model->get_this_stock_moved($id,$date);
            $this->data['main_content'] = 'inventory/counter_stock_report';
            $this->load->view('includes/notemplate', $this->data);
  }
      public function get_products_report(){
          $this->load->dbutil();
          $this->load->helper('file');
          $this->load->helper('download');
        /* get the object   */
           $report =$this->inventory_model->get_allProducts();

        /*  pass it to db utility function  */
           $new_report = $this->dbutil->csv_from_result($report);
          /*  Now use it to write file. write_file helper function will do it */
           write_file('downloads/reports/products_report.csv',$new_report);
    
          $this->data['title'] = 'Products Report'; 
          $this->data['productdata']=$this->inventory_model->get_allProducts();
          $this->data['categorydata']=$this->inventory_model->get_category();
          $this->data['main_content'] = 'inventory/products_report';
          $this->load->view('includes/no_template', $this->data);
 }
  public function get_services_report(){
          $this->load->dbutil();
          $this->load->helper('file');
          $this->load->helper('download');
        /* get the object   */
           $report =$this->inventory_model->get_allServices();

        /*  pass it to db utility function  */
           $new_report = $this->dbutil->csv_from_result($report);
          /*  Now use it to write file. write_file helper function will do it */
           write_file('downloads/reports/services_report.csv',$new_report);
    
          $this->data['title'] = 'Services Report'; 
          $this->data['productdata']=$this->inventory_model->get_allServices();
          $this->data['categorydata']=$this->inventory_model->get_category();
          $this->data['main_content'] = 'inventory/services_report';
          $this->load->view('includes/no_template', $this->data);
 }
function get_counter_inventory_report($id)
  {         
            
           
          $this->load->dbutil();
          $this->load->helper('file');
          $this->load->helper('download');
        /* get the object   */
           $report =$this->inventory_model->get_this_counter_data($id);

        /*  pass it to db utility function  */
           $new_report = $this->dbutil->csv_from_result($report);
          /*  Now use it to write file. write_file helper function will do it */
           write_file('downloads/reports/counter_report.csv',$new_report);
    
            $this->data['title'] = 'Counter Report'; 
            $this->data['counterdata']=$this->inventory_model->get_allCounters();
            $this->data['counterinventory']=$this->inventory_model->get_this_counter_data($id);
            $this->data['main_content'] = 'inventory/chosen_counter_report';
            $this->load->view('includes/no_template', $this->data);
  }
 public function load_approved_adjust_requests(){
        $this->data['title'] = 'Approved Requests Report'; 
        $this->data['stock']=$this->inventory_model->get_approved_defect_requests();
        $this->data['main_content'] = 'inventory/approved_adjustment_requests';
        $this->load->view('includes/no_template', $this->data);

  }
   public function load_rejected_adjust_requests(){
        $this->data['title'] = 'Rejected Requests Report'; 
        $this->data['stock']=$this->inventory_model->get_rejected_defect_requests();
        $this->data['main_content'] = 'inventory/rejected_adjustment_requests';
        $this->load->view('includes/no_template', $this->data);

  }
     //view all inventory products
     public function load_inventory_report()
    { 
          $this->load->dbutil();
          $this->load->helper('file');
          $this->load->helper('download');
        /* get the object   */
           $report =$this->inventory_model->get_stock();

        /*  pass it to db utility function  */
           $new_report = $this->dbutil->csv_from_result($report);
          /*  Now use it to write file. write_file helper function will do it */
           write_file('downloads/reports/inventory_report.csv',$new_report);
    
            $this->data['title'] = 'Counter Report'; 
        $this->data['stock_total']=$this->inventory_model->get_stock_total();
        $this->data['stock']=$this->inventory_model->get_stock();
        $this->data['main_content'] = 'inventory/master_inventory_report';
        $this->load->view('includes/no_template', $this->data);

    }
     function load_received_stock_orders()
      { 
        $this->data['title'] = 'Received orders';
        $this->data['incoming']=$this->inventory_model->get_received_orders();
        $this->data['main_content'] = 'inventory/received';
        $this->load->view('includes/template', $this->data);
      }

      function get_periodic_sales_report($id){
          $this->data['title'] = 'Sales Reports'; 
          $date1=$this->input->post('Start');
          $date2=$this->input->post('End');
          $var1=date('Y-m-d', strtotime($date1));
          $var2=date('Y-m-d', strtotime($date2));
                  
          $this->data['counterdata']=$this->inventory_model->get_this_counter($id);
          $this->data['sales']=$this->inventory_model->get_periodic_sales_perCounter($id,$var1,$var2);
          $this->data['totals']=$this->inventory_model->get_periodic_salessum($id,$var1,$var2);
          $this->data['main_content'] = 'inventory/counter_sales_weekly';
          $this->load->view('includes/no_template', $this->data);
    }
        //load new product cateory store
      function display_new_frequency()
       { 
          $this->data['title'] = 'Frequency'; 
          $this->data['main_content'] = 'inventory/new_frequency';
          $this->load->view('includes/template', $this->data);

      }
         function display_new_quantity()
       { 
          $this->data['title'] = 'Quantity'; 
          $this->data['main_content'] = 'inventory/new_quantity';
          $this->load->view('includes/template', $this->data);

      }
         function display_new_dosage()
       { 
          $this->data['title'] = 'Dosage'; 
          $this->data['main_content'] = 'inventory/new_dosage';
          $this->load->view('includes/template', $this->data);

      }
         function display_new_administrator()
       { 
          $this->data['title'] = 'Frequency'; 
          $this->data['main_content'] = 'inventory/new_frequency';
          $this->load->view('includes/template', $this->data);

      }
         //edit product category
      function edit_frequency($id)
    { 
          $this->data['title'] = 'Edit Frequency'; 
          $this->data['categorydata']=$this->inventory_model->get_this_frequency($id);
          $this->data['main_content'] = 'inventory/edit_frequency';
          $this->load->view('includes/template', $this->data);

    }
       //edit product category
     function edit_quantity($id)
    { 
          $this->data['title'] = 'Edit Quantity'; 
          $this->data['categorydata']=$this->inventory_model->get_this_quantity($id);
          $this->data['main_content'] = 'inventory/edit_quantity';
          $this->load->view('includes/template', $this->data);

    }
         function edit_dosage($id)
    { 
          $this->data['title'] = 'Edit Dosage'; 
          $this->data['categorydata']=$this->inventory_model->get_this_dosage($id);
          $this->data['main_content'] = 'inventory/edit_dosage';
          $this->load->view('includes/template', $this->data);

    }
         function edit_administrator($id)
    { 
          $this->data['title'] = 'Edit Administrator'; 
          $this->data['categorydata']=$this->inventory_model->get_this_administrator($id);
          $this->data['main_content'] = 'inventory/edit_administrator';
          $this->load->view('includes/template', $this->data);

    }
     function add_new_frequency(){
       $this->load->library('form_validation');
       $this->form_validation->set_error_delimiters('<div style="color:red" class="alert alert-danger">', '</div>');
       $this->form_validation->set_rules('category', 'Category',  'required');
      
      if ($this->form_validation->run() == FALSE)
        {
          $this->display_new_frequency();
        }else{
           
      //TODO: load in array
      $this->data=array(
      'name'=>$this->input->post('category'),
      'note'=>$this->input->post('description')
       );
       $this->inventory_model->save_frequency($this->data);
      //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('category').  ' Frequency record successfully saved');

       //TODO: refresh page
       redirect('inventory/display_new_frequency','refresh');
      }
     }
    function add_new_quantity(){
       $this->load->library('form_validation');
       $this->form_validation->set_error_delimiters('<div style="color:red" class="alert alert-danger">', '</div>');
       $this->form_validation->set_rules('category', 'Category',  'required');
      
      if ($this->form_validation->run() == FALSE)
        {
          $this->display_new_frequency();
        }else{
           
      //TODO: load in array
      $this->data=array(
      'name'=>$this->input->post('category'),
      'note'=>$this->input->post('description')
       );
       $this->inventory_model->save_quantity($this->data);
      //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('category').  ' Quantity record successfully saved');

       //TODO: refresh page
       redirect('inventory/display_new_quantity','refresh');
      }
     }
  function add_new_dosage(){
       $this->load->library('form_validation');
       $this->form_validation->set_error_delimiters('<div style="color:red" class="alert alert-danger">', '</div>');
       $this->form_validation->set_rules('category', 'Category',  'required|alpha');
      
      if ($this->form_validation->run() == FALSE)
        {
          $this->display_new_dosage();
        }else{
           
      //TODO: load in array
      $this->data=array(
      'name'=>$this->input->post('category'),
      'note'=>$this->input->post('description')
       );
       $this->inventory_model->save_dosage($this->data);
      //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('category').  ' Dosage record successfully saved');

       //TODO: refresh page
       redirect('inventory/display_new_dosage','refresh');
      }
     } 
  function add_new_administrator(){
       $this->load->library('form_validation');
       $this->form_validation->set_error_delimiters('<div style="color:red" class="alert alert-danger">', '</div>');
       $this->form_validation->set_rules('category', 'Category',  'required');
      
      if ($this->form_validation->run() == FALSE)
        {
          $this->display_new_administrator();
        }else{
           
      //TODO: load in array
      $this->data=array(
      'name'=>$this->input->post('category'),
      'note'=>$this->input->post('description')
       );
       $this->inventory_model->save_administrator($this->data);
      //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('category').  ' Frequency record successfully saved');

       //TODO: refresh page
       redirect('inventory/display_new_administrator','refresh');
      }
     }   
     function edit_frequency_record(){
      
       $nid=$this->input->post('catid');
      //TODO: load in array
      $this->data=array(
      'name'=>$this->input->post('catname'),
      'note'=>$this->input->post('note')
      
      );
      //TODO: store in db
       $this->inventory_model->update_frequency_data($this->data,$nid);
        //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('catname'). ' record successfully edited');

       //TODO: refresh page
       redirect('inventory/edit_frequency/'.$nid,'refresh');
  }
    function edit_quantity_record(){
      
       $nid=$this->input->post('catid');
      //TODO: load in array
      $this->data=array(
      'name'=>$this->input->post('catname'),
      'note'=>$this->input->post('note')
      
      );
      //TODO: store in db
       $this->inventory_model->update_quantity_data($this->data,$nid);
        //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('catname'). ' record successfully edited');

       //TODO: refresh page
       redirect('inventory/edit_quantity/'.$nid,'refresh');
  }
    function edit_dosage_record(){
      
       $nid=$this->input->post('catid');
      //TODO: load in array
      $this->data=array(
      'name'=>$this->input->post('catname'),
      'note'=>$this->input->post('note')
      
      );
      //TODO: store in db
       $this->inventory_model->update_dosage_data($this->data,$nid);
        //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('catname'). ' record successfully edited');

       //TODO: refresh page
       redirect('inventory/edit_dosage/'.$nid,'refresh');
  }
  function edit_administrator_record(){
      
       $nid=$this->input->post('catid');
      //TODO: load in array
      $this->data=array(
      'name'=>$this->input->post('catname'),
      'note'=>$this->input->post('note')
      
      );
      //TODO: store in db
       $this->inventory_model->update_administrator_data($this->data,$nid);
        //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('catname'). ' record successfully edited');

       //TODO: refresh page
       redirect('inventory/edit_administrator/'.$nid,'refresh');
  }  
  function display_drug_frequencies()
    { 

          $this->data['title'] = 'Drug Frequencies'; 
          $this->data['categorydata']=$this->inventory_model->get_frequency();
          $this->data['main_content'] = 'inventory/frequency_list';
          $this->load->view('includes/table_template', $this->data);

    }
    function display_drug_quantities()
    { 

          $this->data['title'] = 'Drug Quantities'; 
           $this->data['categorydata']=$this->inventory_model->get_quantity();
          $this->data['main_content'] = 'inventory/quantity_list';
          $this->load->view('includes/table_template', $this->data);

    }
    function display_drug_dosages()
    { 

          $this->data['title'] = 'Drug Dosages'; 
           $this->data['categorydata']=$this->inventory_model->get_dosage();
          $this->data['main_content'] = 'inventory/dosage_list';
          $this->load->view('includes/table_template', $this->data);

    }
      function display_drug_administrators()
    { 

          $this->data['title'] = 'Drug Administartors'; 
           $this->data['categorydata']=$this->inventory_model->get_administrator();
          $this->data['main_content'] = 'inventory/administrator_list';
          $this->load->view('includes/table_template', $this->data);

    }
      function all_patient_bills()
    { 

          $this->data['title'] = 'Patient bills'; 
          $this->data['bill_data']=$this->inventory_model->get_all_sales();
          $this->data['main_content'] = 'inventory/bill_list';
          $this->load->view('includes/table_template', $this->data);


    }
        function today_patient_bills()
    { 

          $this->data['title'] = 'Patient bills'; 
          $this->data['bill_data']=$this->inventory_model->get_today_sales();
          $this->data['main_content'] = 'inventory/today_bill_list';
          $this->load->view('includes/table_template', $this->data);

    }
         function weekly_patient_bills()
    { 

          $this->data['title'] = 'Patient bills'; 
          $this->data['bill_data']=$this->inventory_model->get_weekly_sales();
          $this->data['main_content'] = 'inventory/weekly_bill_list';
          $this->load->view('includes/table_template', $this->data);

    }
          function monthly_patient_bills()
    { 

          $this->data['title'] = 'Patient bills'; 
          $this->data['bill_data']=$this->inventory_model->get_monthly_sales();
          $this->data['main_content'] = 'inventory/monthly_bill_list';
          $this->load->view('includes/table_template', $this->data);

    }
	     function cashier_patient_bills()
    { 

          $this->data['title'] = 'Patient bills'; 
		      $this->data['clerks']=$this->inventory_model->get_clerks();
          $this->data['bill_data']=$this->inventory_model->get_all_sales();
          $this->data['bill_total']= $this->inventory_model->get_sum_sales();
          $this->data['main_content'] = 'inventory/cashier_sales';
          $this->load->view('includes/template', $this->data);

    }
         function cashier_patient_bill_filter()
    { 

          $name=$this->input->post('clerk');
          $date=date('Y-m-d', strtotime($this->input->post('date')));
  
          $this->data['title'] = 'Patient bills'; 
          $this->data['clerks']=$this->inventory_model->get_clerks();
          $this->data['bill_data']= $this->inventory_model->get_sales($name,$date);
          $this->data['bill_total']= $this->inventory_model->get_total_sales($name,$date);
          $this->data['main_content'] = 'inventory/cashier_sales';
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
         
          $this->data['main_content'] = 'inventory/backup';
          $this->load->view('includes/template', $this->data);
  }
  public function view_bill($value)
  {
              $this->data['title'] = 'Bill';
              $this->data['order']=$this->inventory_model->get_this_sale_order_details($value);//get the order details data
              $this->data['product_data']=$this->inventory_model->get_this_sale_order_items($value);//get the purchase order items data
             // $this->data['tprice_data']=$this->purchase_model-> get_this_sale_order_total($value);//get the purchase order total
              $this->data['main_content'] = 'inventory/this_bill';
              $this->load->view('includes/template', $this->data);
  }
    public function view_this_bill($value)
  {
              $this->data['title'] = 'Bill';
              $this->data['order']=$this->inventory_model->get_this_sale_order_details($value);//get the order details data
              $this->data['product_data']=$this->inventory_model->get_this_sale_order_items($value);//get the purchase order items data
             // $this->data['tprice_data']=$this->purchase_model-> get_this_sale_order_total($value);//get the purchase order total
              $this->data['main_content'] = 'inventory/bill';
              $this->load->view('includes/template', $this->data);
  }
  public function void_bill()
  {
    //create data array for the update
     $id=$this->input->post('id');
      //TODO: load in array
      $this->data=array(
      'status'=>'void',
      'amount_paid'=>$this->input->post('total'),
      'balance'=>'0',
      'void_by'=>$this->session->userdata('fullname'));
      //TODO: store in db
       $this->inventory_model->update_patient_bill($this->data,$id);
        //TODO: return an appropriate message
       $this->session->set_flashdata('msg',  ' Bill successfully recorded as void');

       //TODO: refresh page
       redirect('inventory/view_bill/'.$id,'refresh');

  }

    function display_new_diagnosis()
       { 
          $this->data['title'] = 'Diagnosis'; 
          $this->data['main_content'] = 'inventory/new_diagnosis';
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
       $this->inventory_model->save_diagnosis($this->data);
      //TODO: return an appropriate message
       $this->session->set_flashdata('msg',   ' Diagnosis record successfully saved');

       //TODO: refresh page
       redirect('inventory/display_new_diagnosis','refresh');
      }
     }
        function edit_diagnosis($id)
    { 
          $this->data['title'] = 'Edit Dosage'; 
          $this->data['categorydata']=$this->inventory_model->get_this_diagnosis($id);
          $this->data['main_content'] = 'inventory/edit_diagnosis';
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
       $this->inventory_model->update_diagnosis_data($this->data,$nid);
        //TODO: return an appropriate message
       $this->session->set_flashdata('msg', $this->input->post('catname'). ' record successfully edited');

       //TODO: refresh page
       redirect('inventory/edit_diagnosis/'.$nid,'refresh');
  }
     function display_drug_diagnosis()
    { 

          $this->data['title'] = 'Drug Diagnosis'; 
           $this->data['categorydata']=$this->inventory_model->get_diagnosis();
          $this->data['main_content'] = 'inventory/diagnosis_list';
          $this->load->view('includes/table_template', $this->data);

    }
       
        function load_custom_sales()
    { 
          $this->data['title'] = 'Custom sales'; 
          $this->data['main_content'] = 'inventory/custom_sales';
         
          $this->load->view('includes/template', $this->data);
   }
       function load_yearly_sales()
    { 
          $this->data['title'] = 'Custom sales'; 
          $this->data['main_content'] = 'inventory/yearly_sales';
          $this->data['stock']=$this->inventory_model->get_yearly_sales();
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
                $this->data['stock']=$this->inventory_model->get_custom_sales($from,$to);
              }elseif($ptype=='Inpatient'){
                $this->data['stock']=$this->inventory_model->get_inpatient_sales($from,$to);
              }
                elseif($ptype=='Clinic'){
                $this->data['stock']=$this->inventory_model->get_clinic_sales($from,$to);
              }
              elseif($ptype=='Outpatient'){
                $this->data['stock']=$this->inventory_model->get_outpatient_sales($from,$to);
              }
                $this->data['title'] = 'select'; 
                $this->data['main_content'] = 'inventory/sales_graph';
                $this->load->view('includes/graphtemplate', $this->data);

          }elseif($type=='summary'){
            if($ptype=='All'){
                $this->data['stock']=$this->inventory_model->get_custom_sales($from,$to);
              }elseif($ptype=='Inpatient'){
                $this->data['stock']=$this->inventory_model->get_inpatient_sales($from,$to);
              }
               elseif($ptype=='Clinic'){
                $this->data['stock']=$this->inventory_model->get_clinic_sales($from,$to);
              }
              elseif($ptype=='Outpatient'){
                $this->data['stock']=$this->inventory_model->get_outpatient_sales($from,$to);
              }
            $this->data['title'] = 'select'; 
            $this->data['main_content'] = 'inventory/sales_summary';
            $this->load->view('includes/table_template', $this->data);
          }elseif($type=='detailed'){
             if($ptype=='All'){
                $this->data['stock']=$this->inventory_model->get_custom_sales_report($from,$to);
              }elseif($ptype=='Inpatient'){
                $this->data['stock']=$this->inventory_model->get_inpatient_sales_report($from,$to);
              }
               elseif($ptype=='Clinic'){
                $this->data['stock']=$this->inventory_model->get_clinic_sales_report($from,$to);
              }
              elseif($ptype=='Outpatient'){
                $this->data['stock']=$this->inventory_model->get_outpatient_sales_report($from,$to);
              }
            $this->data['title'] = 'select'; 
            $this->data['main_content'] = 'inventory/sales_detail';
            $this->load->view('includes/table_template', $this->data);

          } 
   }
         function load_today_sales_report()
    { 
          $this->data['title'] = 'Today sales'; 
           $this->data['main_content'] = 'inventory/today_bill_list_report';
          $this->data['bill_data']=$this->inventory_model->get_today_sales();
          $this->data['totals']=$this->inventory_model->get_today_sales_totals();
          $this->load->view('includes/no_template', $this->data);
   }
       function load_custom_diagnosis()
    { 
          $this->data['title'] = 'Custom diagnosis'; 
          $this->data['main_content'] = 'inventory/custom_diagnosis';
          $this->data['diagnosis']=$this->inventory_model->get_diagnosis();
          $this->load->view('includes/template', $this->data);
   }
   public function load_inpatient_diagnosis_report()
   {
          //$this->output->enable_profiler(TRUE);
          $this->load->dbutil();
          $this->load->helper('file');
          $this->load->helper('download');
            //variables to filter
            $from=date('Y-m-d', strtotime($this->input->post('from')));
            $to=date('Y-m-d', strtotime($this->input->post('to')));
            $type=$this->input->post('patient_type');
            $status=$this->input->post('status');
            $diagnosis=$this->input->post('diagnosis');
          if($type=='Inpatient'){

            
           $this->data['title'] = 'select'; 
            
            /* get the object   */
           $report =$this->inventory_model->get_patient_diagnosis($from,$to,$type,$diagnosis,$status);
           /*  pass it to db utility function  */
           $new_report = $this->dbutil->csv_from_result($report);
          /*  Now use it to write file. write_file helper function will do it */
             write_file('downloads/reports/diagnosis_report.csv',$new_report);
              if($status=='ALL'){
               $this->data['bill_data']=$this->inventory_model->get_p_diagnosis($from,$to,$type);
              }
             elseif($status=='ALL' ||$status=='DEAD'||$status=='ALIVE'  && $diagnosis=='all'){
               $this->data['bill_data']=$this->inventory_model->get_p_diagnosis($from,$to,$type);
              }

            else{
             $this->data['bill_data']=$this->inventory_model->get_patient_diagnosis($from,$to,$type,$diagnosis,$status);
             }
            $this->data['main_content'] = 'inventory/patient_diagnosis';
            $this->load->view('includes/no_template', $this->data);
          }elseif($type=='Outpatient'){
            $this->data['title'] = 'select'; 
            $this->data['main_content'] = 'inventory/patient_diagnosis';
              /* get the object   */
           $report =$this->inventory_model->get_patient_diagnosis($from,$to,$type,$diagnosis,$status);
           /*  pass it to db utility function  */
           $new_report = $this->dbutil->csv_from_result($report);
          /*  Now use it to write file. write_file helper function will do it */
           write_file('downloads/reports/diagnosis_report.csv',$new_report);
            if($status=='ALL'){
               $this->data['bill_data']=$this->inventory_model->get_p_diagnosis($from,$to,$type);
              }
             elseif($status=='ALL' ||$status=='DEAD'||$status=='ALIVE'  && $diagnosis=='all'){
               $this->data['bill_data']=$this->inventory_model->get_p_diagnosis($from,$to,$type);
              }

              else{
             $this->data['bill_data']=$this->inventory_model->get_patient_diagnosis($from,$to,$type,$diagnosis,$status);
             }
            $this->load->view('includes/no_template', $this->data);
          }elseif($type=='All'){
            $this->data['title'] = 'select'; 
            $this->data['main_content'] = 'inventory/patient_diagnosis';
              /* get the object   */
           $report =$this->inventory_model->get_p_diagnosis($from,$to);
           /*  pass it to db utility function  */
           $new_report = $this->dbutil->csv_from_result($report);
          /*  Now use it to write file. write_file helper function will do it */
           write_file('downloads/reports/diagnosis_report.csv',$new_report);
            $this->data['bill_data']=$this->inventory_model->get_p_diagnosis($from,$to);
            $this->load->view('includes/no_template', $this->data);
         
          }
            
   }

       function load_custom_diagnosis_analysis()
    { 
          $this->data['title'] = 'Custom diagnosis'; 
          $this->data['main_content'] = 'inventory/custom_diagnosis_analytics';
         // $this->data['diagnosis']=$this->inventory_model->diagnosis_analytics();
          $this->load->view('includes/template', $this->data);
   }

   public function load_diagnosis_report()
   {
          //$this->output->enable_profiler(TRUE);
          $this->load->dbutil();
          $this->load->helper('file');
          $this->load->helper('download');
            //variables to filter
            $from=date('Y-m-d', strtotime($this->input->post('from')));
            $to=date('Y-m-d', strtotime($this->input->post('to')));
            
            $this->data['title'] = 'select'; 
            $this->data['main_content'] = 'inventory/patient_diagnosis_analytics';
              /* get the object   */
            $report =$this->inventory_model->diagnosis_analytics($from,$to);
           /*  pass it to db utility function  */
           $new_report = $this->dbutil->csv_from_result($report);
          /*  Now use it to write file. write_file helper function will do it */
           write_file('downloads/reports/diagnosis_analytics_report.csv',$new_report);
            $this->data['bill_data']=$this->inventory_model->diagnosis_analytics($from,$to);
            $this->load->view('includes/no_template', $this->data);
         
          }
      public function load_patient_report()
   {
          //$this->output->enable_profiler(TRUE);
          $this->load->dbutil();
          $this->load->helper('file');
          $this->load->helper('download');
            //variables to filter
            $from=date('Y-m-d', strtotime($this->input->post('from')));
            $to=date('Y-m-d', strtotime($this->input->post('to')));
            
            $this->data['title'] = 'Patient Report'; 
            $this->data['main_content'] = 'inventory/patient_report_analytics';
              /* get the object   */
            $report =$this->inventory_model->patient_analytics($from,$to);
           /*  pass it to db utility function  */
           $new_report = $this->dbutil->csv_from_result($report);
          /*  Now use it to write file. write_file helper function will do it */
           write_file('downloads/reports/patient_analytics_report.csv',$new_report);
            $this->data['bill_data']=$this->inventory_model->patient_analytics($from,$to);
            $this->load->view('includes/no_template', $this->data);
         
          }
        function load_custom_patient_analysis()
    { 
          $this->data['title'] = 'Custom diagnosis'; 
          $this->data['main_content'] = 'inventory/custom_patient';
         // $this->data['diagnosis']=$this->inventory_model->diagnosis_analytics();
          $this->load->view('includes/template', $this->data);
   }
    function allProductList()
    { 
          $this->data['title'] = 'List of Products'; 
          $this->data['productdata']=$this->inventory_model->getAllProducts()->result();
           $this->data['categorydata']=$this->inventory_model->get_category()->result();
          $this->render_page('inventory/all_product_list', $this->data);

    }
 }
      