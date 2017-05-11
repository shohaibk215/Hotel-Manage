  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reservation and Walk-In

      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'index.php/MainProcess/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/BookReserve/reservation'; ?>">All Reservation</a></li>
        <li class="active">Reservation</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">    
      <!-- form start -->
      <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url().'index.php/BookReserve/add_reservation'; ?>">
        <div class="box-body">
          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Fullname</label>
            <div class="col-sm-10">
              <input class="form-control" id="fullname" name="fullname" placeholder="Enter fullname" type="text" required>
            </div>
          </div>
          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="address" name="address" placeholder="" required></textarea> 
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input class="form-control" id="email" name="email" placeholder="Enter email" type="email" required>
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Telephone</label>
            <div class="col-sm-10">
              <input class="form-control" id="telephone" name="telephone" placeholder="Enter telephone" type="text" required>
            </div>
          </div>


          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Number of Peoples</label>
            <div class="col-sm-10">
              <select name="number_people" class="form-control " id="Capicity">
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
               <option value="4">4</option>                       

             </select>
           </div>
         </div>


         <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Check IN</label>
          <div class="col-sm-10">
           <input class="form-control checkin_date"  name="checkin_date" placeholder="Enter CheckIN Time" type="text"  required>

         </div>
       </div>

       <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Check OUT</label>
        <div class="col-sm-10">
          <input class="form-control checkout_date" id="disabled_input" name="checkout_date" placeholder="Enter Checkout Time" type="text" disabled required>
        </div>
      </div>



      <div class="form-group" id="available_rooms">
        <div style="text-align: center;">
          <button type="button" class="btn btn-info CheckAvalbilty" >Check Avaliblity</button>
        </div>
      </div>
    </div>



    <div class="form-group">
    <label for="title" class="col-sm-2 control-label">Select a avaialbe Room</label>
      <div class="col-sm-10">
        <select name="room_number" class="form-control " id="room">
        </select>
      </div>
    </div>



 


    <div class="form-group">
      <label for="title" class="col-sm-2 control-label">Type</label>
      <div class="col-sm-10">
        <SELECT class="form-control" id="Typestatus" name="status" placeholder="Enter Type"  readonly="true"  required >
          <option value="" selected="" disabled="">Choose Status</option>
          <option value="1">Reservation</option>
          <option value="2">Checkin</option>
        </SELECT>
      </div>
    </div>

    <div class="form-group">
      <label for="title" class="col-sm-2 control-label">Card Details</label>
      <div class="col-sm-10">
        <input class="form-control" id="card_details" name="card_details" placeholder="Enter Card Details" type="text" required>
      </div>
    </div>


    <input type="hidden" id="MaxId" name="reservation_id" value="<?php echo $MaxID;?>">
    <div class="box-footer">
      <input type="button" class="btn btn-info pull-right Payment" name="" value="Payment" />
      <input type="submit" class="btn btn-info pull-right submitbtn" name="btnsubmit" value="Submit" />
    </div><!-- /.box-footer -->
  </form>

  <!-- LISTING -->


  <!-- /.row -->


</div><!-- /.box -->



</div>
</div>
</div><!-- /.box-body -->

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

  $('#checkin_date').change(function(){
  //alert($("#checkin_date").val());
  $.ajax({
    url: "<?php echo base_url().'index.php/BookReserve/get_available_rooms'; ?>",
    data: { "checkin_date": $("#checkin_date").val() },
    dataType:"html",
    type: "post",
    success: function(data){
      $('#available_rooms').empty();
      $('#available_rooms').append(data);
    }
  });
});

</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
  $( function() {
    $( "#datepicker" ).datepicker({ minDate: 0});
  } );
  $('.checkin_date').on('change',function(){
    $('#disabled_input').removeAttr('disabled'); 
  })

</script>

</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="PaymentModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Payment Deatils</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">

            <label>Total Amount</label>
            <input type="text" name="TotalPrice" id="TotalPrice" readonly="true" >
            <input type="hidden" name="ReservationId" id="ReservationId" readonly="true" >
            <input type="hidden"  id="RoomPrice" readonly="true" >
            <input type="hidden"  id="CiDate" readonly="true" >
            <input type="hidden"  id="CoDate" readonly="true" >


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


            <input type="button" class="btn btn info" value="Payment" id="DepositePayment">

          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>