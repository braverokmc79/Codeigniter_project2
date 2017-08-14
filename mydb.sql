create table ITEMS (
	id int(10) not null AUTO_INCREMENT  PRIMARY KEY ,
	content varchar(200) null,
	create_on date null,
	due_date date null,
	`use` int(1) not null default '1'
) COLLATE ='utf8_general_ci' ENGINE =MyISAM;

