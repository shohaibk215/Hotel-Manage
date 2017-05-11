<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookReserve extends CI_Controller {
	
	public function __construct() {
    parent::__construct();
    	
    	$this->load->model(array("BookReserveModel","UserModel","RoomModel","Transaction","Billing"));
 		$this->load->library('email');
		$this->load->library('session');
		date_default_timezone_set('UTC');

		if(isset($this->session->userdata['admin_logged_in'])){

				$UserId=$this->session->userdata['admin_logged_in']['id'];
				
				$type=$this->UserModel->CheckingUserRoleById($UserId);
				

				
				if($type=='receptionist'){

				}else{


					redirect(base_url().'index.php/MainProcess/dashboard');
				}
			}

		}		

// Reservation Management

public function reservation(){	
	
	if(isset($this->session->userdata['admin_logged_in'])){	
		$data['MaxID']=$this->BookReserveModel->GetMaxId();
		$this->load->view('header');
		$this->load->view('reservation',$data);
		$this->load->view('footer');
	
	}
	else{
		$this->load->view('login');	
	}
}

public function add_reservation(){
		
		$data = array(
			'name'=>$this->input->post("fullname"),
			'address'=>$this->input->post("address"),
			'email'=>$this->input->post("email"),
			'telephone'=>$this->input->post("telephone"),
			'number_people'=>$this->input->post("number_people"),
			'roomid'=>$this->input->post("room_number"),
			'card_details'=>$this->input->post("card_details"),
			'checkin_date'=>$this->input->post("checkin_date"),
			'checkout_date'=>$this->input->post("checkout_date"),
			'status'=>$this->input->post("status"),
			'history'=> 0
		);	
		
		$response=$this->BookReserveModel->add_reservation($data);
		
		if ($this->db->affected_rows() > 0) { ?> 
		<script>alert("Booking Completed Successfully");</script><?php redirect('BookReserve/reservation'); }
      else { echo "<h1 style=\"color:red\">Oops Query Problem......!!!!</h1>"; }
	}
// Booking Calendar 

public function calendar(){	
	if(isset($this->session->userdata['admin_logged_in']))
	{	
		$data=array();
		if($query = $this->BookReserveModel->get_rooms())  
         { $data['roomsn'] = $query; }
     	if($query_reservation = $this->BookReserveModel->get_reservation())  
         { $data['all_reservation'] = $query_reservation; }    
		$this->load->view('header');
		$this->load->view('calendar',$data);
		$this->load->view('footer');
	}
	else{
		$this->load->view('login');	
	}
}

// Booking Calendar 

public function get_available_rooms(){

	if(isset($this->session->userdata['admin_logged_in'])){	
			
	 $checkin_date=$this->input->post("checkin_date");
	 $checkout_date=$this->input->post("checkout_date");
	 $roomCapicity=$this->input->post("Capicity");
		 
	$response=$this->BookReserveModel->get_available_rooms($checkin_date,$checkout_date,$roomCapicity);
	
	
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	 
	}
	else{
		$this->load->view('login');	
	}
}


// Reservation Management

public function checkin(){	

		if(isset($this->session->userdata['admin_logged_in'])){	

			if(isset($_POST['checkinbtn'])){

				$data=array('reservation_id'=>$_POST['ReservationId'],
							'total_amount'=>$_POST['TotalPrice'],
							'PaidAmount'=>$_POST['Deposite'],
							'datetime'=>date("Y-m-d h:i:sa"));
							$type='Rental';
				$response=$this->Transaction->DepositePayment($data,$type);
				if($response==true){

					$this->session->set_flashdata('CheckedINMsG','<div class="alert alert-success">Checked In Successfully!</div>');
     				redirect('BookReserve/checkin');

				}else{

					$this->session->set_flashdata('CheckedINMsG','<div class="alert alert-success">Some Internal Error Occur Try Again !</div>');
     				redirect('BookReserve/checkin');
				
				}
			}

		$data['reserved'] = $this->BookReserveModel->reserved_guests(); 
     
		$this->load->view('header');
		$this->load->view('checkin',$data);
		$this->load->view('footer');

	}
	else{

		$this->load->view('login');	
	
	}

}

public function GetBillingDetails(){

	if(isset($this->session->userdata['admin_logged_in'])){	

			if(isset($_POST['id'])){

				$response=$this->RoomModel->GetRoomPriceByReservationId($_POST['id']);
				
				if($response!=false){

					$CheckinDate=date_create($response[0]['checkin_date']);
					$CheckoutDate=date_create($response[0]['checkout_date']);
					$diff=date_diff($CheckinDate,$CheckoutDate);
					$NoOFDays=$diff->days;
					
					$data=array('TotalPrice'=> $NoOFDays*$response[0]['price'],'ReservationID'=>$response[0]['id']);

					$this->output->set_content_type('application/json')->set_output(json_encode($data));

				}else{

					$data=false;
					$this->output->set_content_type('application/json')->set_output(json_encode($data));
				}
				
			}

	}
	
	else{

			
	
	}

}
public function checkout(){	
	
	if(isset($this->session->userdata['admin_logged_in'])){	

		$data['checkout'] = $this->BookReserveModel->AlreadyChecking_Guests(); 
     	
		$this->load->view('header');
		$this->load->view('checkout',$data);
		$this->load->view('footer');

	}
	else{

		$this->load->view('login');	
	
	}
}

public function CheckoutProcess(){	
	
	if(isset($this->session->userdata['admin_logged_in'])){	

		// var_dump($_POST);die();
		if($_POST['TotalPrice']-$_POST['Deposite']==0){

			$ReservationId=$_POST['ReservationId'];
			$response=$this->BookReserveModel->AddReservationToHistry($ReservationId);

			$data=array('reservation_id'=>$_POST['ReservationId'],
							'total_amount'=>$_POST['TotalPrice'],
							'PaidAmount'=>$_POST['Deposite'],
							'datetime'=>date("Y-m-d h:i:sa"));
							$type='All';
			$this->Transaction->DepositePayment($data,$type);

			if($response!=false){

     		$this->session->set_flashdata('CheckOutMsG','<div class="alert alert-success">CheckOut Successfully!</div>');
     		redirect('BookReserve/checkout');

	     	}else{

	     		$this->session->set_flashdata('ReservationMsG','<div class="alert alert-success">Some Error Occur try Again</div>');
				redirect('BookReserve/checkout');     		
	     	}

		}else{

			$this->checkout();
		}

	}
	else{

		$this->load->view('login');	
	
	}
}

public function CancleReservation(){	
	
	if(isset($this->session->userdata['admin_logged_in'])){	

		$id=$this->uri->segment(3);
		$response=$this->BookReserveModel->CancleReservation($id); 
     	if($response!=false){

     		$this->session->set_flashdata('ReservationMsG','<div class="alert alert-success">Reservation  Deleated Successfully!</div>');
     		redirect('BookReserve/checkin');

     	}else{

     		$this->session->set_flashdata('ReservationMsG','<div class="alert alert-success">Could Not Be Deleated</div>');
			redirect('BookReserve/checkin');     		
     	}
		$this->load->view('header');
		$this->load->view('checkin',$data);
		$this->load->view('footer');

	}
	else{

		$this->load->view('login');	
	
	}
}

public function confrimcheckout(){	
	
	if(isset($this->session->userdata['admin_logged_in'])){	

		$totalFoodBilling=0;
		$id=$this->uri->segment(3);
		//var_dump($id);die();
		$data['RentalBilling']=$this->Billing->GetRentalBillingAgainst($id);
		$data['FoodBilling']=$this->Billing->GetFoodBillingAgainst($id);
		
		$this->load->view('header');
		$this->load->view('confermcheckout',$data);
		$this->load->view('footer');		

	}
	else{

		$this->load->view('login');	
	
		}
	}		
	
	public function DepositePayment(){	
	
	if(isset($this->session->userdata['admin_logged_in'])){	

		if(isset($_POST['TotalPrice'])){

			$data=array('reservation_id'=>$_POST['ReservationId'],
						'total_amount'=>$_POST['TotalPrice'],
						'PaidAmount'=>$_POST['Deposite'],
						'datetime'=>date("Y-m-d h:i:sa"));
							$type='Rental';
			$response=$this->Transaction->DepositePayment($data,$type);
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}
	else{

		$this->load->view('login');	
	
		}
	}		
	
}

	

	


	

