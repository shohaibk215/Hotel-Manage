<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderProcess extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array("OrderModel","UserModel","BookReserveModel","Transaction"));
 		$this->load->library(array('email','session'));
		// $this->load->library('session');
		date_default_timezone_set('UTC');
	}
	
	
// FOOD MANAGEMENT
	
	public function all_transactions()
	{
		if(isset($this->session->userdata['admin_logged_in'])){

			$UserId=$this->session->userdata['admin_logged_in']['id'];
			$type=$this->UserModel->CheckingUserRoleById($UserId);

			if($type=='admin'){

				$data['GetAllComplatedTransction']=$this->Transaction->GetAllComplatedTransction();
				$this->load->view('header');
				$this->load->view('reservation_manage',$data);
				$this->load->view('footer');
			
			}else{

				redirect(base_url().'index.php/MainProcess/dashboard');

			}
		}
		else
		{
			$this->load->view('login');	
		}
	}
	// FOOD MANAGEMENT
	
	public function checkout()
	{
		if(isset($this->session->userdata['admin_logged_in']))
		{
			$Q = "select * from reservation order by checkout_date asc";
			$data=array();
			$data['allreservations'] = $this->db->query($Q)->result();
			$this->load->view('header');
			$this->load->view('checkout',$data);
			$this->load->view('footer');
		}
		else
		{
			$this->load->view('login');	
		}
	}
	
	public function orders()
	{	
		if(isset($this->session->userdata['admin_logged_in']))
		{	
			$data=array();
			$data['allfoods'] = $this->OrderModel->get_all_foods();
			$data['allusers'] = $this->OrderModel->get_all_users();
			//$data['allorders'] = $this->OrderModel->get_all_orders();
			//var_dump($data['allfoods']);die();
			$this->load->view('header');
			$this->load->view('order_manage',$data);
			$this->load->view('footer');
		}
		else
		{
			$this->load->view('login');	
		}
	}


	public function add_order(){
	
		if(isset($this->session->userdata['admin_logged_in'])){	
			
			if(isset($_POST['Data'])){
				
				$data=$_POST['Data'];
				
				$response=$this->OrderModel->add_order($data);

				$this->output->set_content_type('application/json')->set_output(json_encode($response));

				
			
			}
		}else{
			
			$this->load->view('login');	
		
		}
		
	}

	public function allorders(){
	
		if(isset($this->session->userdata['admin_logged_in'])){	
			
			
			$data['GetAllReservation'] = $this->BookReserveModel->AlreadyChecking_Guests();
			$this->load->view('header');
			$this->load->view('order',$data);
			$this->load->view('footer');

		}else{
			
			$this->load->view('login');	
		
		}
		
	}	

	public function getOrderDetails(){
	
		
		if(isset($this->session->userdata['admin_logged_in'])){	
			
			if(isset($_POST['id'])){

				//var_dump(expression)
				$response=$this->OrderModel->GetOrderDeailsByReservationId($_POST['id']);

				$this->output->set_content_type('application/json')->set_output(json_encode($response));
			
			}
			
			

		}else{
			
			$this->load->view('login');	
		
		}
		
	}	

	public function transactiondetails(){
	
		
		if(isset($this->session->userdata['admin_logged_in'])){	
			
			if(isset($_POST['id'])){

				$response=$this->Transaction->GetTransctionDetailsByReservationID($_POST['id']);
				$this->output->set_content_type('application/json')->set_output(json_encode($response));
			
			}
			
			

		}else{
			
			$this->load->view('login');	
		
		}
		
	}	

	
}
