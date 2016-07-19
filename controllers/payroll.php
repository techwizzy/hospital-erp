<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation','cart'));
		$this->lang->load('en_admin');
		//$this->load->helper(array('url','language'));
        $this->load->model('payroll_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');

	}

	// redirect if needed, otherwise display the user list
	function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			$this->data['message']='You must be an administrator to view this page.';
			$this->load->view('auth/404', $this->data);
		}
		else
		{

			
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
     
			//render the basic profile page for the payroll

			$this->render_page('payroll/basic_profile', $this->data);
		}
	}
    
    public function Salaries()
    {
    	    
        if (!$this->ion_auth->is_admin()) {
            $this->data['message']='You must be an administrator to view this page.';
			$this->load->view('auth/404', $this->data);
        }else{
        $this->data['title'] = "Salaries";
        // set the flash data error message if there is one
		    $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['salaries']=$this->payroll_model->getSalaries();
        $this->render_page('payroll/salaries', $this->data);
        }
    }
	
	// new payroll posting
	public function newPosting($id)
	{
		$this->data['title'] = "New Posting";

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

         if(!isset($id)){
           $this->session->set_flashdata('error', 'No user selected');
          $this->render_page('error/504', $this->data);

         }elseif( $this->payroll_model->checkPayslipExists($id)){
           $this->session->set_flashdata('error', 'Payroll has been already been processed for this user');
            $this->data['error'] = $this->session->flashdata('error'); 
         $this->render_page('payroll/error', $this->data);
         }else{
        //retrieve from earnings
       $this->data['salary'] = $this->payroll_model->getUserSalary($id)->row();
       $this->data['deductions']=$this->payroll_model->getUserDeductions($id)->result();
       $this->data['total']=$this->payroll_model->getDeductionTotal($id);
       $this->data['loanTotal']=$this->payroll_model->getLoanTotal($id);
       $this->data['loans']=$this->payroll_model->getUserCurrentLoans($id)->result();
       $this->data['banks']=$this->payroll_model->getUserBanks($id);
       $this->render_page('payroll/payroll_posting', $this->data);
       }

     
	}
  public function newGratuity($id)
  {
    $this->data['title'] = "New Gratuity Posting";

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

         if(!isset($id)){
           $this->session->set_flashdata('error', 'No user selected');
          $this->render_page('error/504', $this->data);

         }elseif( $this->payroll_model->checkGratuityExists($id)){
           $this->session->set_flashdata('error', 'Gratuity has been already been processed for this user');
            $this->data['error'] = $this->session->flashdata('error'); 
          $this->render_page('payroll/error', $this->data);
         }else{
        //retrieve from earnings
       $this->data['salary'] = $this->payroll_model->getUserSalary($id)->row();
       $this->data['deductions']=$this->payroll_model->getUserDeductions($id)->result();
       $this->data['total']=$this->payroll_model->getDeductionTotal($id);
       $this->data['loanTotal']=$this->payroll_model->getLoanTotal($id);
       $this->data['loans']=$this->payroll_model->getUserCurrentLoans($id)->result();
       $this->data['banks']=$this->payroll_model->getUserBanks($id);
       $this->render_page('payroll/gratuity_posting', $this->data);
       }

     
  }
    public function addNewPosting(){
     if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

           $this->form_validation->set_rules('bank_name', 'Bank name', 'required');
             $salary_date=date('Y-m-d');
             $startdate=date('Y-m-01');
             $enddate=date('Y-m-t');
             $id=$this->input->post('id');
       if ($this->form_validation->run() == true)
        {
          $data=array(
             'Employee_id'=>$id,
             'no'=>$this->input->post('nid'),
             'Firstname'=>$this->input->post('first_name'),
             'Lastname'=>$this->input->post('last_name'),
             'Salary_date'=>$salary_date,
             'Start_date'=>$startdate,
             'End_date'=>$enddate,
             'Deductions'=>$this->input->post('total_deduction'),
             'Loan'=>$this->input->post('total_loan'),
             'Monthly_salary'=>$this->input->post('gross_salary'),
             'KRA_Pin'=>$this->input->post('pin'),
             'Nssf_no'=>$this->input->post('nssf_no'),
             'Nhif_no'=>$this->input->post('nhif_no'),
             'PAYE'=>$this->input->post('paye'),
             'NSSF'=>$this->input->post('nssf'),
             'NHIF'=>$this->input->post('nhif'),
             'Net_salary'=>$this->input->post('netsalary'),
             'Bank'=>$this->input->post('bank_name'),
             'Bank_account'=>$this->input->post('account'),
             'Branch'=>$this->input->post('branch'),
             'Payment_method'=>'BANK',
              );
          
             if( $this->input->post('helb_option')=='yes'){
              $helbdata=array(
                  'Employee_id'        => $id,
                  'Title'                =>'HELB',
                  'amount'               =>$this->input->post('helbbf'),
                  'date_posted'           =>date('Y-m-d'),
                  );
             
              //insert the data 
              $this->payroll_model->addLoanPosting($helbdata);
            }
            //check whether coop loan is selected
            if( $this->input->post('coop_loan')=='y'){
              $coopdata=array(
                  'Employee_id'        =>$id,
                  'Title'                =>'COOPERATIVE',
                  'amount'               =>$this->input->post('coopbf'),
                  'date_posted'           =>date('Y-m-d'),
            
                );
              //insert the data 
              $this->payroll_model->addLoanPosting($coopdata);
            }
            //check whether company loan is selected
            if( $this->input->post('company_loan')=='a'){
              $companydata=array(
                  'Employee_id'        =>$id,
                  'Title'                =>'HOSPITAL',
                  'amount'          =>$this->input->post('companybf'),
                  'date_posted'           =>date('Y-m-d')
                  );
              //insert the data 
              $this->payroll_model->addLoanPosting($companydata);
            }
            //check whether savings is selected
            if( $this->input->post('coop_savings')=='1'){
              $savingsdata=array(
                  'Employee_id'        =>$id,
                  'Title'                =>'SAVINGS',
                  'amount'                 =>$this->input->post('savebf'),
                  'date_posted'           =>date('Y-m-d')
            );
              //insert the data 
              $this->payroll_model->addLoanPosting($savingsdata);
            }
             if ($this->payroll_model->addPayment($data) )
              {
                  $this->session->set_flashdata('message', 'Payroll posting has been successfully processed');
                  redirect("payroll/Salaries", 'refresh');
              }
              else
              {
                  // display the create user form
                  // set the flash data error message if there is one
                  $this->data['error'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('error')));
                  $this->data['message'] = $this->session->flashdata('message');
           
                  redirect('payroll/Salaries', $this->data);
              }
        
          
        }else{
                  $this->data['error'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('error')));
                  $this->data['message'] = $this->session->flashdata('message');
                  redirect('payroll/newPosting/'.$id, $this->data);
        }
        
  }
  public function addNewGratuity(){
     if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

           $this->form_validation->set_rules('bank_name', 'Bank name', 'required');
             $salary_date=date('Y-m-d');
             $startdate=date('Y-m-01');
             $enddate=date('Y-m-t');
             $id=$this->input->post('id');
       if ($this->form_validation->run() == true)
        {
          $data=array(
             'Employee_id'=>$this->input->post('id'),
             'no'=>$this->input->post('nid'),
             'Firstname'=>$this->input->post('first_name'),
             'Lastname'=>$this->input->post('last_name'),
             'Salary_date'=>$salary_date,
             'Start_date'=>$startdate,
             'End_date'=>$enddate,
             'Deductions'=>$this->input->post('total_deduction'),
             'Loan'=>$this->input->post('total_loan'),
             'Monthly_salary'=>$this->input->post('gross_salary'),
             'KRA_Pin'=>$this->input->post('pin'),
            
             'PAYE'=>$this->input->post('paye'),
             
             'Net_salary'=>$this->input->post('netsalary '),
             'Bank'=>$this->input->post('bank_name'),
             'Bank_account'=>$this->input->post('account'),
             'Branch'=>$this->input->post('branch'),
             'Payment_method'=>'BANK',
              );
          
             if( $this->input->post('helb_option')=='yes'){
              $helbdata=array(
                  'Employee_id'        => $id,
                  'Title'                =>'HELB',
                  'amount'               =>$this->input->post('helbbf'),
                  'date_posted'           =>date('Y-m-d'),
                  );
             
              //insert the data 
              $this->payroll_model->addLoanPosting($helbdata);
            }
            //check whether coop loan is selected
            if( $this->input->post('coop_loan')=='y'){
              $coopdata=array(
                  'Employee_id'        =>$id,
                  'Title'                =>'COOPERATIVE',
                  'amount'               =>$this->input->post('coopbf'),
                  'date_posted'           =>date('Y-m-d'),
            
                );
              //insert the data 
              $this->payroll_model->addLoanPosting($coopdata);
            }
            //check whether company loan is selected
            if( $this->input->post('company_loan')=='a'){
              $companydata=array(
                  'Employee_id'        =>$id,
                  'Title'                =>'HOSPITAL',
                  'amount'          =>$this->input->post('companybf'),
                  'date_posted'           =>date('Y-m-d')
                  );
              //insert the data 
              $this->payroll_model->addLoanPosting($companydata);
            }
            //check whether savings is selected
            if( $this->input->post('coop_savings')=='1'){
              $savingsdata=array(
                  'Employee_id'        =>$id,
                  'Title'                =>'SAVINGS',
                  'amount'                 =>$this->input->post('savebf'),
                  'date_posted'           =>date('Y-m-d')
            );
              //insert the data 
              $this->payroll_model->addLoanPosting($savingsdata);
            }
             if ($this->payroll_model->addGratuity($data))
              {
                  $this->session->set_flashdata('message', 'Gratuity posting has been successfully processed');
                  redirect('payroll/getGratuity/'.$id, $this->data);
              }
              else
              {
                  // display the create user form
                  // set the flash data error message if there is one
                  $this->data['error'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('error')));
                  $this->data['message'] = $this->session->flashdata('message');
           
                  redirect('payroll/Salaries', $this->data);
              }
          
        }else{
                  $this->data['error'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('error')));
                  $this->data['message'] = $this->session->flashdata('message');
                  redirect('payroll/newGratuity/'.$id, $this->data);
        }
        
  }

   public function getPayslip($id) {
          $this->data['title'] = 'Payslip details'; 
          $this->data['payslip']=$this->payroll_model->getPaySlip($id);
           $this->data['deductions']=$this->payroll_model->getPayslipDeductions($id)->result();
          $this->render_page('payroll/view', $this->data);
          //$this->generatepayslippdf();
        }

     public function getGratuity($id) {
          $this->data['title'] = 'Payslip details'; 
          $this->data['payslip']=$this->payroll_model->getGratuity($id);
               //$this->data['deductions']=$this->payroll_model->getDeductions($key)->result();
          $this->render_page('payroll/gratuity_view', $this->data);
          //$this->generatepayslippdf();
        }
     public function printPayslip($id) {
          $this->data['title'] = 'Payslip details'; 
          $this->data['payslip']=$this->payroll_model->getPaySlip($id);
          $this->data['deductions']=$this->payroll_model->getPayslipDeductions($id)->result();
          $this->load->view('payroll/print_view', $this->data);
          //$this->generatepayslippdf();
        }

   

	// create a new user payroll profile
	function add_salary()
    {
        $this->data['title'] = "Add Salary";

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

     
        // validate form input
             $this->form_validation->set_rules('id', "Select Employee", 'required');
             $this->form_validation->set_rules('basic_salary', $this->lang->line('basic_salary'), 'required');
             $this->form_validation->set_rules('house_allowance', $this->lang->line('house_allowance'), 'trim|numeric');
             $this->form_validation->set_rules('risk_allowance', $this->lang->line('risk_allowance'), 'trim|numeric');
             $this->form_validation->set_rules('non_practising', $this->lang->line('non_practising'), 'trim|numeric');
             $this->form_validation->set_rules('streneous_allowance', $this->lang->line('streneous_allowance'), 'trim|numeric');
             $this->form_validation->set_rules('transport_allowance', $this->lang->line('transport_allowance'), 'trim|numeric');
             $this->form_validation->set_rules('resp_allowance', $this->lang->line('resp_allowance'), 'trim|numeric');
             $this->form_validation->set_rules('medical_allowance', $this->lang->line('medical_allowance'), 'trim|numeric');
           
        
           $id =$this->input->post('id');
        if ($this->form_validation->run() == true)
        {
           
            $basic_data = array(
                'Employee_id'   		 => $id,
                'Basic_salary'     		 => $this->input->post('basic_salary'),
                'Transport'    			 => $this->input->post('transport_allowance'),
                'Medical'    			 => $this->input->post('medical_allowance'),
                'other'                  => $this->input->post('house_allowance'),
                'risk' 					 => $this->input->post('risk_allowance'),
                'responsibility'         => $this->input->post('responsibility'),
                'strenuous'        		 => $this->input->post('streneous_allowance'),
                'non_practising'         => $this->input->post('non_practising'),
                'Monthly_salary'         => $this->input->post('gross_salary')
              );

        }


        if ($this->form_validation->run() == true && $this->payroll_model->register_salary($basic_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', 'Salary record successfully added');
            redirect('payroll/Salaries', 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['error'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('error')));
            $this->data['message'] = $this->session->flashdata('message');
     
            $this->render_page('payroll/basic_profile', $this->data);
        }
    }

	// edit a user
	function editSalary($id)
	{
		$this->data['title'] = "Edit Salary";

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin()))
		{
			redirect('auth', 'refresh');
		}

		$salary = $this->payroll_model->getUserSalary($id)->row();
		

    		// validate form input
            $this->form_validation->set_rules('id', $this->lang->line('create_user_staffno'), 'required');
            $this->form_validation->set_rules('basic_salary', $this->lang->line('basic_salary'), 'required');
        
             $this->form_validation->set_rules('house_allowance', $this->lang->line('house_allowance'), 'trim|numeric');
             $this->form_validation->set_rules('risk_allowance', $this->lang->line('risk_allowance'), 'trim|numeric');
             $this->form_validation->set_rules('non_practising', $this->lang->line('non_practising'), 'trim|numeric');
             $this->form_validation->set_rules('streneous_allowance', $this->lang->line('streneous_allowance'), 'trim|numeric');
             $this->form_validation->set_rules('transport_allowance', $this->lang->line('transport_allowance'), 'trim|numeric');
             $this->form_validation->set_rules('resp_allowance', $this->lang->line('resp_allowance'), 'trim|numeric');
             $this->form_validation->set_rules('medical_allowance', $this->lang->line('medical_allowance'), 'trim|numeric');
           
        
	

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($id != $this->input->post('id'))
			{
				$this->data['error']="Sorry. No Valid Staff id sent";
			}
      $id=$this->input->post('id');
            // update the email if it was posted
			if($this->input->post('is_allowed')=='yes')
			{
                $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
			}


			$data= array(
                'Basic_salary'     		 => $this->input->post('basic_salary'),
                'Transport'    			 => $this->input->post('transport_allowance'),
                'Medical'    			 => $this->input->post('medical_allowance'),
                'risk' 					 => $this->input->post('risk_allowance'),
				'other'                   => $this->input->post('house_allowance'),
                'responsibility'         => $this->input->post('responsibility'),
                'strenuous'        		 => $this->input->post('streneous_allowance'),
                'non_practising'         => $this->input->post('non_practising'),
                'Monthly_salary'         => $this->input->post('sgross_salary')
              );


          
			   if($this->payroll_model->updateUserSalary($id, $data))
			    {
			    	   $this->session->set_flashdata('message', "Salary record successfully edited" );
      			
          		 redirect('payroll/Salaries', 'refresh');
          }

			
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['error'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('error')));
    $this->data['message'] = $this->session->flashdata('message');
		// pass the user to the view
		$this->data['salary'] = $salary;
		

		$this->render_page('payroll/edit_salary', $this->data);
	}

	 
   public function add_loan($id)
   {
        $this->data['title'] = "Add deduction";
        $salary = $this->payroll_model->getUserSalary($id)->row();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        
        $this->form_validation->set_rules('amount', 'amount', 'required');
      
      
      
      $expecteddate=date('Y/m/d');

       if ($this->form_validation->run() == true)
        {
          
           $offset=$this->input->post('period');
        
              $data=array(
                  'Employee_id'        => $id,
                  'Title'                =>$this->input->post('loan_type'),
                  'Loan_amount'          =>$this->input->post('amount'),
                  'Period'               =>$this->input->post('period'),
                  'Monthly_repayment'    =>$this->input->post('installment'),
                  'Start_date'           =>date('Y-m-d'),
                  'stop_date'            =>date('Y-m-d', strtotime("+$offset months", strtotime($expecteddate)))
              );

              //insert the data 
              $this->payroll_model->addLoan($data);
        
           
            $this->session->set_flashdata('message', 'Loan/Savings record successfully added');
             redirect('payroll/Salaries', 'refresh');

         }
            

        // display the add deduction form
      $this->data['csrf'] = $this->_get_csrf_nonce();

      // set the flash data error message if there is one
      $this->data['error'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('error')));
      $this->data['message'] = $this->session->flashdata('message');
      // pass the user to the view
      $this->data['salary'] = $salary;
      

      $this->render_page('payroll/add_loan', $this->data);   
        
   }
    function load_employee_detail(){
    	 if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->payroll_model->getEmployeeData($q);
     }

   }
     function load_user_banks($id){
       if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->payroll_model->getStaffBanks($id,$q);
     }

   }

 public function add_deduction($id)
 {
        $this->data['title'] = "Add deduction";

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
       $salary = $this->payroll_model->getUserSalary($id)->row();
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('amount', 'amount', 'required');
    
       
       if ($this->form_validation->run() == true)
        {
          
        $data=array(
               'Employee_id'=>$id,
               'Firstname'=>$this->input->post('first_name'),
               'Lastname'=>$this->input->post('last_name'),
               'Title'=>strtoupper($this->input->post('title')),
               'Amount'=>$this->input->post('amount'),
               'Date_deducted'=>date('Y-m-d', strtotime($this->input->post('date_deducted'))),
               'Note'=>$this->input->post('note')
            );
      }
       if ($this->form_validation->run() == true && $this->payroll_model->addDeduction($data))
        {
            $this->session->set_flashdata('message', 'Deduction record successfully added');
            redirect('payroll/Salaries', 'refresh');
        }
        else
        {
         
      
        // display the add deduction form
      $this->data['csrf'] = $this->_get_csrf_nonce();

      // set the flash data error message if there is one
      $this->data['error'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('error')));
      $this->data['message'] = $this->session->flashdata('message');
      // pass the user to the view
      $this->data['salary'] = $salary;
      $this->render_page('payroll/add_deduction', $this->data);
 }
}
public function edit_deduction($id)
{
     $this->data['title'] = "Edit deduction";

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('amount', 'amount', 'required');
        $id =$this->input->post('id');
      
       $deduction = $this->payroll_model->getDeduction($id)->row();
       if ($this->form_validation->run() == true)
        {
          
        $data=array(
               'Title'=>$this->input->post('title'),
               'Amount'=>$this->input->post('amount'),
               'Date_deducted'=>date('Y-m-d', strtotime($this->input->post('date_deducted'))),
               'Note'=>$this->input->post('note')
            );
      }
       if ($this->form_validation->run() == true && $this->payroll_model->updateDeduction($id,$data))
        {
            $this->session->set_flashdata('message', 'Deduction record successfully updated');
            redirect('payroll/Salaries', 'refresh');
        }
        else
        {
            $this->data['error'] =  $this->session->set_flashdata('error', 'Sorry, try again. The record hasnt been saved');
            $this->data['message'] = $this->session->flashdata('message');
     
            $this->render_page('payroll/Salaries', $this->data);
        }
        // display the add deduction form
      $this->data['csrf'] = $this->_get_csrf_nonce();

      // set the flash data error message if there is one
      $this->data['error'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('error')));
      $this->data['message'] = $this->session->flashdata('message');
      // pass the user to the view
      $this->data['deduction'] = $deduction;
      

      $this->render_page('payroll/edit_deduction', $this->data);
}


