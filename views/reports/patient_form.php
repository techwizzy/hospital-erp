 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
   

        <!-- Main content -->
        <section class="content">


             
       
          <!-- Default box -->
          <div class="panel panel-primary">
            <div class="panel-heading with-border">
             GENERATE PATIENT REPORT
          </div>
            <div class="box-body">
              <div class="panel-heading">
                   
                </div>
            
                <div class="panel-body">

                   <?= form_open('report/get_patient_report','class="form-horizontal"');?>
                 
                   <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i> From</span>
                    <input type="text" name="from" class="form-control input-group-lg" id="datepicker">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i> To</span>
                    <input type="text" name="to" class="form-control input-group-lg" id="datepicker3">
                  </div>
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
      
    
  <script type="text/javascript">

   $(document).ready(function () {

   
    $("#search_term").autocomplete({
    source: "<?php echo site_url('payroll/load_staff_detail'); ?>",
    focus: function(event, ui) {
        $("#search_term").val(ui.item.label);
        return false;
    },
    select: function(event, ui) {
        $("#search_term").val(ui.item.label);
        $("#staffid").val(ui.item.id);
        return false;
    }
});

});
        </script>