ALTER TABLE  `nb_printer` ADD  `name` VARCHAR( 45 ) NOT NULL DEFAULT  '' COMMENT  '打印机名称' AFTER  `company_id` ;
ALTER TABLE `nb_company`
  DROP `ip_address`,
  DROP `brand`;
  ALTER TABLE  `nb_company` ADD  `printer_id` INT UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '打印机ID' AFTER  `description` ;
 ALTER TABLE  `nb_site` 
CHANGE  `overtime`  `overtime` FLOAT UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '超时单位',
CHANGE  `period`  `period` FLOAT UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '最低消费时间';
