ALTER TABLE  `nb_printer` ADD  `name` VARCHAR( 45 ) NOT NULL DEFAULT  '' COMMENT  '打印机名称' AFTER  `company_id` ;
ALTER TABLE `nb_company`
  DROP `ip_address`,
  DROP `brand`;
  ALTER TABLE  `nb_company` ADD  `printer_id` INT UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '打印机ID' AFTER  `description` ;
 ALTER TABLE  `nb_site` 
CHANGE  `overtime`  `overtime` FLOAT UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '超时单位',
CHANGE  `period`  `period` FLOAT UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '最低消费时间';

CREATE TABLE IF NOT EXISTS `nb_payment_method` (
  `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='付款方式' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `nb_payment_method`
--

INSERT INTO `nb_payment_method` (`payment_method_id`, `name`) VALUES
(1, '现金'),
(2, '银联卡'),
(3, '储值卡'),
(4, '团购'),
(5, '签单');
ALTER TABLE  `nb_order` ADD  `payment_method_id` INT UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '付款方式' AFTER  `remark` ;
