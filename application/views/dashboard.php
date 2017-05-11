 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url().'index.php/MainProcess/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
       
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <?php if(isset($this->session->userdata['admin_logged_in']['role']) && ($this->session->userdata['admin_logged_in']['role']=='admin')) { ?>

              <div class="col-lg-4 col-xs-6 dash6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h4>All Users</h4>
                    <p></p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-fw fa-user-secret"></i>
                  </div>
                  <a href="<?php echo base_url().'index.php/MainProcess/users';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!-- ./col -->

              <div class="col-lg-4 col-xs-6 dash2">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h4>All Rooms</h4>
                   
                  </div>
                  <div class="icon">
                    <i class="fa fa-fw fa-group"></i>
                  </div>
                  <a href="<?php echo base_url().'index.php/RoomProcess/rooms';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!-- ./col -->
              
              <div class="col-lg-4 col-xs-6 dash4">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h4>All Transactions</h4>
                    <p></p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-fw fa-user-secret"></i>
                  </div>
                  <a href="<?php echo base_url().'index.php/OrderProcess/all_transactions';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!-- ./col -->


              </div><!-- /.row -->
      
            <div class="row">
              <div class="col-lg-4 col-xs-6 ">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h4>Restaurant Orders</h4>
                 
                </div>
                <div class="icon">
                  <i class="fa fa-fw fa-group"></i>
                </div>
                <a href="<?php echo base_url().'index.php/OrderProcess/orders';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php }else{?>
            
            <div class="col-lg-4 col-xs-6 dash1">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h4>Booking Calendar</h4>
                  <p></p>
                </div>
                <div class="icon">
                  <i class="fa fa-fw fa-unlock-alt"></i>
                </div>
                <a href="<?php echo base_url().'index.php/BookReserve/calendar';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            
            </div><!-- ./col -->

            </div><!-- /.row -->
      
            <div class="row">
              <div class="col-lg-4 col-xs-6 dash3">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h4>Restaurant Orders</h4>
                 
                </div>
                <div class="icon">
                  <i class="fa fa-fw fa-group"></i>
                </div>
                <a href="<?php echo base_url().'index.php/OrderProcess/orders';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
 
            <?php }?>


            
          
           
           


            <div class="col-lg-4 col-xs-6 dash5">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h4>Change Password</h4>
                  <p></p>
                </div>
                <div class="icon">
                  <i class="fa fa-fw fa-unlock-alt"></i>
                </div>
                <a href="<?php echo base_url().'index.php/MainProcess/change_password'; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
           
            
          </div><!-- /.row -->
		  


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->