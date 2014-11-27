CREATE TABLE  `tradeList` (
 `id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `name` VARCHAR( 100 ) NOT NULL ,
 `address` VARCHAR( 100 ) NOT NULL ,
 `phone` VARCHAR( 20 ) NOT NULL ,
 `fax` VARCHAR( 20 ) NULL ,
 `email` VARCHAR( 50 ) NULL ,
 `status` INT( 2 ) NOT NULL
) ENGINE = MYISAM ;

