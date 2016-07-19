<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inventory_model extends CI_Model {
public function save_category($data){
//inserting new category
	$this->db->insert('product_category', $data);
}
 public function get_refunds()
 {
  #STATUS='pending approval';
   $sql="SELECT count(*) as num FROM refund  WHERE status='pending approval'";
    return $this->db->query($sql);
 }

public function get_category(){
//getting all categories
	return $this->db->get('product_category');
}
 public function get_this_category($id)
	    {
	        //select this user record from table users
	       return $this->db->get_where('product_category', array('Row_id' => $id), 1);;

	    }
	    //edit the category data
	     public function update_category_data($data,$id)
	     {
           $this->db->where('Row_id', $id);
           $this->db->update('product_category', $data);
         } 
 public function save_product($data){
//inserting new product
	$this->db->insert('product', $data);
}
 public function save_service($data){
//inserting new product
  $this->db->insert('master_inventory', $data);
}
//get processed purchase orders
   public function get_purchase_orders(){
    return $this->db->query("SELECT * FROM purchase_order  WHERE status='processed' ");
   }
public function get_allProducts(){
//getting all categories
	//return $this->db->query("SELECT * FROM product ORDER BY Product_name ASC");
          $this->db->select('*');
          $this->db->from('product');
          $this->db->join('master_inventory', 'master_inventory.item_code = product.Code');
          $this->db->join('product_category', 'product_category.Row_id = product.Category');
          $this->db->where('product.Type', "Inventory item");
          $query = $this->db->get();
          return $query;
}
public function get_allServices(){
//getting all categories
  return $this->db->query("SELECT * FROM master_inventory WHERE Type='Service item' ORDER BY Product_name ASC");
}
public function get_this_product($id)
	    {
	        //select this user record from table users
	       return $this->db->get_where('product', array('Product_id' => $id), 1);
        

	    }
public function get_this_service($id)
      {
          //select this user record from table users
         return $this->db->get_where('master_inventory', array('Stock_id' => $id), 1);

      }
  function get_this_category_name($id){
            return $this->db->get_where('product_category', array('Row_id' => $id), 1);
 		 }
	    //edit the category data
	     public function update_product_data($data,$id)
	     {
           $this->db->where('Product_id', $id);
           $this->db->update('product', $data);
         } 
         public function update_service_data($data,$id)
       {
           $this->db->where('Stock_id', $id);
           $this->db->update('master_inventory', $data);
         } 
   public function delete_this_product($id){
     return $this->db->query("DELETE FROM product WHERE Product_id='$id' ");
} 
 function check_product_availablity()
{
        $email = trim($this->input->post('pcode'));
    
    
    $query = $this->db->query('SELECT * FROM product where Code="'.$email.'"');
    
    if($query->num_rows() > 0)
    return false;
    else
    return true;
}
 public function get_stock_data($id){
    return $this->db->query("SELECT  * FROM master_inventory WHERE Stock_id='$id' ");
               
   }
   public function insert_defect_record($data){
    $this->db->insert('defects', $data);
 }
   public function get_defect_data($id){

     return $this->db->query("SELECT *  FROM defects WHERE order_no='$id' ");
  }           
   public function update_defect_record($data,$id){
    $this->db->where('Row_id', $id);
    $this->db->update('defects', $data);
   }

        public function get_cat($product){
    $this->db->select('Category');
      $this->db->where('Product_name', $product);
        $getsku = $this->db->get('product');
        if ($getsku->num_rows() > 0)
       {
       $row = $getsku->row();

       
       $cat=$row->Category;
       
     }
     return $cat; 
  }
              
   public function get_defect_requests(){
        return $this->db->query("SELECT  * FROM defects WHERE Status='pending' ");
   
   }
   //get the purchase items data for this order
    function get_this_purchase_order_items($id){
         return $this->db->query("SELECT *  FROM purchase_lines WHERE Order_no=$id ");
     }
      //get the purchase order details for this order
    function get_this_purchase_order_details($d){
         return $this->db->query("SELECT * FROM purchase_order WHERE Order_no='$d' ");
     }
    //get the total value of this purchase order
    function get_this_purchase_order_total($d){
         return $this->db->query("SELECT SUM(Total_Price) as tp  FROM purchase_lines WHERE Order_no=$d  ");
     }
      function get_grn_total($d){
         return $this->db->query("SELECT SUM(Received*Unit_cost) as tp  FROM purchase_lines WHERE Order_no=$d GROUP BY Order_no  ");
     }
     //get purchase items to be received by GRN
    function get_items_received($id){
         return $this->db->query("SELECT Order_no,Supplier,Date_ordered,Product,(Qty-Received) as q,Qty, Unit_cost,Total_Price  FROM purchase_lines WHERE Order_no=$id AND (Qty-Received)>0 ");
    }
     function get_items_already_received($id){
         return $this->db->query("SELECT Order_no,Supplier,Date_ordered,Product,(Qty-Received) as q,Qty,Received,Unit_cost,(Unit_cost*Received) as price  FROM purchase_lines WHERE Order_no=$id AND (Qty-Received)<Qty ");
    }
    function add_incoming_stock($p,$qty,$cat){
        
           $this->db->select('Reorder_level');
           $this->db->select('Available_stock,Selling_price');
           $this->db->where('Product_name', $p);
           $getData = $this->db->get('master_inventory'); 
           $rowdata=$getData->row();
               if($getData->num_rows!=0){
               //values
               $totalp=($rowdata->Available_stock+$qty);
               $stockTotal=(($totalp)*($rowdata->Selling_price));
               $data = array(
                     'Available_stock'=>$totalp,
                     'Total_value' => $stockTotal,
                     'Category'=>$cat
                      );

           $this->db->where('Product_name', $p);
           $this->db->update('master_inventory', $data);
        }
            
     
   }

 function update_incoming_order($p,$q,$id,$desc){

   $this->db->query("UPDATE purchase_lines 
                                      SET Received=((Received)+($q)),
                                          Note='$desc',
                                          Delivery_date=CURDATE() 
                                                              WHERE Product='$p' 
                                                              AND Order_no=$id ");

   $query_result=$this->db->query("SELECT SUM(Qty) as value1, SUM(Received) as value2 
                                                                                  FROM purchase_lines
                                                                                                   WHERE Order_no=$id");           
    foreach ($query_result->result() as $key) {
          if(($key->value1)==($key->value2)){
            $this->db->query("UPDATE purchase_order SET Status='received' WHERE  Order_no=$id "); 
          }
     } 
   }
   function insert_transaction($data)
      {
         $this->db->insert('transaction', $data);
       }
public function deduct_defected_items($id,$qty){
   return $this->db->query("UPDATE master_inventory SET Available_stock=(Available_stock-$qty) WHERE Stock_id='$id' ");
}

//add new counter
function save_new_counter($data){

$this->db->insert('counter', $data);
}
//get all counter details from db
function get_allCounters(){
	return $this->db->get('counter');
}
function get_counters($q){
    $this->db->select('Counter_id,Title');
    $this->db->like('Title', $q);
    $query = $this->db->get('counter');
    if($query->num_rows > 0){
      foreach ($query->result_array() as $row){
        $name=$row['Title'];
        $value=$row['Row_id'];
        $row_set[] = array('label' =>$name,'value'=>$value );
       
      }
      echo json_encode($row_set); //format the array into json data
    }
  }
    public function get_counter($id){
    $this->db->where('Counter_id', $id);
        $getFullname = $this->db->get('counter');
        if ($getFullname->num_rows() > 0)
       {
       $row = $getFullname->row();

       
       $fullname=$row->Title;
       
     }
     return $fullname; 
}

 public function delete_this_counter($id){
     return $this->db->query("DELETE FROM counter WHERE Counter_id='$id' ");
} 
public function get_this_counter($id)
	    {
	        //select this user record from table users
	       return $this->db->get_where('counter', array('Counter_id' => $id), 1);

	    }
function update_counter($data, $id){
$this->db->where('Counter_id', $id);
           $this->db->update('counter', $data);

}
	    
  function get_this_counterInventory($id){
         return  $this->db->get_where('counter_inventory', array('Counter_id' => $id));
            /*if ($query->num_rows() > 0)
             {
            	# code...
            	return $query;

            }else{
            	return $this->session->set_flashdata('msg', 'The counter has no record ');
            }*/
 		 }
 		 public function get_stock(){
    return $this->db->query("SELECT  * FROM master_inventory  ORDER BY Product_name ASC ");
               
   }
    public function get_stock_stats(){
    return $this->db->query("SELECT  Category, count(*) as num FROM master_inventory WHERE Type='Inventory' ORDER BY Product_name ASC ");
               
   }
  
   public function validate_stock_quantity($product){
   $query= $this->db->query("SELECT Available_stock FROM master_inventory WHERE Product_name='$product'");
     $value=$query->row();
     return $value->Available_stock;
}
public function get_sku($product){
    $this->db->select('Product_id');
      $this->db->where('Product_name', $product);
        $getsku = $this->db->get('product');
        if ($getsku->num_rows() > 0)
       {
       $row = $getsku->row();

       
       $sku=$row->Product_id;
       
     }
     return $sku; 
}
   public function insert_order_summary($data)
  {
    $this->db->insert('stock_requisation', $data);
  }
      public function insert_order_detail($data)
  {
    $this->db->insert('stock_lines', $data);
  }
   function generate_stockorderid()
  {
    
    $query = $this->db->query('SELECT max(Order_no) as orderNo FROM stock_requisation');
    foreach ($query->result() as $row)
      {
         $id=$row->orderNo+1;
      }
  return $id;
  }
  function get_stock_requests(){
     return $this->db->query("SELECT * FROM stock_requisation WHERE Status='pending' ");
  }
    function get_stock_counter($name){
        $this->db->select('Row_id');
        $this->db->where('Title', $name);
        $getq = $this->db->get('counter');
         $row = $getq->row();
        return $value=$row->Row_id;
    }
  
    function get_stock_movement_requests(){
     return $this->db->query("SELECT * FROM movement ");
  }
  function get_stock_request_details($id){
     return $this->db->query("SELECT * FROM stock_requisation WHERE Order_no='$id' ");
  }
    function get_stock_request_lines($id){
     return $this->db->query("SELECT  Row_id,Order_no,Allocated_by,Date_moved,Product,(Qty-Received) as quty,Received,Unit_price,Unit,Total_price,Counter,Picked_by FROM stock_lines WHERE Order_no='$id' AND (Qty-Received)>0 ");
  }
      
     function update_stock_lines($id,$product,$quantity,$note,$user){
     return $this->db->query("UPDATE stock_lines SET Allocated_by='$user',Received='$quantity', picked_by='$note' WHERE Order_no='$id' AND Product='$product' ");
  }
  function update_stock_request($data,$id){
           $this->db->where('Order_no', $id);
           $this->db->update('stock_requisation', $data);
  }
  public function deduct_assigned_items($qty,$product){
   return $this->db->query("UPDATE master_inventory SET Available_stock=(Available_stock-$qty) WHERE Product_name='$product' ");
}

   function add_movement_stock($data){
         
           $this->db->insert('movement', $data);
  }
     function add_counter_stock($data){
         
           $this->db->insert('counter_inventory', $data);
  }
  public function category_exists($value){
        $this->db->where('Category_name', $value);
        $this->db->from('product_category');
        $query = $this->db->get();
       if ($query->num_rows() > 0) {
          return TRUE;
        } else {
          return FALSE;
        }
    }
    public function pcode_exists($value){
        $this->db->where('Code', $value);
        $this->db->from('product');
        $query = $this->db->get();
       if ($query->num_rows() > 0) {
          return TRUE;
        } else {
          return FALSE;
        }
    }
    public function counter_exists($value){
        $this->db->where('Title', $value);
        $this->db->from('counter');
        $query = $this->db->get();
       if ($query->num_rows() > 0) {
          return TRUE;
        } else {
          return FALSE;
        }
}
    public function sales_perCounter($id){
    return $this->db->query("SELECT * FROM  patient_bill WHERE counter='$id' AND date_paid=curdate()");
               
   }
     
    public function check_unpaid_orders(){
    return $this->db->query("SELECT * FROM patient_bill  WHERE status='unpaid' ");
   }

//get moved stock ordered per counter
   public function get_this_stock_moved($id,$date){
    return $this->db->query("SELECT * FROM movement  WHERE Moved_to='$id' AND DATE(Date_moved)='$date' ");
   }
    public function get_this_counter_data($id){
    return $this->db->query("SELECT * FROM counter_inventory  WHERE Counter_id='$id' ");
   }
     public function get_approved_defect_requests(){
        return $this->db->query("SELECT  * FROM defects WHERE Status='approved' ");
   
   }
     public function get_rejected_defect_requests(){
        return $this->db->query("SELECT  * FROM defects WHERE Status='rejected' ");
   
   }
     public function get_received_orders(){
    return $this->db->query("SELECT * FROM purchase_order  WHERE status='processed' or status='received' ");
   }

public function get_periodic_sales_perCounter($id,$var1,$var2){
  return $this->db->query("SELECT * FROM `patient_bill`WHERE counter='$id' AND  date_paid BETWEEN '$var1'AND '$var2' ");
}
public function get_periodic_salessum($id,$var1,$var2){
  return $this->db->query("SELECT sum(bill_total) FROM patient_bill WHERE counter='$id' AND  date_paid BETWEEN '$var1'AND '$var2' ");
    }


public function save_frequency($data){
//inserting new category
  $this->db->insert('drug_frequencies', $data);
}
public function save_quantity($data){
//inserting new category
  $this->db->insert('drug_quantities', $data);
}
public function save_dosage($data){
//inserting new category
  $this->db->insert('drug_dosages', $data);
}
public function save_administrator($data){
//inserting new category
  $this->db->insert('drug_administrators', $data);
}


 public function get_this_frequency($id)
  {  //select this user record from table users
  return $this->db->get_where('drug_frequencies', array('id' => $id), 1);;
  }
 public function get_this_quantity($id)
  {  //select this user record from table users
  return $this->db->get_where('drug_quantities', array('id' => $id), 1);;
  }
 public function get_this_dosage($id)
  {  //select this user record from table users
  return $this->db->get_where('drug_dosages', array('id' => $id), 1);;
  }
  public function get_this_administrator($id)
  {  //select this user record from table users
  return $this->db->get_where('drug_administrators', array('id' => $id), 1);;
  }
     
   
      //edit the category data
  public function update_frequency_data($data,$id)
   {
      $this->db->where('id', $id);
      $this->db->update('drug_frequencies', $data);
   }
 public function update_quantity_data($data,$id)
   {
      $this->db->where('id', $id);
      $this->db->update('drug_quantities', $data);
   }
 public function update_dosage_data($data,$id)
   {
      $this->db->where('id', $id);
      $this->db->update('drug_dosages', $data);
   }
   public function update_administrator_data($data,$id)
   {
      $this->db->where('id', $id);
      $this->db->update('drug_administrators', $data);
   }
 public function get_frequency(){
 return $this->db->get('drug_frequencies');
}
 public function get_quantity(){
 return $this->db->get('drug_quantities');
}
 public function get_dosage(){
 return $this->db->get('drug_dosages');
}
 public function get_administrator(){
 return $this->db->get('drug_administrators');
}
public function get_employee_stats(){
  return $this->db->query("SELECT Designation, Count(*) as num FROM employee GROUP BY Designation ");
}
public function get_clerks(){
  return $this->db->query("SELECT * FROM user Where Title='Clerk' ");
}
 public function get_this_sale_order_details($id)
  {  //select this user record from table users
  return $this->db->get_where('patient_bill', array('bill_no' => $id), 1);
  }
 public function get_this_sale_order_items($id)
  {  //select this user record from table users
  return $this->db->get_where('bill_transaction', array('bill_no' => $id));
  }
 public function update_patient_bill($data,$id)
   {
      $this->db->where('bill_no', $id);
      $this->db->update('patient_bill', $data);
   }
  public function update_diagnosis_data($data,$id)
   {
      $this->db->where('id', $id);
      $this->db->update('diagnosis', $data);
   }
    public function get_this_diagnosis($id)
     {  //select this user record from table users
  return $this->db->get_where('diagnosis', array('id' => $id));
  }
  public function save_diagnosis($data){
//inserting new category
  $this->db->insert('diagnosis', $data);
}
public function get_diagnosis(){
  return $this->db->query("SELECT * FROM diagnosis ");
}
public function get_custom_sales($var1,$var2){
  return $this->db->query("SELECT sum(amount_paid) as paidsum,date_paid FROM `patient_bill`WHERE  date_paid BETWEEN '$var1'AND '$var2' Group by date_paid ");
}
public function get_inpatient_sales($var1,$var2){
  return $this->db->query("SELECT sum(amount_paid) as paidsum,date_paid FROM `patient_bill`WHERE Patient_type='Inpatient' AND  date_paid BETWEEN '$var1'AND '$var2' Group by date_paid ");
}
public function get_clinic_sales($var1,$var2){
  return $this->db->query("SELECT sum(amount_paid) as paidsum,date_paid FROM `patient_bill`WHERE Patient_type='Clinic' AND  date_paid BETWEEN '$var1'AND '$var2' Group by date_paid ");
}
public function get_outpatient_sales($var1,$var2){
  return $this->db->query("SELECT sum(amount_paid) as paidsum,date_paid FROM `patient_bill`WHERE Patient_type='Outpatient' AND  date_paid BETWEEN '$var1'AND '$var2' Group by date_paid ");
}
public function get_custom_sales_report($var1,$var2){
  return $this->db->query("SELECT * FROM `patient_bill`WHERE  date_paid BETWEEN '$var1'AND '$var2' ");
}
public function get_clinic_sales_report($var1,$var2){
  return $this->db->query("SELECT * FROM `patient_bill`WHERE Patient_type='Clinic' AND date_paid BETWEEN '$var1'AND '$var2' ");
}
public function get_inpatient_sales_report($var1,$var2){
  return $this->db->query("SELECT * FROM `patient_bill`WHERE Patient_type='Inpatient' AND date_paid BETWEEN '$var1'AND '$var2' ");
}
public function get_outpatient_sales_report($var1,$var2){
  return $this->db->query("SELECT * FROM `patient_bill`WHERE Patient_type='Outpatient' AND date_paid BETWEEN '$var1'AND '$var2' ");
}

public function get_yearly_sales(){
  return $this->db->query("SELECT sum(amount_paid) as paidsum,MONTHNAME(date_paid) as month FROM `patient_bill`  WHERE YEAR(date_paid)=YEAR(NOW()) Group by MonthName(date_paid) ");
}
 public function get_today_sales_totals(){
    return $this->db->query("SELECT SUM(bill_total) as bill_totals, SUM(amount_paid) as paid_totals, SUM(balance) as balance_totals FROM  patient_bill WHERE DATE(date_created)=CURDATE()");
               
   }
public function get_patient_diagnosis($from,$to,$type,$diagnosis,$status)
{
    $array = array('date >=' => $from, 'date <=' => $to, 'patient_diagnosis.patient_type' => $type, 'diagnosis_name'=>$diagnosis,'patient_diagnosis.status'=>$status);
    $this->db->where($array);
    $this->db->select('*');
    $this->db->from('patient_diagnosis');
    $this->db->join('patient', 'patient.patient_no = patient_diagnosis.patient_no ');
    $this->db->join('patient_administrative_details', 'patient_administrative_details.patient_no = patient_diagnosis.patient_no ');
   return $this->db->get();

}
public function get_p_diagnosis($from,$to)
{
    $array = array('date >=' => $from, 'date <=' => $to);
    $this->db->where($array);
    $this->db->select('*');
    $this->db->from('patient_diagnosis');
    $this->db->join('patient', 'patient.patient_no = patient_diagnosis.patient_no ');
    $this->db->join('patient_administrative_details', 'patient_administrative_details.patient_no = patient_diagnosis.patient_no ');
   return $this->db->get();

}

/*
*function to retrieve the diagnosis analysis of patients at a given period of time
*
*/
 public function diagnosis_analytics($from,$to)
 {
    $sql="SELECT diagnosis_name, count(*) as num FROM patient_diagnosis WHERE DATE(patient_diagnosis.date) BETWEEN '$from' AND '$to' GROUP BY diagnosis_name";
    return $this->db->query($sql);
 }
/*
*function to retrieve the number of patients at a given period of time
*
*/
 public function patient_analytics($from,$to)
 {
    $sql="SELECT patient_type, count(*) as num FROM patient_files WHERE DATE(file_date) BETWEEN '$from' AND '$to' GROUP BY patient_type";
    return $this->db->query($sql);
 }

public function getAllProducts()
{
          $this->db->from('product');
          //$this->db->join('product_category', 'product_category.Row_id = product.Category');
          $this->db->where('product.Type', "Inventory item");
          $query = $this->db->get();
          return $query;
}



}