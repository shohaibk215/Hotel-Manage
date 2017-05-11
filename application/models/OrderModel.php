<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModel extends CI_Model {

// Manage foods
	
	public function get_all_foods(){
		
		$query = $this->db->query("SELECT * from foods where status = '1' order by id desc");
		
		if($query->num_rows()>0){

			return $query->result_array();

		}else{

			return false;
		}
	}
	
	public function get_all_users()
	{
		$query = $this->db->query("SELECT reservation.id,reservation.name,rooms.room_number from reservation
									inner join rooms on rooms.id=reservation.roomid 
									where reservation.`status`=2 and reservation.history=0;");
		if($query->num_rows()>0){

			return $query->result_array();

		}else{
			
			return false;

		}
		
	}
	
	public function get_all_orders()
	{
		$query = $this->db->query("select * from `foodorders` order by id desc");

		if($query->num_rows()>0){

			return $query->result_array();

		}else{
			
			return false;
		}
	}
	
	public function add_order($data){

		$result="";
		foreach ($data as $key => $value) {

			$result=$this->db->insert('foodorders',$value);
			
		}
		
		return $result;
	}

	public function GetOrderDeailsByReservationId($Id){
		
		$Sql="SELECT foods.name as name,foodorders.quantity as quantity ,foodorders.price as price ,foodorders.datetime as datedetails  from foodorders 
				inner join foods on foods.id=foodorders.FoodID 
				where foodorders.ReservationID='".$Id."';";
		
		$result=$this->db->query($Sql);
		
		if($result->num_rows()>0){

			return $result->result_array();

		}else{

			return false;
		}
	}

	
}