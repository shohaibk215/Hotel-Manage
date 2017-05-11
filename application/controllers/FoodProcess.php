<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FoodProcess extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array("FoodModel","UserModel"));
		$this->load->library(array('email','session','form_validation'));
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
	
	
// FOOD MANAGEMENT

	public function foods()
	{	
		if(isset($this->session->userdata['admin_logged_in']))
		{	
			$data=array();
			$query = $this->FoodModel->get_all_foods();
			$data['all_foods'] = $query;
			$this->load->view('header');
			$this->load->view('food_manage',$data);
			$this->load->view('footer');
		}
		else
		{
			$this->load->view('login');	
		}
	}


	public function add_foods(){

		if(isset($_POST['btnsubmit'])){

			$this->form_validation->set_rules('foodname', 'foodname', 'trim|required|callback_check_AllowSpace|callback_check_FoodAlreadyExsist');
			$this->form_validation->set_rules('foodprice', 'foodprice', 'trim|required|integer');

			if ($this->form_validation->run() == FALSE){

				$this->foods();

			}
			else{

				$data = array(
					'name'=>$this->input->post("foodname"),
					'price'=>$this->input->post("foodprice"),
					'status'=>'1'
					);	
				$response = $this->FoodModel->add_foods($data);
				if ($response!=false) { 

					$this->session->set_flashdata('FoodAddMsg','<div class="alert alert-success">Food Item added Successfully!</div>');
					redirect('FoodProcess/foods'); 

				}else{ 

					$this->session->set_flashdata('FoodAddMsg','<div class="alert alert-danger">Food Item Could not be added"</div>');
					redirect('FoodProcess/foods'); 
				}

			}
			
			
		}	

		else {

			redirect(base_url()."index.php/FoodProcess/foods",'refresh');
		}
	}
	
	public function edit_food()
	{
		if(isset($this->session->userdata['admin_logged_in']))
		{	
			$id = $this->uri->segment(3);
			$data=array();
			$query_foodid = $this->FoodModel->get_foodbyid($id);
			$data['foodbyid'] = $query_foodid;
			$query = $this->FoodModel->get_all_foods();
			$data['all_foods'] = $query;
			$this->load->view('header');
			$this->load->view('food_manage',$data);
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	}
	
	public function update_food()
	{
		$cid=$this->input->post("id");
		$data = array(
			'name'=>$this->input->post("foodname"),
			'price'=>$this->input->post("foodprice")
			);
		
		$this->FoodModel->update_foods($cid,$data);
		if ($this->db->affected_rows() > 0)
		{
			redirect('FoodProcess/foods');
		}
		else
		{
			echo "<h1 style=\"color:red\">Oops Query Problem......!!!!</h1>";
		}
	}
	
	public function del_food()
	{
		$cid=$this->uri->segment(3);
		$data = array(
			'status'=>'0'
			);
		
		$this->FoodModel->update_foods($cid,$data);
		if ($this->db->affected_rows() > 0)
		{
			redirect('FoodProcess/foods');
		}
		else
		{
			echo "<h1 style=\"color:red\">Oops Query Problem......!!!!</h1>";
		}
	}

	public function check_FoodAlreadyExsist($FoodName){

		//$FoodName = $this->input->post("foodname");
		$response=$this->FoodModel->FoodAlreadyExsist($FoodName); 

		if($response!=false){ 

			return TRUE;

		}
		else{

			$this->form_validation->set_message('check_FoodAlreadyExsist', 'Category Name Already Exsists');

			return false;

		}
	}
	
	function check_AllowSpace($FoodName){
		if (! preg_match('/^[a-zA-Z\s]+$/', $FoodName)) {
			$this->form_validation->set_message('check_AllowSpace', 'The field may only contain alpha characters & White spaces');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	
}








