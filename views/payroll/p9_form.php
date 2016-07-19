<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  
  <title>P9</title>
  
   <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
  <link href="<?php echo base_url();?>resources/admin/css/font-awesome.css" rel="stylesheet" type="text/css" />
  <script type='text/javascript' src='<?php echo base_url() ?>index.php/js/jquery-1.3.2.min.js'></script>
  <script type='text/javascript' src='<?php echo base_url() ?>index.php/js/example.js'></script>
  <style>
  body, h1, h2, h3, h4, h5, h6{
      font-family: 'Bree Serif', serif;
      }

    @media print
      {
      .noprint {display:none;}
      }
      th{
        text-align:left;
      }
</style>
</head>

<body>

  <div style="margin-left:50px;margin-right:50px; " >
       <!--\\\\\\\ container  start \\\\\\-->
  
      <div class="container clear_both padding_fix">
        <div class="noprint">
        <p style="text-align:right;"><A HREF="javascript:window.print()" class="noprint">Print Report
         | <A href="<?php echo base_url() ?>index.php/payroll/generate_p9" class="noprint">Click to go back</A></p> 
       </div> 
        <div class="page-content">

     
      <!--\\\\\\\ container  start \\\\\\-->
      <div style="clear:both;"></div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
    
                 <h4 align="center"><img src="<?php echo base_url();?>resources/icons/kra.png"  ></h4>
           <?php foreach ($kra_data as $r) {} ?>
                                     <div align="center"><B> INCOME TAX DEPARTMENT</B></div>
                                     <div align="center"><B>  TAX DEDUCTION CARD YEAR   <?php echo $date ?></B></div>
