<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 *  ==============================================================================
 *  Author	: Mugambi Alois
 *  Email	: mugambialois@gmail.com
 *  For		: Algohealth
 *  Web		: http://algominetech.co.ke
 *  ==============================================================================
 */
require_once APPPATH . "/third_party/MPDF/mpdf.php";

class Pdf extends mPDF
{
    public function __construct($param = '"en-GB-x","A4","","",10,10,10,10,6,3')
    {
        parent::__construct();
        $this->param =$param;
        $this->pdf = new mPDF($this->param);

    }
}