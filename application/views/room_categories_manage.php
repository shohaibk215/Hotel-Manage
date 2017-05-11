  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Room Categories            
          </h1>
          <span><?php echo $this->session->flashdata('CatogoryAddMsg');?></span>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url().'index.php/MainProcess/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url().'index.php/RoomProcess/room_categories'; ?>">All Categories</a></li>
            <li class="active">Add Room Categories</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">    
                <!-- form start -->
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url().'index.php/RoomProcess/add_room_categories'; ?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Category Name</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="category" name="category" placeholder="Enter Category Name" type="text" value="<?php if(isset($categoriesById)){ echo $categoriesById['category'];}else{ echo set_value('category');}?>" required>
                        <?php echo form_error('category', '<div class="alert alert-danger myerror">', '</div>');?>
                      </div>
                    </div>
                    
                      <input type="hidden" name="id" value="<?php if(isset($categoriesById)){ echo $categoriesById['id'];    }else{echo set_value('id');}?>">
                    <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Category Price</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="category_price" name="category_price" placeholder="Enter Category Price" type="text" value="<?php if(isset($categoriesById)){ echo $categoriesById['price'];}else{echo set_value('category_price');}?>" required>
                        <?php echo form_error('category_price', '<div class="alert alert-danger myerror">', '</div>');?>
                      </div>
                    </div>
                                                    

                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <input type="submit" class="btn btn-info pull-right" name="btnsubmit" value="<?php if(isset($categoriesById)){echo "Change Details";} else {echo "Add Category";} ?>" />
                  </div><!-- /.box-footer -->
                </form>
                       <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Room Categories</h3>
            </div>
            <!-- /.box-header -->
    <div class="box-body">
      <input type="text" class="pull-right form-control" id="filtedra"  placeholder="Search" />
      <table id="tblusers" align="center" class="table table-striped" style="" data-sorting="true" data-page-size="1000" data-paging="true" data-filter="#filtedra">
        <thead style="">
          <tr>          
          <th>Sr. No</th>
          <th>Category</th>
          <th>Price</th>
          <th>Action</th>      
          </tr>
      </thead>
  <tbody id="tby1">
  <?php if(isset($all_rooms_cat)){ 
  $i=1;                        
   foreach($all_rooms_cat as $rooms_cat){ ?>
   <tr><td><?php echo $i; ?></td><td><?php echo $rooms_cat->category; ?></td><td><?php echo "£ " .$rooms_cat->price; ?></td><td>
   <a href="<?php echo base_url().'index.php/RoomProcess/edit_categories/'.$rooms_cat->id; ?>">EDIT</a>
   <a href="<?php echo base_url().'index.php/RoomProcess/delete_categories/'.$rooms_cat->id; ?>">/DELETE</a></td></tr>
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