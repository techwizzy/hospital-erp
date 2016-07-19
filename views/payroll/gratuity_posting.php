<div class="content-wrapper">
        <!-- Content Header (Page header) -->
             
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
        <!-- Main content -->
        <section class="content">
           <?= form_open("payroll/addNewGratuity");?>
          <!-- SELECT2 EXAMPLE -->
          <div class="panel panel-primary">
            <div class="panel-heading with-border">
             Staff Basic details
            </div><!-- /.panel-heading -->
            <div class="panel-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>First name</label>
                     <input type="text" name="first_name" class="form-control" id="first_name" value="<?= $salary->Firstname ?>" />
                  </div><!-- /.form-group -->
                  <div class="form-group">
                    <label>National id</label>
                     <input type="text" name="nid" class="form-control" id="nid" value="<?= $salary->National_id ?>" />
                  </div><!-- /.form-group -->
                   <div class="form-group">
                    <label>PIN</label>
                     <input type="text" name="pin" class="form-control" id="pin" value="<?= $salary->Kra_pin ?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Last name</label>
                     <input type="text" name="last_name" class="form-control" id="last_name" value="<?= $salary->Lastname ?>" />
                  </div><!-- /.form-group -->
                  <div class="form-group">
                    <label>From</label>
                     <input type="text" name="start_period" class="form-control"  value="<?= date('01/m/Y') ?>" />
                  </div><!-- /.form-group -->
               
                </div><!-- /.col -->
                 <div class="col-md-4">
                  <div class="form-group">
                    <label>Staff No</label>
                     <input type="text" name="id" class="form-control" id="id" value="<?= $salary->Staff_no ?>" />
                  </div><!-- /.form-group -->
                  <div class="form-group">
                    <label>To</label>
                      <input type="text" name="end_period" class="form-control" value="<?= date('t/m/Y') ?>" />
                  </div><!-- /.form-group -->
                
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            
          </div><!-- /.box -->

          <div class="row">
            <div class="col-md-6">

              <div class="panel panel-primary">
                <div class="panel-heading">
                Salary & Allowances
                </div>
                <div class="panel-body">
                 
                   <div class="form-group">
                      <label class="col-md-4 control-label"><?= lang('basic_salary', 'basic_salary');?></label>
                      <div class=" col-md-6">
                         <input type="text" name="basic_salary" class="form-control" id="basic_salary" value="<?= $salary->Basic_salary; ?>" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-4 control-label"><?= lang('house_allowance', 'house_allowance');?> </label>
                      <div class=" col-md-6">
                        <input type="text" name="house_allowance" class="form-control" id="house_allowance" value="<?= $salary->other; ?>" />
                       
                      </div>
                  </div>
                  
                 
                             
                  <div class="form-group">
                      <label class=" col-md-4 control-label"><?= lang('risk_allowance', 'risk_allowance');?> </label>
                      <div class=" col-md-6">
                          <div class="has-feedback">
                              <input type="text" name="risk_allowance" class="form-control" id="risk_allowance" value="<?= $salary->risk; ?>" />
                              </i>
                          </div>
                      </div>
                  </div>
                
                  <div class="form-group">
                      <label class=" col-md-4 control-label"><?= lang('non_practising', 'non_practising');?> </label>
                      <div class=" col-md-6">
                            <input type="text" name="non_practising" class="form-control" id="non_practising" value="<?= $salary->non_practising; ?>" />
                      </div>
                  </div>
                     <div class="form-group">
                      <label class="col-md-4 control-label">Streneous </label>
                      <div class=" col-md-6">
                        <input type="text" name="non_practising" class="form-control" id="streneous_allowance" value="<?= $salary->strenuous; ?>" />

                      </div>
                  </div>
                   <div class="form-group">
                      <label class=" col-md-4 control-label">Transport </label>
                      <div class=" col-md-6">
                          <div class="has-feedback">
                                <input type="text" name="transport_allowance" class="form-control" id="transport_allowance" value="<?= $salary->other; ?>" />
                              
                             
                              </i>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-4 control-label">  Medical</label>
                      <div class=" col-md-6">
                          <div class="has-feedback">
                               <input type="text" name="medical_allowance" class="form-control" id="medical_allowance" value="<?= $salary->Medical; ?>" />
                              
                              </i>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class=" col-md-4 control-label">Responsibility</label>
                      <div class="col-md-6">
                          <div class="has-feedback">
                               <input type="text" name="resp_allowance" class="form-control" id="resp_allowance" value="<?= $salary->responsibility; ?>" />
                              
                              </i>
                          </div>
                      </div>
                  </div>
                   </div><!-- /.box-body -->
                   <div class="box-footer">
                    <div class="form-group">
                      <label class=" col-md-4 control-label">Gross salary </label>
                      <div class="col-md-6">
                          <input type="text" name="gross_salary" class="form-control" id="gross_salary" value="<?= $salary->Monthly_salary; ?>" />
                     </div>
                  </div>
                </div>
          
               
              </div><!-- /.box -->

              <div class="panel panel-primary">
                <div class="panel-heading">
                  Statutory Deductions
                </div>
                <div class="panel-body">
                  <!-- Color Picker -->
                   <div class="form-group">
                      <label class="col-md-4 control-label">P.A.Y.E</label>
                      <div class=" col-md-6">
                         <input type="text" name="paye" class="form-control" id="paye" value="0" />
                      </div>
                  </div>

                  

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="form-group">
                      <label class="col-md-4 control-label">Net pay</label>
                      <div class=" col-md-6">
                         <input type="text" name="netpay" class="form-control" id="netpay" value="0" />
                      </div>
                  </div>
                </div>
              </div><!-- /.box -->

            </div><!-- /.col (left) -->
            <div class="col-md-6">
              <div class="box panel-primary">
                <div class="panel-heading">
                  Deductions
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <table class="table table-condensed">
                    <tr>
                      <th>Deduction</th>
                      <th>Amount</th>
                      <th>Note</th>
                     
                    </tr>

                    <?php foreach ($deductions as $deduction) { ?>
                   
                    <tr>
                      <td><?= $deduction->Title ?></td>
                      <td width="100px"><input type="text" name="amount" class="form-control" id="resp_allowance" value="<?= $deduction->Amount; ?>" /></td>
                      <td><?= $deduction->Note ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <td><Strong>Total deduction</Strong></td><td colspan="2"><input type="text" name="total_deduction" class="form-control" id="total_deduction" value="<?= $total->total_deduction ?>" /></td>
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- iCheck -->
              <div class="panel panel-primary">
                <div class="panel-heading">
                 LOANS & SAVINGS
                </div>
                <div class="box-body">
                  <table class="table table-condensed">
                    <tr>
                      <th>Title</th>
                      <th>Amount</th>
                      <th>Installment</th>
                     
                    </tr>

                    <?php foreach ($loans as $loan) { ?>
                   
                    <tr>
                    <?php if($loan->Title=="HELB"){ ?>
                      <input type="hidden" name="helb_option" value="yes" />
                      <input type="hidden" name="helbbf" value="<?= $loan->Monthly_repayment; ?>" />
                      <td><?= $loan->Title ?></td>
                      <td><?= $loan->Loan_amount ?></td>
                      <td width="100px"><input type="text" name="monthly_r" class="form-control" id="monthly_r" value="<?= $loan->Monthly_repayment; ?>" /></td>
                      <?php } ?>
                     <?php if($loan->Title=="COOPERATIVE"){ ?>
                      <input type="hidden" name="coop_loan" value="y" />
                      <input type="hidden" name="coopbf" value="<?= $loan->Monthly_repayment; ?>" />
                      <td><?= $loan->Title ?></td>
                      <td><?= $loan->Loan_amount ?></td>
                      <td width="100px"><input type="text" name="monthly_r" class="form-control" id="monthly_r" value="<?= $loan->Monthly_repayment; ?>" /></td>
                      <?php } ?>
                        <?php if($loan->Title=="COMPANY"){ ?>
                      <input type="hidden" name="company_loan" value="a" />
                      <input type="hidden" name="companybf" value="<?= $loan->Monthly_repayment; ?>" />
                      <td><?= $loan->Title ?></td>
                      <td><?= $loan->Loan_amount ?></td>
                      <td width="100px"><input type="text" name="monthly_r" class="form-control" id="monthly_r" value="<?= $loan->Monthly_repayment; ?>" /></td>
                      <?php } ?>
                       <?php if($loan->Title=="SAVINGS"){ ?>
                      <input type="hidden" name="coop_savings" value="a" />
                      <input type="hidden" name="savebf" value="<?= $loan->Monthly_repayment; ?>" />
                      <td><?= $loan->Title ?></td>
                      <td><?= $loan->Loan_amount ?></td>
                      <td width="100px"><input type="text" name="monthly_r" class="form-control" id="monthly_r" value="<?= $loan->Monthly_repayment; ?>" /></td>
                      <?php } ?>
                    </tr>
                    <?php } ?>
                    <tr>
                      <td><Strong>Total Loan deduction</Strong></td><td colspan="2"><input type="text" name="total_loan" class="form-control" id="total_loan" value="<?= $loanTotal->total_loan ?>" /></td>
                    </tr>
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->

               <div class="panel panel-primary">
                <div class="panel-heading">
                  Payment Method
                </div>
                <div class="box-body">
                  <!-- Color Picker -->
                   <div class="form-group">
                      <label class="col-md-6 control-label">Net salary(net pay after deductions)</label>
                      <div class=" col-md-6">
                         <input type="text" name="netsalary" class="form-control" id="netsalary"  />
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-6 control-label">Bank Name</label>
                      <div class=" col-md-6">
                         <input type="text" name="bank_name" class="form-control" id="bank_name"  />
                      </div>
                  </div>
                   <div class="form-group">
                      <label class="col-md-6 control-label">Branch</label>
                      <div class=" col-md-6">
                         <input type="text" name="branch" class="form-control" id="branch" />
                      </div>
                  </div>
                   <div class="form-group">
                      <label class="col-md-6 control-label">Bank Account</label>
                      <div class=" col-md-6">
                         <input type="text" name="account" class="form-control" id="account"  />
                      </div>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="form-group">
                      <div class=" col-md-6">
                         <input type="submit"  class="btn btn-success"  value="process Gratuity" />
                      </div>
                  </div>
                </div>
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
          </div><!-- /.row -->
         <?= form_close(); ?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
          <script type="text/javascript">

   $(document).ready(function () {

   
              $("#bank_name").autocomplete({
              source: "<?php echo site_url('payroll/load_user_banks/'.$salary->Staff_no); ?>",
              focus: function(event, ui) {
                  $("#bank_name").val(ui.item.label);
                  return false;
              },
              select: function(event, ui) {
                  $("#bank_name").val(ui.item.bank_name);
                  $("#branch").val(ui.item.branch);
                  $("#account").val(ui.item.account);
                
                  return false;
              }
          });

   

   var amount=0;
   var tax=0;
   var relief=1162;
   var payTax=0;
   var totalded=0;
   var nhif=0;
   var nssf=200;
   var gross=0;
   var net=0;
  //calculate nssf
  gross= Number($('#gross_salary').val());



  amount= Number($('#gross_salary').val());
  if(amount<10164){
      tax=amount*0.1;
   }else if(amount>10164 && amount<=19740){
      tax=1016.4+((amount-10164)*0.15);
  } 
   else if(amount>19740 && amount<=29316){
     tax=2452.8+((amount-19740)*0.2);
  } 
   else if(amount>29316 && amount<=38892){
     tax=4368+((amount-29316)*0.25);
  } 
   else if(amount>38892){
     tax=6762+((amount-29316)*0.25);
  } 

    if((payTax=tax-relief)<=0 ){
      payTax=0;
     }else{
      payTax=tax-relief;
     }
 
  
   Number($('#paye').val(payTax.toFixed(1)));
   Number($('#netpay').val(amount-payTax));
   totalded=Number($('#total_deduction').val())+Number($('#total_loan').val())+payTax;
   net=amount-totalded;
   Number($('#netsalary').val(net.toFixed(1)));


  });

        </script>
