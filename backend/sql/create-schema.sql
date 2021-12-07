# SQL commands to create and populate the operations log database for the final project
# CNT 4710 - Fall 2021
#
# delete the database if it already exists
drop database if exists COP4710_FP;

# create a new database named operationslog
create database COP4710_FP;

# switch to the new database
use COP4710_FP;


# We will need a total of: USER, STAFF, PROFESSOR, REQUEST

# The following statements construct our entity tablesbook
create table user (
    user_id INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	username VARCHAR(45) NOT NULL,
    password_hash VARCHAR(128) NOT NULL,
    tmp_password BOOLEAN,
	email VARCHAR(256) NOT NULL,
    first_name VARCHAR(80) NOT NULL,
	last_name VARCHAR(80) NOT NULL,
	# 1 = professor, 2 = staff, 3 = superadmin
	admin_level INTEGER NOT NULL,
    primary key (user_id)
);

create table staff(
	user_id INTEGER NOT NULL REFERENCES user(user_id),
    username VARCHAR(45) NOT NULL REFERENCES user(username),
    superadmin BOOLEAN,
    primary key (user_id)
);

create table professor (
	user_id INTEGER NOT NULL REFERENCES user(user_id),
    username VARCHAR(45) NOT NULL REFERENCES user(username),
	primary key (user_id)
);

create table book (
	book_id INTEGER NOT NULL AUTO_INCREMENT,
	request_id INTEGER NOT NULL REFERENCES request(request_id),
	title VARCHAR(256),
    author VARCHAR(256),
    edition VARCHAR(20),
    publisher VARCHAR(256),
    ISBN VARCHAR(256) NOT NULL,
    primary key(book_id)
);

create table request(
	request_id INTEGER NOT NULL AUTO_INCREMENT,
    user_id INTEGER NOT NULL REFERENCES professor(user_id),
	semester VARCHAR(256) NOT NULL,
    primary key(request_id)
);

create table deadline(
	deadline_id INTEGER NOT NULL AUTO_INCREMENT,
	semester VARCHAR(256) NOT NULL,
	due DATE NOT NULL,
	reminder DATE NOT NULL,
	# 0 = No reminder set, 1 = reminder pending, 2 = reminder was sent
	send_email INTEGER NOT NULL,
	primary key(deadline_id)
);

# By default there is a user "superadmin" with password "root"
INSERT INTO `user` (`username`,`password_hash`,`tmp_password`,`email`,`first_name`,`last_name`,`admin_level`)
VALUES ("superadmin","$2y$10$3EiBtE.lF7EgpZzn.CPSNO95WNJCsZFBnVbfYTojwBvyRaNTvQEoG",0,"","Super","Admin",3);

INSERT INTO `staff` (`user_id`,`username`,`superadmin`)
VALUES (1,"superadmin",1);

