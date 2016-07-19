<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
        
              <div class="panel panel-primary">
             <div class="panel-heading"><h4><i class="fa fa-file-pdf-o"></i><span> PO pending approval</span></h4></div>
            <div class="panel-body">
            
                    <table id="UsrTable" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-striped">
                   <thead>
                    <tr>
                      <tr>
                      <th>#</th>
                      <th>DATE</th>
                      <th >SUPPLIER</th>
                      <th>STATUS</th>
                      <th>TOTAL VALUE</th>
                      <th>AMOUNT PAID</th>
                      <th>BALANCE</th>
                      <th>ACTIONS</th>
                   </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($purchase_data->result() as $row) : ?>
                 
                    <tr class="gradeX">
                     
                      <td class="col-xs-1"><a href="<?php echo base_url() ?>index.php/purchase/view_this_order/<?php echo $row->Order_no; ?> "><?php echo $row->Order_no; ?></a></td>
                      <td class="col-xs-1"><?php echo  date('d/m/Y',strtotime($row->Date_created)); ?></td>
                      <td class="col-xs-2"><?php echo $row->Supplier; ?></td>
                      <td class="col-xs-1"><?php if($row->Status=="received"){ ?> <div class="badge bg-green"><?= $row->Status ?> <?php } elseif($row->Status=="pending"){  ?><div class="badge bg-yellow"><?= $row->Status ?> </div> <?php }else{ ?><div class="badge bg-red"><?= $row->Status ?> </div><?php } ?> </td>
                      <td style="text-align:right" class="col-xs-2"><?php echo $this->cart->format_number($row->Total_value); ?></td>
                      <td class="col-xs-2"><?php echo $this->cart->format_number($row->Amount_paid); ?></td>
                      <td class="col-xs-1"><?php echo $this->cart->format_number($row->Balance); ?></td>
                      <td class="col-xs-4">
                         <div class="btn-group ">
                                   <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu col-md-2" >
                                      <li><a href="<?= site_url('purchase/view_this_order/'.$row->Order_no) ?>"><i class="fa fa-fw fa-list"></i>Purchase details</a></li>
                                      <li><a href="<?= site_url('purchase/load_grn/'.$row->Order_no) ?>"><i class="fa fa-fw fa-truck"></i>Receive items</a></li>
                                      <li><a href="<?= site_url('purchase/each_order_payment/'.$row->Order_no) ?>"><i class="fa fa-fw fa-money"></i>Add Payment</a></li>
                                      <li><a href="<?= site_url('purchase/view_order_payments/'.$row->Order_no) ?>"><i class="fa fa-fw fa-list"></i>View payments</a></li>
                                      <li><a href="<?= site_url('purchase/load_approve_purchase_order/'.$row->Order_no) ?>"><i class="fa fa-fw fa-check-circle"></i>Approve/Reject</a></li>
                
                                

                                   </ul>
                            </div>
                      </td>
                      
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                  <tfoot>
                    
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