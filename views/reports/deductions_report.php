<

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



  <div class="container">
       <!--\\\\\\\ container  start \\\\\\-->
  
      <div class="container clear_both padding_fix">
        <div class="noprint">
        <p style="text-align:right;"><A HREF="javascript:window.print()" class="noprint">Print Report</A>  | <A href="<?php echo base_url() ?>index.php/report/generate_deduction_report" class="noprint">Click to go back</A></p> 
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
          <h4 align="center">Deductions Report</h4>
        </div>
      
      </div> 
      <table class="table table-bordered table-stripped" width="1200">
        <thead style="background-color:#fcfcfc">
                        <thead>
                        <tr>
                            
                            <th ><?php echo lang('staffno'); ?></th>
                            <th class="col-xs-2"><?php echo lang('first_name'); ?></th>
                            <th class="col-xs-2"><?php echo lang('last_name'); ?></th>
                            <th class="col-xs-2">Title</th>
                            <th class="col-xs-2">Amount</th>
                             <th class="col-xs-2">Date Deducted</th>
                             <th>Note</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($salaries->result() as $salary):?>
                            <tr>
                                
                                <td><?php echo htmlspecialchars($salary->Employee_id,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($salary->Firstname,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($salary->Lastname,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($salary->Title,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($salary->Amount,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($salary->Date_deducted,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($salary->Note,ENT_QUOTES,'UTF-8');?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                        <tfoot class="dtFilter">
                        <tr class="active">
                            
                        </tr>
                        </tfoot>
                    </table>
                
             </div>
          </div>


            </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->







<script type="text/javascript">
 
$(document).ready(function() {

    var table = $('#UsrTable').DataTable({
        "paging": true,
          "searching": true,
          "ordering": true,
          "info": true,
        tableTools: {
            "sSwfPath": "<?php echo base_url();?>theme/assets/TableTools/swf/copy_csv_xls.swf"
        }
    } );
    var tt = new $.fn.dataTable.TableTools( table );
    
    $( tt.fnContainer() ).insertBefore( $('#tabletools'));
    //$('#tabletools')[0].appendChild($('.TableTools')[0]);
} );
 
</script> 