$(function(){
	$('input[name=price]').mask('000.000.000.000.000,00', {reverse:true, placeholder:'0,00'});
	$('#search_name').on('keyup', function(){
		var type = $(this).attr('data-type');
		var q = $(this).val();

		$.ajax({
			url:BASE_URL+'/ajax/'+type,
			type:'POST',
			data:{q:q},
			dataType:'json',
			success:function(json){
				if($('.searchResults').length == 0){
					$('#search_name').after('<div class="searchResults"></div>');
				}
				
				var lf = $('#search_name').offset().left;
				$('.searchResults').css('left', lf+'px');
				var tp = $('#busca').height()+34;	
				$('.searchResults').css('top', $('#search_name').offset().top+tp+'px');

				var html = '';
				for(var i in json){
					html += '<div class="si"><a href="javascript:;" onclick="selectReseller(this)" data-id="'+json[i].id+'">'+json[i].name+'</a></div>';
				}
				
				$('.searchResults').html(html);
				$('.searchResults').show();
			}
		});
	});

	$('.reseller_add_button').on('click', function(e){
		e.preventDefault();
		var name = $('#search_name').val();
		if(name != '' && name.length >= 4){
			if(confirm('Deseja adicionar '+name+'?')){
				$.ajax({
					url:BASE_URL+'/ajax/addReseller',
					type:'POST',
					data:{name:name},
					dataType:'json',
					success:function(json){
						$('.searchResults').hide(); 
						$('.reseller_id').val(json.id);
					}
				});
				return false;
			}
		}
	});

	$('#add_product').on('keyup', function(){
		var type = $(this).attr('data-type');
		var q = $(this).val();
		if(q==0) $('.searchResults').hide();

		$.ajax({
			url:BASE_URL+'/ajax/'+type,
			type:'POST',
			data:{q:q},
			dataType:'json',
			success:function(json){
				if($('.searchResults').length == 0){
					$('#add_product').after('<div class="searchResults"></div>');
				}
				
				var lf = $('#add_product').offset().left;
				$('.searchResults').css('left', lf+'px');
				var tp = $('#busca').height()+34;	
				$('.searchResults').css('top', $('#add_product').offset().top+tp+'px');

				var html = '';
				if(json != ''){
					html += '<div class="si"><a href="javascript:;" onclick="addProduct(this)" data-name="'+json.name+'" data-price="'+json.price+'" data-id="'+json.id+'">'+json.name+' - R$'+json.price+'</a></div>';
					$('.searchResults').html(html);
					$('.searchResults').show();
				}
			}
		});
	});
});


function selectReseller(obj){
	var id = $(obj).attr('data-id'); 
	var name = $(obj).html(); 
	$('.searchResults').hide();
	$('#search_name').val(name);
	$('.reseller_id').val(id);
}

function addProduct(obj){
	$('#add_product').val('');
	var id = $(obj).attr('data-id');
	var name = $(obj).attr('data-name');
	var price = $(obj).attr('data-price');

	$('.searchResults').hide();

	if(  $('input[name="quant['+id+']"').length == 0  ){
		var tr = '<tr><td>'+name+'</td><td class="td-quant"><a href="javascript:;"><input type="number" name="quant['+id+']" class="prod_q" data-price="'+price+'" onchange="updateSub(this)" value="1"/></td><td>R$'+price+'</td><td class="subtotal">'+price+'</td><td><a href="javascript:;" onclick="deleteProd(this)">Excluir</a></td></tr>';
		$('#products-table').append(tr);
	}
	updateTotal();
}

function updateSub(obj){
	var quant = $(obj).val();
	if(quant <= 0) $(obj).val(1);
	var price = $(obj).attr('data-price');
	var subtotal = price * quant;
	if(subtotal < price) subtotal = price;
	$(obj).closest('tr').find('.subtotal').html('R$'+subtotal);	
	updateTotal();
}

function updateTotal(){
	var total = 0;
	for(var i=0; i<$('.prod_q').length; i++){
		var quant = $('.prod_q').eq(i);
		var price = quant.attr('data-price');
		var sub = price * parseInt(quant.val());
		total += sub;
	}
	$('#price').val(total);
}

function deleteProd(obj){
	$(obj).closest('tr').remove();
}