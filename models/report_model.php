<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report_model extends CI_Model {

	public function getChartData()
	    {
	        $myQuery = " SELECT  date_format(date_paid, '%Y-%m') as month, SUM(amount_paid) as sales
	                   FROM billtransaction_payments
	                   WHERE date_paid >= date_sub( now( ) , INTERVAL 12 MONTH ) 
	                GROUP BY date_format(date_paid, '%Y-%m') ORDER BY date_format(date_paid, '%Y-%m')";
	        $q = $this->db->query($myQuery);
	        if ($q->num_rows() > 0) {
	            foreach (($q->result()) as $row) {
	                $data[] = $row;
	            }
	            return $data;
	        }
	        return FALSE;
	    }

	public function getInpatientChartData()
	    {
	        $myQuery = " SELECT  date_format(date_paid, '%Y-%m') as month, SUM(amount_paid) as sales
	                   FROM billtransaction_payments
	                   WHERE date_paid >= date_sub( now( ) , INTERVAL 12 MONTH ) AND patient_type='Inpatient'
	                GROUP BY date_format(date_paid, '%Y-%m') ORDER BY date_format(date_paid, '%Y-%m')";
	        $q = $this->db->query($myQuery);
	        if ($q->num_rows() > 0) {
	            foreach (($q->result()) as $row) {
	                $data[] = $row;
	            }
	            return $data;
	        }
	        return FALSE;
	    }

      public function getOutpatientChartData()
	    {
	        $myQuery = " SELECT  date_format(date_paid, '%Y-%m') as month, SUM(amount_paid) as sales
	                   FROM billtransaction_payments
	                   WHERE date_paid >= date_sub( now( ) , INTERVAL 12 MONTH ) AND patient_type='Outpatient'
	                GROUP BY date_format(date_paid, '%Y-%m') ORDER BY date_format(date_paid, '%Y-%m')";
	        $q = $this->db->query($myQuery);
	        if ($q->num_rows() > 0) {
	            foreach (($q->result()) as $row) {
	                $data[] = $row;
	            }
	            return $data;
	        }
	        return FALSE;
	    }
	    public function getClinicChartData()
	    {
	        $myQuery = " SELECT  date_format(date_paid, '%Y-%m') as month, SUM(amount_paid) as sales
	                   FROM billtransaction_payments
	                   WHERE date_paid >= date_sub( now( ) , INTERVAL 12 MONTH ) AND patient_type='Clinic'
	                GROUP BY date_format(date_paid, '%Y-%m') ORDER BY date_format(date_paid, '%Y-%m')";
	        $q = $this->db->query($myQuery);
	        if ($q->num_rows() > 0) {
	            foreach (($q->result()) as $row) {
	                $data[] = $row;
	            }
	            return $data;
	        }
	        return FALSE;
	    }
       public function getTotalPaidAmountInpatient($start, $end)
	    {
	        $q = $this->db->query("SELECT SUM(amount_paid) as total_amount from billtransaction_payments WHERE patient_type='Inpatient' AND date_paid BETWEEN '$start' and '$end'");
	        if ($q->num_rows() > 0) {
	            return $q->row();
	        }
	        return FALSE;
	    }
	     public function getTotalPaidAmountOutpatient($start, $end)
	    {
	        $q = $this->db->query("SELECT SUM(amount_paid) as total_amount from billtransaction_payments WHERE patient_type='Outpatient' AND date_paid BETWEEN '$start' and '$end'");
	        if ($q->num_rows() > 0) {
	            return $q->row();
	        }
	        return FALSE;
	    }
        public function getTotalPaidAmountClinic($start, $end)
	    {
	        $q = $this->db->query("SELECT SUM(amount_paid) as total_amount from billtransaction_payments WHERE patient_type like '%Clinic%' AND date_paid BETWEEN '$start' and '$end'");
	        if ($q->num_rows() > 0) {
	            return $q->row();
	        }
	        return FALSE;
	    }
	    /*
		*Get stock total
		*/
		 public function getStockTotal(){
		    $query=$this->db->query("SELECT sum(Available_stock*Selling_price) as stock_price FROM master_inventory  ");
		    if($query->num_rows()>0){
		         return $query->row();
		      }else{
		         return false;
		      }           
		   }

         public function getTotalInventoryItems(){
		    $query=$this->db->query("SELECT count(Stock_id) as inventory_no   FROM  master_inventory WHERE Type='Inventory item' ");
		    if($query->num_rows()>0){
		         return $query->row();
		      }else{
		         return false;
		      }           
		   }
		  public function getTotalServiceItems(){
		    $query=$this->db->query("SELECT count(Stock_id) as service_no   FROM  master_inventory WHERE Type='Service item' ");
		    if($query->num_rows()>0){
		         return $query->row();
		      }else{
		         return false;
		      }           
		   }

		   public function getReorderItems(){
		   return $this->db->query("SELECT *  FROM  master_inventory WHERE Available_stock <= Reorder_level AND Type='Inventory item' ");
		          
		   }
		     public function getProducts(){
		    $query=$this->db->query("SELECT *  FROM  master_inventory WHERE Type='Inventory item' ");
		    if($query->num_rows()>0){
		         return $query->result();
		      }else{
		         return false;
		      }           
		   }

		       public function getCategories(){
		    $query=$this->db->query("SELECT *  FROM  product_category  ");
		    if($query->num_rows()>0){
		         return $query->result();
		      }else{
		         return false;
		      }           
		   }
		   
		    public function getCustomSales($start,$end, $type = NULL, $method= NULL ){
		    if(isset($type)  && isset($method)){
		     return $query=$this->db->query("SELECT *  FROM  billtransaction_payments WHERE  patient_type='$type' AND payment_method='$method' AND date_paid BETWEEN  '$start' AND '$end' ");
		     }
            
		      elseif(isset($type)){
		      return $query=$this->db->query("SELECT *  FROM  billtransaction_payments WHERE patient_type='$type' AND date_paid BETWEEN  '$start' AND '$end' ");
		     }
		      elseif(isset($method)){
		       return $query=$this->db->query("SELECT *  FROM  billtransaction_payments WHERE  payment_method='$method' AND date_paid BETWEEN  '$start' AND '$end' ");
		     }
		     else{
		      return $query=$this->db->query("SELECT *  FROM  billtransaction_payments WHERE date_paid BETWEEN  '$start' AND '$end'  ");	
		     }
		      
		   }

		   public function getClerkSales($start,$end,$clerk= NULL)
		   {
		     
		     if(isset($clerk)){
		       return $query=$this->db->query("SELECT *  FROM  billtransaction_payments WHERE username='$clerk'  AND date_paid BETWEEN  '$start' AND '$end' ");
		   }else{
		   	return $query=$this->db->query("SELECT *  FROM  billtransaction_payments WHERE  date_paid BETWEEN  '$start' AND '$end' ");
		   }
		     
		   }
		   

		  /* public function getPayments(){
		    $query=$this->db->query("SELECT *  FROM  product_category  ");
		    if($query->num_rows()>0){
		         return $query->result();
		      }else{
		         return false;
		      }           
		   }*/

		   public function getPurchases($start,$end){
		    return $query=$this->db->query("SELECT *  FROM  purchase_order WHERE Date_created BETWEEN  '$start' AND '$end'  ");
		     
		   }
		   
		   public function getSuppliers(){
		   	//$this->db->select('supplier.Pin,supplier.Supplier_name,supplier.Phone,supplier.Email, count(purchase_order.Order_no) as purchase_count, sum(purchase_order.Total_value) as total_amount, sum(purchase_order.Amount_paid) as paid');
			$this->db->from('supplier');
			//$this->db->group_by('supplier.Supplier_name');
			//$this->db->join('purchase_order', 'purchase_order.Supplier = supplier.Supplier_name');
			$query = $this->db->get();
		    if($query->num_rows()>0){
		         return $query->result();
		      }else{
		         return false;
		      }           
		   }
		   
		   public function getStaff(){
		     return $this->db->query("SELECT *  FROM  user order by Firstname Asc ");
		     
		   }
		   
		   public function getDiagnosis($start,$end){
		    $query=$this->db->query("SELECT *, count(id) as patient_no  FROM  patient_diagnosis WHERE date BETWEEN  '$start' AND '$end' GROUP BY date order by date ");
		    if($query->num_rows()>0){
		         return $query->result();
		      }else{
		         return false;
		      }           
		   }
		   
		   public function getDiagnosticReport($from,$to)
		   {
		        $array = array('date >=' => $from, 'date <=' => $to);
			   
			    $this->db->select('*');
			    $this->db->from('patient_diagnosis');
			    $this->db->where($array);
			    $this->db->join('patient', 'patient.patient_no = patient_diagnosis.patient_no ');
			    $this->db->join('patient_administrative_details', 'patient_administrative_details.patient_no = patient_diagnosis.patient_no ');
			   $query=$this->db->get();
			   if($query->num_rows()>0){
		         return $query->result();
		      }else{
		         return false;
		      }     
		   }
		      public function getMonthlyDiagnoReport($from,$to)
		   {
		        $array = array('date >=' => $from, 'date <=' => $to);
			   
			    $this->db->select('*');
			    $this->db->from('patient_diagnosis');
			    $this->db->where($array);
			    $this->db->join('patient', 'patient.patient_no = patient_diagnosis.patient_no ');
			    $this->db->join('patient_administrative_details', 'patient_administrative_details.patient_no = patient_diagnosis.patient_no ');
			    $query=$this->db->get();
			   if($query->num_rows()>0){
		         return $query->result();
		      }else{
		         return false;
		      }     
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

			  public function getPayrollData($start,$end){
			    $query=$this->db->query("SELECT *  FROM  payslip WHERE Salary_date BETWEEN  '$start' AND '$end'   ");
			    if($query->num_rows()>0){
			         return $query->result();
			      }else{
			         return false;
			      }           
		   }
		   public function get_filtered_salary_transfers($Start, $End, $bank){
			    return $this->db->query("SELECT * FROM payslip WHERE Bank='$bank' AND Salary_date BETWEEN '$Start' AND '$End'  ");
			               
			   }
			public function get_filtered_salary_transfers_total($Start, $End, $bank){
			    return $this->db->query("SELECT  Sum(Total_salary) as totalNet
			                                                    FROM payslip 
			                                                    WHERE  Bank='$bank' AND Salary_date 
			                                                    BETWEEN '$Start' AND '$End' ");
			               
			   }
		   
		     public function getDeductionData($start,$end){
			    $query=$this->db->query("SELECT *  FROM  deductions WHERE Date_deducted BETWEEN  '$start' AND '$end'   ");
			    if($query->num_rows()>0){
			         return $query->result();
			      }else{
			         return false;
			      }           
		   }
          
			   //get user loans and savings
			   public function getCurrentLoans($checkDate){
			   
			        $checkDate=date('Y-m-d');
			      
			         return $this->db->query("SELECT * FROM loans WHERE  Employee_id='$id' AND '$checkDate' BETWEEN Start_date AND stop_date");
			     }

			     public function getDailyChartData()
				    {

       					 $start = date('Y-m-01'); // hard-coded '01' for first day
			  		      $end  = date('Y-m-t');
				        $myQuery = " SELECT  date_paid as day, SUM(amount_paid) as sales
				                   FROM billtransaction_payments
				                   WHERE date_paid BETWEEN '$start' and '$end' 
				                GROUP BY date_paid ORDER BY date_paid";
				        $q = $this->db->query($myQuery);
				        if ($q->num_rows() > 0) {
				            foreach (($q->result()) as $row) {
				                $data[] = $row;
				            }
				            return $data;
				        }
				        return FALSE;
				    }
				  
				  public function getInsuranceData($start,$end)
				    {

				        $myQuery = " SELECT  * FROM patient_bill
				                   WHERE date_paid BETWEEN '$start' and '$end' AND payment_method='Nhif'
				                GROUP BY date_paid ORDER BY date_paid";
				        $q = $this->db->query($myQuery);
				        if ($q->num_rows() > 0) {
				            foreach (($q->result()) as $row) {
				                $data[] = $row;
				            }
				            return $data;
				        }
				        return FALSE;
				    }  
				
			public function getLoanData($start,$end){
			    $where="Start_date >= '$start' AND stop_date <= '$end'";
			         $this->db->select('*')
                      ->from('loans')
                       ->join('users', 'users.Staff_no = loans.Employee_id');
                      
              $query=$this->db->get();

			    if($query->num_rows()>0){
			         return $query->result();
			      }else{
			         return false;
			      }           
		   }
          
          public function daily_profit()
          {
          	 $start=date('Y-m-d');
          	 $end=date('Y-m-d');
          	 return $this->db->query("SELECT SUM('amount_paid') as total_paid, payment_method FROM billtransaction_payments WHERE  date_paid = CURDATE() GROUP BY payment_method, date_paid ")->result();
          }

               public function getGratuityData($year){
			    $query=$this->db->query("SELECT *  FROM  gratuity WHERE Year(Salary_date)='$year'  ");
			    if($query->num_rows()>0){
			         return $query->result();
			      }else{
			         return false;
			      }           
		   }
          
          public function getClerks(){
		    $query=$this->db->query("SELECT *  FROM  user WHERE Title='Clerk'  ");
		    if($query->num_rows()>0){
		         return $query->result();
		      }else{
		         return false;
		      }           
		   }
	 public function get_patient_diagnosis($from,$to,$type=NULL,$diagnosis=NULL,$status=NULL)
		{
			$array = array('patient_diagnosis.date >=' => $from, 'patient_diagnosis.date <=' => $to);
				if(!empty($type) && empty($diagnosis) && empty($status)){
		    $array = array('patient_diagnosis.date >=' => $from, 'patient_diagnosis.date <=' => $to, 'patient_diagnosis.patient_type' => $type);
	     	}
			if(!empty($type) && !empty($diagnosis) && !empty($status)){
		    $array = array('patient_diagnosis.date >=' => $from, 'patient_diagnosis.date <=' => $to, 'patient_diagnosis.patient_type' => $type, 'diagnosis_name'=>$diagnosis,'patient_diagnosis.status'=>$status);
	     	}

	     	if(!empty($type) && !empty($diagnosis)){
	     		$array = array('patient_diagnosis.date >=' => $from, 'patient_diagnosis.date <=' => $to, 'patient_diagnosis.patient_type' => $type, 'diagnosis_name'=>$diagnosis);
	     	}
		    if(!empty($type)  && !empty($status)){
		    $array = array('patient_diagnosis.date >=' => $from, 'patient_diagnosis.date <=' => $to, 'patient_diagnosis.patient_type' => $type, 'patient_diagnosis.status'=>$status);
	     	}
	     	if(!empty($diagnosis) && !empty($status)){
		    $array = array('patient_diagnosis.date >=' => $from, 'patient_diagnosis.date <=' => $to, 'diagnosis_name'=>$diagnosis,'patient_diagnosis.status'=>$status);
	     	}

		    $this->db->select('*');
		    $this->db->from('patient_diagnosis');
		    $this->db->join('patient', 'patient.patient_no = patient_diagnosis.patient_no ');
		    $this->db->join('patient_administrative_details', 'patient_administrative_details.patient_no = patient_diagnosis.patient_no ');
		     $this->db->where($array);
		   return $this->db->get();

		}
		public function get_p_diagnosis($from,$to)
		{
		    $array = array('patient_diagnosis.date >=' => $from, 'patient_diagnosis.date <=' => $to);
		    
		    $this->db->select('*');
		    $this->db->from('patient_diagnosis');
		    $this->db->join('patient', 'patient.patient_no = patient_diagnosis.patient_no ');
		    $this->db->join('patient_administrative_details', 'patient_administrative_details.patient_no = patient_diagnosis.patient_no ');
		    $this->db->where($array);
		   return $this->db->get();

		}

	  public function get_diagnosis(){
	     return $this->db->query("SELECT * FROM diagnosis ");
	   }
  }