public function add_bank($id)
 {
        $this->data['title'] = "Add Bank";

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

        $this->form_validation->set_rules('bank_name', 'Bank name', 'required');
        $this->form_validation->set_rules('account', 'account', 'required');
        
      
       
       if ($this->form_validation->run() == true)
        {
          
        $data=array(
               'user_id'=>$id,
               'bank_name'=>strtoupper($this->input->post('bank_name')),
               'branch'=>strtoupper($this->input->post('branch')),
               'account'=>$this->input->post('account')
            );
      }
       if ($this->form_validation->run() == true && $this->payroll_model->addUserBank($data))
        {
            $this->session->set_flashdata('message', 'Bank successfully added');
            redirect('payroll/Salaries', 'refresh');
        }
        else
        {
        
      $salary = $this->payroll_model->getUserSalary($id)->row();
        // display the add deduction form
      $this->data['csrf'] = $this->_get_csrf_nonce();

      // set the flash data error message if there is one
      $this->data['error'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('error')));
      $this->data['message'] = $this->session->flashdata('message');
      // pass the user to the view
      $this->data['salary'] = $salary;
      

      $this->render_page('payroll/add_bank', $this->data);
 }

}

//generate pdf and force to download

    function pdf($id)
    {
       

        /*$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['payslip']=$this->payroll_model->getPaySlip($id);
        $name = "payslip". "_" . str_replace('/', '_', $id) . ".pdf";
        $html = $this->load->view('payroll/pdf', $this->data, TRUE);
        if ($view) {
            $this->load->view('payroll/pdf', $this->data);
        } elseif ($save_bufffer) {
            return $this->Algohealth->generate_pdf($html, $name, $save_bufffer);
        } else {
            $this->Algohealth->generate_pdf($html, $name);
        }*/
        $this->data['payslip']=$this->payroll_model->getPaySlip($id);
        $name = "payslip". "_" . str_replace('/', '_', $id) . ".pdf";
        $html = $this->load->view('payroll/pdf', $this->data, TRUE);
        //this the the PDF filename that user will get to download
        $pdfFilePath = base_url().'assets/uploads/'.$name;
 
        //load mPDF library
        $this->load->library('pdf');
 
       //generate the PDF from the given html
        $this->pdf->WriteHTML($html);
 
        //download it.
        $this->pdf->Output($pdfFilePath, "D");

    }


   function _get_csrf_nonce()
  {
    $this->load->helper('string');
    $key   = random_string('alnum', 8);
    $value = random_string('alnum', 20);
    $this->session->set_flashdata('csrfkey', $key);
    $this->session->set_flashdata('csrfvalue', $value);

    return array($key => $value);
  }

  function _valid_csrf_nonce()
  {
    if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
      $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }
	public function generate_p10()
{
  $this->data['title'] = "Generate p10";
  $this->render_page('payroll/p10', $this->data);
 
}
public function processP10Request()
{
  if (isset($_POST) && !empty($_POST))
      {
     $year=date('Y',strtotime($this->input->post('value1')));
     $this->data['date']=date('Y',strtotime($this->input->post('value1')));
     $this->data['kra_data']=$this->payroll_model->get_p10($year)->result();
     $this->data['total_data']=$this->payroll_model->get_p10_total($year)->row();
     $this->data['title'] = "KRA P10 form";
     $this->load->view('payroll/p10_form', $this->data);
   }
}

