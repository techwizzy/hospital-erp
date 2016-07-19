<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
        
              <div class="panel panel-primary">
             <div class="panel-heading"><h4>Refund Requests</h4></div>
            <div class="panel-body">
            
                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-striped" id="UsrTable">
                        <thead>
                        <tr>
                      <tr>
                      <th class="col-xs-1">Id</th>
                      <th class="col-xs-1">File no</th>
                      <th class="col-xs-1">Bill no</th>
                      <th class="col-xs-1">Amount</th>
                      <th class="col-xs-2">Patient name</th>
                      <th  class="col-xs-1">Biller</th>
                      <th class="col-xs-2">Date requested</th>
                      <th class="col-xs-2">Action</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <!-- loop through category table-->
                    <?php foreach ($itemdata->result() as $row) {
                      # code...
                    ?> 
                    <tr class="gradeX">
                    
                 
                      <td><?php echo anchor('refund/show_refund/'.$row->refund_id, $row->refund_id); ?></td>
                         <td><?php echo $row->file_no; ?></td>
                      <td><?php echo $row->bill_no; ?></td>
                      <td><?php echo number_format($row->refund_amount); ?></td>
                      <td><?php echo $row->patient_name; ?></td>
                      <td><?php echo $row->requested_by; ?></td>
                      <td><?php echo date('d/m/Y h:m:i A',strtotime($row->date_requested)); ?></td>
                      <td>
                         <div class="btn-group ">
                                   <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                   <ul class="dropdown-menu col-md-2" style="text-color:blue">
                                      <li><a href="<?= site_url('refund/show_refund/'.$row->refund_id) ?>"><i class="fa fa-fw fa-eye fa-blue"></i>Refund details</a></li>
                                      <li><a href="<?= site_url('refund/show_approve_view/'.$row->refund_id) ?>"><i class="fa  fa-check"></i>Approve/Cancel</a></li>
                                   </ul>
                                    </div>
                    </td>
                      
                    </tr>
                    <?php
                     }
                   ?>
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
       
        tableTools: {
            "sSwfPath": "<?php echo base_url();?>theme/assets/TableTools/swf/copy_csv_xls.swf"
        }
    } );
    var tt = new $.fn.dataTable.TableTools( table );
    
    $( tt.fnContainer() ).insertBefore( $('#tabletools'));
    //$('#tabletools')[0].appendChild($('.TableTools')[0]);
} );
 
</script> 