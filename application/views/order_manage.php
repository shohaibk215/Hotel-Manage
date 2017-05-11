  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Order
            
          </h1>
          <span><?php echo $this->session->flashdata('OrderMsG');?></span>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url().'index.php/MainProcess/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url().'index.php/RoomProcess/rooms'; ?>">All Orders</a></li>
            <li class="active">Add Order</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">    
                <!-- form start -->
				
                  <div class="box-body">
                    <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Select Customer</label>
                      <div class="col-sm-10">
                        <select id="ReservationID"  class="form-control" required>
							<option value="">Select Customer</option>
							<?php
							if(isset($allusers) && $allusers!=false){

								foreach($allusers as $user => $value){

									echo "<option value='".$value['id']."'>".$value['room_number']." (".$value['name'].")</option>";
								
								}	
							}
							?>
						</select>
                      </div>
                    </div>
                    <div id="food_div">
					<div class="form-group" id="1">
                      <label for="title" class="col-sm-2 control-label">Select Food</label>
                      <div class="col-sm-3">
                        <select id="FoodID" name="" style="width:100%" class="form-control" required>
							<option value="">Select Food</option>
							<?php
							foreach($allfoods as $key => $value){
							
							echo "<option value='".$value['id']."' data-price='".$value['price']."''>".$value['name']." (£-".$value['price'].")</option>";
							}
							?>
						</select>
					  </div>
					  <div class="col-sm-4">
						<input class="form-control qty" id="qty" name="qty" placeholder="Quantity" type="text" required>
                      </div>
                    </div>
                    </div>
					<div class="form-group">
                      <label for="title" class="col-sm-2 control-label"></label>
                      <div class="col-sm-5">
						<input style="margin:5px; display:none;" class="btn btn-info pull-right" id="minusbtn" type="button" value="- Food Item" > 
                        <input style="margin:5px;" class="btn btn-info pull-right" id="addbtn" type="button" value="+ Food Item" >
                      </div>
                    </div>
					
                  </div><!-- /.box-body -->
                  </section>
                  <div class="box-footer">
                    <input type="button" class="btn btn-info pull-right" name="btnsubmit" id="btnsubmit" value="Confirm Orders" />
                  </div><!-- /.box-footer -->
                  <table class="table table-striped">
              		<thead>
              			<tr>
              				<th>Food</th>
              				<th>Quantity</th>	
              				<th>Price</th>
              				<th>Total</th>
              			</tr>
              		</thead>
              		<tbody id="tbody">
              			
              		</tbody>	
              </table>
              </div><!-- /.box -->