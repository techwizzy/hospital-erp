
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
         
             <?php if ($error) { ?>
                        <div class="alert alert-danger">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <ul class="list-group"><?=  $error; ?></ul>
                        </div>
         <?php } ?>
         <?php if($message) { ?>
               <div class="alert alert-success">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <ul class="list-group"><?=  $message; ?></ul>
                        </div>
             <?php } ?>

              <div class="panel panel-primary">
            <div class="panel-heading with-border">
           <div>salaries </div>   
          </div>
 
            <div class="panel-body">
            
                    <table id="UsrTable" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            
                            <th style="width:100px;"><?php echo lang('staffno'); ?></th>
                            <th class="col-xs-2"><?php echo lang('first_name'); ?></th>
                            <th class="col-xs-2"><?php echo lang('last_name'); ?></th>
                            <th class="col-xs-2"><?php echo lang('basic_salary'); ?></th>
                            <th class="col-xs-2">Total Allowance</th>
                            <th class="col-xs-2"><?php echo lang('gross_salary'); ?></th>
                             
                            <th class="col-xs-2"><?php echo lang('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($salaries->result() as $salary):?>
                            <tr>
                                
                                <td><?php echo htmlspecialchars($salary->Employee_id,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($salary->Firstname,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($salary->Lastname,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars(number_format($salary->Basic_salary),ENT_QUOTES,'UTF-8');?>.00</td>
                                <td><?php echo (number_format($salary->other+$salary->Medical+$salary->Transport+$salary->risk+$salary->responsibility+$salary->strenuous+$salary->non_practising)); ?>.00</td>
                                <td><?php echo htmlspecialchars(number_format($salary->Monthly_salary),ENT_QUOTES,'UTF-8');?>.00</td>
                                
                                <td><div class="btn-group ">
                                   <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu col-md-2" >
                                      <li><a href="<?= site_url('payroll/editSalary/'.$salary->Employee_id) ?>"><i class="fa fa-fw fa-eye"></i>view</a></li>
                
                                      
                                      <li><a href="<?= site_url('payroll/add_deduction/'.$salary->Employee_id) ?>"><i class="fa fa-fw fa-minus-circle"></i>Add deduction</a></li>
                                      <li><a href="<?= site_url('payroll/add_loan/'.$salary->Employee_id) ?>"><i class="fa fa-fw fa-money"></i>Add Loan/Savings</a></li>
                                      <li><a href="<?= site_url('payroll/add_bank/'.$salary->Employee_id) ?>"><i class="fa fa-fw fa-home"></i> Add user Bank</a></li>
                                      <li><a href="<?= site_url('payroll/newPosting/'.$salary->Employee_id) ?>"><i class="fa fa-fw fa-circle-o"></i>Process Payslip</a></li>
                                      <li><a href="<?= site_url('payroll/newGratuity/'.$salary->Employee_id) ?>"><i class="fa fa-fw fa-briefcase"></i>Process gratuity</a></li>
                                      <li><a href="<?= site_url('payroll/getPayslip/'.$salary->Employee_id) ?>"><i class="fa fa-fw fa-file-o"></i>View Payslip</a></li>
                                      <li><a href="<?= site_url('payroll/getGratuity/'.$salary->Employee_id) ?>"><i class="fa fa-fw fa-file-o"></i>View gratuity</a></li>
                                    </ul>
                            </div>
                        </td>     
                            
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