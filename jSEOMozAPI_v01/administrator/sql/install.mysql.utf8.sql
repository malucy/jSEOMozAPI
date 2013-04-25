CREATE TABLE IF NOT EXISTS `#__seomozapi_request` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
`customer_name` VARCHAR(50)  NOT NULL ,
`email` VARCHAR(50)  NOT NULL ,
`phone_number` VARCHAR(12)  NOT NULL ,
`domain` VARCHAR(50)  NOT NULL ,
`domain_competitor` VARCHAR(50)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

