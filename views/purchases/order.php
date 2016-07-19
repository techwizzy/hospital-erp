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

              
              <?php echo form_close(); ?>

          <div class="well">
            <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Amount</span>
                  <span class="info-box-number">KES: <?php echo number_format($row->Total_value); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-briefcase"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total paid</span>
                  <span class="info-box-number">KES: <?php echo number_format($row->Amount_paid); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa  fa-envelope"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Balance</span>
                  <span class="info-box-number">KES: <?php echo number_format($row->Balance); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
           </div>
          </div><!-- /.row -->

           <div class="buttons">
             
                <div class="btn-group btn-group-justified">
                    <div class="btn-group"><a href="<?= site_url('purchase/printOrder/'.$row->Order_no) ?>" target="_blank"  class="tip btn btn-primary tip"
                                              title="print"><i class="fa fa-print"></i><span
                                class="hidden-sm hidden-xs">Print </span></a></div>
                 
               
                </div>
            </div>
</div>
</div>
</section>
</div>