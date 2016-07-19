<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Payslip</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
0716456945        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onload="window.print();">
    <div class="wrapper">
      <!-- Main content -->
<section class="invoice"  style=" max-width:700px; border:2px #cccccc solid">
   <div class="row invoice-info">
         
          <div class="col-sm-4 invoice-col">
       
            <address>
                <strong> COTTOLENGO MISSION HOSPITAL<br/>
                                  P.O. BOX 1426-60200,MERU, KENYA <br/>
                                  cottolengo.chaaria@gmail.com <br/>
                                  <i> "Caritas Christi urgent nos!"</i></strong>
            </address>
          </div><!-- /.col -->
          <div class="col-sm-4 invoice-col">
             <p style="font-weight:bold;">Reference No: <?=  $row->Reference ?> </p>
                           <p style="font-weight:bold;">Supplier Name: <?= $row->Supplier ?> </p>
                       
     
          </div><!-- /.col -->
           <div class="col-sm-4 invoice-col">
      
            <address>
                          <p style="font-weight:bold;">Purchase order No: <?=  $row->Order_no ?></p>

                            <p style="font-weight:bold;">Date created: <?php echo  date('d/m/Y',strtotime($row->Date_created)); ?></p>

                            <p style="font-weight:bold;">Status:  <?= $row->Status; ?> </p>
            </address>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
                
 

        <table class="table table-bordered table-condensed  display" style="background-color:#ffffff; border:1px solid #cccccc" >
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


                </div>

            </div>
        </div>

    </div>

      </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>theme/js/app.min.js"></script>
  </body>
</html>
