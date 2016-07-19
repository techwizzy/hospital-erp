
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



 
       <!--\\\\\\\ container  start \\\\\\-->
  
      <div class="container clear_both padding_fix">
        <div class="noprint">
        <p style="text-align:right;"><A HREF="javascript:window.print()" class="noprint">Print Report</A> 
         <A href="<?php echo base_url() ?>index.php/report/generate_patient_report" class="noprint">Click to go back</A></p> 
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
          <h4 align="center">Patient Report</h4>
        </div>
      
      </div>
        <!-- Main content -->
        <section class="container">

    

               <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="box-title"><i class="fa fa-user-plus"></i><span>Patient Number</span> </h4>
                  <div class="box-tools pull-right">
                    
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div id="todaysales" style="min-width: 310px; height: 600px; margin: 0 auto"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

   
  <script src="<?php echo base_url();?>theme/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>theme/plugins/jQueryUI/jquery-ui.js"></script>

    <script src="<?php echo base_url();?>theme/js/highcharts.js"></script>
    <script src="<?php echo base_url();?>theme/js/exporting.js"></script>
    <script src="<?php echo base_url();?>theme/js/highcharts-3d.js"></script>

   <script>
    $(document).ready(function () {

           $('#todaysales').highcharts({
        chart: {
            type: 'bar',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: "No of Patients On <?php echo date('d F, Y') ?>"
        },
        subtitle: {
            text: 'total number of patients for {Inpatient,Outpatient,clinic}'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Patients:',
            data: [
            <?php  foreach ($data as $value) { ?>
                ['<?= $value->patient_type ?>', <?php echo $value->num; ?>],
              <?php } ?> ]
        }]
    });

         });
    </script>

