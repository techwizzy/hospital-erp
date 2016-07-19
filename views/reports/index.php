
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
                 
                      <div id="dailysales" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                      <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    
    </div><!-- ./wrapper -->

    <!-- page script -->

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
            text: "Stock Value as at <?php echo date('d F, Y') ?>"
        },
        subtitle: {
            text: 'Stock Value'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Stock price',
            data: [
                ['Stock price', <?php echo $stock->stock_price; ?>]
               
               
            ]
        }]
    });

         });
    </script>
    <script>
     $(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'INVENTORY  ITEMS'
        },
        subtitle: {
            text: 'Grouped as inventory and service items'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: ' <b>{point.y:.1f} items</b>'
        },
        series: [{
            name: 'Population',
            data: [
                ['Inventory Items', <?php echo $invent->inventory_no; ?>],
                ['Service Items',<?php echo $service->service_no; ?>]

                   ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
    </script>
  </body>
</html>
