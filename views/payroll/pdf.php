<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Payslip</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
0716456945        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onload="window.print();">
    <div class="wrapper">
      <!-- Main content -->
<section class="invoice"  style=" max-width:700px;">
   <div class="row invoice-info">
         
          <div class="col-sm-4 invoice-col">
       
            <address>
                <strong> COTTOLENGO MISSION HOSPITAL<br/>
                                  P.O. BOX 1426-60200,MERU, KENYA <br/>
                                  cottolengo.chaaria@gmail.com <br/>
                                  <i> "Caritas Christi urgent nos!"</i></strong>
            </address>
          </div><!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <address> <strong>Payroll No: <?= $payslip->Employee_id ?> </strong>
                           <p style="font-weight:bold;">Name: <?= $payslip->Firstname . "  " . $payslip->Lastname ?> </p>
                           <p style="font-weight:bold;">National ID: <?= $payslip->no ?> </p>
                           <p style="font-weight:bold;">PIN: <?= $payslip->KRA_Pin ?> </p>
                         </address>
     
          </div><!-- /.col -->
           <div class="col-sm-4 invoice-col">
      
            <address>
                           <p style="font-weight:bold;">Payslip No: <?= $payslip->Row_id; ?></p>

                            <p style="font-weight:bold;">Date: <?= $payslip->Salary_date; ?></p>

                            <p style="font-weight:bold;">Period: <?= $payslip->Start_date; ?> TO: <?= $payslip->End_date; ?> </p>
            </address>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
                

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
                              <td>NSSF Pension Contribution: </td><td> <?php echo number_format($payslip->NSSF); ?></td>
                            </tr>
                             <tr>
                              <td>PAYE: </td><td><?php echo number_format($payslip->PAYE); ?></td>
                            </tr>
                            <tr>
                              <td>NHIF Contribution: </td><td><?php echo number_format($payslip->NHIF); ?></td>
                            </tr>
                            
                             <tr>
                              <td>Loan Repayment: </td> <td><?php echo number_format($payslip->Loan); ?></td>
                             </tr>
                                 <tr>
                              <td>Deductions: </td><td><?php echo number_format($payslip->Deductions); ?></td>
                            </tr>
                          <tr>
                              <th>Net Salary: </th><th><?php echo number_format($payslip->Monthly_salary - $payslip->NSSF -$payslip->PAYE- $payslip->NHIF-$payslip->Loan-$payslip->Deductions); ?></th>
                   </tr>
           
            
    
                        </tbody>
                        <tfoot>
                       
                      

                        </tfoot>
                    </table>

                </div>

            </div>
        </div>

    </div>

      </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>theme/js/app.min.js"></script>
  </body>
</html>
