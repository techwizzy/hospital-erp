

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  
  <title><?php echo $title; ?> </title>
  
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
          | <A href="<?php echo base_url() ?>index.php/report/overview_chart" class="noprint">Click to go back</A></p> 
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
          <h4 align="center"> SUPPLIERS REPORT </h4>
        </div>
      
    
     
      <!-- / end client details section -->
      <table class="table table-bordered" width="1200">
        <thead style="background-color:#fcfcfc">
                        <tr>
                            
                            <th class="col-xs-2">PIN</th>
                            <th class="col-xs-4">Supplier Name</th>
                            <th class="col-xs-2">Phone</th>
                            <th class="col-xs-2">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user):?>
                            <tr>
                                
                                <td><?php echo htmlspecialchars($user->Pin,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($user->Supplier_name,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($user->Phone,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($user->Email,ENT_QUOTES,'UTF-8');?></td>
                               
                            
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                       
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