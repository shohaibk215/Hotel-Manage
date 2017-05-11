var Checkin=function(){

	var CheckIN=function(id){

		
		$.ajax({


				url:base_url+'index.php/BookReserve/GetBillingDetails',
				type:'POST',
				data:{'id':id},
				dataType:'json',
				success:function(data){
					
				if(data!=false){
						
					$('#TotalPrice').val(data.TotalPrice);
					$('#ReservationId').val(data.ReservationID);
					$('#CheckinModel').modal({
        			show: 'false'
    				}); 

					//console.log(data);
						// alert(data['TotalPrice']);

				}else{


				}
			}
		});
	}

return{

	init:function(){

		this.BindUi();
	},
	BindUi:function(){

		$('.CheckinBtn').on('click',function(){
			
			var id=$(this).data('checkinid');
		
				CheckIN(id);
			
		});

		$('#Deposite').on('input',function(){

				var Deposite=$(this).val();
				var TotalPrice=$('#TotalPrice').val();

				if(Deposite<=TotalPrice){

					$('#Balnace').val(TotalPrice-Deposite);

					
				}else{

					$('#Balnace').val("");
						
				}

		});

		$('#CheckOutDeposite').on('input',function(){

				var Deposite=$(this).val();
				var AmountToPaid=$('#AmountToPaid').val();

				if(Deposite<=AmountToPaid){

					$('#CheckoutBalnace').val(AmountToPaid-Deposite);

					
				}else{

					$('#CheckoutBalnace').val("");
						
				}

		});
		

	}

};
}; 
var Checkin= new Checkin();
Checkin.init();
	