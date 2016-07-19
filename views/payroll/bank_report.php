

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  
  <title>Bank report</title>
  
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
        <p style="text-align:right;"><A HREF="javascript:window.print()" class="noprint">Print Report</A> 
          | <A href="<?php echo base_url() ?>index.php/payroll/generate_bank_report" class="noprint">Click to go back</A></p> 
       </div> 
        <div class="page-content">

     
      <!--\\\\\\\ container  start \\\\\\-->
      <div style="clear:both;"></div>
    <h5 align="center">
           <div  style="margin:0 auto; width:600px;">
                  <div style="float:left; width:300px; margin-right:0px;">  
                                <img src="<?php echo base_url();?>resources/icons/logo.png" width="100" height="60" alt="s-logo" />
                              </div>
                 <div style="float:right; width:300px;" > COTTOLENGO MISSION HOSPITAL<br/>
                  P.O. BOX 1426-60200,MERU, KENYA <br/>
                  cottolengo.chaaria@gmail.com
                  <i> "Caritas Christi urgent nos!"</i>
               </div>
           </div>

          </h5>
         <div style="clear:both;"></div>
          <hr>
          <h4 align="center"> BANK PAY LIST  REPORT <strong>FROM: <?php echo date('d/m/Y',strtotime($start)); ?>   TO : <?php echo date('d/m/Y',strtotime($end)); ?></strong></h4>
        </div>
      
    
     
      <!-- / end client details section -->
      <table class="table table-bordered" width="1200">
        <thead style="background-color:#fcfcfc">
                   <tr>
                      
                      <th>NAME </TH>
                      <th>ID NO</th>
                      <th>BANK</th>
                      <th>BRANCH</th>
                      <th>A/C NO</th>
                      <th>Net salary</th>
                     </tr>
                  </thead>
                  <tbody>
                    <!--loop through the array to display the Supplier data --> 
                  <?php foreach ($salary_data->result() as $row) { ?>
           
                    <tr>
                      <td><?php echo $row->Firstname; ?> <?php echo $row->Lastname; ?></td>
                      <td><?php echo $row->Employee_id; ?></td>
                      <td><?php echo $row->Bank; ?></td>
                      <td><?php echo $row->Branch; ?></td>
                      <td><?php echo $row->Bank_account; ?></td>
                      
                   <td><strong><?php  echo $this->cart->format_number($row->Net_salary); ?></strong></td>
                    </tr>
                    <?php    # code...
                  } ?>
                   
        </tbody>
        <tfoot>

                      <tr>
                      
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th><?php echo $this->cart->format_number($r->totalNet); ?></th>
                     </tr>
        </tfoot>
      </table>
      
      </div>
      <div style="margin:0 auto; width:1000px; margin-top:20px;"><div style="float:left">Prepared by _________________________________</div><div style="float:right">Checked by______________________________________</div></div>
    </div>
  </body>
</html>
