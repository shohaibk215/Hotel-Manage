var transaction=function(){

	var alltransaction=function(id){

		
		$.ajax({


				url:base_url+'index.php/OrderProcess/transactiondetails',
				type:'POST',
				data:{'id':id},
				dataType:'json',
				success:function(data){
					
				$('#RentalDetailstbody').empty();
				$('#FoodDetailsTbody').empty();
				$('#GrandTotalTbody').empty();
				var TotalForStay=0;
				var TotalForFood=0;
				var Deposite=0;
				var GRANDTOTAL=0;	
				if(data!=false){
					
					TotalForStay=data[0]['total_amount'];
					Deposite=data[0]['PaidAmount'];

					var row="<tr>"+
				              	"<td>"+data[0]['total_amount']+"</td>"+
				              	"<td>"+data[0]['PaidAmount']+"</td>"+
				              	"<td>"+(data[0]['total_amount'] - data[0]['PaidAmount'])+"</td>"+
				              	"<td>"+data[0]['datetime']+"</td>"+
				              "</tr>";

					$(row).appendTo('#RentalDetailstbody');
					
					if(data.length>1){

						$.each(data,function(index,key){

							var row="<tr>"+
				              	"<td>"+key['name']+"</td>"+
				              	"<td>"+key['quantity']+"</td>"+
				              	"<td>"+key['price']+"</td>"+
				              	"<td>"+(key['price'] * key['quantity'])+"</td>"+
				              	"<td>"+key['food_datetime']+"</td>"+
				              "</tr>";
				             TotalForFood=TotalForFood+(key['price'] * key['quantity']);
							$(row).appendTo('#FoodDetailsTbody');

						}); 

					}else{

						var row="<tr>"+
				              	"<td>No Food Orders Found</td>"+
				              "</tr>";

						$(row).appendTo('#FoodDetailsTbody');


					}

				var row	="<tr>"+
			             	"<td>"+TotalForStay+"</td>"+
			             	"<td>"+TotalForFood+"</td>"+
			             	"<td>"+Deposite+"</td>"+
			             	"<td>"+(parseInt(TotalForStay)+parseInt(TotalForFood))+"</td>"+
			             	"<td>"+(parseInt(TotalForStay)+parseInt(TotalForFood)-Deposite)+"</td>"+
		             	"</tr>";
		        $(row).appendTo('#GrandTotalTbody');     	
					$('#AllTRactionModel').modal({
        				
        				show: 'false'
    				
    				});
				}	

			}
		});
	}

return{

	init:function(){

		this.BindUi();
	},
	BindUi:function(){

		$('.Transactiondetails').on('click',function(){

			var id=$(this).data('id');
			alltransaction(id);
		});
	}

};
}; 
var transaction= new transaction();
transaction.init();
	