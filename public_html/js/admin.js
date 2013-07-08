$(function(){

	var oldClubName, oldGroupName;

	// *** Functions ***
	var closeOpenClub = function(){

		var openInput, nameCol;

		openInput = $('.stats').find('input[type="text"]');

		if(openInput.length > 0){

			nameCol = openInput.parents('#club-name');
			
			//replace input box with text
			if(nameCol.length > 0) nameCol.html(oldClubName);
		}
	};

	var closeOpenGroup = function(){

		var openInput, h3;

		openInput = $('.week h3').find('input[type="text"]');

		if(openInput.length > 0){

			h3 = openInput.parents('h3');
			
			//replace input box with text
			if(h3.length > 0) h3.html(oldGroupName);
		}
	};

	// *** Events ***
	$('.stats .stats-row').on('dblclick', function(){

		var clubName, id, divId, form, nameCol;

		nameCol = $(this).find('#club-name');

		if(nameCol.find('input[type="text"]').length > 0){

			//replace input box with text
			nameCol.html(oldClubName);
		}
		else{

			//close any open inputs
			closeOpenClub();

			divId = $('h2.division').attr('id');
			id = $(this).attr('id');

			//store club name
			clubName = nameCol.html();
			oldClubName = clubName;

			form = '<form method="post" action="clubs/edit?id='+ id +'">';
			form +=	'<input type="text" value="' + clubName + '" name="club-edit-name" />';
			form +=	'<input type="hidden" value="' + id + '" name="club-edit-id" />';
			form +=	'<input type="hidden" value="' + divId + '" name="division_id" />';
			form +=	'</form>';

			//replace with input box containing club name
			nameCol.html(form);
		}
	});

	$('.week h3').on('dblclick', function(){

		var groupName, id, divId, form, h3;

		h3 = $(this);

		if(h3.find('input[type="text"]').length > 0){

			//replace input box with text
			h3.html(oldGroupName);
		}
		else{

			//close any open inputs
			closeOpenGroup();

			id = h3.attr('id');
			divId = $('h2.division').attr('id');

			//store group name
			groupName = h3.html();
			oldGroupName = groupName;

			form = '<form method="post" action="groups/edit?id='+ id +'">';
			form +=	'<input type="text" value="' + groupName + '" name="group-edit-name" />';
			form +=	'<input type="hidden" value="' + id + '" name="group-edit-id" />';
			form +=	'<input type="hidden" value="' + divId + '" name="division_id" />';
			form +=	'</form>';

			//replace with input box containing group name
			h3.html(form);
		}
	});

	$('.event').on('click', function(){

		var adminCtn, 
			hScore, 
			vScore, 
			hClub, 
			vClub,
			loc,
			date,
			time,
			groupID,
			eventID,
			$this;

		$this = $(this);
		hScore = $this.find('.h-score').html();
		vScore = $this.find('.v-score').html();
		hClub = $this.find('.h-club').html();
		vClub = $this.find('.v-club').html();
		loc = $this.find('.loc').html();
		date = $this.find('.date').html();
		time = $this.find('.time').html();
		groupID = $this.find('.group-id').html();
		eventID = $this.find('.event-id').html();

		adminCtn = $this.siblings('.admin-event-ctn');

		adminCtn.find('#admin-event-h-team option').each(function(){

			if($(this).html() == hClub){

				adminCtn.find('#admin-event-h-team').val($(this).attr('id'));
			}

		});

		adminCtn.find('#admin-event-v-team option').each(function(){

			if($(this).html() == vClub){

				adminCtn.find('#admin-event-v-team').val($(this).attr('id'));
			}

		});

		adminCtn.find('#admin-event-h-score').val(hScore);
		adminCtn.find('#admin-event-v-score').val(vScore);
		adminCtn.find('#admin-event-location').val(loc);
		adminCtn.find('#admin-event-date').val(date);
		adminCtn.find('#admin-event-time').val(time);
		adminCtn.find('#admin-event-group-id').val(groupID);
		adminCtn.find('#admin-event-event-id').val(eventID);
		adminCtn.find('form').attr('action', 'events/edit');
	});

	$('.admin-event-add').on('click', function(){

		var adminCtn;

		adminCtn = $(this).parents('.admin-event-ctn');

		adminCtn.find('.admin-event').find('input[type=text], select').val("");
		adminCtn.find('form').attr('action', 'events/add');
	});

	//on esc press
	$(document).keyup(function(e) {

		if(e.keyCode == 27) closeOpenClub();
		if(e.keyCode == 27) closeOpenGroup();
	});	
});