 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
    
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
              add bank
          </div>
                <div class="panel-body">
                   <?= form_open("",'class="form-horizontal" id="new-customer"');?>
        
               <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_fname_label', 'first_name');?></label>
                      <div class="col-sm-10 col-md-8">
                         <input type="text" name="first_name" class="form-control" id="first_name" value="<?= $salary->Firstname ?>" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_lname_label', 'last_name');?> </label>
                      <div class="col-sm-10 col-md-8">
                        <input type="text" name="last_name" class="form-control" id="last_name" value="<?= $salary->Lastname ?>" />
                       
                      </div>
                  </div>
         
                             
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Bank name </label>
                      <div class="col-sm-10 col-md-8">
                       <select  class="form-control select2" style="width: 100%;" name="bank_name" />
                        <option>none</option>
                        <option>ABC Bank (Kenya)</option>
                        <option> Bank of Africa</option>
                        <option> Bank of Baroda</option>
                         <option>Bank of India</option>
                         <option>Barclays Bank Kenya</option>
                         <option> Capital Sacco</option>
                        <option> Centenary Sacco</option>
                        <option> Centenary Sacco Society Savings</option>

                        <option> CfC Stanbic Holdings</option>
                        <option> Chase Bank Kenya</option>
                        <option> Citibank</option>
                         <option>Commercial Bank of Africa</option>
                        <option> Consolidated Bank of Kenya</option>
                        <option> Cooperative Bank of Kenya</option>
                        <option> Credit Bank</option>
                        <option> Development Bank of Kenya</option>
                       <option>  Diamond Trust Bank</option>
                      <option>   Dubai Bank Kenya</option>
                        <option> Ecobank Kenya</option>
                       <option>  Equatorial Commercial Bank</option>
                        <option> Equity Bank</option>
                        <option> Family Bank</option>
                        <option> Fidelity Commercial Bank Limited</option>
                       <option>  First Community Bank</option>
                       <option>  Giro Commercial Bank</option>
                       <option>  Guaranty Trust Bank Kenya</option>
                       <option>  Guardian Bank</option>
                       <option>  Gulf African Bank</option>
                       <option>  Habib Bank</option>
                       <option>  Habib Bank AG Zurich</option>
                       <option>  Housing Finance Company of Kenya</option>
                      <option>   I&M Bank</option>
                       <option>  Imperial Bank Kenya</option>
                       <option>  Jamii Bora Bank</option>
                       <option>  Kenya Commercial Bank</option>
                       <option>  K-Rep Bank</option>
                       <option>  Middle East Bank Kenya</option>
                        <option> National Bank of Kenya</option>
                        <option> NIC Bank</option>
                        <option> Oriental Commercial Bank</option>
                        <option> Paramount Universal Bank</option>
                        <option> Prime Bank (Kenya)</option>
                       <option>  Standard Chartered Kenya</option>
                        <option> Solution Sacco</option>
                        <option> Trans National Bank Kenya</option>
                        <option> United Bank for Africa </option>
                       <option>  Victoria Commercial Bank  </option>


                   </select>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Branch </label>
                      <div class="col-sm-10 col-md-8">
                            <input type="text" name="branch" class="form-control" id="branch" value="<?= set_value('branch') ?>" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Account number </label>
                      <div class="col-sm-10 col-md-8">
                            <input type="text" name="account" class="form-control" id="account"  />
                      </div>
                  </div>
                   <div class="form-group form-actions">
                          <div class="col-sm-offset-2 col-sm-10">
                              <?= form_submit('add_user', 'Add Bank', 'class="btn btn-primary"'); ?>
                          </div>
                        </div>

               </div>
                  
                   <?= form_close(); ?>
                    </div>
                </div>
            </div>
            </div><!-- /.box-body -->
            
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
<script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

       });
 </script>