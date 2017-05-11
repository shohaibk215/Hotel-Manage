<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Model {

// Login verification and if verified then send result = true else false
 public function Userlogin($name,$password){

    $sql = "SELECT users.username,users.id,user_roles.role FROM users  
			inner join user_roles on user_roles.id=users.role_id 
			WHERE username = '".$name."' and password = '".$password."'";
	   $query = $this->db->query($sql);
	
// Store Procedure for verify user by username and password
    
    if ($query->num_rows() == 1) {

   		return $query->result();	   		
    
    } else {
    	
    	return false;
   		
    } 
  }
}