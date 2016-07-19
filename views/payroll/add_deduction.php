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

              
         <div class="panel panel-primary">
            <div class="panel-heading with-border">
             Add deduction
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
                      <label class="col-sm-2 col-md-2 control-label">Deduction Title </label>
                      <div class="col-sm-10 col-md-8">
                          <div class="has-feedback">
                              <input type="text" name="title" class="form-control" id="title" value="<?= set_value('title') ?>" />
                              </i>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Amount </label>
                      <div class="col-sm-10 col-md-8">
                            <input type="text" name="amount" class="form-control" id="amount" value="<?= set_value('amount') ?>" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Date Deducted </label>
                      <div class="col-sm-10 col-md-8">
                            <input type="text" name="date_deducted" class="form-control" id="datepicker"  />
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 col-md-2 control-label">Note</label>
                      <div class="col-sm-10 col-md-8">
                          <textarea class="form-control" rows="4" name="note"><?= set_value('note') ?></textarea>
                      </div>
                  </div>
                  
               

                
                  
                
               
                        <div class="form-group form-actions">
                          <div class="col-sm-offset-2 col-sm-10">
                              <?= form_submit('add_user', 'Add Deduction', 'class="btn btn-primary"'); ?>
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
      
  <script type="text/javascript">
                    $(function() {
                          //load the datepiucker plugin 
                         $( "#datepicker" ).datepicker();
                         $( "#datepicker" ).datepicker('setDate', new Date());

                     });
                       
                    </script>
