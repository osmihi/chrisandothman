<?php

	require_once('../private/ConnectionFactory.php');

	class PartySearch {
		private $db;
		private $searchStr;
		private $res;

		function __construct() {
			$this->db = ConnectionFactory::getFactory()->getConnection();
		}
		
		public function search($searchStr) {
			$terms = explode(' ', $searchStr);

			$likeStr = '';
			$or = '';
			for ($i = 0; $i < count($terms); $i++) {
				$likeStr .= $or . " g3.`lastName` LIKE :term" . $i . "l OR g3.`firstName` LIKE :term" . $i . "f ";
				$or = " OR "; 
			}

			$stmtStr =
				" SELECT g.`party`, p.`size` AS partySize, g.`guestID`, g.`firstName`, g.`lastName`, g.`kid`, " .
					" g.`phone`, g.`email`, g.`attending`, g.`attendingDetails`, g.`menuID`, g.`menuOptions`, " .
					" g.`hotelHelp`, g.`message`, g.`modified`, d.`dietName` " .
				" FROM `Guest` AS g " .
				" INNER JOIN ( " .
				" SELECT g2.`party`, COUNT(g2.`guestID`) AS size " .
				" FROM `Guest` AS g2 WHERE COALESCE(g2.`attending`, 1) = 1 GROUP BY `party`" .
				" ) AS p ON p.`party` = g.`party` " .
				" LEFT OUTER JOIN `Diet` AS d ON d.`guestID` = g.`guestID` " .
				" WHERE 1 = 1 " .
				" AND g.`party` IN (" . 
					"SELECT DISTINCT g3.`party` FROM `Guest` AS g3 WHERE " . $likeStr . 
				") " . 
				" ORDER BY g.`party` ";
			
			$stmt = $this->db->prepare($stmtStr);
			for ($i = 0; $i < count($terms); $i++) {
				$stmt->bindValue(':term' . $i . 'l', $terms[$i] . '%', PDO::PARAM_STR);
				$stmt->bindValue(':term' . $i . 'f', $terms[$i] . '%', PDO::PARAM_STR);
			}
			$stmt->execute();
			$this->res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public function find($partyName) {
			$stmtStr =
				" SELECT g.`party`, p.`size` AS partySize, g.`guestID`, g.`firstName`, g.`lastName`, g.`kid`, " .
				" g.`phone`, g.`email`, g.`attending`, g.`attendingDetails`, g.`menuID`, g.`menuOptions`, " .
				" g.`hotelHelp`, g.`message`, g.`modified`, d.`dietName` " .
				" FROM `Guest` AS g " .
				" INNER JOIN ( " .
				" SELECT g2.`party`, COUNT(g2.`guestID`) AS size " .
				" FROM `Guest` AS g2 WHERE COALESCE(g2.`attending`, 1) = 1 GROUP BY `party`" .
				" ) AS p ON p.`party` = g.`party` " .
				" LEFT OUTER JOIN `Diet` AS d ON d.`guestID` = g.`guestID` " .
				" WHERE 1 = 1 " .
				" AND g.`party` = :partyName " .
				" ORDER BY g.`party` ";
				
			$stmt = $this->db->prepare($stmtStr);
			$stmt->bindValue(':partyName', $partyName, PDO::PARAM_STR);
			$stmt->execute();

			$this->res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public function getJson() {
			$res = $this->res;
			$json = '{';
			$json .= PHP_EOL . "\t\"parties\":[";
			
			$delim = '';
			$currentParty = '';
			$lastGuest = 0;
			$newPartyString = '';

			$dietArrays = array();

			foreach($res as $r) {
				if ($r['dietName'] != '') {
					$gId = $r['guestID'];
					if (isset($dietArrays[$gId])) {
						$dietArrays[$gId] .= ',"' . $r['dietName'] . '"';
					} else {
						$dietArrays[$gId] = '"' . $r['dietName'] . '"';
					}
				}
			}

			foreach($res as $r) {
				$newParty = $r['party'] != $currentParty; 
				if ($newParty) {
					$json .= $newPartyString;
					
					$currentParty = $r['party'];
					$json .= $delim;
					$json .= PHP_EOL . "\t\t{";
					$json .= PHP_EOL . "\t\t\t" . "\"name\":" . json_encode($r['party']) . "," ;
					$json .= PHP_EOL . "\t\t\t" . "\"partySize\":" . json_encode($r['partySize']) . ",";
					$json .= PHP_EOL . "\t\t\t" . "\"guests\":[";
					
					$newPartyString = PHP_EOL . "\t\t\t" . "]";
					$newPartyString .= PHP_EOL . "\t\t}";
					$delim = ',';
				}

				if ($r['guestID'] != $lastGuest) {
					$json .= $newParty ? '' : ',';
					$json .= PHP_EOL . "\t\t\t\t" . "{";
					
					$d3 = '';
					foreach($r as $k => $v) {
						if ($k != 'party' && $k != 'partySize' && $k != 'dietName') {
							$json .= $d3 . PHP_EOL . "\t\t\t\t\t" . "\"" . $k . "\":" . json_encode($v) . "";
							$d3 = ',';
						}
					}
					
					if ($r['dietName'] != '') {
						$json .= ',' . PHP_EOL . "\t\t\t\t\t" . "\"diets\":[" . $dietArrays[$r['guestID']] . "]";
					}
					
					$json .= PHP_EOL . "\t\t\t\t" . "}";		
				}

				$lastGuest = $r['guestID'];
			}
			
			$json .= $newPartyString;
			
			$json .= PHP_EOL . "\t]";
			$json .= PHP_EOL . "}";

			return $json;
		}
	}
?>