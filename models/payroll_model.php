<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getEmployeeData($q)
    {
      
         $this->db->select('*');
         $this->db->like('Firstname', $q);
         $query = $this->db->get('user');
        
          if($query->num_rows > 0){
          foreach ($query->result_array() as $row){
            $id=$row['Staff_no'];
            $name=$row['Firstname'];
            $value1=$row['Lastname'];

            $this->db->where('Employee_id',$id);
            $q = $this->db->get('salary_details');
            if($q->num_rows > 0){
                $data['message']="user details already exists";
            }else{
             $row_set[] = array('label' =>$name.' '.$value1,'fname'=>$name,'lname'=>$value1,'id'=>$id); //build an array
              }
          }

      echo json_encode($row_set); //format the array into json data
    }
    }

     public function getStaffBanks($id,$q)
    {
      
         $this->db->select('*');
         $this->db->like('bank_name', $q);
         $this->db->where('user_id',$id);
         $query = $this->db->get('bank_details');
        
          if($query->num_rows > 0){
          foreach ($query->result_array() as $row){
            $id=$row['id'];
            $name=$row['bank_name'];
            $value1=$row['branch'];
            $value2=$row['account'];
          
            $row_set[] = array('label' =>$name.' - '.$value1,'branch'=>$value1,'account'=>$value2,'bank_name'=>$name); //build an array
              
          }

      echo json_encode($row_set); //format the array into json data
    }
    }

     /**
     * Checks if the user is already registered in payroll
     *
     * @return bool
     * @author alois
     **/
    public function exist_in_payroll($id = FALSE)
    {
      
       $query=$this->db->query("SELECT * FROM salary_details WHERE Employee_id='$id' ");
       if($query->num_rows()>0){
         return true;
        }else{
         return false;
       }
    }


    public function addLoan($data)
    {
        if ($this->db->insert('loans', $data)) {
            return true;
        }
         return false;
        
    }

     public function register_salary($data)
    {
        if($this->db->insert('salary_details', $data)){
            return TRUE;
        } 
        return FALSE;
    }
    /*GET SALARIES*/

    public function getSalaries(){
     return  $this->db->select('*')
                      ->from('salary_details')
                      ->join('user', 'user.Staff_no = salary_details.Employee_id')
                      ->get();
    }
   
   public function salary($id){
     return $this->db->where('Employee_id',$id)
                     ->get('salary_details');
   }
  public function getUserSalary($id = FALSE){


        if (empty($id))
        {
            return FALSE;
        }

        //get salary details
    $query=$this->db->select('*')
                    ->where('Employee_id', $id)
                    ->join('user', 'user.Staff_no = salary_details.Employee_id')
                    ->from('salary_details')
                    ->get();
     return $query;
      
      }
 public function updateUserSalary($id,$data)
    {
       $this->db->where('Employee_id',$id)
                ->update('salary_details', $data);
    }
   //get user deductions
   public function getUserDeductions($id){


       
       $month=date('m');
       $year=date('Y');
       
      return $this->db->query("SELECT * FROM deductions WHERE Employee_id='$id' AND MONTH(Date_deducted)='$month' AND YEAR(Date_deducted)='$year'");
      }
   public function getDeductionTotal($id)
   {
       $month=date('m');
       $year=date('Y');
       $q= $this->db->query("SELECT SUM(COALESCE(Amount, 0)) as total_deduction FROM deductions WHERE Employee_id='$id' AND MONTH(Date_deducted)='$month' AND YEAR(Date_deducted)='$year'");
       if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
   }
  
   //get user loans and savings
   public function getUserCurrentLoans($id){
   
        $checkDate=date('Y-m-d');
      
         return $this->db->query("SELECT * FROM loans WHERE  Employee_id='$id' AND '$checkDate' BETWEEN Start_date AND stop_date");
     }
 //check whether an employee has  a loan, savings scheme 
 public function checkLoan($id,$Title)
 {
      if (empty($id))
        {
            return FALSE;
        }

    //variables
     $checkDate=date('Y-m-d');

     $where="Employee_id='$id' AND Title='$Title' AND $checkDate BETWEEN Start_date AND stop_date and status";
            //get salary details
        return $this->db->select('*')
                        ->where($where)
                        ->from('loans')
                        ->get();
}
 
public function stopLoan($id){
     if (empty($id))
        {
            return FALSE;
        }
        $data = array('Status' => 'stopped');

        $this->db->where('Row_id', $id);
        if($this->db->update('loans', $data)){
            return TRUE;
        }
        return FALSE;
}
public function addDeduction($data)
    {
        if ($this->db->insert('deductions', $data)) {
            return true;
        }
         return false;
        
    }
public function updateDeduction($id,$data)
    {
       $this->db->where('Row_id',$id)
                ->update('deductions', $data);
    }
  //get a deduction 
 public function getDeduction($id)
 {
      if (empty($id))
        {
            return FALSE;
        }

   return $this->db->select('*')
                        ->where('Row_id',$id)
                        ->from('deductions')
                        ->get();
}

  //get deductions 
 public function getDeductions($where)
 {
      if (empty($where))
        {
            return $this->db->select('*')
                        ->from('deductions')
                        ->get();
        }

        return $this->db->select('*')
                        ->where($where)
                        ->from('deductions')
                        ->get();
} 
public function addUserBank($data)
    {
        if ($this->db->insert('bank_details', $data)) {
            return true;
        }
         return false;
        
    }
  //get user bank 
 public function getUserBanks($where)
 {
      if (empty($where))
        {
            return FALSE;
        }

        return $this->db->select('*')
                        ->where('user_id',$where)
                        ->from('bank_details')
                        ->get();
} 
//add a salary posting
public function addPayment($data)
    {
        if ($this->db->insert('payslip', $data)) {
            return true;
        }
         return false;
        
    }
