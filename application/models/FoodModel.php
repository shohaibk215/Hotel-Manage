<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FoodModel extends CI_Model {

// Manage foods
	
	public function get_all_foods(){
		
		$query = $this->db->query("SELECT * from foods where status = '1' order by id desc");
		
		if($query->num_rows()>0){

			return $query->result_array();

		}else{

			return false;
		}
		
	}

	public function get_foodbyid($id)
	{
		$query = $this->db->query("select * from foods where id=".$id);
		return $query->result();
	}
	
	public function add_foods($data)
	{
		$response = $this->db->insert('foods',$data);
		return $response;
	}

	public function update_foods($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('foods',$data);
	}


public function FoodAlreadyExsist($FoodName){
		
		$this->db->where(array('name'=>$FoodName));
		
		$result=$this->db->get('foods');

		if($result->num_rows()>0){

			return false;

		}else{

			return true;
		}
	}	

}