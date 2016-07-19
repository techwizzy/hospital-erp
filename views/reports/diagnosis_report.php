<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
        
             <div class="panel panel-primary">
             <div class="panel-heading"><h4><i class="fa fa-file"></i><span> Diagnosis Report</span></h4></div>
            <div class="panel-body">
                   <div class="row">
                      <div class="col-lg-12">
                         <div>
                

                         </div>
                        <div>
                    <table id="UsrTable" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-striped ">
                        <thead style="background-color:#cccccc">
                        <tr>
                                <th>Date</th>
                                <th>Diagnosis</th>
                                <th>No of Patients</th>
                              
                                </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rows as $row):?>
                            <tr>
                           <td><?php echo date('d/m/Y', strtotime($row->date)); ?></td>
                            <td><?php echo $row->diagnosis_name; ?></td>
                            <td><?php echo $row->patient_no; ?></td>
                           
                            
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                       
                    </table>
                 </div>
               </div>
             </div>
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