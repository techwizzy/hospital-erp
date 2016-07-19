<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <div class="col-md-8">  
        <!-- Main content -->
        <section class="content">
<div class="box-header with-border">
             
                
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
          <!-- Default box -->
          <div class="panel panel-primary">
            
           
           
            <div class="panel-heading"><?php echo lang('change_password_heading');?></div>

          <div class="panel-body">
            <?php echo form_open("auth/change_password");?>

                 <div class="form-group">
                        <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
                        <?php echo form_input($old_password);?>
                  </div>
             <div class="form-group">
                        <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
                        <?php echo form_input($new_password);?>
                  </div>

                <div class="form-group">
                        <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
                        <?php echo form_input($new_password_confirm);?>
                  </div>

                  <?php echo form_input($user_id);?>
                  <p><?php echo form_submit('submit', lang('change_password_submit_btn'),'class="btn btn-primary"');?></p>

            <?php echo form_close();?>
           
       </div>
   </div>
</section>
</div>
</div>