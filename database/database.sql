-- if the table exists drop it
DROP TABLE IF EXISTS `comments`;
DROP TABLE IF EXISTS `posts`;
DROP TABLE IF EXISTS `users`;

-- create a new table
CREATE TABLE users(
	username varchar(50) PRIMARY KEY,
	password varchar(100) NOT NULL,
	first_name varchar(50) NOT NULL,
	last_name varchar(50) NOT NULL,
	email varchar(100) NOT NULL,
	phone_no varchar(10) NOT NULL,
	role varchar(10) NOT NULL,
	status varchar(10) NOT NULL,
	CONSTRAINT username_format CHECK (username REGEXP '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'),
	CONSTRAINT email_format CHECK (email REGEXP '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'),
	CONSTRAINT phone_number CHECK (phone_no REGEXP '[0-9]{10}'),
	CONSTRAINT first_name_check CHECK (first_name REGEXP '^[A-Za-z]+$'),
	CONSTRAINT last_name_check CHECK (last_name REGEXP '^[A-Za-z]+$'),
	CONSTRAINT role_check CHECK (role IN ('superuser', 'regular')),
	CONSTRAINT status_check CHECK (status IN ('enabled', 'disabled'))
	);
	

-- insert data to users table
LOCK TABLES `users` WRITE;
INSERT INTO `users` VALUES ('admin@secad.com',md5('password'),'administrator','kun','adkun@secad.com','1111111111','superuser','enabled');
INSERT INTO `users` VALUES ('user1@secad.com',md5('password'),'user','one','user1@secad.com','1111111111','regular','enabled');
INSERT INTO `users` VALUES ('user2@secad.com',md5('password'),'user','two','user2@secad.com','1111111111','regular','enabled');
INSERT INTO `users` VALUES ('user3@secad.com',md5('password'),'user','three','user3@secad.com','1111111111','regular','enabled');

UNLOCK TABLES;



CREATE TABLE posts(
	post_id int AUTO_INCREMENT PRIMARY KEY,
	date_time datetime NOT NULL,
	owner varchar(50),
	title varchar(100) NOT NULL,
	content varchar(250) NOT NULL,
	FOREIGN KEY(`owner`) REFERENCES `users`(`username`) ON DELETE CASCADE
	);

LOCK TABLES `posts` WRITE;
INSERT INTO `posts` (date_time, owner, title, content) VALUES (NOW(),'admin@secad.com','This is the sample post 1','sometime I wonder whats happening');
INSERT INTO `posts` (date_time, owner, title, content) VALUES (NOW(),'user1@secad.com','This is the sample post 2','admin is cracked');
INSERT INTO `posts` (date_time, owner, title, content) VALUES (NOW(),'user1@secad.com','you can delete this','what happening?');
INSERT INTO `posts` (date_time, owner, title, content) VALUES (NOW(),'user2@secad.com','Edit post works','edit me');
INSERT INTO `posts` (date_time, owner, title, content) VALUES (NOW(),'user3@secad.com','wow!!','life :)');
UNLOCK TABLES;



CREATE TABLE comments(
	comment_id int AUTO_INCREMENT PRIMARY KEY,
	post_id int NOT NULL,
	date_time datetime NOT NULL,
	owner varchar(50),
	comment varchar(250) NOT NULL,
	FOREIGN KEY(`owner`) REFERENCES `users`(`username`) ON DELETE CASCADE,
	FOREIGN KEY(`post_id`) REFERENCES `posts`(`post_id`) ON DELETE CASCADE
	);

LOCK TABLES `comments` WRITE;
INSERT INTO `comments` (post_id, date_time, owner, comment) VALUES (1,NOW(),'user1@secad.com','Ignorance is bliss');
INSERT INTO `comments` (post_id, date_time, owner, comment) VALUES (1,NOW(),'admin@secad.com','I wonder');
INSERT INTO `comments` (post_id, date_time, owner, comment) VALUES (2,NOW(),'user2@secad.com','I wonder');
INSERT INTO `comments` (post_id, date_time, owner, comment) VALUES (3,NOW(),'user2@secad.com','I wonder');
INSERT INTO `comments` (post_id, date_time, owner, comment) VALUES (4,NOW(),'user1@secad.com','I wonder');
UNLOCK TABLES;