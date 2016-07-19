       <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 
        <!-- Main content -->
     <section class="content">
         <div class="panel panel-primary">
           <div class="panel-heading"><i class="fa fa-money"></i> BILL NO <?php echo $row->bill_no ?> DETAILS </div>

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
                                      <div class="col-sm-6"><?php if($row->status=="paid"){ ?> <div class="badge bg-green"><?= $row->status ?> <?php }else{ ?><div class="badge bg-red"><?= $sale->row ?> <?php } ?> </div>
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
                                      <div class="col-sm-6"><?php echo $row->username ?></div>
                                    </div><!--/form-group--> 
                                   </td>
                                    <td><div class="form-group">
                                      <label class="col-sm-8 control-label">Last Payment date</label>
                                      <div class="col-sm-4"><?php echo  date('d/m/Y',strtotime($row->date_paid)); ?> </div>
                                    </div><!--/form-group--> 
                                   </td>
                                   <td> <div class="form-group">
                                      <label class="col-sm-6 control-label">Patient Type:</label>
                                      <div class="col-sm-6"><?php echo $row->patient_type ?> </div>
                                    </div><!--/form-group--> </td>
                                 </tr>
                                  
                                </table>

            
          <div class="well">
            <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total bill</span>
                  <span class="info-box-number">KES: <?php echo number_format($bill->bill_total); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-briefcase"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total paid</span>
                  <span class="info-box-number">KES: <?php echo number_format($bill->amount_paid); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-balance-scale"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Balance</span>
                  <span class="info-box-number">KES: <?php echo number_format($bill->balance); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
           </div>
          </div><!-- /.row -->
                <h4 align="center">PAYMENT SUMMARY</h4>
                <table class="table table-bordered table-condensed  display" style="background-color:#ffffff; border:4px solid #cccccc" >
               <thead module-head>
                  <tr>
                    <th>Date paid</th>
                    <th>Reference</th>
                    <th>Amount paid</th>
                    <th>Paid by</th>
                    <th>Billed by</th>
                  </tr>
                </thead>
               <?php $i= 1;  foreach ($pay as $items){ ?>
                  <tr>
                     <td><?php echo date('d/m/Y',strtotime($items->date_paid)); ?></td>
                      <td> Bill no: <?php echo  $items->bill_no; ?></td>
                      <td>KES:<?php echo number_format($items->amount_paid); ?></td>
                      <td>KES:<?php echo $items->payment_method; ?></td>
                      <td><?php echo  $items->username; ?></td>
                      <?php echo form_close() ?>
                   </tr>
                      <?php $i++; ?>
                    <?php } ?>
                    
               </table>

</div>
</div>
</section>
</div>