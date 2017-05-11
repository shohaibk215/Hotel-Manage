<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hotel Management | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/iCheck/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/daterangepicker/daterangepicker-bs3.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/style.css">
        <style>.form-control { width:50%;  }</style>
        <script type="text/javascript">
            var base_url="<?php echo base_url();?>";
            var CurrentDate="<?php echo Date('Y-m-d');?>";
            var NextDay="<?php echo date('Y-m-d', strtotime("+1 days"));?>";
            // alert(NextDay);
        </script>

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo base_url() . 'index.php/MainProcess/dashboard' ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>HT</b>S</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Hotel</b>System</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">


                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                                    <img src="<?php echo base_url(); ?>asset/action_icons/uesrss.png" class="user-image" alt="User Image">


                                    <span class="hidden-xs"><?php echo "Welcome " . $this->session->userdata['admin_logged_in']['admin_name']; ?></span>

                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo base_url(); ?>asset//action_icons/uesrss.png" class="img-circle" alt="User Image">

                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div align="center">
                                            <a href="<?php echo base_url() . 'index.php/MainProcess/admin_profile'; ?>" class="btn btn-sm btn-primary btn-flat">Profile</a>
                                            <!--</div>
                                   <div>-->
                                            <a href="<?php echo base_url() . 'index.php/MainProcess/change_password'; ?>" class="btn btn-sm btn-primary btn-flat">Change Password</a>
                                            <!--</div>
                                            <div>-->
                                            <a href="<?php echo base_url() . 'index.php/MainProcess/logout'; ?>" class="btn btn-sm btn-primary btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url(); ?>asset/action_icons/uesrss.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>Hotel Management</p>

                        </div>
                    </div>
                    <!-- search form -->

                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header"><a href="<?php echo base_url() . 'index.php/MainProcess/dashboard'; ?>" style="font-size:16px"><span>Dashboard</span></a></li>

                        <?php if(isset($this->session->userdata['admin_logged_in']['role']) && ($this->session->userdata['admin_logged_in']['role']=='admin')) { ?>

                            <li class="treeview users">

                                <a href="#">
                                    <i class="fa fa-laptop"></i>
                                    <span>User Management</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">           
                                    <li><a href="<?php echo base_url() . 'index.php/UserProcess/users'; ?>"><i class="fa fa-circle-o"></i>Manage Users</a></li>
                                    <li><a href="<?php echo base_url() . 'index.php/UserProcess/roles'; ?>"><i class="fa fa-circle-o"></i>Manage Roles</a></li>                 
                                </ul>

                            </li>

                            <li class="treeview rooms">
                                <a href="#">
                                    <i class="fa fa-laptop"></i>
                                    <span>Room Management</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">           
                                    <li><a href="<?php echo base_url() . 'index.php/RoomProcess/rooms'; ?>"><i class="fa fa-circle-o"></i>Manage Rooms</a></li>
                                    <li><a href="<?php echo base_url() . 'index.php/RoomProcess/room_categories'; ?>"><i class="fa fa-circle-o"></i>Manage Room Categories</a></li>                 
                                </ul>

                            </li>

                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-edit"></i> <span>Manage Restaurent Items</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo base_url() . 'index.php/FoodProcess/foods'; ?>"><i class="fa fa-circle-o"></i>Manage Food Items</a></li>

                                </ul>
                            </li>

                            <li class="treeview">
                                <a href="<?php echo base_url() . 'index.php/OrderProcess/all_transactions'; ?>">
                                    <i class="fa fa-edit"></i> <span>All Transactions</span>                
                                </a>              
                            </li>


                            <li class="treeview">
                                <a href="<?php echo base_url() . 'index.php/#'; ?>">
                                    <i class="fa fa-edit"></i> <span>Sales Report</span>                
                                </a>              
                            </li>

                        <?php } else { ?>

                            <li class="treeview adminres">
                                <a href="#">
                                    <i class="fa fa-edit"></i> <span>Booking & Reservation</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo base_url() . 'index.php/BookReserve/reservation'; ?>"><i class="fa fa-circle-o"></i>Walk in / Reservation</a></li>

                                    <li><a href="#"><i class="fa fa-circle-o"></i>Booking Calendar</a></li>

                                </ul>
                            </li>


                                 <li class="treeview checkout">
                                <a href="<?php echo base_url() . 'index.php/BookReserve/checkin'; ?>">
                                    <i class="fa fa-edit"></i> <span>Arrival / CheckIn Guests</span>                
                                </a>              
                            </li>
                            
                            <li class="treeview checkout">
                                <a href="<?php echo base_url() . 'index.php/BookReserve/checkout'; ?>">
                                    <i class="fa fa-edit"></i> <span>Departure / Checkout Guests</span>                
                                </a>              
                            </li>    

                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-edit"></i> <span>Restaurent</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo base_url() . 'index.php/OrderProcess/orders'; ?>"><i class="fa fa-circle-o"></i>Manage Orders</a></li>       
                                    <li><a href="<?php echo base_url() . 'index.php/OrderProcess/allorders'; ?>"><i class="fa fa-circle-o"></i>All Orders</a></li>
                                </ul>
                            </li>





                            <!--<li class="treeview checkout">
                             <a href="<?php echo base_url() . 'index.php/BookReserve/checkout'; ?>">
                               <i class="fa fa-edit"></i> <span>Departure/Checkout Guests</span>                
                             </a></li>-->




                            
                        <?php } ?>      


                        <li><a href="<?php echo base_url() . 'index.php/MainProcess/logout'; ?>" style="font-size:16px;text-decoration: underline;"><span>Sign Out</span></a></li>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>



            <div class="control-sidebar-bg"></div>


            <!-- jQuery 2.1.4 -->
            <script src="<?php echo base_url(); ?>asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
            <!-- jQuery UI 1.11.4 -->
            <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
            <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
            <script>
                $.widget.bridge('uibutton', $.ui.button);
            </script>
            <!-- Bootstrap 3.3.5 -->
            <script src="<?php echo base_url(); ?>asset/bootstrap/js/bootstrap.min.js"></script>
            
            <script src="<?php echo base_url(); ?>asset/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
            <script src="<?php echo base_url(); ?>asset/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
            <!-- jQuery Knob Chart -->
            <script src="<?php echo base_url(); ?>asset/plugins/knob/jquery.knob.js"></script>
            <!-- daterangepicker -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
            <script src="<?php echo base_url(); ?>asset/plugins/daterangepicker/daterangepicker.js"></script>
                        
            <!-- Bootstrap WYSIHTML5 -->
            <!-- <script src="<?php //echo base_url(); ?>asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
            <!-- Slimscroll -->
            <script src="<?php echo base_url(); ?>asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
            <!-- FastClick -->
            <script src="<?php echo base_url(); ?>asset/plugins/fastclick/fastclick.min.js"></script>
            <!-- AdminLTE App -->
            <script src="<?php echo base_url(); ?>asset/dist/js/app.min.js"></script>
            <!-- AdminLTE dashboard demo (This is only for demo purposes) 
            <script src="<?php echo base_url(); ?>asset/dist/js/pages/dashboard.js"></script>-->
            <!-- AdminLTE for demo purposes -->
            <script src="<?php echo base_url(); ?>asset/dist/js/demo.js"></script>

