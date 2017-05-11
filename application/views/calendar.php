<style>


.search-table-outter { overflow-x: scroll; }
.table>tbody>tr>td {
padding:7px !important;

}
th, td { min-width: 200px; border: 1px solid #ccc;}
  </style>

  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            All Booking 
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url().'index.php/MainProcess/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url().'index.php/BookReserve/calendar'; ?>">All Booking</a></li>
            <li class="active">Calendar</li>
          </ol>
        </section>
             <!-- Main content -->

<section class="content"> 
<?php
$month= date ("m");
$year=date("Y");
$day=date("d");
$endDate=date("t",mktime(0,0,0,$month,$day,$year)); ?>
<table align="center" border="0" cellpadding=5 class="table " cellspacing=5 style="background: #fff;"><tr><td align=center>
<?php echo "Today : ".date("F, d Y ",mktime(0,0,0,$month,$day,$year)); ?> </td></tr></table>
<div style="width:10%;float: left">
  
<table align="center" class="table calend" border="0" style="width:80%;background: #fff;">
<tr style="height:30px"><td>ROOMs.</td></tr>
<?php if(isset($roomsn)) { foreach($roomsn as $rooms) {
?>
<tr style="height:30px"><td><?php echo $rooms->name; ?></td></tr>
<?php } } ?>

</table>

</div>
<div style="width:90%;float: left" class="search-table-outter">
<table align="center" class="table calend" border="0" style="background: #fff;">
<tr style="height:30px">

<?php for ($n=1;$n<=31;$n++) {
//print_r($all_reservation);

?>
<td><?php echo $n; ?></td>
<?php }  ?>
</tr>
<?php  $i=1; foreach($roomsn as $rooms) { 
   $i=$i+1;
?>

<tr style="height:30px">
<?php for ($d=1;$d<=31;$d++) {

?>
<td><?php get_calendar_data($d, $rooms->id); ?> </td>

<?php }  ?>
</tr>
<?php } ?>
</table> </div>
</section><!-- /.content -->
      </div><!-- /.content-wrapper -->

 <?php 

function get_calendar_data($d,$r)
{
  $ci =& get_instance();
  if(strlen($d)<2){ $d="0".$d; }
   $date="2017-04-".$d;
 
//$query = $this->db->query("select * from reservation where check_date=".$date.' and room_number='.$room);
 $query = $ci->db->query("select * from reservation where checkin_date='".$date."' and room_number='".$r."' ");
 $name="";
 $trecrd= $query->result();
 foreach($trecrd as $trow){ 
 $name = $trow->name;  
  $checkin_date = $trow->checkin_date;                          
 } 
 if($name!="") { echo "<div style='background:red'><a href='#' style='color:#fff' onclick='get_reservation_info($checkin_date,$r)'>".$name."</a></div>"; } else { echo "<div style='background:green;text-align:center;'><a href='http://www.manageyourhotel.com/index.php/BookReserve/reservation/".date($date)."' style='color:#fff'>AV</a></div>"; }
  
 }
 ?>     

 <script type="text/javascript">
 function get_reservation_info()
 {
 // alert();
    $.ajax({
        url: "<?php echo base_url().'index.php/BookReserve/get_reservation_info'; ?>",
        data: { "checkin_date": $("#checkin_date").val() },
        dataType:"html",
        type: "post",
        success: function(data){
          $('#available_rooms').empty();
          $('#available_rooms').append(data);
        }
    });
}
  </script>