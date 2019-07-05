create table if not exists `b_defo_log1c_entity` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `DATE` datetime NULL,
  `TYPE` VARCHAR(50) NOT NULL,
  `STATUS` VARCHAR(50) NOT NULL,
  `AMOUNT` int(11) NULL,
  `TEXT` VARCHAR(255) NULL,
  PRIMARY KEY (`ID`)
);