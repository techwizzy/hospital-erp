 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
   

        <!-- Main content -->
        <section class="content">


             
       
          <!-- Default box -->
          <div class="panel panel-primary">
            <div class="panel-heading with-border">
             GENERATE BANK PAYMENT REPORT
          </div>
            <div class="box-body">
              <div class="panel-heading">
                   
                </div>
            
                <div class="panel-body">

                   <?= form_open('payroll/processBankForm','class="form-horizontal"');?>
                   <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                         <select  class="form-control select2" style="width: 100%;" name="bank_name" />
                        <option>select a bank</option>
                        <option>ABC Bank (Kenya)</option>
                        <option> Bank of Africa</option>
                        <option> Bank of Baroda</option>
                         <option>Bank of India</option>
                         <option>Barclays Bank Kenya</option>
                         <option> Capital Sacco</option>
                        <option> Centenary Sacco</option>
                        <option> Centenary Sacco Society Savings</option>

                        <option> CfC Stanbic Holdings</option>
                        <option> Chase Bank Kenya</option>
                        <option> Citibank</option>
                         <option>Commercial Bank of Africa</option>
                        <option> Consolidated Bank of Kenya</option>
                        <option> Cooperative Bank of Kenya</option>
                        <option> Credit Bank</option>
                        <option> Development Bank of Kenya</option>
                       <option>  Diamond Trust Bank</option>
                      <option>   Dubai Bank Kenya</option>
                        <option> Ecobank Kenya</option>
                       <option>  Equatorial Commercial Bank</option>
                        <option> Equity Bank</option>
                        <option> Family Bank</option>
                        <option> Fidelity Commercial Bank Limited</option>
                       <option>  First Community Bank</option>
                       <option>  Giro Commercial Bank</option>
                       <option>  Guaranty Trust Bank Kenya</option>
                       <option>  Guardian Bank</option>
                       <option>  Gulf African Bank</option>
                       <option>  Habib Bank</option>
                       <option>  Habib Bank AG Zurich</option>
                       <option>  Housing Finance Company of Kenya</option>
                      <option>   I&M Bank</option>
                       <option>  Imperial Bank Kenya</option>
                       <option>  Jamii Bora Bank</option>
                       <option>  Kenya Commercial Bank</option>
                       <option>  K-Rep Bank</option>
                       <option>  Middle East Bank Kenya</option>
                        <option> National Bank of Kenya</option>
                        <option> NIC Bank</option>
                        <option> Oriental Commercial Bank</option>
                        <option> Paramount Universal Bank</option>
                        <option> Prime Bank (Kenya)</option>
                       <option>  Standard Chartered Kenya</option>
                        <option> Solution Sacco</option>
                        <option> Trans National Bank Kenya</option>
                        <option> United Bank for Africa </option>
                       <option>  Victoria Commercial Bank  </option>


                   </select>
                      </div>
                    </div>
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