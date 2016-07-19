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
         
                <div class="panel-heading">
                        <h4>Add service</h4>
                </div>
               
            
               
                <div class="panel-body">
                   <?= form_open("inventory/add_newService",'class="form-horizontal" id="new-customer"');?>
         <div class="tab-content">
             <div class="tab-pane fade in active" id="tab1default">
             
               <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">service Name</label>
                      <div class="col-sm-10 col-md-8">
                        <input class="form-control" type="text" name="productname" id="servicename" title="Name of the service" value="<?php echo set_value('productname'); ?>" /><span ><?php echo form_error('servicename'); ?></span></div>

                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">service Code </label>
                      <div class="col-sm-10 col-md-8">
                        <input class="form-control" type="text" name="pcode" id="pcode" title="Unique code for the service" value="<?php echo set_value('pcode'); ?>" />
                       
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Type</label>
                      <div class="col-sm-10 col-md-8">
                       <select name="ptype" class="form-control select2">
         
                        <option value="Service item">Service Item</option>
                      
                         </select>
                                 
                      </div>
                  </div>
                
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"> Price</label>
                      <div class="col-sm-10 col-md-8">
                          <div class="has-feedback">
                               <input class="form-control" type="text" min="0" max="100" name="sprice" id="sprice" title="Your Selling price"  value="0"/></div>
                              </i>
                          </div>
                      </div>
                  </div>
                
                    
        
                        <div class="form-group form-actions">
                          <div class="col-sm-offset-2 col-sm-10">
                              <?= form_submit('add_service', 'Add service', 'class="btn btn-primary"'); ?>
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
