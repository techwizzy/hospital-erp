<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
 
 function __construct() {
	 parent::__construct();
	 $this->load->helper('form');
     $this->load->model('report_model');
	 // Load language file
	 $this->lang->load('en_admin', 'english');
 	}


	function render_page($view, $data=null)//I think this makes more sense
	{
        $this->data['sales']=$this->report_model->daily_profit();
        $this->load->view('common/header');
		$this->viewdata = (empty($data)) ? $this->data: $data;
        $this->load->view($view, $this->viewdata);
        $this->load->view('common/footer');
	}
}