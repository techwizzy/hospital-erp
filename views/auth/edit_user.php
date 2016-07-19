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
              <div class=" panel-heading">User Profile</div>
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
                   <?= form_open(uri_string(),'class="form-horizontal" id="new-customer"');?>
         <div class="tab-content">
             <div class="tab-pane fade in active" id="tab1default">
             
               <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_fname_label', 'first_name');?></label>
                      <div class="col-sm-10 col-md-8">
                         <input type="text" name="first_name" class="form-control" id="first_name" value="<?= set_value('first_name', $user->Firstname) ?>" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_lname_label', 'last_name');?> </label>
                      <div class="col-sm-10 col-md-8">
                        <input type="text" name="last_name" class="form-control" id="last_name" value="<?= set_value('last_name', $user->Lastname) ?>" />
                       
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_gender_label', 'gender');?> </label>
                      <div class="col-sm-10 col-md-8">
                        <select name="gender" class="form-control select2">
                         <?php if($user->Gender=='male'){ ?>
                          <option value="male" selected>Male</option>
                          <option value="female" >Female</option>
                         <?php }elseif($user->Gender=='female'){ ?>
                           <option value="female" selected>Female</option>
                            <option value="male">Male</option>
                          <?php }else{ ?>
                              <option value="female" selected>Female</option>
                            <option value="male">Male</option>

                          <?php } ?>
                        </select>
                   
                     
                      </div>
                  </div>
         
                             
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_phone_label', 'phone');?> </label>
                      <div class="col-sm-10 col-md-8">
                          <div class="has-feedback">
                              <input type="text" name="phone" class="form-control" id="phone" value="<?= set_value('phone', $user->phone) ?>" />
                              </i>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 col-md-2 control-label">Address</label>
                      <div class="col-sm-10 col-md-8">
                          <textarea class="ckeditor" rows="4" name="address"><?= set_value('address', $user->address) ?></textarea>
                      </div>
                  </div>
                  <?php if ($user->Allowed_login=='no'){ ?>
                     <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_isallowed_label', 'email');?> </label>
                         <div class="col-sm-10 col-md-4">
                        Yes <span><input type="radio" id="yes" name="is_allowed"  Value="yes" /> </span>
                      </div>                     
                       <div class="col-sm-10 col-md-4">
                         No  <input type="radio" id="no" name="is_allowed"  Value="no" checked="TRUE"/> </span>
                      </div>
                  </div>
                    <script>
                   $(document).ready(function(){
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
                    <!----Hidden -------------->
                  <div id="userdata" style="display:none"  >
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_email_label', 'email');?> </label>
                      <div class="col-sm-10 col-md-8">
                            <input type="text" name="email" class="form-control" id="email" value="<?= set_value('email') ?>" />
                      </div>
                  </div>
                     <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_group_label', 'group');?> </label>
                      <div class="col-sm-10 col-md-8">
                         <?php  $options = array('Accountant'  => 'Accountant',
                                                 'Administrator'  => 'Administrator',
                                                 'Clerk'    => 'Clerk'
                                            );


                          echo form_dropdown('group', $options, 'Administrator','class="form-control"');

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
            
                </div>
                
                      <?php } else{?>      
                  <!----Hidden -------------->
                  <div id="userdata" style=""  >
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_email_label', 'email');?> </label>
                      <div class="col-sm-10 col-md-8">
                            <input type="text" name="email" class="form-control" id="email" value="<?= set_value('email',$user->email) ?>" />
                      </div>
                  </div>
                     <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_group_label', 'group');?> </label>
                      <div class="col-sm-10 col-md-8">
                      <select name="group" class="form-control select2">
                        <?php if($user->Title=='Administrator'){ ?>
                        <option selected>Administrator</option>
                        <option>Accountant</option>
                        <option >Clerk</option>
                        <?php }elseif ($user->Title=='Accountant') { ?>
                        <option selected>Accountant</option>
                        <option >Administrator</option>
                        <option >Clerk</option>
                        <?php }elseif ($user->Title=='Clerk'){ ?>
                        <option selected>Clerk</option>
                        <option>Administrator</option>
                        <option>Accountant</option>
                        <?php }else{ ?>
                         <option >Clerk</option>
                        <option>Administrator</option>
                        <option>Accountant</option>
                        <?php } ?>
                       </select>  

                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_status_label', 'status');?> </label>
                      <div class="col-sm-10 col-md-8">
                        <select name="status" class="form-control select2"> 
                          <?php if($user->active==1){ ?>
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option> 
                        <?php }elseif($user->active==0){ ?>
                          <option value="1">Active</option>
                         <option value="0" selected>Inactive</option> 
                       <?php }else{ ?>
                           <option value="1">Active</option>
                         <option value="0" >Inactive</option> 
                      <?php } ?>
                     </select>
                       
                        
                     </div>
                  </div>
                  <div class="col-sm-2 col-md-2 "></div>
                <div class="col-sm-10 col-md-8">
                 <div class="panel panel-warning ">
              
                  <div class="panel-heading">If You need to change the password</div>
                     <div class="panel-body">
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
              </div>
            </div>
          </div>
               
                </div>
                  <?php } ?>      
                
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
                                 <input type="text" name="nid" class="form-control" id="nid" value="<?= set_value('nid',$user->National_id) ?>" />
                          </div>
                      </div>
                        <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_staffno', 'staffno');?> </label>
                          <div class="col-sm-10 col-md-8">
                               <input type="text" name="staff_no" class="form-control" id="staff_no" value="<?= set_value('staff_no', $user->Staff_no) ?>" />
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_pin', 'pin');?> </label>
                          <div class="col-sm-10 col-md-8">
                                <input type="text" name="pin" class="form-control" id="pin" value="<?= set_value('pin', $user->Kra_pin) ?>" />
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_nssf', 'nssf');?> </label>
                          <div class="col-sm-10 col-md-8">
                                 <input type="text" name="nssf_no" class="form-control" id="nssf_no" value="<?= set_value('nssf_no', $user->Nssf_no) ?>" />
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_nhif', 'nhif');?> </label>
                          <div class="col-sm-10 col-md-8">
                                <input type="text" name="nhif_no" class="form-control" id="nhif_no" value="<?= set_value('nhif_no', $user->Nhif_no) ?>" />
                          </div>
                      </div>
                       <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_company_label', 'company');?> </label>
                          <div class="col-sm-10 col-md-8">
                                <input type="text" name="company" class="form-control" id="company" value="<?= set_value('company', $user->company) ?>" />
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_marital', 'marital');?> </label>
                          <div class="col-sm-10 col-md-8">
                            <select name="marital" class="form-control select2">
                              <?php if($user->Marital_status=='single'){ ?>
                                 <option value="single" selected>Single </option>
                                 <option value="married">Married</option>
                                 <option value="divorced">Divorced</option>
                                 <?php }elseif ($user->Marital_status=='married') { ?>
                                  <option value="single" >Single </option>
                                 <option value="married" selected>Married</option>
                                 <option value="divorced">Divorced</option>
                                 <?php }elseif ($user->Marital_status=='divorced') { ?>
                                  <option value="single" >Single </option>
                                 <option value="married">Married</option>
                                 <option value="divorced"  selected>Divorced</option>
                                 <?php }else{ ?>
                                  <option value="single" >Single </option>
                                 <option value="married">Married</option>
                                 <option value="divorced">Divorced</option>
                                 <?php } ?>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_jdate', 'jdate');?> </label>
                          <div class="col-sm-10 col-md-8">
                            <input type="text" name="jdate" class="form-control" id="datepicker" value="<?= set_value('jdate', Date('m/d/Y',strtotime($user->Jdate))) ?>" /> 
                            
                          </div>
                      </div>
                      <script type="text/javascript">
                    $(function() {
                      //load the datepiucker plugin 
                     $( "#datepicker" ).datepicker();
                      });
                       
                    </script>
                       <div class="form-group">
                        <label class="col-sm-2 col-md-2 control-label"><?= lang('create_user_wstatus', 'wstatus');?> </label>
                        <div class="col-sm-10 col-md-8">
                          <select name="wstatus" class="form-control select2">
                              <?php if ($user->Work=='hired') { ?>
                               <option selected>hired</option>
                               <option>fired</option>
                              <?php }elseif ($user->Work=='fired') { ?>
                                <option>hired</option>
                                <option selected>fired</option>
                              <?php } else{?>
                                <option>hired</option>
                                <option>fired</option>
                              <?php } ?>
                          </select>
                          
                       </div>
                  </div>
                   <?php echo form_hidden('id', $user->id);?>
                   <?php echo form_hidden($csrf); ?>
                   <?php if ($this->ion_auth->is_admin()): ?>
                        <div class="form-group form-actions">
                          <div class="col-sm-offset-2 col-sm-10">
                              <?= form_submit('edit_user', lang('edit_user_btn'), 'class="btn btn-primary"'); ?>
                          </div>
                        </div>
                  <?php endif ?>
                  
               </div>
                  
                   <?= form_close(); ?>
                    </div>
                </div>
            </div>

            </div>
            </section>
        </div>
  
