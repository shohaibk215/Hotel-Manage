  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Rooms

      </h1>
      <span><?php echo $this->session->flashdata('RoomAddMsg');?></span>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'index.php/MainProcess/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/RoomProcess/rooms'; ?>">All Rooms</a></li>
        <li class="active">Add Rooms</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">    
      <!-- form start -->
      <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url().'index.php/RoomProcess/add_rooms'; ?>">
        <div class="box-body">
          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Room Number</label>
            <div class="col-sm-10">
              <input class="form-control" id="roomnumber" name="roomnumber" placeholder="Enter Room Number" type="text" value="<?php if(isset($room_ByID)){ echo $room_ByID['room_number'];}else{echo set_value('roomnumber');}?>" required>
              <?php echo form_error('roomnumber', '<div class="alert alert-danger myerror">', '</div>');?>
            </div>
          </div>

          <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Category</label>
            <div class="col-sm-10">
              <select name="category_id" class="form-control">
               <?php  
               if(isset($room_categories)){                         
                foreach($room_categories as $roomcat){ ?>

                <option value="<?php echo $roomcat->id;  ?>"><?php echo $roomcat->category; ?></option>

                <?php }
              } ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Capacity</label>
          <div class="col-sm-10">
            <input class="form-control" id="capacity" name="capacity" placeholder="Enter Capacity (Maximum 4!)" type="text" value="<?php if(isset($room_ByID)){ echo $room_ByID['capacity'];}else{echo set_value('capacity');}?>" required>

            <?php echo form_error('capacity', '<div class="alert alert-danger myerror">', '</div>');?>
          </div>
        </div>

        <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Bed</label>
          <div class="col-sm-10">
            <input class="form-control" id="bed" name="bed" placeholder="Enter Bed(single,double..)" type="text" value="<?php if(isset($room_ByID)){ echo $room_ByID['bed'];}else{echo set_value('bed');}?>" required>
            <?php echo form_error('bed', '<div class="alert alert-danger myerror">', '</div>');?>
          </div>
        </div>

      </div><!-- /.box-body -->
      <div class="box-footer">
        <input type="submit" class="btn btn-info pull-right" name="btnsubmit" value="<?php if(isset($room_ByID)){ echo "Change Details";} else {echo "Add Room";}?>" />
      </div><!-- /.box-footer -->
    </form>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">All Rooms</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <input type="text" class="pull-right form-control" id="filtedra"  placeholder="Search" />
            <table id="tblusers" align="center" class="table table-striped" style="" data-sorting="true" data-page-size="1000" data-paging="true" data-filter="#filtedra">
              <thead style="">
                <tr>          
                  <th>Sr. No</th>           
                  <th>Room Number</th> 
                  <th>Category</th>          
                  <th>Capacity</th> 
                  <th>Bed</th>           
                  <th>Action</th>      
                </tr>
              </thead>
              <tbody id="tby1">
                <?php if(isset($all_rooms)){ 
                  $i=1;                        
                  foreach($all_rooms as $rooms){ 

                    $querym = $this->db->get_where('room_categories', array('id' => $rooms->category_id));
                    $trecrd  = $querym->result();
                    foreach($trecrd as $trow){ 
                      $cat = $trow->category;               
                    }

                    ?>
                    <tr><td><?php echo $i; ?></td><td><?php echo $rooms->room_number; ?></td><td><?php echo $cat; ?></td><td><?php echo $rooms->capacity; ?></td><td><?php echo $rooms->bed; ?></td><td><a href='<?php echo base_url()."index.php/RoomProcess/edit_room/".$rooms->id;?>'>EDIT</a><a href='<?php echo base_url()."index.php/RoomProcess/delete_room/".$rooms->id;?>'>/DELETE</a></td></tr>
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