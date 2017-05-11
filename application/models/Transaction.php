<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Model {

	public function __construct(){
		
		parent::__construct();
		$this->load->model(array("FoodModel"));
 	
	}
	
	public function DepositePayment($data,$type){

		if($type=='Rental'){

			$result=$this->db->insert('transaction',$data);	
			
			if($result==true){

				$this->db->where(array('id'=>$data['reservation_id']));
				$Reservation=$this->db->update('reservation',array('status'=>2));
				return $Reservation;

			}
		}else{

			$result=$this->db->insert('transaction',$data);	
			
			if($result==true){

				$this->db->where(array('id'=>$data['reservation_id']));
				$Reservation=$this->db->update('reservation',array('status'=>2));
				return $Reservation;

			}
		}
		
	}

	public function GetAllComplatedTransction(){

				

		$Sql="SELECT rooms.room_number,reservation.name,reservation.id,reservation.telephone,reservation.roomid,reservation.checkin_date,reservation.checkout_date,reservation.`status`,reservation.history
			from reservation 
			inner join rooms on rooms.id=reservation.roomid
		 order by reservation.id DESC";

		$result=$this->db->query($Sql);		
		
		if($result->num_rows()>0){

			return $result->result_array();			
		}else{

			return false;
		}
	}

	public function GetTransctionDetailsByReservationID($id){

		
		$GetFoodsResponse=$this->GetFoodsByReservationID($id);

		if($GetFoodsResponse==true){

			$Sql="SELECT transaction.reservation_id as reservation_id ,transaction.id as id,transaction.total_amount as total_amount,transaction.PaidAmount as PaidAmount,transaction.datetime as datetime, foodorders.quantity as quantity,foodorders.price as price,foodorders.datetime as food_datetime ,foods.name as name from transaction 
				inner join foodorders on foodorders.ReservationID=transaction.reservation_id
				inner join foods on foods.id = foodorders.FoodID
				where transaction.reservation_id='".$id."';";

						$result=$this->db->query($Sql);		
						
						if($result->num_rows()>0){

							return $result->result_array();	
									
						}else{

							return false;
			}

		}else{

			$Sql="SELECT * from transaction where transaction.reservation_id='".$id."';";
			
				$result=$this->db->query($Sql);		
						
				if($result->num_rows()>0){

					return $result->result_array();	
							
				}else{

					return false;
			}
		}

	}
	
	public function GetFoodsByReservationID($id){


		$Sql="SELECT * from foodorders  where foodorders.ReservationID='".$id."';";

		$result=$this->db->query($Sql);		
		
		if($result->num_rows()>0){

			return true;			
		
		}else{

			return false;
		}
	}

}