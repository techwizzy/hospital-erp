<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Refund_model extends CI_Model {

/*-----------------------------------------------------------------
*function to retrieve the refunds with 'pending approval' status
*------------------------------------------------------------------
*/

 public function get_refund_requests()
 {
  #STATUS='pending approval';
   $sql="SELECT * FROM refund  WHERE status='pending approval'";
    return $this->db->query($sql);
 }

public function get_refunds()
 {
  #STATUS='pending approval';
   $sql="SELECT * FROM refund";
    $q= $this->db->query($sql);
     if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
               
 }

/*-----------------------------------------------------------------
*function to retrieve the refund object from refund table
*------------------------------------------------------------------
*/
public function get_refund_object($id)
{
  # get refund object using the primary key
 /* $sql="SELECT * FROM refund WHERE refund_id='$id' ";
  $this->db->query($sql);*/
  return $this->db->get_where('refund', array('refund_id' => $id), 1);

}



/*-----------------------------------------------------------------
*function to retrieve the refund items from the refund details
*------------------------------------------------------------------
*/

public function get_refund_items($id)
{
    /*$this->db->where($filter_array);
    $this->db->select('*');
    $this->db->from('refund_details');*/
   /* $sql="SELECT * FROM refund_details WHERE refund_id='$id'";
    $this->db->query($sql);*/
     return $this->db->get_where('refund_details', array('refund_id' => $id));
}
public function get_refund_items1($id)
{
    /*$this->db->where($filter_array);
    $this->db->select('*');
    $this->db->from('refund_details');*/
   /* $sql="SELECT * FROM refund_details WHERE refund_id='$id'";
    $this->db->query($sql);*/
     return $this->db->get_where('refund_details', array('refund_id' => $id));
}

/*-----------------------------------------------------------------
*function to approve the refund request
*------------------------------------------------------------------
*/
 public function approve_refund($filter_data,$data_array)
 {
   # approve the refund of each item by changing the status of the refund item to approved or rejected
   #affected rows: status, approved_by
           $this->db->where($filter_data);
           $this->db->update('refund_details', $data_array);  
  
 }

#2: record the transacation of the refund on the bill transaction table

 public function record_refund_transaction($data_array)
 {
    #inserting a new record
     $this->db->insert('billtransaction_payments', $data_array);
 }
 #3: change the status of the refund object to approved 
 public function update_refund_request($filter_data,$data_array)
 {
           $this->db->where($filter_data);
           $this->db->update('refund', $data_array);
 }
 #1: Adjust the stock of this item
 public function positive_stock_adjust($filter_data,$qty)
 {
   # update the quantity in master inventory by adding the adjusted quantity 
   # where the item code is equal to the item code of the refunded item
  $sql="UPDATE master_inventory SET Available_stock=Available_stock+$qty WHERE item_code='$filter_data'";
  $this->db->query($sql);

 }
/*-----------------------------------------------------------------
*function to retrieve the all the refunds filtered from a specific period and status
*------------------------------------------------------------------
*/


public function get_custom_refund_report($from,$to,$status)
{
    $array = array('DATE(date_requested) >=' => $from, 'DATE(date_requested) <=' => $to,'status'=>$status);
    $this->db->where($array);
    $this->db->select('*');
    $this->db->from('refund');
    return $this->db->get();

}

public function get_item_type($value)
{
      $this->db->select('Type');
      $this->db->where('item_code', $value);
        $gettype = $this->db->get('master_inventory');
        if ($gettype->num_rows() > 0)
       {
       $row = $gettype->row();

       
       $cat=$row->Type;
       
     }
     return $cat; 
}

 public function get_daily_sales(){
    return $this->db->query("SELECT sum(bill_total) as total,date_paid FROM  patient_bill   GROUP BY date_paid ");
               
   }
       public function get_all_sales(){
        $today=date('Y-m-d 00:00:00');
     return $this->db->query("SELECT * FROM  patient_bill WHERE date_created >='$today' ORDER BY date_created DESC  ");
    
               
   }

     public function get_today_sales(){
    return $this->db->query("SELECT * FROM  patient_bill WHERE DATE(date_created)=CURDATE()");
               
   }
 public function get_sales($name,$date){
    return $this->db->query("SELECT * FROM  patient_bill WHERE username='$name' AND date_paid='$date' AND status='paid' ");
               
   }
   public function get_total_sales($name,$date){
    return $this->db->query("SELECT sum(bill_total) as total FROM  patient_bill WHERE DATE(date_paid)='$date' AND username='$name' AND status='paid'");
               
   }
   public function get_sum_sales(){
    return $this->db->query("SELECT sum(bill_total) as total FROM  patient_bill WHERE  DATE(date_created)=CURDATE() AND status='paid'");
               
   }
       public function get_weekly_sales(){
    return $this->db->query("SELECT * FROM  patient_bill WHERE WEEKOFYEAR( date_created ) = WEEKOFYEAR( curdate()) ");
               
   }
   public function get_monthly_purchases(){
    return $this->db->query("SELECT sum(total_value) as total,Supplier,status FROM  purchase_order WHERE MONTH(Date_paid ) = MONTH( curdate()) GROUP BY Supplier");
               
   }

public function get_monthly_sales(){
  return $this->db->query("SELECT * FROM patient_bill WHERE MONTH( date_created ) = MONTH( curdate( )) ");
}
public function get_weekly_salessum($id){
  

      return $this->db->query("SELECT sum(bill_total) FROM patient_bill WHERE WEEKOFYEAR( date_paid ) = WEEKOFYEAR( curdate( ) ) AND counter='$id'");
    }
public function get_monthly_salessum($id){
  

      return $this->db->query("SELECT sum(bill_total) FROM patient_bill WHERE counter='$id' AND MONTH( date_paid ) = MONTH( curdate( ))");
    }
   public function get_dairly_salessum($id){
      return $this->db->query("SELECT sum(bill_total) FROM patient_bill WHERE counter='$id' AND DAY(date_paid)=DAY(NOW())");
    }

 public function get_this_sale_order_details($id)
  {  //select this user record from table users
  return $this->db->get_where('billtransaction_payments', array('bill_no' => $id));
  }
  public function get_this_sale_order_bill($id)
  {  //select this user record from table users

  return $this->db->get_where('patient_bill', array('bill_no' => $id), 1)->row();
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
   public function update_bill_transactions($data,$id)
   {
      $this->db->where('bill_no', $id);
      $this->db->update('billtransaction_payments', $data);
   }


   //get custom sales with a daterange value
    public function get_daterange_sales($start,$end){
   
     return $this->db->query("SELECT * FROM  patient_bill WHERE date_created >= '$start' AND  date_created <= '$end' ORDER BY date_created DESC ");
   }

   public function get_daterange_sum($start,$end){
   
     return $this->db->query("SELECT sum(amount_paid) as sales_total FROM  billtransaction_payments WHERE date_paid >= '$start' AND  date_paid <= '$end' ");
   }

    public function get_today_sum(){
   
    return $this->db->query("SELECT sum(amount_paid) as sales_total FROM  billtransaction_payments WHERE date_paid >= curdate() AND  date_paid <=  curdate() ");
   }
}