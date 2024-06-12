$(function(){
	$('.tab-body').eq(0).show();
	$('.tab-item').on('click', function(){
		$('.active-tab').removeClass('active-tab');
		$(this).addClass('active-tab');

		var item = $('.active-tab').index();
		$('.tab-body').hide();
		$('.tab-body').eq(item).show();
	});

	$('#search').on('focus', function(){
		$(this).animate({'width':'240px'});
	});
	$('#search').on('blur', function(){
		if($(this).val() == ''){
			$(this).animate({'width':'100px'});
		}
		setTimeout(function(){
			$('.searchResults').hide();
		}, 500);
		
	});
	$('#search').on('keyup', function(){
		var type = $(this).attr('data-type');
		var q = $(this).val();

		$.ajax({
			url:BASE_URL+'/ajax/'+type,
			type:'POST',
			data:{q:q},
			dataType:'json',
			success:function(json){
				if($('.searchResults').length == 0){
					$('#search').after('<div class="searchResults"></div>');
				}
				
				var lf = $('#search').offset().left;
				$('.searchResults').css('left', lf+'px');
				var tp = $('#busca').height()+34;	
				$('.searchResults').css('top', $('#search').offset().top+tp+'px');

				var html = '';
				for(var i in json){
					html += '<div class="si"><a href="'+json[i].link+'">'+json[i].name+'</a></div>';
				}
				
				$('.searchResults').html(html);
				$('.searchResults').show();
			}
		});
	});
});