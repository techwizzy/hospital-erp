<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  
  <title>P10</title>
  
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

  <div id="page-wrap">
       <!--\\\\\\\ container  start \\\\\\-->
  
      <div class="container clear_both padding_fix">
        <div class="noprint">
        <p style="text-align:right;"><A HREF="javascript:window.print()" class="noprint">Print Report</a> 
          | <A href="<?php echo base_url() ?>index.php/payroll/generate_p10" class="noprint">Click to go back</A></p> 
       </div> 
        <div class="page-content">

     
      <!--\\\\\\\ container  start \\\\\\-->
      <div style="clear:both;"></div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
 
                 <h4 align="center"><img src="<?php echo base_url();?>resources/icons/kra.png"  ></h4>
          
                                     <div align="center"><B> INCOME TAX DEPARTMENT</B></div>
                                     <div align="center"><B>P.A.Y.E SUPPORTING LIST FOR END OF YEAR CERTIFICATE: YEAR  <?php echo ($date); ?></B></div>

        </div>
      <div style="float:left; padding-bottom:10px;">Employers Name: <span style="Margin-left:10px; padding-bottom:10px;" >ST. J. COTTOLENGO CENTRE</span></div><div style="float:right">Employers Pin: P051108437Y </div>
      </div>
     
     
      <!-- / end client details section -->
      <table class="table table-bordered" width="1200px">
        <thead style="background-color:#fcfcfc">
                   <tr>
                   
                      <th>EMPLOYEE'S PIN: </th>
                      <th>EMPLOYEE'S NAME:</th>
                      <td align="right">TOTAL EMOLUMENTS KSHS</td>
                      <td align="right">P.A.Y.E DEDUCTED KSHS</td>
                     
                     
                     </tr>
                  </thead>
                  <tbody>
                    <!--loop through the array to display the Supplier data --> 
                  <?php foreach ($kra_data as $row) { ?>
           
                    <tr>
                      <td><?php echo $row->KRA_Pin; ?></td>
                      <td><?php echo $row->Firstname;?>   <?php echo $row->Lastname;?></td>
                      <td align="right"><?php $t=$row->totalGross; echo $this->cart->format_number($row->totalGross); $sumTotalGross+=$t; ?></td>
                      <td align="right"><?php echo $this->cart->format_number($row->tax); ?></td>
                    
                   </tr>
                    <?php    # code...
                  } ?>
                   
        </tbody>
        <tfoot>
          
                      <tr>
                      <th>Totals</th>
                      <th></th>
                     
          
                      <td align="right"><?php echo $this->cart->format_number($sumTotalGross); ?></td>
                      <td align="right"><?php echo $this->cart->format_number($total_data->totalPaye); ?></td>
                     </tr>
        </tfoot>
      </table>

      </div>
    </div>
  </body>
</html>
