<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    All Transactions
    
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url().'index.php/MainProcess/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo base_url().'index.php/RoomProcess/rooms'; ?>">All Orders</a></li>
    <li class="active">All Transactions</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">    
        <!-- form start -->
        <div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">All Transactions</h3>
    </div>
    <!-- /.box-header -->
		    <div class="box-body">
		      <input type="text" class="pull-right form-control" id="filtedra"  placeholder="Search" />
		      <table id="tbltran" align="center" class="table table-striped" style="" data-sorting="true" data-page-size="20" data-paging="true" data-filter="#filtedra">
		        <thead style="">
		          <tr>          
		          <th>Customer Name</th>          
		          <th>Room Number</th>
		          <th>Telephone</th>
		          <th>Checkin Date</th>
		          <th>Checkout Date</th>
		          <th>Status</th>
				  <th>Action</th>		  
		          </tr>
		      </thead>
			  <tbody id="tby1">
			  	<?php if(isset($GetAllComplatedTransction) && $GetAllComplatedTransction!=false){
			  			foreach ($GetAllComplatedTransction as $key => $value) {?>
			  		<tr>
			  			<td><?=$value['name']?></td>
			  			<td><?=$value['room_number']?></td>
			  			<td><?=$value['telephone']?></td>
			  			<td><?=$value['checkin_date']?></td>
			  			<td><?=$value['checkout_date']?></td>

			  			<td>
			  				<?php if($value['history']==0){

			  					if($value['status']==1){

			  						echo "<span style='color:red;font-size: 16px;'>ReServed</span>";
			  						
			  					}
			  					if($value['status']==2){

			  						echo "<span style='color:green;font-size: 16px;'>Checked in</span>";

			  					}	
			  				}else{

			  					echo "Archive";
			  				}
			  				?>
			  				
			  			</td>
			  			<td><?php if($value['status']!=1){?><button type="button" class="btn btn-info Transactiondetails" data-id="<?=$value['id']?>" data-status="<?=$value['status']?>" >Details</button><?php }?></td>
			  		</tr>
			  	<?php }}else{?>
			  		<tr>
			  			<td>No Transaction Found</td>
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
		      <!-- /.row -->


          </div><!-- /.box -->
        </div>
      </div>

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->



  <!-- Modal -->
<div id="AllTRactionModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Payment Deatils</h4>
      </div>
      <div class="modal-body">
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
                <th>Total Rental Cost</th>
                <th>Deposite</th>
                <th>Balance Due</th>                                   
                <th>Date </th>
              </tr>
            </thead>
            <tbody id="RentalDetailstbody">

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
                 <th>Total For This Order</th>
                 <th>Date</th>
                </tr>
             </thead>
             <tbody id="FoodDetailsTbody">
             
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
                 <th>Balnace to be paid</th>                                   


               </tr>
             </thead>
             <tbody id="GrandTotalTbody">
             
              
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


  