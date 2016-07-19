<?php

class Purchase_model extends CI_Model {

public function __construct()
    {
        parent::__construct();
    }


  
/*-----------------------------------------------------------------
*function to get all suppliers
*------------------------------------------------------------------
*/
    function getAllSuppliers()
      {
      
        return $this->db->get('supplier');
      }

/*-----------------------------------------------------------------
*function to retrieve the particular supplier
*------------------------------------------------------------------
*/
    function getParticularSupplier($id)
      {
         
         return $this->db->get_where('supplier', array('Pin' => $id), 1);
       
       }
  
/*-----------------------------------------------------------------
*function to add supplier record
*------------------------------------------------------------------
*/
    function addSupplier($data)
      {
    
      if($this->db->insert('supplier', $data)){
         return TRUE;
      }
       return FALSE;
      }
   

/*-----------------------------------------------------------------
*function to update supplier
*------------------------------------------------------------------
*/
    function updateSupplier($data,$id)
      {
          if($this->db->where('Pin', $id)->update('supplier', $data)){
             return TRUE;
          }
          return FALSE;
      }
  
/*-----------------------------------------------------------------
*function to generate a purchase id
*------------------------------------------------------------------
*/
    function generatePurchaseId()
      {
          $query = $this->db->query('SELECT max(Order_no) as orderNo FROM purchase_order');
            foreach ($query->result() as $row)
            {
               $id=$row->orderNo+1;
            }
            return $id;
      }

/*-----------------------------------------------------------------
*function to insert purchase items into purchase lines
*------------------------------------------------------------------
*/
    function addPurchaseOrder($items,$data)
      {
            if(empty($items)){
              return FALSE;
            }

            $this->db->insert('purchase_lines', $items);
            $this->db->insert('purchase_order', $data);
      }

/*-----------------------------------------------------------------
*function to get a purchase order
*------------------------------------------------------------------
*/
    function getPurchaseOrder($id){
          return $this->db->select('*')
                      ->where('Order_no',$d);
                      ->from('purchase_lines')
                      ->join('purchase_order', ' purchase_order.Order_no = purchase_lines..Order_no')
                      ->get();
     }
/*-----------------------------------------------------------------
*function to get  purchase order details
*------------------------------------------------------------------
*/
    function getPurchaseOrderDetails($d){
          return $this->db->select('*')
                         ->where('Order_no',$d);
            $q = $this->db->get('purchase_order');
            if ($q->num_rows() > 0) {
                return $q->row();
            }
            return FALSE;
     }


   /*-----------------------------------------------------------------
*function to get  purchase order total
*------------------------------------------------------------------
*/
    function getPurchaseOrderTotal($d){

         return $this->db->select(" SUM(COALESCE(Total_Price, 0)) as total_price ")
                         ->where('Order_no',$d );
          $q = $this->db->get('purchase_lines');
          if ($q->num_rows() > 0) {
              return $q->row();
          }
          return FALSE;
     }
    /*-----------------------------------------------------------------
*function to update statuses of a purchase order 
*------------------------------------------------------------------
*/  
    function confirm_order_summary($data,$id){
          $this->db->where('Order_no', $id);
          $this->db->update('purchase_order', $data); 
     }
    function cancel_order_summary($data,$id){
          $this->db->where('Order_no', $id);
          $this->db->update('purchase_order', $data); 
    } 

    /*-----------------------------------------------------------------
*function to get purchase items to be received by GRN
*------------------------------------------------------------------
*/  

