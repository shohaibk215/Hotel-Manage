<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
	  
// Manage Users
	
	public function get_users(){
		$query = $this->db->query("select * from users");
		return $query->result();
	}
	public function get_usersbyid($id){
		$query = $this->db->query("select * from users where id=".$id);
		return $query->result();
	}
	
	public function add_users($data){
		
		$result=$this->db->insert('users',$data);
		return $result;
	}
	public function update_users($id,$data){
		$this->db->where('id',$id);
		$result=$this->db->update('users',$data);
		return $result;
	}	

// Manage Roles
	
	public function get_user_roles(){
		$query = $this->db->query("select * from user_roles");
		return $query->result();
		}
	public function get_role_byid($id){
		$query = $this->db->query("select * from user_roles where id=".$id);
		return $query->result();
		}

	public function add_role($data){
		$result=$this->db->insert('user_roles',$data);
		return $result;
	}	

	public function update_role($id,$data){
		$this->db->where('id',$id);
		$this->db->update('user_roles',$data);
	}

// Checking 	

	public function UserNameExsist($UserName){
		
		$this->db->where(array('username'=>$UserName));
		
		$result=$this->db->get('users');

		if($result->num_rows()>0){

			return false;

		}else{

			return true;
		}

	}

	public function EmailExsist($Email){
		
		$this->db->where(array('email'=>$Email));
		
		$result=$this->db->get('users');

		if($result->num_rows()>0){

			return false;

		}else{

			return true;
		}
	}


	public function RoleExsist($Role){
		
		$this->db->where(array('role'=>$Role));
		
		$result=$this->db->get('user_roles');

		if($result->num_rows()>0){

			return false;

		}else{

			return true;
		}
	}

	public function CheckingUserRoleById($UserId){
		
		$Sql="SELECT * from users inner join user_roles as rol on rol.id=users.role_id where users.id='".$UserId."'";
		
		$result=$this->db->query($Sql);

		if($result->num_rows()>0){

			$row=$result->row_array();			
			return $row['role'];
		}else{

			return false;
		}
	}
	
}