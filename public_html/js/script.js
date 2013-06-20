$(function(){

	var oldClubName;

	// *** Functions ***
	var closeOpen = function(){

		var openInput, nameCol;

		openInput = $('.stats').find('input[type="text"]');

		if(openInput.length > 0){

			nameCol = openInput.parents('td#club-name');
			
			//replace input box with text
			if(nameCol.length > 0) nameCol.html(oldClubName);
		}
	};

	// *** Events ***
	$('.stats tr').on('dblclick', function(){

		var clubName, id, form, nameCol;

		nameCol = $(this).find('#club-name');

		if(nameCol.find('input[type="text"]').length > 0){

			//replace input box with text
			nameCol.html(oldClubName);
		}
		else{

			//close any open inputs
			closeOpen();

			id = $(this).attr('id');

			//store club name
			clubName = nameCol.html();
			oldClubName = clubName;

			form = '<form method="post" action="clubs/edit?id='+ id +'">';
			form +=	'<input type="text" value="' + clubName + '" name="club-edit-name" />';
			form +=	'<input type="hidden" value="' + id + '" name="club-edit-id" />';
			form +=	'</form>';

			//replace with input box containing club name
			nameCol.html(form);
		}

	});

	//on esc press
	$(document).keyup(function(e) {

		if(e.keyCode == 27) closeOpen();
	});	
});