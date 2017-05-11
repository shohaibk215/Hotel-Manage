<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserProcess extends CI_Controller {
	
	public function __construct() {

		parent::__construct();

		$this->load->model("UserModel");
		$this->load->library(array('session','form_validation','email'));

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

// USER MANAGEMENT

	public function users(){	
		if(isset($this->session->userdata['admin_logged_in'])){	
			$data=array();
			if($query = $this->UserModel->get_user_roles())  { 
				$data['user_roles'] = $query; 
			}
			if($query_users = $this->UserModel->get_users())  {
				$data['all_users'] = $query_users; 
			}
			$this->load->view('header');
			$this->load->view('user_manage',$data);
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	}

	public function add_users(){
		

		if(isset($_POST['btnsubmit'])){

			$this->form_validation->set_rules('username', 'username', 'trim|required|callback_check_usernamecheck|callback_check_usernameHasSpace');
			$this->form_validation->set_rules('firstname', 'firstname', 'trim|required|alpha');
			$this->form_validation->set_rules('lastname', 'lastname', 'trim|required|alpha');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_check_emailcheck');
			$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('user_role', 'user_role', 'trim|required');

			if ($this->form_validation->run() == FALSE){

				$this->users();


			}else{

				$data = array(
					'username'=>$this->input->post("username"),
					'firstname'=>$this->input->post("firstname"),
					'lastname'=>$this->input->post("lastname"),
					'email'=>$this->input->post("email"),
					'password'=>md5($this->input->post("password")),
					'role_id'=>$this->input->post("user_role")
					);	

				$response=$this->UserModel->add_users($data);

				if ($response!=false) { 

					$this->session->set_flashdata('UsersAddMsg','<div class="alert alert-success">User successfully been added!</div>');
					redirect('UserProcess/users'); 

				}else{ 

					$this->session->set_flashdata('UsersAddMsg','<div class="alert alert-danger">User could not be added.</div>');
					redirect('UserProcess/users');	
				}	

			}

		}else{

			redirect(base_url()."index.php/UserProcess/users",'refresh');
		}
	}

	public function edit_user(){
		if(isset($this->session->userdata['admin_logged_in']))
		{	
			$id = $this->uri->segment(3);
			$data=array();
			if($query = $this->UserModel->get_user_roles())  
				{ $data['user_roles'] = $query; }
			if($query_users = $this->UserModel->get_users())  
				{ $data['all_users'] = $query_users; }
			if($query_usersid= $this->UserModel->get_usersbyid($id))  
				{ $data['userbyid'] = $query_usersid; }

			$this->load->view('header');
			$this->load->view('edit_users',$data);
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	}

	public function update_users(){

		
		if(isset($_POST['btnsubmit'])){

			$id = $this->input->post("id");
			$user = $this->UserModel->get_usersbyid($id);
			if($user[0]->username != $this->input->post("username")){
				$this->form_validation->set_rules('username', 'username', 'trim|required|callback_check_usernamecheck|callback_check_usernameHasSpace');
			}
			else {
				$this->form_validation->set_rules('username', 'username', 'trim|required|callback_check_usernameHasSpace');

			}
			if($user[0]->email != $this->input->post("email")){
				$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_check_emailcheck');
			}
			else {
				$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
			}

			$this->form_validation->set_rules('firstname', 'firstname', 'trim|required|alpha');
			$this->form_validation->set_rules('lastname', 'lastname', 'trim|required|alpha');
			$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('user_role', 'user_role', 'trim|required');



			if ($this->form_validation->run() == FALSE){
				redirect("UserProcess/edit_user/". $id);
				
			}
			else {
				$data = array(
					'username'=>$this->input->post("username"),
					'firstname'=>$this->input->post("firstname"),
					'lastname'=>$this->input->post("lastname"),
					'email'=>$this->input->post("email"),
					'password'=>$this->input->post("password"),
					'role_id'=>$this->input->post("user_role")
					);	
				$response=$this->UserModel->update_users($id,$data);

				if ($this->db->affected_rows() > 0)

				{ 
					$this->session->set_flashdata('UsersAddMsg','<div class="alert alert-success">User details have successfully been changed!</div>');
					redirect('UserProcess/users');
				}

				else 
					{ $this->session->set_flashdata('UsersAddMsg','<div class="alert alert-danger">User Detils could not be changed.</div>');
				redirect('UserProcess/users');	 }
			}
		}
	}

	public function delete_users($id){
		$this->db->where('id',$id);
		$this->db->delete('users');
		redirect('UserProcess/users');	
	}	


// ROLE MANAGEMENT

	public function roles(){	
		if(isset($this->session->userdata['admin_logged_in'])){



			$data=array();
			if($query = $this->UserModel->get_user_roles())  
				{ $data['user_roles'] = $query; }
			$this->load->view('header');
			$this->load->view('role_manage',$data);
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	}

	public function add_role(){
		if(isset($this->session->userdata['admin_logged_in'])){

			if(isset($_POST['btnsubmit'])){

				$this->form_validation->set_rules('role', 'role', 'trim|required|alpha|callback_check_RoleExists');

				if ($this->form_validation->run() == FALSE){

					$this->roles();


				}else{


					$data = array('role'=>$this->input->post("role"));	
					$response=$this->UserModel->add_role($data);

					if ($response!=false) { 

						$this->session->set_flashdata('roleAddMsg','<div class="alert alert-success">New Role Has Successfully been added!</div>');
						redirect('UserProcess/roles'); 

					}else{ 

						$this->session->set_flashdata('roleAddMsg','<div class="alert alert-danger">Role could not be added.</div>');
						redirect('UserProcess/roles');	
					}	

				}

			}else{

				redirect(base_url()."index.php/UserProcess/roles",'refresh');
			}	


		}
		else{
			$this->load->view('login');	
		}
	}

	public function edit_roles(){	
		if(isset($this->session->userdata['admin_logged_in']))
		{
			$id = $this->uri->segment(3);
			$data = array();

			if($query1 = $this->UserModel->get_role_byid($id))
			{
				$data['roledata'] = $query1;	
			}
			if($query = $this->UserModel->get_user_roles())  
				{ $data['user_roles'] = $query; }

			$this->load->view('header');
			$this->load->view('edit_role',$data);
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	}

	public function update_role(){
		if(isset($this->session->userdata['admin_logged_in']))
		{	
			$roleid=$this->input->post("id");
			$data = array(
				'role'=>$this->input->post("role")

				);	
			$this->UserModel->update_role($roleid,$data);
			if ($this->db->affected_rows() > 0) { ?> <script>alert("Role updated Successfully");</script><?php redirect('UserProcess/roles'); }
			else { echo "<h1 style=\"color:red\">Oops Query Problem......!!!!</h1>"; }
		}
		else{
			$this->load->view('login');	
		}
	}

	public function delete_roles($id){
		$this->db->where('id',$id);
		$this->db->delete('user_roles');
		redirect('UserProcess/roles');	
	}

	public function check_usernamecheck($username){

		$response=$this->UserModel->UserNameExsist($username); 

		if($response!=false){ 

			return TRUE;

		}
		else{

			$this->form_validation->set_message('check_usernamecheck', 'User Name Already Exsists');

			return false;

		}

	}
	public function check_usernameHasSpace($username){


		if (strpos($username, ' ') > 0) { 

			$this->form_validation->set_message('check_usernameHasSpace', 'Space Not allowed!!!');

			return false;

		}
		else{

			return TRUE;

		}

	}	

	public function check_emailcheck($email){

		$response=$this->UserModel->EmailExsist($email); 

		if($response!=false){

			return TRUE;

		}
		else{

			$this->form_validation->set_message('check_emailcheck', 'Email Already Exsists');

			return false;

		}

	}

	public function check_RoleExists($role){

		$response=$this->UserModel->RoleExsist($role); 

		if($response!=false){

			return TRUE;

		}
		else{

			$this->form_validation->set_message('check_RoleExists', 'role Already Exsists');

			return false;

		}

	}

}








