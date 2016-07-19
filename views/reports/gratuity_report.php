<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
        
              <div class="panel panel-primary">
             <div class="panel-heading"><h4><i class="fa fa-file-pdf-o"></i><span>Gratuity Report</span></h4></div>
            <div class="panel-body">
            
                    <table id="UsrTable" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            
                            <th style="width:100px;"><?php echo lang('staffno'); ?></th>
                            <th class="col-xs-2"><?php echo lang('first_name'); ?></th>
                            <th class="col-xs-2"><?php echo lang('last_name'); ?></th>
                            <th class="col-xs-2">Salary</th>
                            <th class="col-xs-2">Paye</th>
                             <th class="col-xs-2">Total Gratuity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($salaries as $salary):?>
                            <tr>
                                
                                <td><?php echo htmlspecialchars($salary->Employee_id,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($salary->Firstname,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($salary->Lastname,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($salary->Monthly_salary,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($salary->PAYE,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo ($salary->Monthly_salary-$salary->PAYE); ?></td>
                                
                            
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                        <tfoot class="dtFilter">
                        <tr class="active">
                            
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