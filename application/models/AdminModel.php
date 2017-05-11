<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {

// Login verification and if verified then send result = true else false
     public function login($name,$password)
      {	
        $sql = "SELECT * FROM admin_login WHERE admin_name = '".$name."' and password = '".$password."'";
		$query = $this->db->query($sql);
		
// Store Procedure for verify user by username and password
        
        if ($query->num_rows() == 1) {
       		return $query->result();	   		
        } else {
        	return false;
	   		
        } 
	  }

// Login verification and if verified then send result = true else false
     public function receptlogin($name,$password)
      {	
      	$role="receptionist";
        $sql = "SELECT * FROM admin_login WHERE admin_name = '".$name."' and password = '".$password."' and role = '".$role."'";
		$query = $this->db->query($sql);
		
// Store Procedure for verify user by username and password
        
        if ($query->num_rows() == 1) {
       		return $query->result();	   		
        } else {
        	return false;
	   		
        } 
	  }	  
	  
//Admin Profile
	public function admin_profile(){
		$query = $this->db->get('admin_login');
		return $query->result();
	}
	public function edit_admin_profile_data($id,$data){
		$this->db->where('id',$id);
		$this->db->update('admin_login',$data);
	}
		 
//Change Password

	public function change_pwd($oldpass){
		$query = $this->db->get_where('admin_login',array('admin_password'=>$oldpass));
		return $query->result();
	}
	public function change($oldpass,$data){
			$this->db->where('admin_password',$oldpass);
			$this->db->update('admin_login',$data);
	}
	  
// Manage Users
	
	public function add_users($data){
		$this->db->insert('users',$data);
	}
	public function get_users(){
		$query = $this->db->query("select * from users");
		return $query->result();
		}
	
}