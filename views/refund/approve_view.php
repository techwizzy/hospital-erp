              <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 
        <!-- Main content -->
     <section class="content">
         <div class="panel panel-primary">
           <div class="panel-heading"><i class="fa fa-money"></i> BILL NO <?php echo $row->bill_no ?> REFUND DETAILS </div>  
          <div class="panel-body">
        <?php echo form_open('refund/approve_refund_request', array('class' => 'form-horizontal group-border-dashed','enctype' => 'multipart/form-data','id'=>'contact-form')); ?>
        
                
              <table class="table table-bordered">
              <tr>
                 <td>
                    <div class="form-group">
                     <label class="col-sm-4 control-label">Refund #:</label>
                    <div class="col-sm-6">
                      <input name="id" type="text" class="form-control"  value="<?php echo $row->refund_id ?>" name="id" style="border:none;background-color:#FAFBFA; color:#66CC26; font-weight:bold" readonly />
                    </div>
                  </div><!--/form-group--> 
                </td>
                   <td>
                    <div class="form-group">
                     <label class="col-sm-4 control-label">Bill #:</label>
                    <div class="col-sm-6">
                      <input  type="text" class="form-control"  value="<?php echo $row->bill_no ?>" name="bill_no" style="border:none;background-color:#FAFBFA; color:#66CC26; font-weight:bold" readonly />
                    </div>
                  </div><!--/form-group--> 
                </td>
                <td>
                  <div class="form-group">
                  <label class="col-sm-4 control-label">file no:</label>
                  <div class="col-sm-6">
                   <input  type="text" class="form-control" value="<?php echo $row->file_no ?>" name="file_no" style="border:none;background-color:#F9E9EB; color:#f03b52; font-weight:bold" readonly />
                                   </div>
                </div><!--/form-group--> 
               </td>

             </tr>
             <tr>
                 <td><div class="form-group">
                  <label class="col-sm-6 control-label">Patient name</label>
                  <div class="col-sm-6">
                    <input  type="text" class="form-control" value="<?php echo $row->patient_name ?>" name="patient_name" style="border:none;background-color:#FAFBFA; color:#66CC26; font-weight:bold" readonly />
                  </div>
                </div><!--/form-group--> 
               </td>
                <td><div class="form-group">
                  <label class="col-sm-6 control-label">Patient type</label>
                  <div class="col-sm-6">
                    <input  type="text" class="form-control" value="<?php echo $row->patient_type ?>" name="patient_type" style="border:none;background-color:#FAFBFA; color:#66CC26; font-weight:bold" readonly />
                  </div>
                </div><!--/form-group--> 
               </td>
                 <td><div class="form-group">
                  <label class="col-sm-6 control-label">Requested by</label>
                  <div class="col-sm-6">
                    <input  type="text" class="form-control" value="<?php echo $row->requested_by ?>" name="requested_by" style="border:none;background-color:#FAFBFA; color:#66CC26; font-weight:bold" readonly />
                  </div>
                </div><!--/form-group--> 
               </td>
                <td><div class="form-group">
                  <label class="col-sm-6 control-label">Date requested</label>
                  <div class="col-sm-6">
                    <input  type="text" class="form-control" value="<?php echo  date('d/m/Y',strtotime($row->date_requested)); ?>" name="date_requested" style="border:none;background-color:#FAFBFA; color:#66CC26; font-weight:bold" readonly />
                  </div>
                </div><!--/form-group--> 
               </td>

             </tr>
              
            </table>


               <?php if($message) { ?>
               <div class="alert alert-success">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <ul class="list-group"><?=  $message; ?></ul>
                        </div>
             <?php } ?>

        <table class="table table-bordered table-condensed  display" style="background-color:#ffffff; border:4px solid #cccccc" >
               <thead module-head>
                  <tr>
                    <th>Item code</th>
                    <th>Item name</th>
                    <th>item cost</th>
                    <th>Qty </th>
                    <th>Sub total</th>
                    <th>Action</th>
                  </tr>
                </thead>
               <?php $i= 1;  foreach ($itemdata as $items){ ?>
                  <tr>
              
                     <?php //echo form_hidden('total', $row->bill_total); ?>
                    
                     <?php //echo form_hidden('unit', $row->unit); ?>
                      <td><input type="text" class="form-control" name="item_code" value="<?php echo $items->item_code; ?>" ></td>
                      <td><input type="text" name="item_name" class="form-control" value="<?php echo $items->item_name; ?>" ></td>
                      <td><input type="text" class="form-control" name="qty"  value="<?php echo  $items->qty; ?>" ></td>
                      <td><input type="text" name="item_cost" class="form-control" value="<?php echo $items->item_cost; ?>" ></td>
                      <td><input type="text" name="item_cost" class="form-control" value="<?php echo $items->sub_total; ?>" ></td>
                      <td><?php if($items->status=="approved") { }else{?> <button type="submit" class="btn btn-primary">Approve</button> <?php } ?></td>
                      <?php echo form_close() ?>
                   </tr>
                      <?php $i++; ?>
                    <?php } ?>
                     <tr>
                         <td colspan="2"></td>
                        
                          <td ><strong>Total</strong></td>
                          <td ><strong>KES: <?php echo number_format($row->refund_amount); ?></strong></td>
                      </tr>
               </table>

              <?php echo form_open('refund/close_request'); ?>
               
              <?php echo form_hidden('id', $row->refund_id); ?>
              <?php //echo form_hidden('approved_by', $row->approved_by); ?>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary"> Finish</button>
                    
                  </div>
                </div><!--/form-group--> 

              <?php echo form_close(); ?>
            </div>
          </div>
        </section>
      </div>