<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookReserveModel extends CI_Model {

	public function get_rooms(){
		$query = $this->db->query("select * from rooms");
		
		if($query->num_rows()>0){

			return $query->result();

		}else{
			
			false;
			
		}
		
	}
	public function get_available_rooms($Checkindate,$CheckOutdate,$roomCapicity){
		
		
		$result_reservation=$this->db->get('reservation');
		
		if($result_reservation->num_rows()>0){

			$query = $this->db->query("SELECT  rooms.id as id, rooms.room_number as name ,room_categories.category as categoryname,room_categories.price as price 	FROM rooms
			inner join room_categories on room_categories.id=rooms.category_id 
			where rooms.id not in (SELECT res.roomid FROM reservation as res 
			WHERE ('".$Checkindate."' between  checkin_date and checkout_date  ) or ('".$CheckOutdate."' between  checkin_date and checkout_date)) 
			and rooms.capacity >= '".$roomCapicity."';
			");

				if($query->num_rows()>0){
					
					return $query->result_array();

				}else{

					return false;					
					
				}	

		}else{


			$query = $this->db->query("SELECT rooms.id as id ,rooms.room_number as name,
				room_categories.category as categoryname,
				room_categories.price as price from rooms 
				inner join room_categories on room_categories.id=rooms.category_id ;");

			if($query->num_rows()>0){

				return $query->result_array();

			}else{
				
				false;
				
			}

		}


		
		
	}			

	public function reserved_guests(){
		
		$query = $this->db->query("SELECT rooms.room_number,reservation.name,reservation.address,reservation.email,reservation.telephone,reservation.number_people,
			reservation.card_details,reservation.checkin_date,reservation.checkout_date,reservation.id 
			from reservation 
			inner join rooms on rooms.id=reservation.roomid
			where reservation.status='1'; 
			");
		if($query->num_rows()>0){

			return $query->result_array();
			
		}else{

			return false;

		}

	}

	public function AlreadyChecking_Guests(){
		
		$query = $this->db->query("SELECT rooms.room_number,reservation.name,reservation.address,reservation.email,reservation.telephone,reservation.number_people,
			reservation.card_details,reservation.checkin_date,reservation.checkout_date,reservation.id 
			from reservation 
			inner join rooms on rooms.id=reservation.roomid
			where reservation.status='2' and reservation.history='0'; 
			");
		if($query->num_rows()>0){

			return $query->result_array();
			
		}else{

			return false;

		}

	}
	public function add_reservation($data){
		
		$result=$this->db->insert('reservation',$data);
		return $result;
	}
	public function CancleReservation($id){

		$this->db->where(array('id' => $id));
		$result=$this->db->delete('reservation');
		return $result;
	}
	public function checkout_guests(){
		$query =  $this->db->query("select * from reservation where checkout_date=CURDATE()"); 
		return $query->result();
	}

	public function AddReservationToHistry($ReservationId){
		
		$this->db->where(array('id' => $ReservationId));
		$result=$this->db->get('reservation');

		if($result->num_rows()>0){

			$this->db->where(array('id' => $ReservationId));
			$resultUp=$this->db->update('reservation',array('history'=>1));
			return $resultUp;

		}else{


		}
	}

	public function GetMaxId(){
		
		$Sql="SELECT  Max(id) AS MAXID from reservation";
		
		$result=$this->db->query($Sql);

		if($result->num_rows()>0){

			$row=$result->row_array();			
			return $row['MAXID'] + 1;
		}else{

			return false;
		}

	}
	
}