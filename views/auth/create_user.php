<div class="content-wrapper">
   

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


           
             <div class="panel with-nav-tabs panel-primary">
              <div class=" panel-heading">New Staff</div>
              <div id="tabs">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Basic details</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Payroll Details</a></li>
                        </ul>
                </div>
                <script>
                     // store the currently selected tab in the hash value
                    $("ul.nav-tabs > li > a").click(function(e) {
                      e.preventDefault();
                      $(this).addClass("active");
                    });

                </script>
                <div class="panel-body">
                   <?= form_open("auth/create_user",'class="form-horizontal" id="new-customer"');?>
         <div class="tab-content">
             <div class="tab-pane fade in active" id="tab1default">
             
               <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_fname_label', 'first_name');?></label>
                      <div class="col-sm-10 col-md-8">
                         <input type="text" name="first_name" class="form-control" id="first_name" value="<?= set_value('first_name') ?>" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_lname_label', 'last_name');?> </label>
                      <div class="col-sm-10 col-md-8">
                        <input type="text" name="last_name" class="form-control" id="last_name" value="<?= set_value('last_name') ?>" />
                       
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_gender_label', 'gender');?> </label>
                      <div class="col-sm-10 col-md-8">
                         <?php  $options = array('male'  => 'Male',
                                                'female'    => 'Female'
                                            );
                          echo form_dropdown('gender', $options, 'male','class="form-control select2"');

                        ?>
                     
                      </div>
                  </div>
         
                             
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_phone_label', 'phone');?> </label>
                      <div class="col-sm-10 col-md-8">
                          <div class="has-feedback">
                              <input type="text" name="phone" class="form-control" id="phone" value="<?= set_value('phone') ?>" />
                              </i>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 col-md-2 control-label">Address</label>
                      <div class="col-sm-10 col-md-8">
                          <textarea class="ckeditor" rows="4" name="address"><?= set_value('address') ?></textarea>
                      </div>
                  </div>
                  
                     <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_isallowed_label', 'username');?> </label>
                         <div class="col-sm-10 col-md-4">
                        Yes <span><input type="radio" id="allow" name="is_allowed"  Value="yes" /> </span>
                      </div>                     
                       <div class="col-sm-10 col-md-4">
                         No  <input type="radio" id="dontAllow" name="is_allowed"  Value="no" checked="TRUE" /> </span>
                      </div>
                  </div>
               

                
                  <!----Hidden -------------->
                  <div id="userdata" style=""  >
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Username</label>
                      <div class="col-sm-10 col-md-8">
                            <input type="text" name="username" class="form-control" id="username" value="<?= set_value('username') ?>" />
                      </div>
                  </div>
                     <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_group_label', 'group');?> </label>
                      <div class="col-sm-10 col-md-8">
                         <?php  $options = array('none'=> 'none',
                                                  'Accountant'  => 'Accountant',
                                                 'Administrator'  => 'Administrator',
                                                 'Clerk'    => 'Clerk'
                                            );


                          echo form_dropdown('group', $options, 'none','class="form-control select2"');

                        ?>

                      </div>
                  </div>
                   <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_password_label', 'password');?> </label>
                      <div class="col-sm-10 col-md-8">
                          <div class="has-feedback">
                                <input type="password" name="password" class="form-control" id="password" value="<?= set_value('password') ?>" />
                              
                             
                              </i>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">  <?= lang('create_user_password_confirm_label', 'password_confirm');?></label>
                      <div class="col-sm-10 col-md-8">
                          <div class="has-feedback">
                               <input type="text" name="password_confirm" class="form-control" id="password_confirm" value="<?= set_value('password_confirm') ?>" />
                              
                              </i>
                          </div>
                      </div>
                  </div>
                    <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_status_label', 'status');?> </label>
                      <div class="col-sm-10 col-md-8">
                         <?php  $options = array('1'  => 'Active',
                                                '0'    => 'Inactive'
                                            );
                          echo form_dropdown('status', $options, 'Inactive','class="form-control select2"');
                        ?>
                     </div>
                  </div>
                </div>
                
                   <div class="form-group form-actions">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button  id="next" class="btn btn-primary">Next</button>
                         
                      </div>
                  </div>
                  <script>
                       $('#next').on('click', function(event) {
                        event.preventDefault();
                            $('#tabs a[href="#tab2default"]').tab('show');
                        });
                   </script>
               </div>
               <div class="tab-pane fade" id="tab2default">

                      <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_id', 'id');?> </label>
                          <div class="col-sm-10 col-md-8">
                                 <input type="text" name="nid" class="form-control" id="nid" value="<?= set_value('nid') ?>" />
                          </div>
                      </div>
                        <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_staffno', 'staffno');?> </label>
                          <div class="col-sm-10 col-md-8">
                               <input type="text" name="staff_no" class="form-control" id="staff_no" value="<?= set_value('staff_no') ?>" />
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_pin', 'pin');?> </label>
                          <div class="col-sm-10 col-md-8">
                                <input type="text" name="pin" class="form-control" id="pin" value="<?= set_value('pin') ?>" />
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_nssf', 'nssf');?> </label>
                          <div class="col-sm-10 col-md-8">
                                 <input type="text" name="nssf_no" class="form-control" id="nssf_no" value="<?= set_value('nssf_no') ?>" />
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_nhif', 'nhif');?> </label>
                          <div class="col-sm-10 col-md-8">
                                <input type="text" name="nhif_no" class="form-control" id="nhif_no" value="<?= set_value('nhif_no') ?>" />
                          </div>
                      </div>
                       <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_company_label', 'company');?> </label>
                          <div class="col-sm-10 col-md-8">
                                <input type="text" name="company" class="form-control" id="company" value="<?= set_value('company') ?>" />
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_marital', 'marital');?> </label>
                          <div class="col-sm-10 col-md-8">
                              <?php  $options = array('single'  => 'Single',
                                                   'married'    =>'Married',
                                                   'divorced'    =>'Divorced'
                                              );
                            echo form_dropdown('marital', $options, 'single','class="form-control select2"');
                          ?>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_jdate', 'jdate');?> </label>
                          <div class="col-sm-10 col-md-8">
                               <?= form_input('jdate', '', 'class="form-control " id="datepicker" '); ?>
                          </div>
                      </div>
                      <script type="text/javascript">
                    $(function() {
                          //load the datepiucker plugin 
                         $( "#datepicker" ).datepicker();
                         $( "#datepicker" ).datepicker('setDate', new Date());

                     });
                       
                    </script>
                       <div class="form-group">
                        <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_wstatus', 'wstatus');?> </label>
                        <div class="col-sm-10 col-md-8">
                           <?php  $options = array('hired'  => 'Hired',
                                                   'fired'    =>'Fired'
                                              );
                            echo form_dropdown('wstatus', $options, 'Hired','class="form-control select2"');
                          ?>
                       </div>
                  </div>
                        <div class="form-group form-actions">
                          <div class="col-sm-offset-2 col-sm-10">
                              <?= form_submit('add_user', lang('add_user'), 'class="btn btn-primary"'); ?>
                          </div>
                        </div>

               </div>
                  
                   <?= form_close(); ?>
                
                    </div>
                </div>
            </div>

            </div>
            </section>
        </div>
  

<script type="text/javascript">
$(document).ready(function() {
 $('input[type="radio"]').click(function(){
                          if($(this).attr("value")=="yes"){
                               $("#userdata").show();
                          }
                          if($(this).attr("value")=="no"){
                              $("#userdata").hide();
                          }
                       });
                    });
</script>