public function generate_p9()
{
  $this->data['title'] = "Generate p9";
  $this->render_page('payroll/p9', $this->data);
 
}
public function processP9Request()
{
  if (isset($_POST) && !empty($_POST))
      {
     $id=$this->input->post('id');
     $year=date('Y',strtotime($this->input->post('value1')));
     $this->data['date']=date('Y',strtotime($this->input->post('value1')));
     $this->data['kra_data']=$this->payroll_model->get_p9($year,$id)->result();
     $this->data['rs']=$this->payroll_model->get_p9_total($year,$id)->row();
     $this->data['title'] = "KRA P9 form";
     $this->load->view('payroll/p9_form', $this->data);
   }
}
public function generate_bank_report()
{
  $this->data['title'] = "Generate Bank report";
  $this->render_page('payroll/bank_form', $this->data);
 
}

 public function processBankForm(){
          $s=$this->input->post('from');
           $this->data['start']=$this->input->post('from');
            $this->data['end']=$this->input->post('to');
          $start=date('Y-m-d', strtotime($s));
          $e=$this->input->post('to');
          $end=date('Y-m-d', strtotime($e));
          $bank=$this->input->post('bank_name');
         $this->data['salary_data']=$this->payroll_model->get_filtered_salary_transfers($start,$end,$bank);
         $this->data['r']=$this->payroll_model->get_filtered_salary_transfers_total($start, $end,$bank)->row();
         $this->data['title'] = "Bank report";
         $this->load->view('payroll/bank_report', $this->data);
 }
  
   function load_staff_detail(){
       if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->payroll_model->getSalariedStaff($q);
     }

   }



}
