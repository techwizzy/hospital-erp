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
                        <h4>Add Supplier</h4>
                </div>
               
                <div class="panel-body">
                   <?= form_open("purchase/record_new_supplier",'class="form-horizontal" id="new-customer"');?>
         <div class="tab-content">
             <div class="tab-pane fade in active" id="tab1default">
             
               <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Supplier name</label>
                      <div class="col-sm-10 col-md-8">
                         <input class="form-control" type="text" id="sname" name="sname" title="The  official name of the supplier"/>
                         <span><?php echo form_error('sname'); ?></span>
                      </div>
                  </div>
               
                                             
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Pin</label>
                      <div class="col-sm-10 col-md-8">
                          <div class="has-feedback">
                                <input class="form-control" type="text" id="pin" name="pin" title="Supplier's Tax/Trade Number" />
                              </i>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Phone</label>
                      <div class="col-sm-10 col-md-8">
                          <div class="has-feedback">
                                   <input class="form-control" type="text" name="phone" title="Mobile Number Of the supplier. 10-12 digits"/>
              
                              </i>
                          </div>
                      </div>
                    </div>
                   <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">Address</label>
                      <div class="col-sm-10 col-md-8">
                     <textarea class="form-control" name="address"  cols="20" rows="5" title="physical address of supplier" ></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-md-2 control-label">supplier since</label>
                      <div class="col-sm-10 col-md-8">
                      <input class="form-control" id="datepicker" type="text" name="sdate" /></div>            
                      </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-2 col-md-2 control-label">Bank name </label>
                      <div class="col-sm-10 col-md-8">
                       <select  class="form-control select2" style="width: 100%;" name="particulars" />
                        <option>none</option>
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
                      <label class="col-sm-2 col-md-2 control-label">Email</label>
                      <div class="col-sm-10 col-md-8">
                        <input class="form-control" type="email" name="email" title="suppliers email" /></div>
                    </div>
                  </div>
                   <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 col-md-2 control-label">Notes</label>
                      <div class="col-sm-10 col-md-8">
                            <textarea class="form-control ckeditor" name="notes" cols="20" rows="5" ></textarea>
                      </div>
                  </div>
                  
                    
        
                        <div class="form-group form-actions">
                          <div class="col-sm-offset-2 col-sm-10">
                              <?= form_submit('add_supplier', 'Add supplier', 'class="btn btn-primary"'); ?>
                          </div>
                        </div>

               </div>
                  
                   <?= form_close(); ?>
                    </div>
                </div>
            </div>
  

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<script type="text/javascript">
$(function() {
 $( "#datepicker3" ).datepicker();
 $( "#datepicker" ).datepicker();
 $( "#datepicker" ).datepicker('setDate', new Date());

 });

</script>