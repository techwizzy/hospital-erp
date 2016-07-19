      <?php
      foreach ($chatData as $all_sale) {
            $months[] = date('M-Y', strtotime($all_sale->month));
            $allsales[] = $all_sale->sales;
           
        }
         foreach ($InpatientchatData as $month_sale) {
            //$months[] = date('M-Y', strtotime($month_sale->month));
            $msales[] = $month_sale->sales;
           
        }
        foreach ($OutPatientchatData as $outp_sale) {
            //$months[] = date('M-Y', strtotime($outp_sale->month));
            $outmsales[] = $outp_sale->sales;
           
        }
        foreach ($ClinicPatientchatData as $clinicp_sale) {
            $clinicpsales[] = $clinicp_sale->sales;
           
        }
      ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
 

                         
                         
        <!-- Main content -->
        <section class="content">
          <?php if($message) { ?>
          <div class="callout callout-success">
             <p><b><?=  $message; ?></p>
          </div>
          <?php } ?>
          <div class="row">
            <div class="col-md-12">
             
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4><i class="fa fa-bar-chart"></i></h4>
                   
                </div>
                <div class="box-body chart-responsive">
                  
                      <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
        

            <div class="col-md-12">
              <!-- DONUT CHART -->
              
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="box-title">Daily Sales</h4>
                  <div class="box-tools pull-right">
                    
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div id="dailysales" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col (LEFT) -->
           
             <div class="col-md-12">
                <!-- LINE CHART -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="box-title">Quick Links</h4>
                  
                </div>
                <div class="box-body ">
                 
          <div class="row">
            <div class="col-md-3">
              <div class="info-box">
                <a href="<?= site_url('auth/getUsers') ?>">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                <span class="info-box-text">users</span>
                 </a>
    
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3">
                 <a href="<?= site_url('inventory/productlist') ?>">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-barcode"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Products</span>
                  
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?= site_url('payroll/Salaries') ?>">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Payroll</span>
                  
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?= site_url('purchase/all_pending_orders') ?>">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-truck"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Purchases</span>
                
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </a>
            </div><!-- /.col -->
          </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (RIGHT) -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    
    </div><!-- ./wrapper -->

    <!-- page script -->
    <script>
     $(function () {
    $('#container').highcharts({
        title: {
            text: 'Monthly Sales Analytics',
            x: -20 //center
        },
        subtitle: {
            text: 'Sales from clinic, outpatient and Inpatient',
            x: -20
        },
        xAxis: {
            categories:<?= json_encode($months); ?>
        },
        yAxis: {
            title: {
                text: 'KES'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valuePrefix: 'KES:'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [
        {
            name: 'All',
            data: [<?php
                    echo implode(',', $allsales);
                    ?>]
        },{
            name: 'Inpatient',
            data: [<?php
                    echo implode(',', $msales);
                    ?>]
        },
        {
            name: 'Outpatient',
            data: [<?php
                    echo implode(',', $outmsales);
                    ?>]
        },
        {
            name: 'Clinic',
            data: [<?php
                    echo implode(',', $clinicpsales);
                    ?>]
        }]
    });
});
    </script>
    <script>
    $(document).ready(function () {

           $('#dailysales').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: "Sales For <?php echo date('d F, Y') ?>"
        },
        subtitle: {
            text: 'totals for {Inpatient,Outpatient,clinic}'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Sales',
            data: [
                ['Inpatient', <?php echo $Idata->total_amount; ?>],
                ['Outpatient',<?php echo $Odata->total_amount; ?>],
                ['Clinic', <?php echo $Cdata->total_amount; ?>]
               
               
            ]
        }]
    });

         });
    </script>
   
  </body>
</html>
