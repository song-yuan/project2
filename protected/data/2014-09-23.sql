alter table nb_order add column `reality_total` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
add column  `remark` text NOT NULL COMMENT '备注';
ALTER TABLE  `nb_product` ADD  `status` TINYINT UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '0正常,下架' AFTER  `create_time` ;
