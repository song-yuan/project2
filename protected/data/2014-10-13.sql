--
-- 表的结构 `nb_department`
--

CREATE TABLE IF NOT EXISTS `nb_department` (
  `department_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '操作间Id',
  `company_id` int(10) unsigned NOT NULL COMMENT '企业ID',
  `name` varchar(45) NOT NULL DEFAULT '' COMMENT '名称',
  `manager` varchar(20) NOT NULL DEFAULT '' COMMENT '负责人',
  `printer_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '打印机ID',
  `list_no` tinyint(4) NOT NULL DEFAULT '2' COMMENT '打印份数',
  `remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='操作间表' AUTO_INCREMENT=1 ;

--
-- 表的结构 `nb_printer`
--

CREATE TABLE IF NOT EXISTS `nb_printer` (
  `printer_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL,
  `department_id` int(10) unsigned NOT NULL DEFAULT '0',
  `brand` varchar(45) NOT NULL,
  `remark` text NOT NULL,
  PRIMARY KEY (`printer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='打印机表';

alter table nb_site 
add column `has_minimum_consumption` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否有最低消费，0无，1有',
add column  `minimum_consumption_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '最低消费类型，1按时间，2按人头',
add column `minimum_consumption` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '最低消费',
add column  `number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '人数',
add column  `period` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最低消费时间',
add column  `overtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '超时时间',
add column `buffer` float unsigned NOT NULL DEFAULT '0' COMMENT '超时计算点',
add column  `overtime_fee` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '超时费';

alter table nb_product add column `department_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属操作间';
 
 
 