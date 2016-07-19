<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">


  </div>
</div>

 
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.1
        </div>
        <strong>Copyright &copy; 2014-<?php echo date('Y') ?><a href="http://algominetech.co.ke">Agominetech LTD</a>.</strong> All rights reserved.
      </footer>

  </div><!-- ./wrapper -->

  

      <!-- REQUIRED JS SCRIPTS -->
     <script src="<?php echo base_url();?>theme/plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>theme/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>theme/plugins/jQueryUI/jquery-ui.js"></script>
        <script src="<?php echo base_url();?>theme/plugins/select2/select2.full.min.js"></script>
         <script src="<?php echo base_url();?>theme/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url();?>theme/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>theme/js/app.min.js"></script>
    <script src="<?php echo base_url();?>theme/js/custom.js"></script>
    <script src="<?php echo base_url();?>theme/plugins/ckeditor/ckeditor.js"></script>
  
    <script src="<?php echo base_url();?>theme/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>theme/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url();?>theme/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url();?>theme/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url();?>theme/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url();?>theme/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url();?>theme/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url();?>theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url();?>theme/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>theme/plugins/fastclick/fastclick.min.js"></script>
    <script src="<?php echo base_url();?>theme/js/highcharts.js"></script>
    <script src="<?php echo base_url();?>theme/js/exporting.js"></script>
    <script src="<?php echo base_url();?>theme/js/highcharts-3d.js"></script>
<script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
        
       });

 </script>
 <script >
 $(function () {
$(".progress-bar").animate({
    width: "50%"
}, 2000);
$(".progress-bar").animate({
    width: "75%"
}, 4000);
$(".progress-bar").animate({
    width: "100%"
}, 10000);
$(".progress-bar").hide(2000);
$(".data").show(10000);
});
 </script>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>

            <script type="text/javascript">
              $(function() {
               $( "#datepicker3" ).datepicker('setDate', new Date());
               $( "#datepicker" ).datepicker();
               $( "#datepicker" ).datepicker('setDate', new Date());
               $("#datepicker1").datepicker({ dateFormat: 'yy' });
               });

           </script>

  

 </body>
</html>
   