CREATE TABLE  `tradeList` (
 `id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `name` VARCHAR( 100 ) NOT NULL ,
 `address` VARCHAR( 100 ) NOT NULL ,
 `phone` VARCHAR( 20 ) NOT NULL ,
 `fax` VARCHAR( 20 ) NULL ,
 `email` VARCHAR( 50 ) NULL ,
 `status` INT( 2 ) NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE  `tradeHistory` (
 `id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `user` VARCHAR( 20 ) NOT NULL ,
 `action` VARCHAR( 20 ) NOT NULL ,
 `date` DATETIME NOT NULL
) ENGINE = MYISAM ;
ALTER TABLE  `tradeHistory` ADD  `tradename` VARCHAR( 100 ) NOT NULL AFTER  `action` ;

CREATE TABLE  `poList` (
 `id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `po_number` INT( 11 ) NOT NULL ,
 `vendorID` INT( 11 ) NOT NULL ,
 `shiptoAdd` VARCHAR( 100 ) NOT NULL ,
 `poStatus` VARCHAR( 20 ) NOT NULL ,
 `quantity` INT( 11 ) NOT NULL ,
 `account` VARCHAR( 100 ) NOT NULL ,
 `description` VARCHAR( 500 ) NOT NULL ,
 `unitPrice` INT( 11 ) NOT NULL ,
 `extPrice` INT( 11 ) NOT NULL
)
alter table poList auto_increment = 10001;