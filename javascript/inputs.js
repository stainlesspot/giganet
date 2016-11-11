$(document).ready(function (){
	/*$('.login input[type=submit]').on('click', function (event) {
		event.preventDefault();
		$(this).parent('form').addClass('activated')
	});*/
	$('html').on('click', function (event){
		var target = $(event.target);
		if(target.is('.search-button') || target.parents().is('.search-button')){
			var searchElement = $('.search');
			searchElement.addClass('activated');
			setTimeout(function(){
				searchElement.children().focus();
			}, 400);
		}
		else if(!(target.is('.search') || target.parent().is('.search')))
			$('.search').removeClass('activated');
	}).on('click', function (event){
		var target = $(event.target);

		if(target.is('.login input[type=submit]')){
			if(target.parent().is('.login.activated')){
			}
			else{
				event.preventDefault();
				target.parent().removeClass('no-animation')
							   .addClass('activated');
				pendingRule = setTimeout(function (){
					$('.login .wrapper').css('overflow', 'visible');
				}, 1000);
			}
		}
		else if(!(target.is('.login') || target.parents().is('.login'))) {
			$('.login').removeClass('activated');
			$('.login .wrapper').css('overflow', 'hidden');
			clearTimeout(pendingRule);

		}

	})
	;
});