-- chrisandothman data definition language

DROP TABLE IF EXISTS `smihi83_chrisandothman`.`Diet`;
DROP TABLE IF EXISTS `smihi83_chrisandothman`.`Guest`;
DROP TABLE IF EXISTS `smihi83_chrisandothman`.`Menu`;

CREATE TABLE IF NOT EXISTS `smihi83_chrisandothman`.`Menu` (
	`menuID` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL,
	`description` TEXT NULL,
	`category` VARCHAR(32) NULL,
	`kid` TINYINT NULL,
	PRIMARY KEY (`menuID`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `smihi83_chrisandothman`.`Guest` (
	`guestID` INT NOT NULL AUTO_INCREMENT,
	`party` VARCHAR(32) NOT NULL,
	`firstName` VARCHAR(64) NOT NULL,
	`lastName` VARCHAR(64) NOT NULL,
	`kid` TINYINT NULL,
	`phone` VARCHAR(32) NULL,
	`email` VARCHAR(64) NULL,
	`attending` TINYINT NULL,
	`attendingDetails` TEXT NULL,
	`menuID` INT NULL,
	`menuOptions` VARCHAR(64) NULL,
	`hotelHelp` TINYINT NULL,
	`message` TEXT NULL,
	`modified` TIMESTAMP NOT NULL,
	PRIMARY KEY (`guestID`),
	CONSTRAINT `Guest_Menu` FOREIGN KEY (`menuID`) REFERENCES `smihi83_chrisandothman`.`Menu` (`menuID`) 
	ON DELETE CASCADE 
	ON UPDATE CASCADE
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `smihi83_chrisandothman`.`Diet` (
	`dietID` INT NOT NULL AUTO_INCREMENT,
	`guestID` INT NOT NULL,
	`dietName` VARCHAR(512) NOT NULL,
	PRIMARY KEY (`dietID`)
)
ENGINE = InnoDB;