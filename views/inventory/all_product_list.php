<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
        
              <div class="panel panel-primary">
             <div class="panel-heading"><h4><i class="fa fa-file-pdf-o"></i><span>Products Report</span></h4></div>
            <div class="panel-body">
            
                    <table id="UsrTable" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-striped">
                   <thead>
                    <tr>
                      <th class="col-xs-1">Id</th>
                      <th class="col-xs-1">Code</th>
                      <th class="col-xs-4">Name</th>
                      
                    
                      <th class="col-xs-2">Price</th>
                     
                      <th class="col-xs-3">Reorder level</th>
                       <th class="col-xs-2">Total Value</th>
                      <th class="col-xs-4">Actions</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <!-- loop through category table-->
                    <?php foreach ($productdata as $row) : ?> 
                    <tr>
                       <td><?php echo $row->Product_id; ?></td>
                       <td><?php echo $row->Code; ?></td>
                       <td><?php echo $row->Product_name; ?></td>
                     
                       <td><?php echo number_format($row->Selling_price); ?>.00</td>
                       <td><?php echo number_format($row->Reorder_level); ?></td>
                       <td><?php echo number_format($row->Total_value); ?>.00</td>
                      <td>
                         <div class="btn-group ">
                                   <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu col-md-2" >
                                      <li><a href="<?= site_url('inventory/edit_product/'.$row->Product_id) ?>"><i class="fa fa-fw fa-edit"></i>Edit</a></li>
                
                                      <li><a href="<?= site_url('inventory/delete_product/'.$row->Product_id) ?>"><i class="fa fa-fw fa-times-circle-o"></i>Delete</a></li>
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