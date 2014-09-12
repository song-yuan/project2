ALTER TABLE  `nb_site_type` ADD  `delete_flag` TINYINT UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '删除';
ALTER TABLE  `nb_site` ADD  `delete_flag` TINYINT UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '删除';

CREATE TABLE IF NOT EXISTS `nb_product_category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) NOT NULL DEFAULT '',
  `company_id` int(10) unsigned NOT NULL,
  `delete_flag` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
ALTER TABLE  `nb_product` ADD  `category_id` INT UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '分类' AFTER  `product_id` ;
ALTER TABLE  `nb_product` ADD  `origin_price` DECIMAL( 12, 0 ) NOT NULL DEFAULT  '0.00' COMMENT  '原价' AFTER  `delete_flag` ;
ALTER TABLE  `nb_product` CHANGE  `price`  `price` DECIMAL( 12, 0 ) NOT NULL DEFAULT  '0.00';