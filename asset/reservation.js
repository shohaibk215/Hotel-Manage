var reservation=function(){

	var CheckingAvalibleRooms=function(checkindate,checkoutdate,Capicity){

		
		$.ajax({


				url:base_url+'index.php/BookReserve/get_available_rooms',
				type:'POST',
				data:{'checkin_date':checkindate,'checkout_date':checkoutdate,'Capicity':Capicity},
				dataType:'json',
				success:function(data){
					
				if(data!=false){
					
					$('#room').show();
					$('#room').empty();


						var row="<option value='' selected='' disabled=''>Room.NO | Category | Price</option>";
						$(row).appendTo('#room');

					$.each(data,function(index,key){
						
						var row="<option value=" +key.id+" data-roomprice="+key.price+">"+key.name+"&emsp; &emsp;&emsp;"+ key.categoryname+"&emsp; "+key.price+"</option>";
						$(row).appendTo('#room');

					});

				}else{


				}
			}
		});

	}

	var DepositePayment=function(TotalPrice,Deposite,ReservationId){

		
		$.ajax({


				url:base_url+'index.php/BookReserve/DepositePayment',
				type:'POST',
				data:{'TotalPrice':TotalPrice,'Deposite':Deposite,'ReservationId':ReservationId},
				dataType:'json',
				success:function(data){
					
					if(data==true){

						$('#PaymentModel').modal('hide');
						$('.Payment').hide();
		 		$('.submitbtn').removeAttr('disabled');
					
					}
				// alert(data);
			}
		});

	}
		var parseDate=function(str) {
		    
		    var mdy = str.split('-');
		    return new Date(mdy[2], mdy[0]-1, mdy[1]);
		
		}

		var daydiff=function(first, second) {
		    
		    return Math.round((second-first)/(1000*60*60*24));
		
		}

return{

	init:function(){

		this.BindUi();
	},
	BindUi:function(){

		$('.CheckAvalbilty').on('click',function(){
			
			var checkin_date=$('.checkin_date').val();
			var checkout_date=$('.checkout_date').val();
			var Capicity=$('#Capicity option:selected').val();

			if(checkin_date!="" && checkout_date!="" && Capicity!=""){

				CheckingAvalibleRooms(checkin_date,checkout_date,Capicity);
			
			}else{

				alert("Please Check that Dates Are Selected!!!!!!!!!!!");
			}
			
		});

		 $('.checkin_date').datepicker({ 
		  
		    format: "yyyy-mm-dd",
      		startDate: CurrentDate,
      		minDate: CurrentDate
		  
		  });

		 $('.checkin_date').val(CurrentDate);

		 $('.checkin_date').on('change',function(){

		 	var Checking=$('.checkin_date').val();

		 	if(Checking==CurrentDate){

			 	$('#Typestatus').val(2);
		 	
		 	}else{

		 		$('#Typestatus').val(1);

		 	}

		 	if($('#Typestatus option:selected').val()==2){

			 $('.submitbtn').attr('disabled',true);	
			 $('.Payment').show();			 	
		 	}else{

		 		$('.Payment').hide();
		 		$('.submitbtn').removeAttr('disabled');	

		 	}		 

		 });

		
		 $('.submitbtn').attr('disabled','true');	

			 

		 $('#Typestatus').val(2);
		 
		 $('.checkin_date').on('change',function(){

		 	var Checking=$('.checkin_date').val();

		 	$('.checkout_date').datepicker({ 
		  
			    format: "yyyy-mm-dd",
	      		startDate: Checking,
	      		minDate: Checking
		  
		  	});
		 });




		 $('.Payment').on('click',function(){

		 	var roomprice=$('#room option:selected').data('roomprice');

		 	if(roomprice!="" && roomprice!=undefined){

		 		$('#ReservationId').val($('#MaxId').val());
				$('#RoomPrice').val(roomprice);
				$('#CiDate').val($('.checkin_date').val());
				$('#CoDate').val($('.checkout_date').val());
				
				var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
				var firstDatemdy = $('#CiDate').val().split('-');
				var secondDatemdy = $('#CoDate').val().split('-');
				var firstDate = new Date(firstDatemdy[0],firstDatemdy[1],firstDatemdy[2]);
				var secondDate = new Date(secondDatemdy[0],secondDatemdy[1],secondDatemdy[2]);
				var diffDay = Math.round(Math.abs(firstDate.getTime() - secondDate.getTime())/(oneDay));
				
				TotalAmount=diffDay*$('#RoomPrice').val();

				$('#TotalPrice').val(TotalAmount);				 		
		 		
		 		$('#PaymentModel').modal({
        				
        			show: 'false'
    				
    			});	
		 	}
		 		
		 });

		 $('#DepositePayment').on('click',function(){

		 	var TotalPrice= $('#TotalPrice').val();
		 	var Deposite= $('#Deposite').val();
		 	var ReservationId= $('#ReservationId').val();
		 	DepositePayment(TotalPrice,Deposite,ReservationId);
		 });
		 
	}

};
}; 
var reservation= new reservation();
reservation.init();
	