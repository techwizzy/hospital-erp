<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
        
              <div class="panel panel-primary">
             <div class="panel-heading"><h4><i class="fa fa-file-pdf-o"></i><span>Payslip Report</span></h4></div>
            <div class="panel-body">
            
                    <table id="UsrTable" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-striped ">
                        <thead style="background-color:#fcfcfc">
                        <tr>
                            
                            <th class="col-xs-2">PIN</th>
                            <th class="col-xs-4">First name</th>
                            <th class="col-xs-2">Last name</th>
                            <th class="col-xs-2">Salary date</th>
                            <th class="col-xs-2">Gross Salary</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($payslip as $pay):?>
                            <tr>
                                
                                <td><?php echo htmlspecialchars($pay->KRA_Pin,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($pay->Firstname,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($pay->Lastname,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($pay->Salary_date,ENT_QUOTES,'UTF-8');?></td>
                                 <td><?php echo htmlspecialchars($pay->Monthly_salary,ENT_QUOTES,'UTF-8');?></td>
                                <th><div class="badge bg-blue"><i class="fa fa-file-pdf-o"></i>View Payslip</div></th>
                            
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