 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Reservation
            
          </h1>
          <span><?php echo $this->session->flashdata('ReservationMsG');?></span>
          <span><?php echo $this->session->flashdata('CheckedINMsG');?></span>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url().'index.php/MainProcess/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url().'index.php/BookReserve/reservation'; ?>">All Reservation</a></li>
            <li class="active">Reservation</li>
          </ol>
        </section>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">All Reservation</h3>
      </div>
      <!-- /.box-header -->
            <div class="box-body">
              <input type="text" class="pull-right form-control" id="filtedra"  placeholder="Search" />
              <table id="tblusers" align="center" class="table table-striped" style="" data-sorting="true" data-page-size="1000" data-paging="true" data-filter="#filtedra">
                    <thead style="">
                      <tr>          
                      <th>Sr. No</th>          
                      <th>Fullname</th>
                      <th>Address</th>
                      <th>Email</th>
                      <th>Telephone</th>           
                      <th>Room Number</th>
                      <th>Number of People</th> 
                       <th>CheckIN Date</th>
                      <th>Checkout Date</th>  
                      <th>Action</th>      
                      </tr>
                  </thead>
              <tbody id="tby1">
                <?php if(isset($reserved) && $reserved!=false){ 
                $i=1;                        
                 foreach($reserved as $key => $value){ ?>
                 <tr>
                   <td><?php echo $i; ?></td>
                     <td><?php echo $value['name']; ?></td>
                       <td><?php echo $value['address']; ?></td>
                         <td><?php echo $value['email']; ?></td>
                           <td><?php echo $value['telephone']; ?></td>
                           <td><?php echo $value['room_number']; ?></td>
                         <td><?php echo $value['number_people']; ?></td>
                       <td><?php echo $value['checkin_date']; ?></td>
                     <td><?php echo $value['checkout_date']; ?></td>
                   <td>
                   
                   <?php if($value['checkin_date']==date('Y-m-d')){?>
                    
                    <button type="button" class="btn btn-info CheckinBtn" data-CheckinId="<?php echo $value['id'];?>">Checkin</button>

                   <?php }if($value['checkin_date']>date('Y-m-d')){?>
                      <button type="button" class="btn btn-info" disabled="" style="background:yellow;color: black;">Checkin</button>

                   <?php }if($value['checkin_date']<date('Y-m-d')){?>
                      
                      <button type="button" class="btn btn-info" disabled="" style="background:red;color: black;">Checkin</button>
                   <?php }?>   
                   <a href="<?php echo base_url().'index.php/BookReserve/CancleReservation/'.$value['id']; ?>" onclick="return ConfirmDelete()">Cancle</a>
                   </td>
                 </tr>
                  <?php $i++;} }else{ ?>
                  <tr>
                    <td>NO Found</td>
                  </tr>
                  <?php }?>
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
</div>

<!-- Modal -->
<!-- Modal -->
<div id="CheckinModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Payment Deatils</h4>
      </div>
      <div class="modal-body">
      <form action="<?php echo base_url().'index.php/BookReserve/checkin'?>" method="POST">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
              
              <label>Total Amount</label>
              <input type="text" name="TotalPrice" id="TotalPrice" readonly="true" >
              <input type="hidden" name="ReservationId" id="ReservationId" readonly="true" >


          </div>
         </div>
         <div class="row"> 
          <div class="col-md-6 col-md-offset-3"> 
              
              <label>Deposite</label>
              <input type="text" name="Deposite" id="Deposite"  >

          </div>
          </div>
          <div class="row">
          <div class="col-md-6 col-md-offset-3"> 
              
              <label>Balnace</label>
              <input type="text" name="Balnace" id="Balnace" readonly="true" >

          </div>

        </div>

         <div class="row">
          <div class="col-md-6 col-md-offset-3"> 
              
             
              <input type="submit" class="btn btn info" value="Checkin" name="checkinbtn">

          </div>

        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
