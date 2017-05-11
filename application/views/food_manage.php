  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Foods
            
          </h1>
          <span><?php echo $this->session->flashdata('FoodAddMsg');?></span>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url().'index.php/MainProcess/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url().'index.php/RoomProcess/rooms'; ?>">All Foods</a></li>
            <li class="active">Add and Manage Food</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">    
                <!-- form start -->
                <?php
				$form_url = base_url().'index.php/FoodProcess/add_foods';
				$foodname = $foodprice = $foodid = '';
				if(isset($foodbyid))
				{
					$form_url = base_url().'index.php/FoodProcess/update_food';
					$foodname = $foodbyid[0]->name;
					$foodprice = $foodbyid[0]->price;
					$foodid = $foodbyid[0]->id;
				}
				?>
				<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo $form_url; ?>">
				<input type="hidden" name="id" value="<?php echo $foodid; ?>" />
                  <div class="box-body">
                    <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Food Name</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="foodname" name="foodname" placeholder="Enter Food Name" type="text" value="<?php echo $foodname; ?>" required>
                        <?php echo form_error('foodname', '<div class="alert alert-danger myerror">', '</div>');?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Food Price</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="foodprice" name="foodprice" placeholder="Enter Food Price" type="text" value="<?php echo $foodprice; ?>" required>
                        <?php echo form_error('foodprice', '<div class="alert alert-danger myerror">', '</div>');?>
                      </div>
                    </div>
                                       
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                 <?php $identifier = $this->uri->segment(3); ?>
                    <input type="submit" class="btn btn-info pull-right" name="btnsubmit" value="<?php if(isset($identifier)){echo "Change Details";} else {echo "Add Food";} ?>" />
                  </div><!-- /.box-footer -->
                </form>

                <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Foods</h3>
            </div>
            <!-- /.box-header -->
    <div class="box-body">
      <input type="text" class="pull-right form-control" id="filtedra"  placeholder="Search" />
      <table id="tblusers" align="center" class="table table-striped" style="" data-sorting="true" data-page-size="1000" data-paging="true" data-filter="#filtedra">
        <thead style="">
          <tr>          
          <th>Sr. No</th>          
          <th>Food Name</th> 
          <th>Food Price</th>  
          </tr>
      </thead>
  <tbody id="tby1">
  <?php if(isset($all_foods)){ 
  $i=1;                        
   foreach($all_foods as $foods){ 


    ?>
   <tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $foods['name']; ?></td>
		<td><?php echo "£ " . $foods['price']; ?></td>
		<td><a href="edit_food/<?php echo $foods['id']; ?>">EDIT</a>/<a href="del_food/<?php echo $foods['id']; ?>" onclick="return confirm('Are you sure?')">DELETE</a></td>
	</tr>
    <?php $i++;} } ?>
  </tbody>
  <tfoot class="hide-if-no-paging">
  <tr>
    <td>
    <div class="pagination pagination-centered"></div>
    </td>
  </tr></tfoot>
  
    </table>  
        
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->        
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


              </div><!-- /.box -->
            </div>
          </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->