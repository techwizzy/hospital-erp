

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  
  <title>Product report</title>
  
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
          | <A href="<?php echo base_url() ?>index.php/report/generate_sales_report" class="noprint">Click to go back</A></p> 
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
          <h4 align="center"> SALES  REPORT </h4>
        </div>
      
    
            
                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            
                            <th style="width:100px;">Bill No</th>
                            <th class="col-xs-2">File No</th>
                            <th class="col-xs-2">Patient type</th>
                            <th class="col-xs-2">Patient name</th>
                            <th class="col-xs-2">Amount Paid</th>
                            <th class="col-xs-2">Date paid</th>
                            <th class="col-xs-2">Clerk</th>
                            <th class="col-xs-2">Payment method </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total_amount=0; ?>
                        <?php foreach ($sales->result() as $sale):?>
                            <tr>
                                
                                <td><?php echo htmlspecialchars($sale->bill_no,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($sale->file_no,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($sale->patient_type,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($sale->patient_name,ENT_QUOTES,'UTF-8');?></td>
                                <td><?= $this->cart->format_number($sale->amount_paid); ?> <?php $total_amount+=$sale->amount_paid ?></td>
                                <td><?= $sale->date_paid ?></td>
                                <td><?= $sale->username ?></td>
                                <td><?= $sale->payment_method ?></td>
                            
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                         <tfoot>
                         <tr>
                           <th></th>
                           <th>TOTAL AMOUNT</th>
                           <th></th>
                           <th></th>
                           <th><?= $this->cart->format_number($total_amount); ?></th>
                           <th colspan="3"></th>
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
        "paging": false,
          "searching": false,
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