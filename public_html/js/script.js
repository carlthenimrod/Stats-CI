$(function(){
	
	$(window).on('load', function(){

		$('.week').each(function(){

			var sibiling = $(this).siblings();

			if($(this).height() < sibiling.height()){

				$(this).height(sibiling.height());
			}
		});
	});
});