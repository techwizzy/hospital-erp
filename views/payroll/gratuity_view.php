<div class="content-wrapper">
<!-- Main content -->
 <section class="content">
<?php if (!empty($payslip)){ ?>

        <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
               <div class="panel-heading"></div>
               <div class="panel-body">
                <div class="print-only col-xs-12">
                   <i class="fa fa-3x fa-file-image"></i>
                </div>
                <div class="well well-sm">
                    <div class="col-xs-4 border-right">

                        <div class="col-xs-2"><i class="fa fa-3x fa-building padding010 text-muted"></i></div>
                        <div class="col-xs-10">
                            <address><strong>COTTOLENGO MISSION HOSPITAL<br/>
                                  P.O. BOX 1426-60200,MERU, KENYA <br/>
                                  cottolengo.chaaria@gmail.com
                                  <i> "Caritas Christi urgent nos!"</i> <strong></address>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <div class="col-xs-4">

                        <div class="col-xs-2"><i class="fa fa-3x fa-user padding010 text-muted"></i></div>
                        <div class="col-xs-10">
                           
                           <p style="font-weight:bold;">Payroll No: <?= $payslip->Employee_id ?> </p>
                           <p style="font-weight:bold;">Name: <?= $payslip->Firstname . "  " . $payslip->Lastname ?> </p>
                           <p style="font-weight:bold;">National ID: <?= $payslip->no ?> </p>
                           <p style="font-weight:bold;">PIN: <?= $payslip->KRA_Pin ?> </p>
     

                        </div>
                        <div class="clearfix"></div>


                    </div>
                    <div class="col-xs-4 border-left">

                        <div class="col-xs-2"><i class="fa fa-3x fa-file-text-o padding010 text-muted"></i></div>
                        <div class="col-xs-10">
                            <p style="font-weight:bold;">Gratuity slip No: <?= $payslip->Row_id; ?></p>

                            <p style="font-weight:bold;">Date: <?= $payslip->Salary_date; ?></p>

                            <p style="font-weight:bold;">Period: <?=date('01-01-Y') ?> TO: <?= date('31-12-Y'); ?> </p>
                        </div>
                       
                        <div class="clearfix"></div>


                    </div>
                    <div class="clearfix"></div>
                </div>
            
                <div class="table-responsive">
                   <table class="table table-bordered  print-table order-table">
                        <thead style="background-color:#fcfcfc">
                        <tr>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                            <tr>
                             <td><strong>Gross Pay:</strong></td> <td><strong><?php echo number_format($payslip->Monthly_salary); ?></strong></td>
                             </tr>
                           
                             <tr>
                              <td>PAYE: </td><td><?php echo number_format($payslip->PAYE); ?></td>
                            </tr>
                           
                             <tr>
                              <td>Loan Repayment: </td> <td><?php echo number_format($payslip->Loan); ?></td>
                             </tr>
                                 <tr>
                              <td>Deductions: </td><td><?php echo number_format($payslip->Deductions); ?></td>
                            </tr>
                          <tr>
                              <th>Net Salary: </th><th><?php echo number_format($payslip->Monthly_salary -$payslip->PAYE-$payslip->Loan-$payslip->Deductions); ?></th>
                   </tr>
           
            
    
                        </tbody>
                        <tfoot>
                       
                      

                        </tfoot>
                    </table>

                </div>

            </div>
        </div>
         <div class="row">
            <div class="col-lg-12">
               
                <div class="well well-sm">
                  <p style="font-weight:bold;">Payment Details</p>
                  <p style="font-weight:bold;">Bank: <?= $payslip->Bank ?> </p>
                  <p style="font-weight:bold;">Bank Branch: <?= $payslip->Branch ?> </p>
                  <p style="font-weight:bold;">Bank Account: <?= $payslip->Bank_account ?> </p>
                </div>
             </div>
          </div>

            <div class="buttons">
             
                <div class="btn-group btn-group-justified">
                    <div class="btn-group"><a href="<?= site_url('payroll/printPayslip/'.$payslip->Employee_id) ?>" target="_blank"  class="tip btn btn-primary tip"
                                              title="print"><i class="fa fa-print"></i>Print <span
                                class="hidden-sm hidden-xs"><?= lang('view_payments') ?></span></a></div>
                 
                    <div class="btn-group"><a href="<?= site_url('payroll/pdf/' .$payslip->Employee_id) ?>"
                                              class="tip btn btn-primary" title="<?= lang('download_pdf') ?>"><i
                                class="fa fa-download"></i> <span class="hidden-sm hidden-xs"><?= lang('pdf') ?></span></a>
                    </div>
                                 
                </div>
            </div>
       
    </div>
 <?php }else{ ?>
     <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">STATUS REPORT</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="callout callout-danger">
                   <p align="center"><strong>There is no Payslip record for this user in the current period(from <?= date('01, F, Y'); ?>)  to  (<?= date('t,  F, Y'); ?>)</strong></p>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->


 <?php } ?>
</section>
</div>