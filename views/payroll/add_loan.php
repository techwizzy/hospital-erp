 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
   

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
          <!-- Default box -->
          <div class="panel panel-primary">
            <div class="panel-heading with-border">
              add loan
          </div>
            <div class="box-body">
              <div class="panel-heading">
                     
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
                      <label class="col-sm-2 col-md-2 control-label">Title </label>
                      <div class="col-sm-10 col-md-8">
                          <div class="has-feedback">
                              <input type="text" name="title" class="form-control" id="title" value="<?= set_value('title') ?>" />
                              </i>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Select Type </label>
                      <div class="col-sm-10 col-md-8">
                            <select class="form-control" name="loan_type">
                               <option>HELB</option>
                               <option>COOPERATIVE</option>
                               <option>COMPANY</option>
                               <OPTION>SAVINGS</OPTION>
                            </select>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Loan Amount </label>
                      <div class="col-sm-10 col-md-8">
                            <input type="text" name="amount" class="form-control" id="amount" value="<?= set_value('amount') ?>" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Period </label>
                      <div class="col-sm-10 col-md-8">
                            <input type="text" name="period" class="form-control" id="period" value="<?= set_value('period') ?>" data-toggle="tooltip" data-placement="right" title="type number of months only"  />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Monthly Installment </label>
                      <div class="col-sm-10 col-md-8">
                            <input type="text" name="installment" class="form-control" id="installment" value="<?= set_value('installment') ?>" />
                      </div>
                  </div>
                              
                        <div class="form-group form-actions">
                          <div class="col-sm-offset-2 col-sm-10">
                              <?= form_submit('add_user', 'Add Loan/Savings', 'class="btn btn-primary"'); ?>
                          </div>
                        </div>

               </div>
                  
                   <?= form_close(); ?>
                    </div>
               
            </div><!-- /.box-body -->
            
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

