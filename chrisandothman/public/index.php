<?php
	session_start();

	require_once('../private/ConnectionFactory.php');
	$db = ConnectionFactory::getFactory()->getConnection();
?>
		
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Wedding of Chris and Othman in Minneapolis in October 2013">
		<meta name="author" content="Othman Smihi">

		<title>Chris and Othman's Wedding</title>

		<!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="assets/favicon.ico">
		<!-- Custom styles -->
    	<link href="css/styles.css" rel="stylesheet">
		<!-- Bootstrap -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">
		<!-- select2 -->
		<link type="text/css" rel="stylesheet" href="//cdn.jsdelivr.net/select2/3.4.2/select2.css" />

		<!-- jQuery -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
		<script src="js/jQuery.XDomainRequest.js" ></script>
		<!-- Bootstrap -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
		<!-- select2 -->
		<script type="text/javascript" src="//cdn.jsdelivr.net/select2/3.4.2/select2.min.js"></script>

	</head>

	<body>

		<?php include('includes/navbar.php'); ?>

	    <div class="container">
	      <div class="jumbotron cornerVine">

      		<?php
				if (isset($_GET['p']) && $_GET['p'] == 'rsvp') {
					echo '<h1 class="pageTitle">RSVP</h1>' . PHP_EOL;
					include('includes/rsvp.php');
				} else if (isset($_GET['p']) && $_GET['p'] == 'admin') {
					echo '<h1 class="pageTitle">Administration</h1>' . PHP_EOL;
					include('includes/admin.php');
				} else {
					echo '<h1 class="pageTitle">Our Wedding</h1>' . PHP_EOL;
					include('includes/homeText.php');
				}
      		?>

       	  </div>
	    </div> <!-- /container -->

	</body>
</html>