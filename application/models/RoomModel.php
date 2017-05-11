<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoomModel extends CI_Model {

// Manage Rooms
	
	public function get_all_rooms(){
		$query = $this->db->query("select * from rooms");
		return $query->result();
		}

	public function get_roomById($id){
		$query = $this->db->query("select * from rooms where id='".$id."'");
		
		if($query->num_rows()>0){

			return $query->row_array();

		}else{

			return false;
		}
	}	

	public function get_room_categories(){
		$query = $this->db->query("select * from room_categories");
		return $query->result();
		}

	public function get_room_categoriesById($id){
		$this->db->where('id',$id);
		$result=$this->db->get('room_categories');
		
		if($result->num_rows()>0){

			return $result->row_array();

		}else{

			return false;
		}
	}	
			
	public function add_rooms($data){
		$result=$this->db->insert('rooms',$data);
		return $result;
	}

	public function add_room_categories($data){

		$this->db->where(array('id'=>$data['id']));
		
		$result=$this->db->get('room_categories');
		if($result->num_rows()>0){

			$row=$result->row_array();			
			$response=$this->update_room_categories($row['id'],$data);

		}else{

			$response=$this->db->insert('room_categories',$data);
			
		}

		return $response;
		
	}

	public function update_room_categories($id,$data){
		$this->db->where('id',$id);
		$result=$this->db->update('room_categories',$data);
		return $result;
	}
	public function update_rooms($id,$data){
		$this->db->where('id',$id);
		$this->db->update('rooms',$data);
	}

	public function delete_room($id){
		
		$this->db->where('id',$id);
		$result=$this->db->delete('rooms');

		return $result;
	}

	public function delete_categories($id){
		
		$this->db->where('id',$id);
		$result=$this->db->delete('room_categories');

		return $result;
	}

	
	public function CheckingRoomAlreadyExsist($RoomNo){
		
		$this->db->where(array('room_number'=>$RoomNo));
		
		$result=$this->db->get('rooms');

		if($result->num_rows()>0){

			return false;

		}else{

			return true;
		}
	}

	public function CategoryAlreadyExsist($CategoryName){
		
		$this->db->where(array('category'=>$CategoryName));
		
		$result=$this->db->get('room_categories');

		if($result->num_rows()>0){

			return false;

		}else{

			return true;
		}
	}	

	public function GetRoomPriceByReservationId($id){

		$result=$this->db->query("SELECT reservation.checkin_date,reservation.checkout_date,reservation.id,room_categories.price from reservation
						inner join rooms on rooms.id=reservation.roomid 
						inner join room_categories on room_categories.id=rooms.category_id 
						where reservation.id='".$id."';");

		if($result->num_rows()>0){

			return $result->result_array();

		}else{

			return false;
		}

	}
}