<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Hotel Management System | Login</title>
	<link rel="shortcut icon" type="image/png" href="http://eg.com/favicon.png"/>
    <link rel="stylesheet" href="<?php echo base_url();?>asset/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	
  
  </head>
  <body class="hold-transition login-page" style="background-color:#3c8dbc">
    <div class="login-box">
      
      <div class="login-box-body" style=" padding:30px !important">
       <div id="myTabContent" class="tab-content">
       <!-- <ul class="nav nav-tabs">
            <li class="active"><a href="#loginadmin" data-toggle="tab" id="tab1">Admin Login</a></li>
            <li><a href="#loginrecept" data-toggle="tab" id="tab2">Receptionalist Login</a></li> 
      </ul> --> 
      <div id="loginadmin" class="active in">
        <h3 class="login-box-msg" style="text-decoration:underline; padding: 10px 20px 20px 20px !important;">Login</h3>
        
        <form method="post" action="<?php echo base_url().'index.php/MainProcess/user_login'; ?>">
        <?php
			if(isset($error))
			{
		?>
		<div class="form-group has-feedback" align="center">
            <span class="alert-danger">  <?php echo $error; ?>     </span>
            <br />
            
         </div>
        		
        <?php } ?>
        
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" style="padding: 20px 12px !important;" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="username" placeholder="Password" style="padding: 20px 12px !important;" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
             
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" style="margin-top: 20px;">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>
        </div> <!-- ADMIN LOGIN -->
       
        <div id="loginrecept" class="tab-pane fade">
        <h3 class="login-box-msg" style="text-decoration:underline; padding: 10px 20px 20px 20px !important;">Receptionist  Login</h3>
        
        <form method="post" action="<?php echo base_url().'index.php/MainProcess/recept_login'; ?>">
        <?php
      if(isset($error))
      {
    ?>
    <div class="form-group has-feedback" align="center">
            <span class="alert-danger">  <?php echo $error; ?>     </span>
            <br />
            
         </div>
            
        <?php } ?>
        
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" style="padding: 20px 12px !important;" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="username" placeholder="Password" style="padding: 20px 12px !important;" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
             
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" style="margin-top: 20px;">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>
        </div> <!-- Receptionalist LOGIN -->
        </div>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

     <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>asset/bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url();?>asset/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url();?>asset/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url();?>asset/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url();?>asset/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url();?>asset/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?php echo base_url();?>asset/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url();?>asset/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url();?>asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url();?>asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>asset/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>asset/dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url();?>asset/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url();?>asset/dist/js/demo.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
      $('#tab2').click(function() {        
        $('#loginadmin').hide();
        $('#loginrecept').show();
      })
       $('#tab1').click(function() {       
        $('#loginadmin').show();
        $('#loginrecept').hide();
      })
    </script>
  </body>
</html>
