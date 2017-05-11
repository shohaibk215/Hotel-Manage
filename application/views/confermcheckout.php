 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Confirm Check-OUT
      
    </h1>

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
          <h3 class="box-title">Rental Details</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="tblusers" align="center" class="table table-striped" style="" data-sorting="true" data-page-size="1000" data-paging="true" data-filter="#filtedra">
            <thead style="">
              <tr>          
                <th>RoomNo</th>          
                <th>DateCheckedIN</th>                   
                <th>Number of Days</th>
                <th>Total Rental Cost</th>
                <th>Deposite</th>
                <th>Balnace to be paid</th>                                   

              </tr>
            </thead>
            <tbody id="tby1">
            <?php $TotalRentalBilling=0;$Deposite=0;?>
            <?php if(isset($RentalBilling) && $RentalBilling!=false){?>
              <tr>
                <td><?php echo $RentalBilling[0]['room_number']?></td>                   
                <td><?php echo $RentalBilling[0]['checkin_date']?></td>
                <td><?php $CheckinDate=date_create($RentalBilling[0]['checkin_date']);
                    $CheckoutDate=date_create($RentalBilling[0]['checkout_date']);
                    $diff=date_diff($CheckinDate,$CheckoutDate);
                    echo $NoOFDays=$diff->days;?>
                </td>
                <td>£ <?php echo  $RentalBilling[0]['total_amount'];
                                $TotalRentalBilling=$RentalBilling[0]['total_amount']?>
                                  
                                </td>
                <td>£ <?php echo $RentalBilling[0]['PaidAmount'];$Deposite=$RentalBilling[0]['PaidAmount'];?></td>
                <td>£ <?php echo $RentalBilling[0]['total_amount']-$RentalBilling[0]['PaidAmount']?></td>  
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


        <div class="box-header">
          <h3 class="box-title">Food Details</h3>
        </div>
            
            <table id="tblusers" align="center" class="table table-striped" style="" data-sorting="true" data-page-size="1000" data-paging="true" data-filter="#filtedra">
              <thead style="">
                <tr>          
                 <th>Food Name</th>          
                 <th>Quantity</th>                   
                 <th>Price Per Item</th>
                 <th>Total</th>
                 <th>Date</th>
                </tr>
             </thead>
             <tbody id="tby1">
             <?php $TotalFoodBilling=0;?>
             <?php if(isset($FoodBilling) && $FoodBilling!=false){
                
               foreach ($FoodBilling as $key => $value){
                $TotalFoodBilling=$TotalFoodBilling+$value['price']*$value['quantity'];
                ?>
              <tr>
                <td><?=$value['name']?></td>
                <td><?=$value['quantity']?></td>
                <td>£ <?=$value['price']?></td>
                <td>£ <?=$value['price']*$value['quantity']?></td>
                <td><?=$value['datetime']?></td>
              </tr>
              <?php }}else{?>
              <?php }?>
            </tbody>
            <tfoot class="hide-if-no-paging">
              <tr>
                <td>
                  <div class="pagination pagination-centered"></div>
                </td>
              </tr></tfoot>
              
            </table> 


 <div class="box-header">
          <h3 class="box-title">Grand Total</h3>
        </div>



            <table id="tblusers" align="center" class="table table-striped" style="" data-sorting="true" data-page-size="1000" data-paging="true" data-filter="#filtedra">
              <thead style="">
                <tr>          
                 <th>Total For Stay</th>          
                 <th>Total For Food</th>                   
                 <th>Deposite</th>
                 <th>GRAND TOTAL</th>
                 <th>Balance to be paid</th>                                   


               </tr>
             </thead>
             <tbody id="tby1">

              <tr>
               <td>£ <?=$TotalRentalBilling;?></td>          
               <td>£ <?=$TotalFoodBilling;?></td>                   
               <td>£ <?=$Deposite;?></td>
               <td>£ <?=$TotalRentalBilling+$TotalFoodBilling;?></td>
               <td>£ <?=$TotalRentalBilling+$TotalFoodBilling-$Deposite;?></td>
               <td><button type="button" class="btn btn-info checkout" data-toggle="modal" data-target="#CheckoutModel">Checkout</button></td>   


             </tr>
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
<div id="CheckoutModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Payment Deatils</h4>
      </div>
      <div class="modal-body">
      <form action="<?php echo base_url().'index.php/BookReserve/CheckoutProcess'?>" method="POST">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
              
              <label>Total Amount £</label>
              <input type="text" name="TotalPrice" id="AmountToPaid" readonly="true" value="<?=$TotalRentalBilling+$TotalFoodBilling-$Deposite;?>">
              <input type="hidden" name="ReservationId" value="<?php echo $this->uri->segment(3);?>" readonly="true" >


          </div>
         </div>
         <div class="row"> 
          <div class="col-md-6 col-md-offset-3"> 
              
              <label>Deposite £</label>
              <input type="text" name="Deposite" id="CheckOutDeposite"  >

          </div>
          </div>
          <div class="row">
          <div class="col-md-6 col-md-offset-3"> 
              
              <label>Balnace £</label>
              <input type="text" name="Balnace" id="CheckoutBalnace" readonly="true" value="<?=$TotalRentalBilling+$TotalFoodBilling-$Deposite;?>">

          </div>

        </div>

         <div class="row">
          <div class="col-md-6 col-md-offset-3"> 
              
             
              <input type="submit" class="btn btn info" value="CheckOut" name="CheckOutBtn">

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