public function addGratuity($data)
    {
        if ($this->db->insert('gratuity', $data)) {
            $this->db->insert_id();
            return true;
        }
         return false;
        
    }
public function addLoanPosting($data)
    {
        if ($this->db->insert('loan_posting', $data)) {
            return true;
        }
         return false;
        
    }

public function getLoanTotal($id)
   {
       $checkDate=date('Y-m-d');
       $q= $this->db->query("SELECT SUM(COALESCE(Monthly_repayment, 0)) as total_loan FROM loans WHERE Employee_id='$id' AND '$checkDate' BETWEEN Start_date AND stop_date");
       if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
   }
 public function getPaySlip($id)
 {
        $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
        $last_day_this_month  = date('Y-m-t');

      
        $q= $this->db->query("SELECT * FROM payslip WHERE Salary_date BETWEEN '$first_day_this_month' AND '$last_day_this_month' AND Employee_id='$id'");
         if ($q->num_rows() > 0) {
              return $q->row();
          }
          return FALSE;

}
 public function getGratuity($id)
 {
        $first_day_this_month = date('Y'); // hard-coded '01' for first day
        $last_day_this_month  = date('Y');

      
        $q= $this->db->query("SELECT * FROM gratuity WHERE Year(Salary_date) BETWEEN '$first_day_this_month' AND '$last_day_this_month' AND Employee_id='$id'");
         if ($q->num_rows() > 0) {
              return $q->row();
          }
          return FALSE;

}
 public function checkPayslipExists($id){
    $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
    $last_day_this_month  = date('Y-m-t');

      $query=$this->db->query("SELECT * FROM payslip WHERE Start_date='$first_day_this_month' AND End_date='$last_day_this_month' AND Employee_id='$id'");
      if($query->num_rows()>0){
         return true;
      }else{
         return false;
      }
   }
 public function checkGratuityExists($id){
    $first_day_this_month = date('Y'); // hard-coded '01' for first day
    $last_day_this_month  = date('Y');

      $query=$this->db->query("SELECT * FROM gratuity WHERE YEAR(Start_date)='$first_day_this_month' AND Year(End_date)='$last_day_this_month' AND Employee_id='$id'");
      if($query->num_rows()>0){
         return true;
      }else{
         return false;
      }
   }
    public function getLoanPostings($id)
     {
          if (empty($id))
            {
                return FALSE;
            }
         $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
         $last_day_this_month  = date('Y-m-t');

           $where="Employee_id=".$id." AND date_posted  BETWEEN ".$first_day_this_month." AND ".$last_day_this_month."";
            return $this->db->select('*')
                            ->where($where)
                            ->from('loan_postings')
                            ->get();
    }
	public function get_p10($year){
  return $this->db->query("SELECT Firstname, Lastname,KRA_Pin,SUM(PAYE) as tax, SUM(Monthly_salary-200) AS totalGross from payslip  WHERE YEAR(Salary_date)='$year' GROUP BY Employee_id  ");
}
public function get_p10_total($year){
  return $this->db->query("SELECT SUM(PAYE) as totalPaye  from payslip  WHERE YEAR(Salary_date)='$year' ");
}
public function get_p9($year,$id){
  return $this->db->query("SELECT PAYE as totalPaye, Monthly_salary as totalGross, MONTHNAME(End_date) as month, Total_salary, Firstname,Lastname, KRA_Pin from payslip  WHERE Employee_id='$id' AND YEAR(End_date)='$year'  ");
}
public function get_p9_total($year,$id){
  return $this->db->query("SELECT SUM(PAYE) as totalPaye,
   SUM(Monthly_salary) as totalGross, SUM(Total_salary) as nettotal from payslip   WHERE Employee_id='$id' AND YEAR(End_date)='$year' ");
}

public function getSalariedStaff($q)
    {
      
         $this->db->select('*');
         $this->db->like('Firstname', $q);
         $query = $this->db->get('user');
        
          if($query->num_rows > 0){
          foreach ($query->result_array() as $row){
            $id=$row['Staff_no'];
            $name=$row['Firstname'];
            $value1=$row['Lastname'];

            $this->db->where('Employee_id',$id);
            $q = $this->db->get('salary_details');
            if($q->num_rows > 0){
                  $row_set[] = array('label' =>$name.' '.$value1,'fname'=>$name,'lname'=>$value1,'id'=>$id); //build an array
            
            }
          }

      echo json_encode($row_set); //format the array into json data
    }
    }

      public function get_filtered_salary_transfers($Start, $End, $bank){
          return $this->db->query("SELECT * FROM payslip WHERE Bank='$bank' AND Salary_date BETWEEN '$Start' AND '$End'  ");
                     
         }
      public function get_filtered_salary_transfers_total($Start, $End, $bank){
          return $this->db->query("SELECT  Sum(Net_salary) as totalNet
                                                          FROM payslip 
                                                          WHERE  Bank='$bank' AND Salary_date 
                                                          BETWEEN '$Start' AND '$End' ");
                     
         }
           public function getPayslipDeductions($id)
           {
              $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
              $last_day_this_month  = date('Y-m-t');
               $q= $this->db->query("SELECT * FROM deductions WHERE Employee_id='$id' AND Date_deducted  BETWEEN '$first_day_this_month' AND '$last_day_this_month' ");
               return $q;
           }
}