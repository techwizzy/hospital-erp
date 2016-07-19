<!DOCTYPE html>
<html lang="en">
 <head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="">
 <meta name="author" content="">
 <link rel="shortcut icon" href="<?php echo base_url('bootstrap/ico/favicon.ico'); ?>">
 <title><?php echo $this->lang->line('system_name'); ?></title>
 <!-- Bootstrap core CSS -->
  <link data-turbolinks-track="true" href="<?php echo base_url(); ?>theme/css/application-b9abcf044a0bc3e705568d103eddd00e.css" media="all" rel="stylesheet" />
  <script data-turbolinks-track="true" src="<?php echo base_url();?>theme/assets/application-c19ca191fe14a22b6c3ee53ac5b340a6.js"></script>

 </head>
 <body id="signin">
  <div class="bg clear">


    <a href=""  class="logo">
      <img src="<?php echo  base_url('theme/assets/avatars/logo.jpg'); ?>" />
    </a>

    <h3>Welcome back!</h3>
        
    <div class="content">
      <?php echo form_open("auth/login");?>
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

        <div class="fields">
          <strong><?php echo lang('login_identity_label', 'identity');?></strong>
          <input class="form-control" type="text" name="<?php echo lang('login_identity');?>" placeholder="Your username" />
        </div>
        <div class="fields">
          <strong><?php echo lang('login_password_label', 'password');?></strong>
          <input class="form-control" type="password" name="<?php echo lang('login_password');?>" placeholder="Password" />
        </div>
        <div class="info">
          <label>
           <?php echo lang('login_remember_label', 'remember');?>
           <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
          </label>
        </div>
        <div class="actions">
          <button type="submit" class="btn btn-primary btn-lg"><?= lang('login_submit_btn'); ?></button>
        
        </div>
      <?php echo form_close();?>
    </div>

  </div>


</body>
</html>



