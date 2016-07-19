<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
        
              <div class="panel panel-primary">
             <div class="panel-heading"><h4>All refunds</h4></div>
            <div class="panel-body">
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
                      <tr>
                      <th class="col-xs-1">Id</th>
                      <th class="col-xs-1">File no</th>
                      <th class="col-xs-1">Bill no</th>
                      <th class="col-xs-1">Amount</th>
                      <th class="col-xs-2">Patient name</th>
                      <th  class="col-xs-1">Biller</th>
                      <th class="col-xs-2">Date requested</th>
                      <th class="col-xs-2">Approved by</th>
                       <th class="col-xs-2">Date approved</th>
                      <th class="col-xs-2">Status</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <!-- loop through category table-->
                    <?php foreach ($itemdata as $row) {
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
                      <td><?php echo $row->approved_by; ?></td>
                       <td><?php echo date('d/m/Y h:m:i A',strtotime($row->date_approved)); ?></td>
                      <td><?php if($row->status=="approved"){ ?> <div class="badge bg-green"><?= $row->status ?> <?php }else{ ?><div class="badge bg-red"><?= $row->status ?> <?php } ?></td>
                      
                    </tr>
                    <?php
                     }
                   ?>
                  </tbody>
                  <tfoot>
                    
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