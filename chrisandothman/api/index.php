<?php
require_once('../private/ConnectionFactory.php');
require_once('PartySearch.php');
require_once('GuestUpdate.php');
require_once('AdminSearch.php');

class APIController {
	
	public function __construct() {
		$this->setHeaders();

		if (isset($_GET['party']) && $_GET['party'] != '') {
			$this->partySearch();
		} elseif (isset($_GET['submitForm']) && $_GET['submitForm'] == 'true') {
			$this->formSubmit($_POST);
		} elseif (isset($_GET['authorize']) && $_GET['authorize'] == 'true') {
			$this->adminSearch($_POST);
		}
	}
	
	private function setHeaders() {
		header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
		header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');
		header('Access-Control-Max-Age: 1000');
		header('Access-Control-Allow-Headers: Content-Type');
		header('Content-Type: application/json');
		header( "HTTP/1.1 " . '200' . " " . "OK" );
	}
	
	private function partySearch() {
		$partyStr = $_GET['party'];
			
		$ps = new PartySearch();
		$ps->search($partyStr);
			
		echo $ps->getJson();
			
		exit;
	}
	
	private function formSubmit($p) {
		$gu = new GuestUpdate();
		$ok = $gu->update($p);

		if (!$ok) {
			header( "HTTP/1.1 " . '400' . " " . "Bad Request" );
		}

		$ps = new PartySearch();
		$ps->find($p['guestParty']);
		
		echo $ps->getJson();

		exit;
	}
	
	private function adminSearch($params) {
		
		if ( session_id() == '' ) session_start();

		$as = new AdminSearch();
		
		$isAdmin = $_SESSION['admin'] || $_COOKIE['admin'];
		
		if (!$isAdmin) {
			if (isset($_POST['adminKey']) && $_POST['adminKey'] != '') {
				if (!$as->authorize($params['adminKey'])) {
					header( "HTTP/1.1 " . '400' . " " . "Bad Request" );
					exit;
				}
			} 
		}

		echo '{"admin":true}';

		exit;
	}
}	

new APIController();

?>