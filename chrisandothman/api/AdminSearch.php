<?php

	require_once('../private/ConnectionFactory.php');

	class AdminSearch {
		private $db;
		private $searchStr;
		private $res;

		function __construct() {
			$this->db = ConnectionFactory::getFactory()->getConnection();
		}
		
		public function authorize($adminKey) {
			
			$filename = '../private/adminKey.cfg';
			
			if (file_exists($filename) && is_readable ($filename)) {

				$data = file_get_contents($filename);

				if ( $adminKey == trim($data) ) {
					setcookie('admin', true, time() + 60*60*24*30);
					$_SESSION['admin'] = true;
					return true;
				}
			}

			return false;
		}
	
	}
?>