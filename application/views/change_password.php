 <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Change Password

          </h1>

          <ol class="breadcrumb">

            <li><a href="<?php echo base_url().'index.php/MainProcess/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Change Password</li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

         <div class="box box-info">

                <div class="box-header with-border">

                  <h3 class="box-title">Change Password</h3>

                </div><!-- /.box-header -->

                <!-- form start -->

                <form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/MainProcess/change_pwd'; ?>">

                  

                    <div class="box-body">

        			

                    <?php

						if(isset($error))

						{

					?>

							

        					<h5 style ="text-align:center"><span class="bg-red"><?php echo $error; ?></span></h5>

							

        			<?php } ?>

                    

                    <?php

						if(isset($error1))

						{

					?>   	

        					<h5 style ="text-align:center"><span class="bg-red"><?php echo $error1; ?></span></h5>

							

                           

        			<?php } ?>

                    

                    

                    

                     

                    <div class="form-group">

                      <label for="inputPassword3" class="col-sm-2 control-label">Old Password</label>

                      <div class="col-sm-10">

                        <input class="form-control" id="oldpass" name="oldpass" placeholder="Old Password" type="password" required>

                      </div>

                    </div>

                  

                    <div class="form-group">

                      <label for="inputPassword3" class="col-sm-2 control-label">New Password</label>

                      <div class="col-sm-10">

                        <input class="form-control" id="newpass" name="newpass" placeholder="New Password" type="password" required>

                      </div>

                    </div>

                    

                    <div class="form-group">

                      <label for="inputPassword3" class="col-sm-2 control-label">Confirm Password</label>

                      <div class="col-sm-10">

                        <input class="form-control" id="confirmpass" name="confirmpass" placeholder="Confirm Password" type="password" required>

                      </div>

                    </div>

                    

                    

                 <!-- /.box-body -->

                  <div class="box-footer">

                    <a href="<?php echo base_url().'index.php/MainProcess/dashboard'; ?>" class="btn btn-default">Cancel</a>

                    <button type="submit" class="btn btn-info pull-right">Change Password</button>

                  </div><!-- /.box-footer -->

                </form>

				 </div>

              </div>

     



        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->