  <?php
      foreach ($chatData as $all_sale) {
            $days[] = date('d', strtotime($all_sale->day));
            $allsales[] = $all_sale->sales;
           
        }
        ?>


<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
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

               <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="box-title">Today Sales</h4>
                  <div class="box-tools pull-right">
                    
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div id="todaysales" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<script>
     $(function () {
    $('#dailysales').highcharts({
        title: {
            text: 'Monthly Sales Analytics',
            x: -20 //center
        },
        subtitle: {
            text: 'Sales  for each day in the current month',
            x: -20
        },
        xAxis: {
            categories:<?= json_encode($days); ?>
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
        }]
    });
});
    </script>



   <script>
    $(document).ready(function () {

           $('#todaysales').highcharts({
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

