<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
        
              <div class="panel panel-primary">
             <div class="panel-heading"><h4><i class="fa fa-file-pdf-o"></i><span>PO pending approval</span></h4></div>
            <div class="panel-body">
            
                    <table id="UsrTable" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-striped">
                   <thead>
                  <tr>
                    
                      <th>KRA PIN</th>
                      <th class="col-xs-2">Name</th>
                      <th>Address</th>
                      <th>Phone</th>
                       <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!--loop through the array to display the Supplier data --> 
                  <?php foreach ($data->result() as $row) { ?>
           
                    <tr>
                      <td><?php echo $row->Pin; ?></td>
                      <td><?php echo $row->Supplier_name; ?></td>
                      <td><?php echo $row->Address; ?></td>
                      <td><?php echo $row->Phone; ?></td>
                      <td><?php echo $row->Email; ?></td>
                      <td><div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-xs btn-flat">Action</button>
                                      <button type="button" class="btn btn-primary btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                      </button>
                                      <ul class="dropdown-menu" role="menu">
                                        <li><?php echo anchor("purchase/load_edit_supplier/".$row->Pin, '<i class="fa fa-edit"> Edit </i>') ; ?></li>
                                      
                                        
                                      </ul>
                                    </div> </td>
                      
                    </tr>
                    <?php    //end of loop
                  } ?>
                   
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