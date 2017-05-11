<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends CI_Model {

// Manage foods
	
public function GetRentalBillingAgainst($id){
	
	$query = $this->db->query("SELECT  rooms.room_number, reservation.checkin_date,reservation.checkout_date,transaction.total_amount,transaction.PaidAmount from transaction 
		inner join reservation on reservation.id=transaction.reservation_id
		inner join rooms on rooms.id=reservation.roomid
		where transaction.reservation_id='".$id."';");
	
	if($query->num_rows()>0){

		return $query->result_array();

	}else{

		return false;
	}
}

public function GetFoodBillingAgainst($id){
		
		$query = $this->db->query("SELECT foods.name,foodorders.ReservationID,foodorders.quantity,foodorders.price,foodorders.datetime from foodorders
									inner join foods on foods.id=foodorders.FoodID 
									where foodorders.ReservationID='".$id."'");
		
		if($query->num_rows()>0){

			return $query->result_array();

		}else{

			return false;
		}
	}
	
}