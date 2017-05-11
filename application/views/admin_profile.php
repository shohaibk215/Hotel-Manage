  <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Admin Profile Details            

          </h1>

          <ol class="breadcrumb">

            <li><a href="<?php echo base_url().'index.php/MainProcess/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Admin Profile</li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

        <!------------TERMS AND POLICY--------------->		  

     <div class="row">

            <div class="col-xs-12">

              <div class="box box-info">

                <div class="box-header with-border">

                  <h3 class="box-title">Admin Information</h3>

                </div><!-- /.box-header -->

                <!-- form start -->

                <form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/MainProcess/edit_about_ivlesson_data'; ?>">

                  <div class="box-body">

                  <?php 

				  		if(isset($admin_profile))

						{

							foreach($admin_profile as $row)

							{

							

				  ?>

                    <div class="form-group">

                      <label for="title" class="col-sm-2 control-label">Admin Name</label>

                      <div class="col-sm-10">

                        <input type="text" class="form-control" id="txtoffice" name="txtoffice" placeholder="Enter Title" disabled value="<?php echo $row->admin_name; ?>" required>

                      </div>

                    </div>

					

					<div class="form-group">

                      <label for="title" class="col-sm-2 control-label">Email</label>

                      <div class="col-sm-10">

                        <input type="text" class="form-control" id="txtoffice" name="txtoffice" placeholder="Enter Title" disabled value="<?php echo $row->admin_email; ?>" required>

                      </div>

                    </div>

                    <?php }} ?>

                  </div><!-- /.box-body -->

                  <div class="box-footer">

                    <a href="<?php echo base_url().'index.php/MainProcess/change_password'; ?>" class="btn btn-info pull-right">Change Password</a>

                   

                  </div><!-- /.box-footer -->

                </form>

              </div><!-- /.box -->

            </div>

          </div>



        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->