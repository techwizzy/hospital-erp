                   <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 
        <!-- Main content -->
     <section class="content">
         <div class="panel panel-primary">
           <div class="panel-heading"><i class="fa fa-money"></i>PURCHASE ORDER NO <?php echo $row->Order_no ?> DETAILS </div>

               <div class="panel-body">
                 <div class="well well-sm">
                                  <div class="col-xs-4 border-right">

                                      <div class="col-xs-2"><i class="fa fa-3x fa-building padding010 text-muted"></i></div>
                                      <div class="col-xs-10">
                                          <address><strong>COTTOLENGO MISSION HOSPITAL<br/>
                                                P.O. BOX 1426-60200,MERU, KENYA <br/>
                                                cottolengo.chaaria@gmail.com
                                                <i> "Caritas Christi urgent nos!"</i> <strong></address>
                                      </div>
                                      <div class="clearfix"></div>

                                  </div>
                                  <div class="col-xs-4">

                                      <div class="col-xs-2"><i class="fa fa-3x fa-user padding010 text-muted"></i></div>
                                      <div class="col-xs-10">
                                         
                                         <p style="font-weight:bold;">Reference No: <?=  $row->Reference ?> </p>
                                         <p style="font-weight:bold;">Supplier Name: <?= $row->Supplier ?> </p>
                                     
                   

                                      </div>
                        <div class="clearfix"></div>
                 
                    </div>
                    <div class="col-xs-4 border-left">

                        <div class="col-xs-2"><i class="fa fa-3x fa-file-text-o padding010 text-muted"></i></div>
                        <div class="col-xs-10">
                            <p style="font-weight:bold;">Purchase order No: <?=  $row->Order_no ?></p>

                            <p style="font-weight:bold;">Date created: <?php echo  date('d/m/Y',strtotime($row->Date_created)); ?></p>

                            <p style="font-weight:bold;">Status:  <?= $row->Status; ?> </p>
                        </div>
                       
                        <div class="clearfix"></div>


                    </div>
                    <div class="clearfix"></div>
                </div>
           
<?php if($row->Status=="processed") {?>

          <table class="table table-bordered table-condensed  display" >
                                      <thead module-head>
                                              <tr>
                                                  <th> PRODUCT</th>
                                                  <th> QTY</th>
                                                  <th>BUYING PRICE</th>
                                                 <th>Additional Notes:</th>
                                                <th>ADD TO INVENTORY</th>
                                              </tr>
                                          </thead>
                                            <?php $i= 1;  foreach ($pData->result() as $items){ ?>
                                            <?php if($items->Received < $items->Qty ){?>
                                            <tr>
                                             <?php  echo form_open('inventory/add_to_invent'); ?>
                                             <?php echo form_hidden('value', ($items->Unit_cost * $items->q)); ?>
                                             <?php echo form_hidden('product', $items->Product); ?>
                                             <?php echo form_hidden('code', $items->Order_no); ?>
                                             <?php //echo form_hidden('unit', $row->unit); ?>
                                            <td><?php echo $items->Product; ?></td>
                                            
                                         <td width="30">  <?php echo form_input(array('name' => 'updateQty', 'value' => $items->q, 'maxlength="5" size="5" style="width:100px"')); ?></td>
                                                                                
                                            <td>KES:<?php echo $this->cart->format_number($items->Unit_cost); ?></td>
                                            <td>     <textarea name="description" class="form-control"></textarea> </td>
                                            <td><button type="submit" class="btn btn-success btn-xs"><i class="fa fa-check-circle-o"></i>add </button></td>
                                            <?php echo form_close() ?>
                                         
                                          </tr>
                                          <?php }else{} ?>
                                             <?php $i++; ?>
                                           <?php } ?>
                                          
                                        </table>
                            

                           <?php }elseif($row->Status=="received") {?>

                                 <div class="well">
                                    <div class="box box-solid">
                                              <div class="box-header with-border">
                                                <h3 class="box-title">STATUS MESSAGE</h3>
                                              </div><!-- /.box-header -->
                                              <div class="box-body">
                                                  <div class="callout callout-success">
                                                 <p align="center"><strong>All Items under these purchase order have been received</strong></p>
                                                </div>
                                              </div><!-- /.box-body -->
                                            </div><!-- /.box -->
                                 </div>

                              <?php  }else{?>
                            <div class="well">
                                    <div class="box box-solid">
                                              <div class="box-header with-border">
                                                <h3 class="box-title">WARNING MESSAGE</h3>
                                              </div><!-- /.box-header -->
                                              <div class="box-body">
                                                  <div class="callout callout-danger">
                                                 <p align="center"><strong>This action is not possible on this order at the moment</strong></p>
                                                </div>
                                              </div><!-- /.box-body -->
                                            </div><!-- /.box -->
                                 </div>
                               <?php } ?>
                    </div>
</div>
</section>
</div>