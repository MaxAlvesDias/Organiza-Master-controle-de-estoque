$(function(){
	$('#address_zipCode').on('blur', function(){
		var cep = $(this).val();
		$.ajax({
			url:'http://api.postmon.com.br/v1/cep/'+cep,
			type:'GET',
			dataType:'json',
			success:function(json){
				if(typeof json.logradouro != 'undefined'){
					$('#address').val(json.logradouro); 
					$('#address_neighborhood').val(json.bairro);
					$('#address_city').val(json.cidade);
					$('#address_state').val(json.estado);
					$('#address_country').val('Brasil');
					$('#address_number').focus();
				}
			}
		});
	});
});

