// Global variable for selected party
var selectedParty;
var selectedGuest;

function partyResult(r) {
	if (r.parties.length == 0) {
		$('#partyResults').append('<span>Name not found.</span>');
	}
	
	for (var i = 0; i < r.parties.length; i++) {
		$('#partyResults').append('<div class="partyChoice" id="party' + r.parties[i].name + '"></div>');
		$('#party' + r.parties[i].name).append('<button type="button" id="partySelect' + r.parties[i].name + '" class="partySelectBtn btn btn-default">This is me!</button>');
		$('#party' + r.parties[i].name).append('<span class="partyResultName">The ' + r.parties[i].name + ' Party</span> <small><em>' + r.parties[i].partySize + ' people ' + '</em></small><br />');
		var delim = '';
		for (var j = 0; j < r.parties[i].guests.length; j++) {
			$('#party' + r.parties[i].name).append('<small>' + delim + r.parties[i].guests[j].firstName + ' ' + r.parties[i].guests[j].lastName + '</small>');
			delim = ', ';
		}
	}

	$('#partyResults').show('fast');

	$('.partySelectBtn').click(function(event) {
		var selPartyName = event.target.id.substring(11);

		for (var i = 0; i < r.parties.length; i++) {
			if (r.parties[i].name == selPartyName) {
				selectedParty = r.parties[i]; 
			}
		}

		loadParty();
		
	});
}

function loadParty() {
	// selectedParty should be set first.
	$('#partyName').val('')
	$('#partyResults').hide('slow');
	$('#partyResults').html('');

	$('#step2Header').show('slow');

	$('#partyMembers').html('');
	for (var i = 0; i < selectedParty.guests.length; i++) {
		var checkStr = selectedParty.guests[i].attending == null ? '' : '&nbsp;&nbsp;<span class="glyphicon glyphicon-check"></span>';
		$('#partyMembers').append('<button type="button" id="guestButton' + selectedParty.guests[i].guestID  + '" class="guestButton btn btn-default" onclick="loadForm(' + selectedParty.guests[i].guestID  + ');">' + selectedParty.guests[i].firstName + ' ' + selectedParty.guests[i].lastName + checkStr + '</button>');
	}
}

function fillForm(g) {
	var modMsg = 'This is the first time you have edited this information.';
	if (g.modified != null) {
		var thisDate = new Date(g.modified);
		var cutoffDate = new Date(2013,9,5,16,0);
		if (cutoffDate < thisDate) {
			modMsg = 'You last edited this information on ' + thisDate.toLocaleString() + '.';
		}
	}
	$('#modified', '#guestForm').html(modMsg);
	
	$('#guestID', '#guestForm').val(g.guestID);
	$('#firstName', '#guestForm').val(g.firstName);
	$('#lastName', '#guestForm').val(g.lastName);
	$('#kid', '#guestForm').prop('checked', g.kid == 1);
	$('#phone', '#guestForm').val(g.phone);
	$('#email', '#guestForm').val(g.email);
	$('#attendingYes', '#guestForm').prop('checked', g.attending == 1);
	$('#attendingNo', '#guestForm').prop('checked', g.attending == 0);
	$('#attendingDetails', '#guestForm').val(g.attendingDetails);
	$('#hotelHelpYes', '#guestForm').prop('checked', g.hotelHelp == 1);
	$('#hotelHelpNo', '#guestForm').prop('checked', g.hotelHelp == 0);
	$('.menuChoiceRadio', '#guestForm').prop('checked', false);
	$('#menuID' + g.menuID, '#guestForm').prop('checked', true);
	$('#menuOptions', '#guestForm').val(g.menuOptions);
	$("#dietName").select2("val", g.diets);
	$('#message', '#guestForm').val(g.message);
	
	if (g.kid != 1) {
		$('.kid', '#guestForm').hide('slow');
		$('.adult', '#guestForm').show('slow');
	} else {
		$('.kid', '#guestForm').show('slow');
		$('.adult', '#guestForm').hide('slow');
	}
}

function loadForm(guestID) {
	selectedGuest = '';
	for (var i = 0; i < selectedParty.guests.length; i++) {
		if (selectedParty.guests[i].guestID == guestID) {
			selectedGuest = selectedParty.guests[i];  
		}
	}
	fillForm(selectedGuest);

	$('.guestButton').removeClass('active');
	$('#guestButton' + guestID).addClass('active');
	$('#formArea').show('slow');
}

function submitForm() {
	var dietStr = '';
	var diets = $('#dietName').val();
	diets = diets == null ? 0 : diets;
	for (var i = 0; i < diets.length; i++) {
		dietStr += '&diets[]=' + diets[i];
	}

	var dataStr = $('#guestForm').serialize() + dietStr;

	$.ajax({
		url : "http://api.chrisandothman.com/?submitForm=true",
		type : "POST",
		data : dataStr + '&guestParty=' + selectedParty.name,
		//contentType: "application/json",
		//dataType: "text",
		error : function(response, textStatus, errorThrown) {
			alert('Error submitting form. If you are using Internet Explorer, please try another browser like Firefox or Chrome. Failing that, call Othman & Chris :)');
		},
		success : function(r) {
			$('#formArea').hide();
			selectedParty = r.parties[0];
			loadParty();
		} 
	});
}

$(function() {

	$('#formArea').hide();

	$("#dietName").select2();

	$('#kid').change(function() {
		$('.menuChoiceRadio', '#guestForm').prop('checked', false);

		if (!this.checked) {
			$('.kid').hide('slow');
			$('.adult').show('slow');
		} else {
			$('.kid').show('slow');
			$('.adult').hide('slow');
		}
	});
	
	$('#partySearchBtn').click(function() {

		$('#formArea').hide();
		$('#partyResults').html('');
		$('#partyMembers').html('');

		if ($('#partyName').val() == '') {
			$('#partyResults').append('<span>Please enter your first or last name to search for your party.</span>');
			$('#partyResults').show('fast');
			return;
		}

		$.ajax({
			url : "http://api.chrisandothman.com/",
			type : "GET",
			data : 'party=' + $('#partyName').val(),
			contentType: "application/json; charset=utf-8",
			dataType: "json",
			error : function(response, textStatus, errorThrown) {},
			success : partyResult
		});
	});
});
