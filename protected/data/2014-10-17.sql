ALTER TABLE  `nb_company` ADD  `description` TEXT NOT NULL COMMENT  '公司描述',
ADD  `ip_address` VARCHAR( 45 ) NOT NULL DEFAULT  '' COMMENT  '打印机IP',
ADD  `brand` VARCHAR( 45 ) NOT NULL DEFAULT  '' COMMENT  '品牌';