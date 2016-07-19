         <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 
        <!-- Main content -->
     <section class="content">
         <div class="panel panel-primary">
           <div class="panel-heading"><i class="fa fa-money"></i> BILL NO <?php echo $row->bill_no ?> REFUND DETAILS </div>

               <div class="panel-body">
                     <table class="table table-bordered">
                                  <tr>
                                     <td>
                                        <div class="form-group">
                                         <label class="col-sm-6 control-label">Bill No:</label>
                                        <div class="col-sm-3" style="color:#66CC26; font-weight:bold" > <?php echo $row->bill_no ?>
                                        </div>
                                      </div><!--/form-group--> 
                                    </td>
                                    <td>
                                      <div class="form-group">
                                      <label class="col-sm-3 control-label">Status:</label>
                                      <div class="col-sm-6"><?php if($bill->status=="approved"){ ?> <div class="badge bg-green"><?= $row->status ?> <?php }else{ ?><div class="badge bg-red"><?= $row->status ?> <?php } ?> </div>
                                    </div><!--/form-group--> 
                                   </td>
                                    <td>
                                      <div class="form-group">
                                      <label class="col-sm-6 control-label">Patient name:</label>
                                      <div class="col-sm-6"><?php echo $row->patient_name ?> </div>
                                    </div><!--/form-group--> 
                                   </td>
                                 </tr>
                                 <tr>
                                     <td><div class="form-group">
                                      <label class="col-sm-3 control-label">Biller</label>
                                      <div class="col-sm-6"><?php echo $row->requested_by ?></div>
                                    </div><!--/form-group--> 
                                   </td>
                                    <td><div class="form-group">
                                      <label class="col-sm-6 control-label">Date requested</label>
                                      <div class="col-sm-6"><?php echo  date('d/m/Y h:m:i A',strtotime($row->date_requested)); ?> </div>
                                    </div><!--/form-group--> 
                                   </td>
                                   <td> <div class="form-group">
                                      <label class="col-sm-6 control-label">Patient Type:</label>
                                      <div class="col-sm-6"><?php echo $row->patient_type ?> </div>
                                    </div><!--/form-group--> </td>
                                 </tr>
                                  
                                </table>


  <table class="table table-bordered table-condensed  display" style="background-color:#ffffff; border:4px solid #cccccc" >
               <thead module-head>
                  <tr>
                    <th>ITEM</th>
                    <th> QTY</th>
                    <th>BUYING PRICE</th>
                    <th>SUB TOTAL</th>
                  </tr>
                </thead>
               <?php $i= 1;  foreach ($itemdata as $items){ ?>
                  <tr>
              
                     <?php echo form_hidden('total', $row->bill_total); ?>
                    
                     <?php //echo form_hidden('unit', $row->unit); ?>
                      <td><?php echo $items->item_name; ?></td>
                      <td width="30">  <?php echo  $items->qty; ?></td>
                      <td>KES:<?php echo number_format($items->item_cost); ?></td>
                      <td>KES:<?php echo number_format($items->sub_total); ?></td>
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
            
          
</div>
</section>
</div>