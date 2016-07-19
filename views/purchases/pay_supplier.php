<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <div class="col-md-8">  
        <!-- Main content -->
        <section class="content">
         <div class="panel panel-primary">
           <div class="panel-heading"><i class="fa fa-money"></i>Add Payment</div>

               <div class="panel-body">
<?php if(($row->Total_value)-($row->Amount_paid)==0){ ?>
                     <div class="well">
                                    <div class="box box-solid">
                                              <div class="box-header with-border">
                                                <h3 class="box-title">WARNING MESSAGE</h3>
                                              </div><!-- /.box-header -->
                                              <div class="box-body">
                                                  <div class="callout callout-danger">
                                                 <p align="center"><strong>You do not have any outstanding balances on this order</strong></p>
                                                </div>
                                              </div><!-- /.box-body -->
                                            </div><!-- /.box -->
                                 </div>



<?php } else{ ?>
 <?php echo form_open('purchase/update_order', array('class' => 'form-horizontal group-border-dashed','enctype' => 'multipart/form-data','id'=>'contact-form')); ?>
   <?php echo validation_errors(); ?>
   <div class="row">
     <div class="col-md-6">
            <div class="form-group">
                  <label class="col-sm-2 control-label">Supplier:</label>
                  <div class="col-sm-10">
                          <input  type="text" class="form-control" value="<?php echo $row->Supplier ?>" name="supplier"  readonly />
                
                  </div>
                </div>
       </div>
     <div class="col-md-6">
         <label class="col-sm-6 control-label">Order No:</label>
                  <div class="col-sm-6">
                 <input  type="text" class="form-control"  value="<?php echo $row->Order_no ?>" name="orderno" readonly />
                
                  </div>

     </div>
  </div>
  <div class="row">
     <div class="col-md-6">
            <div class="form-group">
                  <label class="col-sm-2 control-label"> Date:</label>
                  <div class="col-sm-10">
                   <input  type="text" id="datepicker" class="form-control"  name="paydate" />
                
                  </div>
                </div>
       </div>
     <div class="col-md-6">
         <label class="col-sm-6 control-label">Reference No:</label>
                  <div class="col-sm-6">
                  <input  type="text"  class="form-control" id="ref"  name="ref_no" /><span style="color:red"><?php echo form_error('refno'); ?></span>
                
                  </div>

     </div>
  </div>
<div class="well">
 <div class="row">
  
     <div class="col-md-6">
                 <div class="form-group">
                  <label class="col-sm-2 control-label">Amount:</label>
                  <div class="col-sm-6">
                  <input  type="text"  value=" <?php echo ($row->Total_value-$row->Amount_paid); ?>" class="form-control"  name="amount" />
                
                  </div>
                </div>

     </div>
     <div class="col-md-6">
     <div class="form-group">
                  <label class="col-sm-6 control-label">Pay with :</label>
                  <div id="field" class="col-sm-6">
                   <select name="mode" class="form-control" id="pay">
                  <option id="cash" value="Cash"  ><small>Cash</small></option>
                  <option id="bank" value="Bank"  ><small>Bank</small></option>
                   
                </select>
              </div>
                </div><!--/form-group--> 
        </div>
    </div>
          
        <div class="row">
                 <div id="chequedata" class="form-group" style="display:none">
                  <label class="col-sm-2 control-label">Cheque No:</label>
                  <div class="col-sm-6">
                  <input  type="text"  class="form-control" id="cheque"  name="refno" /><span style="color:red"><?php echo form_error('refno'); ?></span>
                
                  </div>
                </div>
      </div>
   </div>   
    <div class="row">
      
               
                <div class="form-group">
                  <label class="col-sm-2 control-label"> Notes:</label>
                  <div class="col-sm-6">
                    <textarea name="description" class="form-control"></textarea>
                  </div>
                </div><!--/form-group--> 
       
      </div>
   <div class="row">
      <div class="col-md-6">
              <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Add payment</button>
                  
                  </div>
                </div><!--/form-group--> 
         </div>
                  
       </div>

        
                   <input  type="hidden"  value=" <?php echo $row->Total_value; ?>" class="form-control"  name="initial" />
                
               
                   <input  type="hidden"  value=" <?php echo ($row->Amount_paid); ?>" class="form-control"  name="paid" />
                
     <?php echo form_close(); ?>
             
<?php } ?>
</div>
</div>
</div>
</section>
</div>

<script type="text/javascript">
$(function() {
 $( "#datepicker3" ).datepicker();
 $( "#datepicker" ).datepicker();
 $( "#datepicker" ).datepicker('setDate', new Date());

 });


</script>
<script>

$(document).ready(function() {
   $("#pay").change(function() {
      $("#chequedata")[$(this).val() == "Bank" ? 'show' : 'hide']("fast")
  }).change();
});
</script> 

