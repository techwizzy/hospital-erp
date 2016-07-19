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
             GENERATE KRA P10 FORM
          </div>
            <div class="box-body">
              <div class="panel-heading">
                   
                </div>
            
                <div class="panel-body">
                   <?= form_open('payroll/processP10Request','class="form-horizontal"');?>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" name="value1" class="form-control input-group-lg" id="datepicker1">
                  </div>
                  <br>
                  <div class="input-group">
                    <input type="submit" class="btn btn-large btn-primary" value="Generate">
                  
                  </div>
                  <?= form_close(); ?>
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