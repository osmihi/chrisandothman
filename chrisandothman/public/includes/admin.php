<script src="js/admin.js" type="text/javascript"></script>

<div id="bodyText">

<?php 
	echo '<h5>Cookie</h5>';
	echo '<pre>';
	var_dump($_COOKIE);
	echo '</pre>';
	echo '<h5>Session</h5>';
	echo '<pre>';
	var_dump($_SESSION);
	echo '</pre>';

	if ($_SESSION['admin']) {
		echo "<script>" . PHP_EOL;
		echo "\t" . "$(function() {" . PHP_EOL;
		echo "\t\t" . "$('#adminForm').hide();" . PHP_EOL;
		echo "\t" . "});" . PHP_EOL;
		echo "</script>" . PHP_EOL;
	}
?>

	<form role="form" id="adminForm" onsubmit="$('#adminKeyBtn').click();return false;">
		<label for="adminKey">Enter the admin key</label><br />
		<div class="input-group halfWide">	
			<input type="text" name="adminKey" id="adminKey" class="form-control" placeholder="Enter the admin key" maxlength="64" size="32"/>
			<span class="input-group-btn">
				<button id="adminKeyBtn" type="button" class="btn btn-default">Authorize</button>
			</span>
		</div>
	</form>
	
	<div id="adminArea"></div>

</div> <!-- bodyText -->