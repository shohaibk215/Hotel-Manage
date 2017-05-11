<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainProcess extends CI_Controller {
	
	public function __construct() {

		parent::__construct();
		$this->load->library(array('email','session'));
		date_default_timezone_set('UTC');

	}
	
	public function index(){	

		if(isset($this->session->userdata['admin_logged_in'])){

			redirect('MainProcess/dashboard');

		}else{
			
			$this->load->view('login');

		}
		//$this->load->view('footer');
	}
	//Admin_Login
	public function user_login(){ 
		$name = $this->input->post("username");
		$password = md5($this->input->post("password"));                   


		$result = $this->Login->Userlogin($name,$password);

		if($result == true){
			$session_data = array(
				'admin_name' => $name,
				'id' => $result[0]->id,
				'role'  => $result[0]->role );
                //Add user data in session for use in any page
			$this->session->set_userdata('admin_logged_in', $session_data);
			redirect('MainProcess/dashboard');
		}
		else
		{
			$data = array(
				'error' => 'Invalid User Name or Password...!!!'
				);

			$this->load->view('login',$data);	
		}

	} 

	public function dashboard(){	

		if(isset($this->session->userdata['admin_logged_in'])){	

			$this->load->view('header');
			$this->load->view('dashboard');
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	}


// Logout from admin page
	public function logout() {
        // Removing session data
		$sess_array = array(
			'admin_name' => '',
			'id'=>''
			);        
// unset user session 		
		$this->session->unset_userdata('admin_logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';     
// after logout display login panel		
		$this->load->view('login',$data);       
	}
	

//----------------------------------------Admin Profile------------------------------------------------

	public function admin_profile(){
		if(isset($this->session->userdata['admin_logged_in'])){
			$this->load->view('header');
			$data = array();
			if($query = $this->AdminModel->admin_profile()){
				$data['admin_profile'] = $query;
			}
			$this->load->view('admin_profile',$data);
			$this->load->view('footer');
		}else{
			$this->load->view('login');
		}
	}
	public function edit_admin_profile(){
		$this->load->view('header');
		$data = array();
		if($query = $this->AdminModel->admin_profile()){
			$data['edit_admin_profile'] = $query;
		}
		$this->load->view('edit_admin_profile',$data);
		$this->load->view('footer');
	}
	public function edit_admin_profile_data(){
		$id = $this->input->post("id");
		$data = array(
			'admin_name' => $this->input->post("txtadmin_name"),
			'admin_email' => $this->input->post("txtemail")
			);
		$query = $this->AdminModel->edit_admin_profile_data($id,$data);
		if($query = $this->db->affected_rows()){
			redirect("MainProcess/logout");
		}else{
			redirect("MainProcess/dashboard");
		}

		
		
	}
//-------------------------------------CHANGE PASSWORD-------------------------------------------------

	
	public function change_password(){
		if(isset($this->session->userdata['admin_logged_in'])){
			$this->load->view('header');	
			$this->load->view('change_password');	
			$this->load->view('footer');	
		}
		else{
			$this->load->view('login');	
		}
	}
	
	
	public function change_pwd(){
		$oldpass = md5($this->input->post("oldpass"));
		$newpass = md5($this->input->post("newpass"));
		$confirmpass = md5($this->input->post("confirmpass"));
		$result = $this->AdminModel->change_pwd($oldpass);
		if($result == true){
			if($newpass == $confirmpass){
				$data = array(
					'password' => $newpass
					);
				$this->AdminModel->Change($oldpass,$data);
				redirect("MainProcess/dashboard");
			}
			else
			{
				$data = array(
					'error' => 'New Password and Confirm Password are not matching...!!'
					);
				$this->load->view('header');
				$this->load->view('change_password',$data);
				$this->load->view('footer');
			}
		}
		else
		{
			$data = array(
				'error1' => 'Your Old Password is Incorrect...!!'
				);
			$this->load->view('header');
			$this->load->view('change_password',$data);
			$this->load->view('footer');	
		}
	}



}








