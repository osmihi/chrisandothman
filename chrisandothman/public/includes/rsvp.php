<script src="js/rsvp.js" type="text/javascript"></script>

<div id="bodyText">

	<p>
		Please fill out the RSVP form for you and each person who will be coming with you to the wedding. Search for your party using your name below, then fill out the form for each person (be sure to click the Submit button for each person). If there's a +1 in your party and you don't plan on bringing anyone, just mark the +1 person as not attending. 
	</p>

	<form role="form" class="partyForm" onsubmit="$('#partySearchBtn').click();return false;">
		<label for="partyName">Step 1: Find your party</label><br />
		<small><em>Enter the first or last name of you or someone in your party.</em></small>
		<div class="input-group halfWide">	
			<input type="text" name="partyName" id="partyName" class="form-control" placeholder="Enter a name here" maxlength="64" size="32"/>
			<span class="input-group-btn">
				<button id="partySearchBtn" type="button" class="btn btn-default">Search</button>
			</span>
		</div>
	</form>
	
	<div id="partyResults"></div>

	<div id="step2Header">
		<label>Step 2: RSVP for each person in your party</label><br />
		<small><em>Click on each name below and fill out the form. Make sure to press the blue Submit button after filling out <strong>each person</strong>.</em></small>
	</div>
	
	<div id="partyMembers" class="btn-group btn-group-sm"></div>

	<div id="formArea">
		<?php include('includes/guestForm.php'); ?>
	</div>
 
</div> <!-- bodyText -->