<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoomProcess extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		$this->load->model(array("RoomModel","UserModel"));
		$this->load->library(array('email','session','form_validation'));
		$this->load->helper(array('form'));
		date_default_timezone_set('UTC');

		if(isset($this->session->userdata['admin_logged_in'])){

			$UserId=$this->session->userdata['admin_logged_in']['id'];

			$type=$this->UserModel->CheckingUserRoleById($UserId);


			if($type=='admin'){

			}else{

				redirect(base_url().'index.php/MainProcess/dashboard');
			}
		}
	}
	
	
// ROOM MANAGEMENT

	public function rooms(){	
		if(isset($this->session->userdata['admin_logged_in'])){	

			$data=array();
			if($query = $this->RoomModel->get_all_rooms())  
				{ $data['all_rooms'] = $query; }
			if($query_cat = $this->RoomModel->get_room_categories())  
				{ $data['room_categories'] = $query_cat; }
			$this->load->view('header');
			$this->load->view('room_manage',$data);
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	}

	public function room_categories(){	
		if(isset($this->session->userdata['admin_logged_in'])){

			$data=array();
			if($query = $this->RoomModel->get_room_categories())  
				{ $data['all_rooms_cat'] = $query; }
			$this->load->view('header');
			$this->load->view('room_categories_manage',$data);
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	}


	public function edit_categories(){

		if(isset($this->session->userdata['admin_logged_in'])){	

			$id = $this->uri->segment(3);

			$data=array();

			if($query = $this->RoomModel->get_room_categories()){ 

				$data['all_rooms_cat'] = $query; 
			}

			if($query1 = $this->RoomModel->get_room_categoriesById($id)){ 

				$data['categoriesById'] = $query1; 
			}
			
			$this->load->view('header');
			$this->load->view('room_categories_manage',$data);
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	}		

	public function add_room_categories(){
		
		if(isset($_POST['btnsubmit'])){
			
			$this->form_validation->set_rules('category', 'category', 'trim|required|alpha|callback_check_CategoryAlreadyExsist');
			$this->form_validation->set_rules('category_price', 'category_price', 'trim|required|integer');

			if ($this->form_validation->run() == FALSE){

				$this->room_categories();


			}else{

				$data = array(
					'id' => ($this->input->post("id"))?$this->input->post("id"):"",
					'category'=>$this->input->post("category"),
					'price'=>$this->input->post("category_price")
					);	

				$response=$this->RoomModel->add_room_categories($data);


				if ($response!=false) { 

					$this->session->set_flashdata('CatogoryAddMsg','<div class="alert alert-success">Room categories added Successfully!</div>');
					redirect('RoomProcess/room_categories'); 

				}else{ 

					$this->session->set_flashdata('CatogoryAddMsg','<div class="alert alert-danger">Oops Query Problem......!!!!</div>');
					redirect('RoomProcess/room_categories');	
				}	

			}

		}else{

			redirect(base_url()."index.php/RoomProcess/room_categories",'refresh');
		}


	}

	public function delete_categories(){

		if(isset($this->session->userdata['admin_logged_in'])){

			$id = $this->uri->segment(3);

			$response=$this->RoomModel->delete_categories($id);

			if ($response!=false) { 
				
				$this->session->set_flashdata('CatogoryAddMsg','<div class="alert alert-success">Room Deleted Successfully!</div>');
				redirect('RoomProcess/room_categories'); 

			}else{ 
				
				$this->session->set_flashdata('CatogoryAddMsg','<div class="alert alert-danger">Oops Query Problem......!!!!</div>');
				redirect('RoomProcess/room_categories');	
			}	

		}else{

			$this->load->view('login');	

		}	
	}

	public function add_rooms(){
		
		if(isset($_POST['btnsubmit'])){

			
			$this->form_validation->set_rules('roomnumber', 'roomnumber', 'trim|required|integer|callback_check_RoomAlreadyExsist');
			$this->form_validation->set_rules('category_id', 'category_id', 'trim|required|integer');
			$this->form_validation->set_rules('capacity', 'capacity', 'trim|required|callback_check_number|max_length[5]|integer');
			$this->form_validation->set_rules('bed', 'bed', 'trim|required');

			if ($this->form_validation->run() == FALSE){

				$this->rooms();


			}else{

				$data = array(

					'room_number'=>$this->input->post("roomnumber"),
					'category_id'=>$this->input->post("category_id"),
					'capacity'=>$this->input->post("capacity"),
					'bed'=>$this->input->post("bed"));

				$response=$this->RoomModel->add_rooms($data);

				if ($response!=false) { 

					$this->session->set_flashdata('RoomAddMsg','<div class="alert alert-success">Room added Successfully!</div>');
					redirect('RoomProcess/rooms'); 

				}else{ 

					$this->session->set_flashdata('RoomAddMsg','<div class="alert alert-danger">Oops Query Problem......!!!!</div>');
					redirect('RoomProcess/rooms');	
				}	

			}

		}else{

			redirect(base_url()."index.php/RoomProcess/rooms",'refresh');
		}

	}	
	public function update_room_categories(){
		$cid=$this->input->post("id");
		$data = array(
			'category'=>$this->input->post("category")
			);	
		$this->RoomModel->update_room_categories($cid,$data);
		if ($this->db->affected_rows() > 0) { redirect('RoomProcess/room_categories'); }
		else { echo "<h1 style=\"color:red\">Oops Query Problem......!!!!</h1>"; }
	}		

	public function update_room(){
		$cid=$this->input->post("id");
		$data = array('name'=>$this->input->post("roomname"),
			'room_number'=>$this->input->post("roomnumber"),
			'category_id'=>$this->input->post("category_id"),
			'capacity'=>$this->input->post("capacity"),
			'availability'=>$this->input->post("status")
			);
		
		$this->RoomModel->update_rooms($cid,$data);
		if ($this->db->affected_rows() > 0) { redirect('RoomProcess/rooms'); }
		else { echo "<h1 style=\"color:red\">Oops Query Problem......!!!!</h1>"; }
	}

	public function edit_room(){	

		if(isset($this->session->userdata['admin_logged_in'])){

			$id = $this->uri->segment(3);
			$data=array();

			if($query = $this->RoomModel->get_all_rooms()){ 

				$data['all_rooms'] = $query; 
			}
			if($query_cat = $this->RoomModel->get_room_categories()){ 

				$data['room_categories'] = $query_cat; 
			}
			if($query_RoomByID = $this->RoomModel->get_roomById($id)){ 

				$data['room_ByID'] = $query_RoomByID; 
			}
        // echo "<pre>";
        // var_dump($data['room_ByID']);die();
			$this->load->view('header');
			$this->load->view('room_manage',$data);
			$this->load->view('footer');
		}

		else{
			$this->load->view('login');	
		}

	}

	public function check_RoomAlreadyExsist($RoomName){

		$response=$this->RoomModel->CheckingRoomAlreadyExsist($RoomName); 

		if($response!=false){ 

			return TRUE;

		}
		else{

			$this->form_validation->set_message('check_RoomAlreadyExsist', 'Room Name Already Exsists');

			return false;

		}
	}

	public function check_CategoryAlreadyExsist($CategoryName){

		$response=$this->RoomModel->CategoryAlreadyExsist($CategoryName); 

		if($response!=false){ 

			return TRUE;

		}
		else{

			$this->form_validation->set_message('check_CategoryAlreadyExsist', 'Category Name Already Exsists');

			return false;

		}
	}

	

	public function delete_room(){

		if(isset($this->session->userdata['admin_logged_in'])){

			$id = $this->uri->segment(3);
			$response=$this->RoomModel->delete_room($id);

			if ($response!=false) { 
				
				$this->session->set_flashdata('RoomAddMsg','<div class="alert alert-success">Room Deleted Successfully!</div>');
				redirect('RoomProcess/rooms'); 

			}else{ 
				
				$this->session->set_flashdata('RoomAddMsg','<div class="alert alert-danger">Oops Query Problem......!!!!</div>');
				redirect('RoomProcess/rooms');	
			}	

		}else{

			$this->load->view('login');	

		}	
	}		



	public function check_number(){

		if ($this->input->post("capacity") > 4){

			$this->form_validation->set_message('check_number', 'Room capacity should be 4 or below');
			return false;
		}
		else{
			return true;
		}

	}


}