    function getItemsReceived($id){
        $where="Order_no=$id AND (Qty-Received)=0 ";
          $this->db->select("Order_no,Supplier,Date_ordered,Product,(Qty-Received) as q,Qty, Unit_cost,Total_Price ")
                          ->where($where);
        $q = $this->db->get('purchase_lines');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
 /*-----------------------------------------------------------------
*function to add incomig stock
*------------------------------------------------------------------
*/  
    function addIncomingStock($p,$qty,$cat){
        
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
 /*-----------------------------------------------------------------
*function update incoming order
*------------------------------------------------------------------
*/  
 function updateIncomingOrder($p,$q,$id,$desc){

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
/*-----------------------------------------------------------------
*function to get suppliers for autload
*------------------------------------------------------------------
*/  
   function getSupplierName($q){
    $this->db->select('Supplier_name');
    $this->db->like('Supplier_name', $q);
    $query = $this->db->get('supplier');
    if($query->num_rows > 0){
      foreach ($query->result_array() as $row){
        $row_set[] = htmlentities(stripslashes($row['Supplier_name'])); //build an array
      }
      echo json_encode($row_set); //format the array into json data
    }
  }
 /*-----------------------------------------------------------------
*function to get products
*------------------------------------------------------------------
*/  
  function get_products($q){
    $value='Inventory item';
    $this->db->select('Product_name,Code');
    $this->db->like('Product_name', $q);
    $this->db->where('Type', $value);
    $query = $this->db->get('product');
    
      if($query->num_rows > 0){
      foreach ($query->result_array() as $row){
        $name=$row['Product_name'];
        $code=$row['Code'];
       
        $row_set[] = array('label' =>$name,'value' =>$code); //build an array
      }
      echo json_encode($row_set); //format the array into json data
    }
 }

  /*-----------------------------------------------------------------
*function to get sku
*------------------------------------------------------------------
*/  
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

 /*-----------------------------------------------------------------
*function to get category
*------------------------------------------------------------------
*/  
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


  public function get_pending_orders(){
     return $this->db->query("SELECT * FROM purchase_order WHERE Status='pending' ");  
   }
//get processed purchase orders
   public function get_purchase_orders(){
    return $this->db->query("SELECT * FROM purchase_order  WHERE status='processed' ");
   }
   //get unpaid purchase orders
   public function get_unpaid_porders(){
     return $this->db->query("SELECT * FROM purchase_order
                                             WHERE ((Total_value)-(Amount_paid)) > 0 
                                             AND Status='received'  ");
   }

   public function update_order_summary($data,$id){
        $this->db->where('order_no', $id);
        $this->db->update('purchase_order', $data); 
    }


   function insert_transaction($data)
      {
         $this->db->insert('transaction', $data);
       }


    public function update_inventory($product,$qty,$unit,$code,$price){
     
              if($unit=='carton'){
                ///////////////get the quantity to be added///////////////////
          $this->db->select('carton_size,Reorder_level,Sprice');
            $this->db->where('Product_name', $product);
              $getq = $this->db->get('product');
               $row = $getq->row();

              if ($getq->num_rows() > 0)
             {
                 
                          $value=$row->carton_size;
                          $q=$value*$qty;
                          
                 $totalp=$price/$value;
               //////////////////////////////////////////////////
    
        }else{
          //insert a new record into the inventory
                 $sprice=$row->Sprice;
                 $bprice=$row->Bprice;
                 $rl=$row->Reorder_level;
                 $data = array(
                   'item_code'=>$code,
                   'Product_name'=>$product,
                   'Type'=>'Inventory item',
                   'Selling_price'=>$sprice,
                   'Reorder_level'=> $rl
              
        );    
         $this->db->insert('master_inventory', $data);
        }
          

}else{
        //if its a unit
       $this->db->select('Reorder_level,Sprice');
            $this->db->where('Product_name', $product);
              $getq = $this->db->get('product');
               $row = $getq->row();
               $rl=$row->Reorder_level;
               $sprice=$row->Sprice;
               
                 $this->db->select('Stock_id,Selling_price');
                 $this->db->where('Product_name', $product);
                 $getData = $this->db->get('master_inventory'); 
                 if($getData->num_rows()!=0){
                     $this->db->query("UPDATE master_inventory  SET  Selling_price='$sprice' WHERE Product_name='$product' ");
                 }else{ 
                $data = array(
                   'item_code'=>$code,
                   'Product_name'=>$product,
                   'Type'=>'Inventory item',
                   'Selling_price'=>$sprice,
                   'Reorder_level'=> $rl
              
        );    
  
                 $this->db->insert('master_inventory', $data);
               }
        }

}
    public function supplierPinExists($value){
        $this->db->where('Pin', $value);
        $this->db->from('supplier');
        $query = $this->db->get();
       if ($query->num_rows() > 0) {
          return TRUE;
        } else {
          return FALSE;
        }
    }

       public function supplierNameExists($value){
        $this->db->where('Supplier_name', $value);
        $this->db->from('supplier');
        $query = $this->db->get();
       if ($query->num_rows() > 0) {
          return TRUE;
        } else {
          return FALSE;
        }
    }

    public function get_approved_purchase_orders(){
      return $this->db->query("SELECT * FROM purchase_order WHERE Status='processed' ");
    }

    public function get_this_approved_purchase_order($no){
      return $this->db->query("SELECT * FROM purchase_lines WHERE Order_no='$no' AND (Qty-Received) > 1 ");
    }

    public function get_this_approved_purchase_order_total($no){
      return $this->db->query("SELECT SUM(Total_Price) as total  FROM purchase_lines WHERE Order_no='$no' AND (Qty-Received) > 1  ");
    }
     public function get_unpaid_porders_total(){
     return $this->db->query("SELECT SUM(Total_value) as total,SUM(Amount_paid) as paid, SUM((Total_value)-(Amount_paid)) as balance FROM purchase_order
                                             WHERE ((Total_value)-(Amount_paid)) > 0 
                                             AND Status='received'  ");
   }
   public function get_received_purchase_orders(){
      return $this->db->query("SELECT * FROM purchase_order WHERE Status='received' ");
    }
       public function get_this_received_purchase_order($no){
      return $this->db->query("SELECT * FROM purchase_lines WHERE Order_no='$no' AND (Qty-Received)!= Qty ");
    }
   public function get_this_received_purchase_order_total($no){
      return $this->db->query("SELECT SUM(Total_Price) as total  FROM purchase_lines WHERE Order_no='$no' AND (Qty-Received)!= Qty ");
    }
    //get unpaid purchase orders
   public function get_paid_porders(){
     return $this->db->query("SELECT * FROM purchase_order
                                             WHERE ((Total_value)-(Amount_paid)) = 0 
                                             AND Status='received'  ");
}
}