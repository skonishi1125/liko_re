$(document).ready(function(){
	$('.openCommentModal').click(function(){
		$('.modal-background').show();
		$('.tweetModal-wrapper').show();
	});

	$('.closeBtn').click(function(){
		$('.modal-background').hide();
		$('.tweetModal-wrapper').hide();
		$('.searchModal-wrapper').hide();
		$('.imgModal-wrapper').hide();
		$('.configModal-wrapper').hide();
	});

	$('.openSearchModal').click(function(){
		$('.modal-background').show();
		$('.searchModal-wrapper').show();
	});

	$('.openImgModal').click(function(){
		$('.modal-background').show();
		$(this).addClass("imgModal-container");
	});

	$('.openConfigModal').click(function(){
		$('.modal-background').show();
		$('.configModal-wrapper').show();
	});

	$('.modal-background').click(function(){
		$('.contentImg').removeClass("imgModal-container");
		$('.modal-background').hide();
		$('.tweetModal-wrapper').hide();
		$('.searchModal-wrapper').hide();
		$('.configModal-wrapper').hide();
	});


});

$(function(){

	/*画面のスクロール*/
	/*
	$('.back-to-top').each(function(){
		var el = scrollableElement('html','body');

		$(this).on('click',function(event){
			event.preventDefault();
			$(el).animate({ scrollTop: 0 }, 250);
		});

	});

	function scrollableElement(){
		var i, len, el, $el, scrollable;
		for(i = 0, len = arguments.length; i < len; i++){
			el = arguments[i],
			$el = $(el);
			if($el.scrollTop() > 0){
				return el;
			} else {
				$el.scrollTop(1);
				$scrollable = $el.scrollTop() > 0;
				$el.scrollTop(0);
				if(scrollable) {
					return el;
				}
			}
		}
		return [];
	}
	*/

});