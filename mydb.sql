create table ITEMS (
	id int(10) not null AUTO_INCREMENT  PRIMARY KEY ,
	content varchar(200) null,
	create_on date null,
	due_date date null,
	`use` int(1) not null default '1'
) COLLATE ='utf8_general_ci' ENGINE =MyISAM;


insert into braverokmc.items ( content, create_on, due_date) 

values ('웅파미팅', '2012-09-23', '2012-09-24');


insert into braverokmc.items ( content, create_on, due_date) 

values ('스터디', '2012-09-23', '2012-09-24');


-- 테이블 ci_book의 구조를 덤프합니다. ci_board
DROP TABLE IF EXISTS `ci_board`;
CREATE TABLE IF NOT EXISTS `ci_board` (
  `board_id` int(10) NOT NULL AUTO_INCREMENT,
  `board_pid` int(10) NOT NULL DEFAULT '0' COMMENT '원글번호',
  `user_id` varchar(20) NOT NULL COMMENT '작성자ID',
  `user_name` varchar(20) NOT NULL COMMENT '작성자이름',
  `subject` varchar(50) NOT NULL COMMENT '게시글제목',
  `contents` text NOT NULL COMMENT '게시글내용',
  `hits` int(10) NOT NULL DEFAULT '0' COMMENT '조회수',
  `reg_date` datetime NOT NULL COMMENT '등록일',
  PRIMARY KEY (`board_id`),
  KEY `board_pid` (`board_pid`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='CodeIgniter 게시판';	 
	 
DELETE FROM `ci_board`;
/*!40000 ALTER TABLE `ci_board` DISABLE KEYS */;
INSERT INTO `ci_board` (`board_id`, `board_pid`, `user_id`, `user_name`, `subject`, `contents`, `hits`, `reg_date`) VALUES
	(1, 0, 'advisor', '웅파', '안녕하세요', '첫글이네요.', 5, '2012-06-12 22:23:01'),
	(2, 0, 'advisor', '웅파', '두번째 글입니다.', '두번째글이네요.', 0, '2012-06-12 22:24:01'),
	(3, 0, 'advisor', '웅파', '세번째 글입니다.', '세번째글이네요.', 1, '2012-06-12 22:24:01'),
	(4, 0, 'advisor', '웅파', '네번째 글입니다.', '네번째글이네요.', 6, '2012-06-12 22:24:01'),
	(5, 0, 'advisor', '웅파', '다섯번째 글입니다.', '다섯번째글이네요.', 4, '2012-06-12 22:24:01'),
	(8, 0, 'advisor', '웅파', '여덞번째 글입니다.2', '여덞번째글이네요.2', 13, '2012-06-12 22:24:01'),
	(9, 0, 'advisor', '웅파', '아홉번째 글입니다.', '아홉번째글이네요.', 1, '2012-06-12 22:24:01'),
	(10, 0, 'advisor', '웅파', '열번째 글입니다.', '열번째글이네요.', 9, '2012-06-12 22:24:01'),
	(11, 1, 'blumine', '웅파1', '첫번째 글의 첫번째 댓글입니다.', '첫번째 댓글이네요.', 1, '2012-06-12 22:26:01'),
	(12, 1, 'blumine', '웅파1', '첫번째 글의 두번째 댓글입니다.', '두번째 댓글이네요.', 0, '2012-06-12 22:27:01'),
	(13, 2, 'blumine', '웅파1', '두번째 글의 첫번째 댓글입니다.', '두번째 글의 첫번째 댓글이네요.', 9, '2012-06-12 22:29:01'),
	(24, 4, 'advisor', 'advisor', '', '3333', 0, '2012-10-09 17:17:22'),
	(22, 4, 'advisor', 'advisor', '', '1111', 0, '2012-10-09 17:17:19'),
	(25, 4, 'advisor', 'advisor', '', '4444', 0, '2012-11-07 14:09:59');
/*!40000 ALTER TABLE `ci_board` ENABLE KEYS */;	


show tables;

desc ci_board;

CREATE TABLE USERS(
	id int(10) AUTO_INCREMENT PRIMARY KEY UNIQUE  ,
	username VARCHAR(50) null COMMENT '아이디',
	password VARCHAR(50) null COMMENT '비밀번호',
	name VARCHAR (50) null COMMENT '이름',
	email VARCHAR (50) null COMMENT '이메일',
	reg_date DATETIME null COMMENT '가입일'
) COMMENT ='회원테이블'
	COLLATE ='utf8_general_ci'
	ENGINE =MyISAM
	ROW_FORMAT =DEFAULT ;
	
INSERT INTO USERS ( username, password, name, email, reg_date) 

	VALUES ('braverokmc', '1111', '마카로닉스', 'braverokmc@gmail.com' , '2017-08-18 20:55:55'	);



-- 테이블 ci_book의 구조를 덤프합니다. ci_sessions
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(200) not null default '0',
  `session_id` BIGINT AUTO_INCREMENT ,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  `timestamp` TIMESTAMP ,
  `data` TEXT,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
