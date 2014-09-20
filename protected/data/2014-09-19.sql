ALTER TABLE  `nb_site` ADD  `site_level` VARCHAR( 20 ) NOT NULL DEFAULT  '' COMMENT  '座位等级' AFTER  `type_id` ;
ALTER TABLE  `nb_product_category` ADD  `pid` int unsigned NOT NULL DEFAULT  0  AFTER  `category_id`,
 ADD  `tree` varchar(100) NOT NULL DEFAULT  '0'  AFTER  `pid` ;
