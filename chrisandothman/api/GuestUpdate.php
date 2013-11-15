<?php

require_once('../private/ConnectionFactory.php');

class GuestUpdate {
	private $db;
	private $res;
	
	public function __construct() {
		$this->db = ConnectionFactory::getFactory()->getConnection();
	}
	
	public function update($params) {
		$stmtStr = 
			" UPDATE `Guest` " . 
			" SET " . 
				" `firstName` = :firstName, " .
				" `lastName` = :lastName, " .
				" `kid` = :kid, " .
				" `phone` = :phone, " .
				" `email` = :email, " .
				" `attending` = :attending, " .
				" `attendingDetails` = :attendingDetails, " .
				" `hotelHelp` = :hotelHelp, " .
				" `menuID` = :menuID, " .
				" `menuOptions` = :menuOptions, " .
				" `message` = :message " .
			" WHERE `guestID` = :guestID ";
		
		$stmt = $this->db->prepare($stmtStr);

		$stmt->bindValue(':firstName', $params['firstName'], PDO::PARAM_STR);
		$stmt->bindValue(':lastName', $params['lastName'], PDO::PARAM_STR);
		$stmt->bindValue(':kid', $params['kid'], PDO::PARAM_INT);
		$stmt->bindValue(':phone', $params['phone'], PDO::PARAM_STR);
		$stmt->bindValue(':email', $params['email'], PDO::PARAM_STR);
		$stmt->bindValue(':attending', $params['attending'], PDO::PARAM_INT);
		$stmt->bindValue(':attendingDetails', $params['attendingDetails'], PDO::PARAM_STR);
		$stmt->bindValue(':hotelHelp', $params['hotelHelp'], PDO::PARAM_INT);
		$stmt->bindValue(':menuID', $params['menuID'], PDO::PARAM_INT);
		$stmt->bindValue(':menuOptions', $params['menuOptions'], PDO::PARAM_STR);
		$stmt->bindValue(':message', $params['message'], PDO::PARAM_STR);
		$stmt->bindValue(':guestID', $params['guestID'], PDO::PARAM_INT);
		
		$ok = $stmt->execute();
		
		//var_dump($params);

		if ( !$ok ) return false;

		// Delete diets
		
		$stmt2Str = " DELETE FROM `Diet` WHERE `guestID` = :guestID ";
		
		$stmt2 = $this->db->prepare($stmt2Str);
		
		$stmt2->bindValue(':guestID', $params['guestID'], PDO::PARAM_INT);
		
		$ok = $stmt2->execute();
		
		if ( !$ok ) return false;
		
		if ( count($params['diets']) == 0 ) {
			return true;
		}
		
		// Add diets
		
		$stmt3Str = 
			" INSERT INTO `Diet` " . 
				" (`guestID`, `dietName`) " . 
			" VALUES "; 

		$delim = '';
		for ($i = 0; $i < count($params['diets']); $i++) {
			$stmt3Str .= $delim . " (:guestID" . $i . ", :diet" . $i . ") ";
			$delim = ", ";
		}

		$stmt3 = $this->db->prepare($stmt3Str);

		for ($i = 0; $i < count($params['diets']); $i++) {
			$stmt3->bindValue(':guestID' . $i, $params['guestID'], PDO::PARAM_INT);
			$stmt3->bindValue(':diet' . $i, $params['diets'][$i], PDO::PARAM_STR);
		}

		$ok = $stmt3->execute();
		
		return $ok;
	} 
}