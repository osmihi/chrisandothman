<form role="form" id="guestForm" class="guestForm" onsubmit="submitForm();return false;">
	
	<input type="hidden" name="guestID" id="guestID" value=""/>

	<small><em><span id="modified"></span></em></small><br /><br />
	
	<div class="input-group inline formLine">
		<label for="firstName">First Name</label>
		<input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" maxlength="64" size="32"/>
	</div>
	
	<div class="input-group inline formLine">
		<label for="lastName">Last Name</label>
		<input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" maxlength="64" size="32"/>
	</div>
	
	<div class="checkbox inline formLine">
		<label for="kid">
			<input type="checkbox" name="kid" id="kid" value="1"> This person is a kid
		</label>
	</div>	
	
	<div class="input-group formLine">
		<label for="phone">Phone</label>
		<input type="tel" name="phone" id="phone" class="form-control" placeholder="Your phone number" maxlength="32" size="32"/>
	</div>
	
	<div class="input-group formLine">
		<label for="email">E-mail</label>
		<input type="email" name="email" id="email" class="form-control" placeholder="Your e-mail address" maxlength="64" size="64"/>
	</div>
	
	<div class="form-group formLine"></div>
	
	<div class="form-group formLine">
		<label for="attending">Will you be attending our wedding on October 20th, 2013?</label>
		&nbsp;<input type="radio" name="attending" id="attendingYes"value="1" required="required"/> Yes
		&nbsp;<input type="radio" name="attending" id="attendingNo" value="0" required="required"/> No
	</div>
	
	<div class="form-group formLine">
		<label for="attendingDetails">Notes about attendance</label>
		<textarea class="form-control" name="attendingDetails" id="attendingDetails" rows="3" placeholder="Please mention any details, needs or other stuff related to why you will or won't be attending."></textarea>
	</div>
	
	<div class="form-group formLine">
		<label for="hotelHelp">Do you need any help from us in finding or booking a hotel room?</label>
		&nbsp;<input type="radio" name="hotelHelp" id="hotelHelpYes" value="1"> Yes
		&nbsp;<input type="radio" name="hotelHelp" id="hotelHelpNo" value="0" checked="checked"> No
	</div>
	
	<div class="form-group formLine">
		<label for="menuID">Please choose your dinner entr&eacute;e.</label>
		<em>Note: Choices are affected by whether or not this person is a kid.</em>
		<?php 
			$stmt = $db->prepare("SELECT `menuID`, `name`, `description`, `category`, `kid` FROM `Menu`");
			$stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
			foreach( $res as $r ) {
				if ( $r['category'] == 'entree') {
					$kidClass = $r['kid'] == 1 ? 'kid' : 'adult';
					echo '<label class="' . $kidClass . '">' . PHP_EOL;
					echo '<input type="radio" name="menuID" class="menuChoiceRadio" id="menuID' . $r['menuID'] . '" value="' . $r['menuID'] . '"/>' . PHP_EOL;
					echo '<span class="regularLabel">' . $r['description'] . '</span>' . PHP_EOL;
					echo '</label>' . PHP_EOL;
				}
			}
		?>
	</div>
	
	<div class="input-group inline formLine">
		<label for="menuOptions">Notes about your menu choice</label>
		<input type="text" name="menuOptions" id="menuOptions" class="form-control" placeholder="How would you like your food cooked?" maxlength="64" size="64"/>
	</div>
	
	<div class="form-group formLine">
		<label for="dietName">Do you have any special dietary needs?</label><br />
		<select multiple="multiple" name="dietName" id="dietName" data-placeholder="Click and select all that apply">
			<option value="Gluten Free">Gluten Free</option>
			<option value="Dairy Free">Dairy Free</option>
			<option value="Vegetarian">Vegetarian</option>
			<option value="Vegan">Vegan</option>
			<option value="Kosher">Kosher</option>
			<option value="Other">Other</option>
		</select>
	</div>
	
	<div class="form-group formLine">
		<label for="message">Message</label>
		<textarea class="form-control" name="message" id="message" rows="3" placeholder="Is there anything else you'd like to share?"></textarea>
	</div>
	
	<button class="btn btn-lg btn-primary" type="submit">Submit &raquo;</button>
	
</form>