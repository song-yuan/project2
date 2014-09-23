alter table nb_order add column `reality_total` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
add column  `remark` text NOT NULL COMMENT '备注';
