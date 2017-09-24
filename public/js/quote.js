$(document).on('click' , '.btn-like', function (){

	var _this = $(this);

	var _url = "/like/" + _this.attr('data-type')
				+"/"+ _this.attr('data-model-id');

	//console.log(_url);
	$.get(_url, function(data) {
		if (data == '0') {
				_this.next('.total_like').find('.like_warning').show().delay(600).fadeOut('slow');
		}else{
				_this.addClass('btn-danger').html('unlike');
				var likeNumber =_this.parents('.like_wrapper').find('.like_number');
				likeNumber.html(parseInt(likeNumber.html()) +1);
				 //console.log(data);
		}

	}); 

}); 