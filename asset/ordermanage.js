var ordermanage=function(){

	var OrderDetails=function(id){

		
		$.ajax({


				url:base_url+'index.php/OrderProcess/getOrderDetails',
				type:'POST',
				data:{'id':id},
				dataType:'json',
				success:function(data){
					
				if(data!=false){
						
					$('#tbodyDetails').find('tr').empty();
						
					$.each(data,function(index,key){

						var row="<tr>"+
								"<td>"+key.name+"</td>"+
			  					"<td class='Qty'>"+key.quantity+"</td>"+
			  					"<td class='Price'>"+key.price+"</td>"+
			  					"<td >"+key.datedetails+"</td>"+
			  				"</tr>";

			  			$(row).appendTo('#tbodyDetails');
			  				
					});
					
					$('#AllOrderModel').modal({
        				
        				show: 'false'
    				
    				});

				}else{


				}
			}
		});
	}


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
					$.each(data,function(index,key){
						
						var row="<option value="+key.id+">"+key.name+"&emsp; "+ key.categoryname+"&emsp; "+key.price+"</option>";
						$(row).appendTo('#room');

					});

				}else{


				}
			}
		});
	}

	var Save=function(data){

		
		$.ajax({

			url:base_url+'index.php/OrderProcess/add_order',
			type:'POST',
			data:{'Data':data},
			dataType:'json',
			success:function(data){
				
				if(data==true){

					alert("Added Successfully!!!!!!");
					location.reload();
				}	
				
			}
		});
	}

	var SaveObj=function(){

		
		var details=[];
		var d = new Date();
		var curr_date = d.getDate();
		var curr_month = d.getMonth();
		var curr_year = d.getFullYear();
		
		$('#tbody').find('tr').each(function(index,key){

			var obj={};
			obj.ReservationID=$(key).find(".ReservationID").text();
			obj.FoodID = $(key).find(".FoodID").text();
			obj.quantity= $(key).find(".qty").text();
			obj.price = $(key).find(".Price").text();
			obj.datetime= curr_date + "-" +curr_month 
		+ "-" + curr_year;
			details.push(obj);

		});

		return details;
			
	}

	var AppendToTable=function(data){

		var sr=$('#tbody').find('tr').length+1;

			var row =	"<tr>"+
				 	      	"<td class='ReservationID' style='display:none;'>"+data.ReservationID+"</td>"+
				 	      	"<td >"+data.FoodName+"</td>"+
				 	      	"<td class='FoodID' style='display:none;'>"+data.FoodID+"</td>"+
				 	      	"<td class='qty'>"+data.qty+"</td>"+
				 	      	"<td class='Price'>"+data.Price+"</td>"+
				 	      	"<td>"+data.qty*data.Price+"</td>"+
				 	      	"<td><button class='btn btn-default btn-edit ' style='margin-left:23px;'>edit</button></td>"+
				 	    
				 	    "</tr>"
				$(row).appendTo('#tbody'); 	    

			resetfileds();		
	}

	var GetObj=function(){

		 var obj={};

		 	obj.ReservationID	=	$('#ReservationID option:selected').val();
			obj.FoodName		=	$('#FoodID option:selected').text();
			obj.FoodID			=	$('#FoodID option:selected').val();
			obj.Price			=	$('#FoodID option:selected').data('price');
			obj.qty				=	$('#qty').val();

		return obj;	
	}

	var resetfileds=function(){

		$('#ReservationID').val("");
		$('#FoodID').val("");
		$('#qty').val("");
	}

	var validate=function(){

		 	var errorflag=false;

		 		var ReservationID 		=	$('#ReservationID');
				var FoodID 				=	$('#FoodID');
				var qty 				=	$('#qty');

				$('.error').removeClass('error');

				if(!ReservationID.val()){

					$(ReservationID).addClass('error');
					errorflag=true;
				}
				if(!FoodID.val()){

					$(FoodID).addClass('error');
					errorflag=true;
				}
				if(!qty.val()){

					$(qty).addClass('error');
					errorflag=true;
				}
				
				return errorflag;
		 		
		 }

		var editdetail=function(self){

			var ReservationID 		=	$(self).closest('tr').find('.ReservationID').text();
			var FoodID 	=	$(self).closest('tr').find('.FoodID').text();
			var qty =	$(self).closest('tr').find('.qty').text();
			
			// alert(ReservationID);
			$('#ReservationID').val(ReservationID);
			$('#FoodID').val(FoodID);
			$('#qty').val(qty);
			
			$(self).closest('tr').remove();

			var length=$('#tabletbody').find('tr').length;

				for (var i = 0; i <=length; i++) {
					
					$('#tabletbody').find('.sr').eq(i).text(i+1);
				
				};
				
		} 

return{

	init:function(){

		this.BindUi();
	},
	BindUi:function(){

		$("#btnsubmit").click(function(){

				var data=SaveObj();
				//alert(data.length);
				if(data.length>0){
					Save(data);	
				}else{

					alert("Please ");
				}
				
			
		});

		$("#addbtn").click(function(){

			var error=validate();
			var data =GetObj();
			if(!error){

				AppendToTable(data);

			}else{

				alert("Fill it correctly");
			}	
			
		});

		$('#tbody').on('click','.btn-edit',function(e){

			
			var data=GetObj();

			if(data.ReservationID!='' && data.FoodID !='' && data.qty !=''){

				alert("Correct The Error First!!");
			}
			else{

				editdetail(this);
			}
			
		});

		$('#tby1').on('click','.DetailsBtn',function(){

			var id=$(this).data('reservationid');
			// alert(id);
			OrderDetails(id);

		});


	}	
};
}; 
var ordermanage= new ordermanage();
ordermanage.init();
	