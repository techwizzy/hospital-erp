

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    
        <!-- Main content -->
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
           <div class="panel panel-primary">
               <div class="panel-heading"><h4>Add Salary</h4></div>
               <div class="panel-body">
             
                
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

              
          </div>
            <div class="box-body">
                <div class="panel panel-primary">
                <div class="panel-heading"><?= lang('select_emp'); ?></div>
                <div class="panel-body">
                  <?php echo form_open() ?>
                    <div class="form-group">
                      <label class="col-sm-4 col-md-4 control-label"><?= lang('select_emp', 'first_name');?></label>
                      <div class="col-sm-6 col-md-6">
                         <input type="text" name="st" class="form-control" id="search_term" />
                      </div>
                    <?php echo form_close(); ?>
                    
                  </div>
                </div>
              </div>

            <!--Tab section ______________________________________________________ -->

             <div class="panel with-nav-tabs panel-primary">
              <div id="tabs">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">General details</a></li>
                            <li><a href="#tab3default" data-toggle="tab">Summary</a></li>
                        </ul>
                </div>
                <div class="panel-body">
          <?= form_open("payroll/add_salary",'class="form-horizontal" id="new-customer"');?>
         <div class="tab-content">
             <div class="tab-pane fade in active" id="tab1default">
               <input type="hidden" name="id" class="form-control" id="staffid"/>
         <div class="row">
         <div class="col-md-6">
               <div class="form-group">
                      <label class="col-sm-4 col-md-4 control-label"><?= lang('basic_salary', 'basic_salary');?></label>
                      <div class="col-sm-6 col-md-6">
                         <input type="text" name="basic_salary" class="form-control" id="basic_salary" value="0" />
                      </div>
                  </div>
           </div>
           <div class="col-md-6">
                  <div class="form-group">
                      <label class="col-sm-4 col-md-4 control-label"><?= lang('house_allowance', 'house_allowance');?> </label>
                      <div class="col-sm-6 col-md-6">
                        <input type="text" name="house_allowance" class="form-control" id="house_allowance" value="0" />
                       
                      </div>
                  </div>
              </div>    
           </div>      
         <div class="row">
         <div class="col-md-6">                
                  <div class="form-group">
                      <label class="col-sm-4 col-md-4 control-label"><?= lang('risk_allowance', 'risk_allowance');?> </label>
                      <div class="col-sm-6 col-md-6">
                          <div class="has-feedback">
                              <input type="text" name="risk_allowance" class="form-control" id="risk_allowance" value="0" />
                              </i>
                          </div>
                      </div>
                  </div>
            </div>

         <div class="col-md-6">  
                  <div class="form-group">
                      <label class="col-sm-4 col-md-4 control-label"><?= lang('non_practising', 'non_practising');?> </label>
                      <div class="col-sm-6 col-md-6">
                            <input type="text" name="non_practising" class="form-control" id="non_practising" value="0" />
                      </div>
                  </div>
          </div>
        </div>
       <div class="row">
         <div class="col-md-6">
                     <div class="form-group">
                      <label class="col-sm-4 col-md-4 control-label"><?= lang('streneous_allowance', 'streneous_allowance');?> </label>
                      <div class="col-sm-6 col-md-6">
                        <input type="text" name="streneous_allowance" class="form-control" id="streneous_allowance" value="0" />

                      </div>
                  </div>
            </div>
             <div class="col-md-6">
                   <div class="form-group">
                      <label class="col-sm-4 col-md-4 control-label">Transport</label>
                      <div class="col-sm-6 col-md-6">
                        <input type="text" name="transport_allowance" class="form-control" id="transport_allowance" value="0" />
                      </div>
                    </div>
                  </div>
              </div>
        <div class="row">
         <div class="col-md-6">
                  <div class="form-group">
                      <label class="col-sm-4 col-md-4 control-label">  Responsibility</label>
                      <div class="col-sm-6 col-md-6">
                           <input type="text" name="responsibility" class="form-control" id="resp_allowance" value="0" />
                          </div>
                      </div>
          </div>

          <div class="col-md-6">
                  <div class="form-group">
                      <label class="col-sm-4 col-md-4 control-label">  medical </label>
                      <div class="col-sm-6 col-md-6">
                             <input type="text" name="medical_allowance" class="form-control" id="medical_allowance" value="0" />
                           
                      </div>
                  </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-sm-4 col-md-4 control-label">Gross Salary </label>
                      <div class="col-sm-6 col-md-6">
                          <input type="text" name="gross_salary" class="form-control" id="gross_salary" value="0" readonly/>
                     </div>
                  </div>
                </div>
             </div>   
                <div class="row">
                   <div class="form-group form-actions">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button  id="next" class="btn btn-primary">Next</button>
                         
                      </div>
                  </div>
                </div>
               </div>
               

               <!--- 3rd tab -->
               <div class="tab-pane fade slow" id="tab3default">

                  <div class="form-group">
                        <div class="col-sm-4 col-md-4"></div>
                        <div class="col-sm-6 col-md-6" >
                          <div class="panel panel-info">
                              <div class="panel-heading"><h4 align="center">Summary</h4></div>
                               <div class="panel-body">
                                 <div class="form-group">
                                  <label class="col-sm-4 col-md-4 control-label"><?= lang('basic_salary', 'basic_salary');?></label>
                                  <div class="col-sm-4 col-md-4">
                                     <input type="text" name="sbasic_salary" class="form-control" id="sbasic_salary" value="0" />
                                  </div>
                              </div>
                                <div class="form-group">
                                  <label class="col-sm-4 col-md-4 control-label">Total allowances</label>
                                  <div class="col-sm-4 col-md-4">
                                     <input type="text" name="total_allowance" class="form-control" id="total_allowance" value="0" />
                                  </div>
                              </div>
                                  <div class="form-group">
                                  <label class="col-sm-4 col-md-4 control-label">Salary + Allowances </label>
                                  <div class="col-sm-4 col-md-4">
                                      <input type="text" name="sgross_salary" class="form-control" id="sgross_salary" value="0" />
                                 </div>
                              </div>
                               
                                
                               <div class="form-group form-actions">
                                <div class="col-sm-offset-4 col-sm-10">
                                     <button  id="previous" class="btn btn-primary">Previous</button>
                                    <?= form_submit('save_details', lang('save_details'), 'class="btn btn-primary"'); ?>
                                </div>
                              </div>
                               </div>
                          </div>
                    </div>

               </div>

                  
                   <?= form_close(); ?>
                </div>
              </div>
             </div>
            </div>
        
        <script type="text/javascript">

   $(document).ready(function () {

   
    $("#search_term").autocomplete({
    source: "<?php echo site_url('payroll/load_employee_detail'); ?>",
    focus: function(event, ui) {
        $("#search_term").val(ui.item.label);
        return false;
    },
    select: function(event, ui) {
        $("#search_term").val(ui.item.label);
        $("#first_name").val(ui.item.fname);
        $("#last_name").val(ui.item.lname);
        $("#staffid").val(ui.item.id);
        return false;
    }
});

});
        </script>

         
         
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->



