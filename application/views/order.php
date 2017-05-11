 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1> All Order </h1>
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
        <h3 class="box-title">All Order</h3>
      </div>
      <!-- /.box-header -->
            <div class="box-body">
              <input type="text" class="pull-right form-control" id="filtedra"  placeholder="Search" />
              <table id="tblusers" align="center" class="table table-striped" style="" data-sorting="true" data-page-size="1000" data-paging="true" data-filter="#filtedra">
                    <thead style="">
                      <tr>          
                      <th>name</th>
	                      <th>room_number</th> 
	                       	<th>CheckIN Date</th>
	                      <th>Checkout Date</th>  
                      <th>Action</th>      
                      </tr>
                  </thead>
              <tbody id="tby1">
                <?php if(isset($GetAllReservation) && $GetAllReservation!=false){ 
                $i=1;                        
                 foreach($GetAllReservation as $key => $value){ ?>
                 <tr>
                     <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['room_number']; ?></td>
                       <td><?php echo $value['checkin_date']; ?></td>
                     <td><?php echo $value['checkout_date']; ?></td>
                   <td>
                   <button type="button" class="btn btn-info DetailsBtn" data-reservationid="<?php echo $value['id'];?>">Detail</button>
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
<div id="AllOrderModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Payment Deatils</h4>
      </div>
      <div class="modal-body">
      	<table class="table table-striped">
      		<thead>
      			<tr>
      				<th>Food</th>
      				<th>Qty</th>
      				<th>Price</th>
      				<th>Date</th>
      			</tr>
      			
      			<tbody id="tbodyDetails">
      			</tbody>	
      			
      		</thead>
      		
      	</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>