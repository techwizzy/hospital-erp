<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
        
              <div class="panel panel-primary">
             <div class="panel-heading"><h4>All Sales</h4></div>
            <div class="panel-body">
             
              
             <div class="col-md-12">
               <div class="well">
           <form action="" method="post">
              <div class="box box-primary">
                 <div class="box-body">
                  <div class="row">
                   <div class="col-xs-4">
                    <div class="input-group">
                      <div class="input-group-addon">
                        From: <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control" name="start" id="datepicker">
                      </div>
                   </div>
                    <div class="col-xs-4">
                    <div class="input-group">
                      <div class="input-group-addon">
                        To: <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control" name="end" id="datepicker3">
                      </div>
                   </div>
                    <div class="col-xs-4">
                      <input type="submit" class="btn btn-primary" value="Filter">
                    </div>
                  </div>
                   
                </div>
              </div>

            <?php echo form_close() ?>
            <div class="alert alert-info"><p>This default list consists of the current date sales only.
             If you wish to get a more detailed list, please use the filter. </p>

            </div>
                 
              </div>
            <div class="col-xs-12 col-sm-12 progress-container">
              <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-success" style="width:0%"></div>
              </div>
          </div>
           
        <section class="data" style="display: none;">


                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-striped" id="UsrTable">
                        <thead>
                        <tr>
                            
                            <th style="width:50px;">Bill No</th>
                            <th class="col-xs-1">File No</th>
                            <th class="col-xs-2">Date Created</th>
                            <th class="col-xs-1">Bill Total</th>
                            <th class="col-xs-2">Amount Paid</th>
                            <th class="col-xs-1">Date paid</th>
                            <th class="col-xs-1">Balance</th>
                            <th class="col-xs-1">Status </th>
                            <th class="col-xs-2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($bill_data as $sale):?>
                            <tr>
                                
                                <td><?php echo htmlspecialchars($sale->bill_no,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($sale->file_no,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo date('d/m/Y h:m:i A',strtotime($sale->date_created));?></td>
                                <td>KES: <?php echo number_format($sale->bill_total);?></td>
                                <td>KES: <?= number_format($sale->amount_paid) ?></td>
                                <td><?= date('d/m/Y',strtotime($sale->date_paid)) ?></td>
                                <td>KES: <?= number_format($sale->balance) ?></td>
                                <td><?php if($sale->status=="paid"){ ?> <div class="badge bg-green"><?= $sale->status ?> <?php }else{ ?><div class="badge bg-red"><?= $sale->status ?> <?php } ?></td>
                                <td>
                               <div class="btn-group ">
                                   <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                           
                                 <ul class="dropdown-menu col-md-2" style="text-color:blue">
                                      <li><a href="<?= site_url('refund/view_this_bill/'.$sale->bill_no) ?>"><i class="fa fa-fw fa-eye fa-blue"></i>sale details</a></li>
                                      <li><a href="<?= site_url('refund/view_payments/'.$sale->bill_no) ?>"><i class="fa fa-fw fa-money"></i>View Payments</a></li>
                                     <?php if($sale->status=="Unpaid"){ ?>
                                      <li><a href="<?= site_url('refund/void_bill/'.$sale->bill_no) ?>"><i class="fa fa-fw fa-reply"></i>waive bill</a></li>
                                      <?php } ?>
                                    </ul>
                                    </div>
                               </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                        <tfoot>
                          <th colspan="6"><h3>Total Sales Sum:</h3></th>
                          <th><h3><?= number_format($total_bill->sales_total); ?>.00</h3></th>
                          <th></th>
                          <th></th>
                        </tfoot>
                       
                    </table>
                </section>
             </div>
          </div>


            </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 




<script type="text/javascript">
 
$(document).ready(function() {
 
    var table = $('#UsrTable').DataTable({
        
        tableTools: {
            "sSwfPath": "<?php echo base_url();?>theme/assets/TableTools/swf/copy_csv_xls.swf"
        }
    } );
    var tt = new $.fn.dataTable.TableTools( table );
    
    $( tt.fnContainer() ).insertBefore( $('#tabletools'));
    //$('#tabletools')[0].appendChild($('.TableTools')[0]);
} );
 
</script> 