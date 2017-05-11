 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Checked-IN Guests
            
          </h1>
          <span><?php echo $this->session->flashdata('ReservationMsG');?></span>
          <span><?php echo $this->session->flashdata('CheckOutMsG');?></span>
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
        <h3 class="box-title">Currently Checked-IN Guests and Departure LIST</h3>
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
                <?php if(isset($checkout) && $checkout!=false){ 
                $i=1;                        
                 foreach($checkout as $key => $value){ ?>
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
                    
                    <a class="btn btn-info" style="background:green;" href="<?php echo base_url().'index.php/BookReserve/confrimcheckout/'.$value['id'];?>">CheckOut</a>

                   <?php }if($value['checkin_date']>date('Y-m-d')){?>
                      
                      <a class="btn btn-info" href="<?php echo base_url().'index.php/BookReserve/confrimcheckout/'.$value['id'];?>" style="background:yellow;color: black;">CheckOut</a>
                      

                   <?php }if($value['checkin_date']<date('Y-m-d')){?>
                      
                      <a class="btn btn-info" href="<?php echo base_url().'index.php/BookReserve/confrimcheckout/'.$value['id'];?>" style="background:red;color: black">CheckOut</a>

                   <?php }?>

                   
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