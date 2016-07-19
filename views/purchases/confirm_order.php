         <!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
 
        <!-- Main content -->
     <section class="content">
       <?php if( $this->session->flashdata('msg')) { ?>
               <div class="alert alert-success">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <ul class="list-group"><?=  $this->session->flashdata('msg') ?></ul>
                        </div>
             <?php } ?>
         <div class="panel panel-primary">
           <div class="panel-heading"><i class="fa fa-money"></i> BILL NO <?php echo $row->bill_no ?> DETAILS </div>
               <div class="panel-body">
      
        
            
            <table class="table table-bordered">
              <tr>
                 <td>
                    <div class="form-group">
                     <label class="col-sm-2 control-label">Order #:</label>
                    <div class="col-sm-6">
                      <input  type="text" class="form-control"  value="<?php echo $row->Order_no ?>" name="orderno" style="border:none;background-color:#FAFBFA; color:#66CC26; font-weight:bold" readonly />
                    </div>
                  </div><!--/form-group--> 
                </td>
                <td>
                  <div class="form-group">
                  <label class="col-sm-2 control-label">Status:</label>
                  <div class="col-sm-6">
                  
                   <input  type="text" class="form-control" value="<?php echo $row->Status ?>" name="status" style="border:none;background-color:#b8d6a5; color:#419010; font-weight:bold" readonly />
                   
                   </div>
                </div><!--/form-group--> 
               </td>

             </tr>
             <tr>
                 <td><div class="form-group">
                  <label class="col-sm-2 control-label">Supplier</label>
                  <div class="col-sm-10">
                    <input  type="text" class="form-control" value="<?php echo $row->Supplier ?>" name="supplier" style="border:none;background-color:#FAFBFA; color:#66CC26; font-weight:bold" readonly />
                  </div>
                </div><!--/form-group--> 
               </td>
                <td><div class="form-group">
                  <label class="col-sm-2 control-label">Date</label>
                  <div class="col-sm-6">
                    <input  type="text" class="form-control" value="<?php echo  date('d/m/Y',strtotime($row->Date_created)); ?>" name="orderdate" style="border:none;background-color:#FAFBFA; color:#66CC26; font-weight:bold" readonly />
                  </div>
                </div><!--/form-group--> 
               </td>

             </tr>
              
            </table>

        <table class="table table-bordered table-condensed  display" style="background-color:#ffffff; border:4px solid #cccccc" >
               <thead module-head>
                  <tr>
                    <th>PRODUCT</th>
                    <th> QTY</th>
                    <th>BUYING PRICE</th>
                    <th>SUB TOTAL</th>
                  </tr>
                </thead>
               <?php $i= 1;  foreach ($product_data->result() as $items){ ?>
                  <tr>
                     <?php  echo form_open('purchase/add_to_inventory'); ?>
                     <?php echo form_hidden('product', $items->Product); ?>
                     <?php echo form_hidden('code', $items->Order_no); ?>
                     <?php //echo form_hidden('unit', $row->unit); ?>
                      <td><?php echo $items->Product; ?></td>
                      <td width="30">  <?php echo  $items->Qty; ?></td>
                      <td>KES:<?php echo $this->cart->format_number($items->Unit_cost); ?></td>
                      <td>KES:<?php echo $this->cart->format_number($items->Total_Price); ?></td>
                      <?php echo form_close() ?>
                   </tr>
                      <?php $i++; ?>
                    <?php } ?>
                     <tr>
                         <td colspan="2"></td>
                          <?php  foreach ($tprice_data->result() as $t) {} ?>
                          <td ><strong>Total</strong></td>
                          <td ><strong>KES: <?php echo $this->cart->format_number($t->tp); ?></strong></td>
                      </tr>
               </table>

              
        <?php if($row->Status=="pending"){ ?>
       
         <?php if($row->Status=="cancelled" || $row->Status=="processed" ) {}else{ ?>

         <div class="buttons">
             
                <div class="btn-group btn-group-justified">
                    <div class="btn-group"><a href="<?= site_url('purchase/approve_pending_order/'.$row->Order_no) ?>"  class="tip btn btn-success tip"
                                              title="approve"><i class="fa fa-check-circle"></i><span
                                class="hidden-sm hidden-xs">Approve </span></a></div>
                 
                    <div class="btn-group"><a href="<?= site_url('purchase/cancel_pending_order/' .$row->Order_no) ?>"
                                              class="tip btn btn-danger" title="cancel"><i
                                class="fa fa-close"></i> <span class="hidden-sm hidden-xs">reject</span></a>
                    </div>
                                 
                </div>
            </div>
        <?php } ?>
 <?php }else{ ?>

   <div class="well">
      <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">WARNING MESSAGE</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="callout callout-warning">
                   <p align="center"><strong>This purchase order is beyond this stage</strong></p>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
   </div>


 <?php } ?>


</div>
</div>
</section>
</div>