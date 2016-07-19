<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->lang->line('system_name'); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
  <link href="<?php echo base_url();?>resources/admin/css/font-awesome.css" rel="stylesheet" type="text/css" />

    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/css/skins/skin-blue.min.css">
     <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/plugins/morris/morris.css">
    <link href="<?php echo base_url();?>theme/plugins/jQueryUI/jquery-ui.css" rel="stylesheet">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/plugins/datepicker/datepicker3.css">
     <link rel="stylesheet" href="<?php echo base_url(); ?>theme/plugins/select2/select2.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/plugins/datatables/dataTables.bootstrap.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>theme/plugins/jQuery/jQuery-2.1.4.min.js"></script>
     

    
  </head>
  <style type="text/css">
.progress.active .progress-bar {
    -webkit-transition: none !important;
    transition: none !important;
}
  </style>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>ALGO</b>HEALTH</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                       
              <!-- User Account Menu -->
               <li class="dropdown user user-menu">
                
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img width="30" alt="1" class="avatar" src="<?php echo base_url('theme/img/avatar6.jpg'); ?>" />
                   <span >
                      <?php echo $this->session->userdata('Firstname'); ?>  <?php echo $this->session->userdata('Lastname'); ?>
                     <i class="fa fa-chevron-down"></i>
                   </span></a>
                  <ul class="dropdown-menu">
                  <li>
                    <a href="<?= site_url('auth/edit_user/'.$user->id) ?>"><i class="fa fa-user"></i> <?= lang('item_profile') ?></a>
                  </li>
                  <li>
                    <a href="<?= site_url('auth/change_password') ?>"><i class="fa fa-key"></i> <?= lang('item_change_pwd') ?></a>
                  </li>
                  <li>
                    <a href="<?= site_url('auth/logout'); ?>"><i class="fa fa-power-off"></i> <?= lang('item_logout') ?></a>
                  </li>
                </ul>
                </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
  
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="active"><a href="<?= site_url('auth/index') ?>"><i class="fa fa-dashboard  "></i> <span>Dashboard</span></a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-list  "></i> <span>Products</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="active"><a  href="<?= site_url('inventory/new_products') ?>">Add product </a></li>
                <li><a href="<?= site_url('inventory/productlist') ?>">Stocked products</a></li>
                 <li><a href="<?= site_url('inventory/allProductList') ?>">All products</a></li>
                <li><a href="<?= site_url('inventory/new_services') ?>">Add service</a></li>
                <li><a href="<?= site_url('inventory/servicelist') ?>">List services</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-money"></i> <span>Sales</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="active"><a  href="<?= site_url('refund/get_patient_bills') ?>">List Sales </a></li>
                <li class="active"><a  href="<?= site_url('refund/show_refund_notifications') ?>">Refund requests </a></li>
                <li class="active"><a  href="<?= site_url('refund/show_refunds') ?>">List Refunds </a></li>
                <li><a href="<?= site_url('report/generate_sales_report') ?>"><i class="fa fa-cog"></i> Sales report</a></li>
                <li><a href="<?= site_url('report/generate_clerks_report') ?>"><i class="fa fa-list"></i> Clerks Sales report</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-truck"></i> <span>Purchases</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="active"><a  href="<?= site_url('purchase/index') ?>">Add purchase </a></li>
                <li><a href="<?= site_url('purchase/all_pending_orders') ?>">list purchases</a></li>

              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-users"></i> <span>People</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="active"><a  href="<?= site_url('auth/create_user') ?>">Add staff </a></li>
                <li><a href="<?= site_url('auth/getUsers') ?>">list staff</a></li>
                 <li class="active"><a  href="<?= site_url('purchase/load_new_supplier') ?>">Add supplier </a></li>
                <li><a href="<?= site_url('purchase/view_suppliers') ?>">List suppliers</a></li>
              </ul>
            </li>
               <li class="treeview">
              <a href="#"><i class="fa fa-flag"></i> <span>Payroll</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="active"><a  href="<?= site_url('payroll/add_salary') ?>">Add salary </a></li>
                <li><a href="<?= site_url('payroll/Salaries') ?>">list Salaries</a></li>
                <li><a href="<?= site_url('payroll/Salaries') ?>">New Payroll posting</a></li>
                <li><a href="<?= site_url('payroll/generate_p10') ?>">Generate P10</a></li>
                 <li><a href="<?= site_url('payroll/generate_p9') ?>">Generate P9</a></li>
                 <li><a href="<?= site_url('payroll/generate_bank_report') ?>">Generate Bank Paylist</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-file-text"></i> <span>Reports</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                
                <li><a href="<?= site_url('report/overview_chart') ?>"><i class="fa fa-list"></i> Drug Stock Chart Report</a></li>
                <li><a href="<?= site_url('report/get_reorder_items') ?>"><i class="fa fa-reply"></i>  Reorder alerts Report</a></li>
                <li><a href="<?= site_url('report/get_products_report') ?>"><i class="fa fa-barcode"></i> Products Report</a></li>
                <li ><a  href="<?= site_url('report/get_categories_report') ?>"><i class="fa fa-qrcode"></i> Categories Report</a></li>
                <li><a href="<?= site_url('report/get_daily_sales_report') ?>"> <i class="fa fa-money"></i>  Daily Sales</a></li>
                <li><a href="<?= site_url('report/get_monthly_sales_report') ?>"><i class="fa fa-calendar"></i> Mothly sales</a></li>
                
                <li><a href="<?= site_url('report/generate_purchase_report') ?>"><i class="fa fa-reply"></i>Purchases Report</a></li>
                <li><a href="<?= site_url('report/get_suppliers_report') ?>"><i class="fa fa-truck"></i><span>Suppliers Report</span></a></li>
                <li><a href="<?= site_url('report/get_staff_report') ?>"><i class="fa fa-users"></i><span>Staff Report</span></a></li>
                <li><a href="<?= site_url('report/get_diagnostic_report') ?>"><i class="fa fa-heart"></i><span>Diagnostic Report </span></a></li>
             
                <li><a href="<?= site_url('report/generate_patient_report') ?>"><i class="fa fa-stethoscope"></i><span>Patients Report</span></a></li>
                <li><a href="<?= site_url('report/get_payslip_report') ?>"><i class="fa fa-file-o"></i><span>Payslips Report</span></a></li>
               
                <li><a href="<?= site_url('report/generate_statutory_report') ?>"><i class="fa fa-file-o"></i><span>Statutory Report</a></span></li>
                 <li><a href="<?= site_url('report/get_gratuity_report') ?>"><i class="fa fa-file-o"></i><span>Gratuity Report</a></span></li>
                <li><a href="<?= site_url('report/generate_insurance_report') ?>"><i class="fa fa-medkit"></i><span>Insurance Report</a></span></li>
                <li><a href="<?= site_url('report/get_salaries_report') ?>"><i class="fa fa-file-o"></i><span>Salaries Report</span></a></li>
                <li><a href="<?= site_url('report/generate_deduction_report') ?>"><i class="fa fa-file-o"></i><span>Deduction Report</span></a></li>
                <li><a href="<?= site_url('report/generate_loans_report') ?>"><i class="fa fa-file-o"></i><span>Loans & Savings Report</span></a></li>
              </ul>
           </li>
          
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>































    