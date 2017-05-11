  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Users
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url().'index.php/MainProcess/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url().'index.php/UserProcess/users'; ?>">All Users</a></li>
            <li class="active">Add Users</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">    
                <!-- form start -->
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url().'index.php/UserProcess/update_users'; ?>">
                <?php 
            if(isset($userbyid))
            {
              foreach($userbyid as $row)
              { ?>

                  <input type="hidden" id="id" name="id" value="<?php echo $row->id; ?>" />
                  <div class="box-body">
                    <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="username" name="username" value="<?php echo $row->username; ?>" type="text" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Firstname</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="firstname" name="firstname" value="<?php echo $row->firstname; ?>" type="text" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="description" class="col-sm-2 control-label">Lastname</label>
                      <div class="col-sm-10">
                         <input class="form-control" id="lastname" name="lastname" value="<?php echo $row->lastname; ?>" type="text" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="email" name="email" value="<?php echo $row->email; ?>" type="email" required>
                      </div>
                    </div>

                     
                        <input class="form-control" id="password" name="password" value="<?php echo $row->password; ?>" type="hidden" required>
                    

                     <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">User Role</label>
                      <div class="col-sm-10">
                      <select name="user_role" class="form-control">
                         <?php  
                        if(isset($user_roles)){                         
                        foreach($user_roles as $roles){ ?>

                        <option value="<?php echo $roles->id;  ?>" <?php if($roles->id==$row->role_id) { echo "selected=selected"; } ?>><?php echo $roles->role; ?></option>
                        
                        <?php }
                      } ?>

                        
                      </select>
                      </div>
                    </div>
                      <?php }} ?>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <input type="submit" class="btn btn-info pull-right" name="btnsubmit" value="Change Details" />
                  </div><!-- /.box-footer -->
                </form>

                  <!-- LISTING -->

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Users</h3>
            </div>
            <!-- /.box-header -->
    <div class="box-body">
      <input type="text" class="pull-right form-control" id="filtedra"  placeholder="Search" />
      <table id="tblusers" align="center" class="table table-striped" style="" data-sorting="true" data-page-size="1000" data-paging="true" data-filter="#filtedra">
        <thead style="">
          <tr>          
          <th>Sr. No</th>          
          <th>Usrename</th>
          <th>firstname</th>
          <th>Lastname</th>
          <th>Email</th>           
          <th>Role</th>  
          <th>Action</th>      
          </tr>
      </thead>
  <tbody id="tby1">
   <?php if(isset($all_users)){ 
                $i=1;                        
                foreach($all_users as $users){ 
                  $rolen = "Role not found";
                  foreach($user_roles as $roles){
                    if ($users->role_id == $roles->id ){

                      $rolen = $roles->role;
                    }

                  }
                  ?>
                  <tr><td><?php echo $i; ?></td><td><?php echo $users->username; ?></td><td><?php echo $users->firstname; ?></td><td><?php echo $users->lastname; ?></td><td><?php echo $users->email; ?></td><td><?php echo $rolen; ?></td><td><a href="<?php echo base_url().'index.php/UserProcess/edit_user/'.$users->id; ?>">EDIT</a><a href="<?php echo base_url().'index.php/UserProcess/delete_users/'.$users->id; ?>" onclick="return ConfirmDelete()">/DELETE</a></td></tr>
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

<script type="text/javascript">
    
$(document).ready(function()
{
  $('#tblusers').footable();

});
    
    </script>
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

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->