<p>                                    
<div style="float:left"><span style="padding-right:180px;">Employers Name:  <strong>ST. J COTTOLENGO CENTER</strong></span><br>
Employee’s Main Name:  <strong><?php echo $r->Firstname ?></strong>  <strong><?php echo $r->Lastname ?></strong><br>
  Employee’s Other Names: <strong><?php echo $r->Lastname ?></strong> </div><div style="float:right"> Employer’s PIN : P051108437Y <br>Employee’s PIN: <strong> <?php echo $r->KRA_Pin ?></strong></div>

      
     
     
     
      <!-- / end client details section -->
      <table class="table table-bordered">
        <thead style="background-color:#fcfcfc">
                   <tr>
                      <th>MONTH</th>
                      <th>Basic Salary <br>Kshs.</th>
                      <th>Benefits<br>– NonCash<br>Kshs.</th>
                      <th>Value of Quarters<br>Kshs.</th>
                      <th>Total Gross Pay<br>Kshs.</th>
                      <th colspan="3">Defined Contribution<br> Retirement Scheme<br>Kshs.</th>
                      <th>OwnerOccupied Interest<br>Kshs.</th>
                      <th>Retirement Contribution & Owner Occupied Interest<br>Kshs.</th>
                      <th>Chargeable Pay <br>Kshs.</th>
                      <th>Tax Charged <br>Kshs.</th>
                      <th>Personal Relief + Insurance Relief <br>Kshs.</th>
                      <th>PAYE Tax (JK)<br>Kshs.</th>
                     </tr>
                     <tr>
                      <th></th>
                      <th>A</th>
                      <th>B</th>
                      <th>C</th>
                      <th>D</th>
                      <th colspan="3">E</th>
                      <th>F</th>
                      <th>G</th>
                      <th>H</th>
                      <th>J</th>
                      <th>K</th>
                      <th>L</th>
                     </tr>
                       <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      
                      <th>E1 30% of A</th>
                      <th>E2 Actual</th>
                      <th>E3 Fixed</th>
                      <th>Amount of Interest</th>
                      <th>The lowest of E added to F</th>
                     
                      <th>Total Kshs</th>
                      <th></th>
                      <th></th>
                      <th></th>
                     </tr>
                  </thead>
                  <tbody>
                    <?php
                     $reliefSum=0;
                    ?>
                    <!--loop through the array to display the Supplier data --> 
                  <?php foreach ($kra_data as $row) { ?>
              
                    <tr>
                      <td><?php echo $row->month; ?></td>
                      <td align="right"><?php echo $this->cart->format_number($row->totalGross); ?></td>
                      <td></td>
                  
                      <td></td>
                      <td align="right"><?php echo $this->cart->format_number($row->totalGross); ?></td>
                      <td align="right"><?php $totalDefined=$row->totalGross * 0.3; echo $this->cart->format_number($row->totalGross * 0.3); $sumTotalDefined+=$totalDefined; ?></td>
                      <td align="right"><?php echo $this->cart->format_number(200); $totalNssf+=200;?></td>
                      
                      <td></td>
                      <td></td>
                    
                      <td align="right"><?php echo $this->cart->format_number(200); $totalNssf+=200; ?></td>
                      
                      <td align="right"><?php $totalTaxableAmount=$row->totalGross-200; echo $this->cart->format_number($row->totalGross-200); $sumTotalTaxableAmount=+$totalTaxableAmount?></td>
                      <td align="right"><?php $totalTax=$row->totalPaye+1162;echo $this->cart->format_number($row->totalPaye+1162);$sumTotalTax=+$totalTax; ?></td>

                      <td align="right"><?php echo $this->cart->format_number(1162); $reliefSum+=1162; ?></td>

                      <td align="right"><?php $totalP=$row->totalPaye; echo $this->cart->format_number($row->totalPaye); $sumTotalPaye+=$totalP; ?></td>
                   </tr>
                    <?php    # code...
                  } ?>
                   
        </tbody>
        <tfoot>
           
                      <tr>
                      <th>Totals</th>
                      <td align="right"><?php echo $this->cart->format_number($rs->totalGross); ?></td>
                      <th></th>
                      <th></th>
                      <td align="right"><?php echo $this->cart->format_number($rs->totalGross); ?></td>
                    
                      <td align="right"><?php echo $this->cart->format_number($sumTotalDefined); ?></td>
                      <td align="right"><?php echo $this->cart->format_number($totalNssf); ?></td>
                      <th></th>
                      <th></th>
                      <td align="right"><?php echo $this->cart->format_number($totalNssf); ?></td>
                      <td align="right"><?php echo $this->cart->format_number($sumTotalTaxableAmount); ?></td>
                     
                      <td align="right"><?php echo $this->cart->format_number($sumTotalTax); ?></td>
                      <td align="right"><?php echo $this->cart->format_number($reliefSum); ?></td>
                      <td align="right"><?php echo $this->cart->format_number($sumTotalPaye); ?></td>
                     </tr>
        </tfoot>
      </table>

      </div>
    <div style="max-width:500px;float:left; padding-top:20px;"><b>Total Chargeable Pay(Col. H).</b> Kshs. <?php echo $this->cart->format_number($sumTotalTaxableAmount); ?><br/>
     <h4>IMPORTANT</h4><br/>
     1. Use P9A   <span style="margin-left:50px;"> (a) For all liable employees and where director/employee received </span><br>
                     <span style="margin-left:50px;">  benefits in addition to cash emoluments.</span><br>
                  <span style="margin-left:50px;"> (b) Where an employee is eligible to deduction on owner occupier interest.</span><br>
     2. Deductible interest in respect of any month must not exceed Kshs 12,500/= except for <br>
          December Where the amount shall be Kshs. 12,501/=   <br>
      <b>(see back of this card for further information required by the department)</b>  
    </div>
    <div style="max-width:500px;float:right;padding-top:20px;"><b>TOTAL TAX (Col. L) </b>Kshs   <?php echo $this->cart->format_number($sumTotalPaye); ?> <br/>
     (b) Attach    <span style="margin-left:50px;">  (i)Photostat copy of interest certificate and statement of account from the </span><br>
                      <span style="margin-left:50px;">  Financial institution.</span><br>
                   <div style="margin-left:50px;"> (ii)The DECLARATION duly signed by the employee to form p9A.</div><br>
    <STRONG>NAMES OF FINANCIAL INSTITUTION ADVANCING MORTGAGE LOAN</STRONG> <br>
        ________________________________________________________________________ <br>
      L R NO. OF OWNER OCCUPIED PROPERTY....................................................<BR>
      DATE OF OCCUPATION OF HOUSE.................................................................  
    </div>
         
    </div>
  </body>
</html>
