  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Room Categories
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url().'index.php/MainProcess/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url().'index.php/UserProcess/room_categories'; ?>">All Room Categories</a></li>
            <li class="active">Edit Room Categories</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">    
                <!-- form start -->
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url().'index.php/RoomProcess/update_room_categories'; ?>">
                  <div class="box-body">
            <?php 
            if(isset($all_rooms_cat))
            {
              foreach($all_rooms_cat as $row)
              { ?>
              

                    <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Category Name</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="category" name="category" value="<?php echo $row->category; ?>" type="text" required>
                          <input class="form-control" id="id" name="id" value="<?php echo $row->id; ?>" Role " type="hidden" required>
                      </div>
                    </div>                                

                    <input type="hidden" id="id" name="id" value="<?php echo $row->id; ?>" />
                  </div><!-- /.box-body -->
                   <?php }} ?>
                  <div class="box-footer">
                    <input type="submit" class="btn btn-info pull-right" name="btnsubmit" value="Submit" />
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
          <th>Role Name</th>          
          <th>Action</th>      
          </tr>
      </thead>
  <tbody id="tby1">
  <?php if(isset($all_rooms_cat)){ 
  $i=1;                        
   foreach($all_rooms_cat as $rooms_cat){ ?>
   <tr><td><?php echo $i; ?></td><td><?php echo $rooms_cat->category; ?></td><td><a href="<?php echo base_url().'index.php/UserProcess/edit_categories/'.$all_rooms_cat->id; ?>">EDIT</a><a href="<?php echo base_url().'index.php/UserProcess/delete_categories/'.$all_rooms_cat->id; ?>">/DELETE</a></td></tr>
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
       <script type="text/javascript">
      function ConfirmDelete()
      {
            if(confirm("Are you sure you want to delete this record?"))
      {
        return true;
      }else
      {
        return false;
      }
                  
      }
  </script> 