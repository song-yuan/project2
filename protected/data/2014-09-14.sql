alter table nb_company add column mobile varchar(20) not null default '',
add column telephone varchar(20) not null default '',
add column email varchar(50) not null default '',
add column homepage varchar(255) not null default '',
add column create_time int unsigned not null default 0,
add column delete_flag tinyint unsigned not null default 0;