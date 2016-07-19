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
          <!-- Default box -->
          <div class="panel panel-primary">
         
                <div class="panel-heading">
                        <h4>Edit product</h4>
                </div>
               
                <div class="panel-body">
                   <?= form_open("inventory/edit_product_record",'class="form-horizontal" id="new-customer"');?>
         <div class="tab-content">
             <div class="tab-pane fade in active" id="tab1default">
             
               <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Product Name</label>
                      <div class="col-sm-10 col-md-8">
                        <input class="form-control" type="text" name="productname" id="productname" title="Name of the product" value="<?php echo $row->Product_name ?>"  /><span ><?php echo form_error('productname'); ?></span></div>
                       <input class="medium" name="pid"  id="pid" type="hidden" value="<?php echo $row->Product_id; ?>"/>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Product Code </label>
                      <div class="col-sm-10 col-md-8">
                        <input class="form-control" type="text" name="pcode" id="pcode" title="Unique code for the product" value="<?php echo  $row->Code ?>" />
                       
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Type</label>
                      <div class="col-sm-10 col-md-8">
                       <select name="ptype" class="form-control select2">
         
                        <option value="Inventory item">Inventory Item</option>
                      
                         </select>
                                 
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Product Category </label>
                      <div class="col-sm-10 col-md-8">
                         <select  name="pcat" class="form-control select2" >

                            <?php  foreach($categorydata->result() as $r){if(($row->Category)==($r->Row_id)){?>

                               <option value="<?php echo $r->Row_id; ?>" selected><?php echo $r->Category_name ?></option>
                               <?php } } ?>
                                     <?php $cnt = 1; foreach($categorydata->result() as $r){?>
                                         <option value="<?php echo $r->Row_id; ?>"><?php echo $r->Category_name; ?></option>
                                    <?php $cnt++; }?>
                                  </select>
                           </select>
                      </div>
                  </div>
                             
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Selling Price</label>
                      <div class="col-sm-10 col-md-8">
                          <div class="has-feedback">
                               <input class="form-control" type="text" min="0" max="100" name="sprice" id="sprice" title="Your Selling price"  value="<?php echo $row->Sprice ?>"/></div>
                              </i>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Reorder Level</label>
                      <div class="col-sm-10 col-md-8">
                          <div class="has-feedback">
                                   <input class="form-control" type="text" min="0" max="100" name="reorder" id="reorder"  title="Reorder Level" value="<?php echo $row->Reorder_level ?>"/><span><?php echo form_error('reorder');?></span></div>
              
                              </i>
                          </div>
                      </div>
                  
              
                   <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 col-md-2 control-label">Notes</label>
                      <div class="col-sm-10 col-md-8">
                           <textarea class="ckeditor"  name="notes" cols="20" rows="5"  ><?php echo $row->Notes ?></textarea>
                      </div>
                  </div>
                  
                    
        
                        <div class="form-group form-actions">
                          <div class="col-sm-offset-2 col-sm-10">
                              <?= form_submit('edit_product', 'Edit product', 'class="btn btn-primary"'); ?>
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
