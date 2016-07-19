

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  
  <title><?php echo $title; ?> </title>
  
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
  <link href="<?php echo base_url();?>resources/admin/css/font-awesome.css" rel="stylesheet" type="text/css" />
   <script src="<?php echo base_url();?>theme/plugins/jQuery/jQuery-2.1.4.min.js"></script>
     
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
        <p style="text-align:right;"><A HREF="javascript:window.print()" class="noprint">Print Report</A> | <a href="<?php echo base_url() ?>downloads/reports/diagnosis_report.csv" >
            Excel
        
         </a> | <A href="<?php echo base_url() ?>index.php/report/get_diagnostic_report" class="noprint">Click to go back</A></p> 
       </div> 
        <div class="container">

     
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
          <h4 align="center"> Diagnosis Report from <?= $start ?> to <?= $end ?></h4>
  
 
<table class="table table-bordered" width="1200">
        <thead style="background-color:#fcfcfc">
               
                    <tr>
                      <th>Date of Admission</th>
                      <th>Diagnosis Date</th>
                      <th>Patient No</th>
                      <th>Full names</th>
                      <th>Patient Type</th>
                      
                      <th>Age</th>
                      <th>Gender</th>
                      <th>Diagnosis</th>
                      <th>Address</th>
                      <th>Sublocation</th>
                      <th>Village</th>
                      <th>Phone</th>
                      <th>Status</th>
                      <th>Date discharged</th>
                    
                     </tr>
                  </thead>
                  <tbody>
                    <!-- loop through category table-->
                    <?php foreach ($bill_data->result() as $row) {
                      # code...
                    ?>
                    <tr class="gradeX">
                      <td><?php echo date('d/m/Y', strtotime($row->reg_date)); ?></td>
                      <td><?php echo date('d/m/Y', strtotime($row->date)); ?></td>
                      <td><?php echo $row->file_no; ?></td>
                      <td><?php echo $row->patient_name; ?></td>
                      <td><?php echo $row->patient_type; ?></td>
                      <td><?php echo $row->age; ?></td>
                      <td><?php echo $row->gender; ?></td>
                      <td><?php echo $row->diagnosis_name; ?></td>
                      <td><?php echo $row->address; ?></td>
                      <td><?php echo $row->sub_location; ?></td>
                      <td><?php echo $row->village; ?></td>
                      <td><?php echo $row->phone_no; ?></td>
                      <td><?php echo $row->status; ?></td>
                      <?php if ($row->discharge_date=='0000-00-00') { ?>
                         <td>N/A</td>
                                               <?php }else{ ?>
                      <td><?php echo date('d/m/Y', strtotime($row->discharge_date)); ?></td>
                      <?php } ?>
                   </tr>
                    <?php
                     }
                   ?>
                  </tbody>
                  
                  <tfoot>
                  
                  </tfoot>
                </table>
                 <div id="terms">
               <h5 style="font-size:10px;">Report Generated on <?php echo date('d,F,Y');?> AT <?php echo date('H:i:s A'); ?></h5>
             </div>
  
          </div>
          <!--/row-->
        </div>

      </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
  </div>
  <!--\\\\\\\ inner end\\\\\\-->
</div>


</body>
</html>

