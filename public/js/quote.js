$(document).on('click' , '.btn-like', function (){

	var _this = $(this);

	var _url = "/like/" + _this.attr('data-type')
				+"/"+ _this.attr('data-model-id');

	//console.log(_url);
	$.get(_url, function(data) {
		if (data == '0') {
				_this.next('.total_like').find('.like_warning').show().delay(600).fadeOut('slow');
		}else{
			console.log(data);

				_this.addClass('btn-danger btn-unlike').removeClass('btn-like').html('unlike');
				var likeNumber =_this.parents('.like_wrapper').find('.like_number');
				likeNumber.html(parseInt(likeNumber.html()) +1);
				 //console.log(data);
		}

	});

});

$(document).on('click' , '.btn-unlike', function (){

	var _this = $(this);

	var _url = "/unlike/" + _this.attr('data-type')
				+"/"+ _this.attr('data-model-id');

	//console.log(_url);
	$.get(_url, function(data) {

				_this.removeClass('btn-danger btn-unlike').addClass('btn-primary btn-like').html('like');
				var likeNumber =_this.parents('.like_wrapper').find('.like_number');
				likeNumber.html(parseInt(likeNumber.html()) -	1);
				 //console.log(data);


	});

});
