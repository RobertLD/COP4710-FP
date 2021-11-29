# SQL commands to create and populate the operations log database for the final project
# CNT 4710 - Fall 2021
#
# delete the database if it already exists
drop database if exists COP4710_FP;

# create a new database named operationslog
create database COP4710_FP;

# switch to the new database
use COP4710_FP;


# We will need a total of: USER, ROLE, STAFF, REQUEST, PROFESSOR, BOOK

# The following statements construct our entity tablesbook
create table user (
    user_id INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	username VARCHAR(45) NOT NULL,
    password_hash VARCHAR(128) NOT NULL,
    tmp_password BOOLEAN,
	email VARCHAR(256) NOT NULL,
    first_name VARCHAR(80) NOT NULL,
	last_name VARCHAR(80) NOT NULL,
	admin_level INTEGER NOT NULL,
    primary key (user_id)
);

#create table role (
#	user_id INTEGER NOT NULL REFERENCES user(user_id),
#    role_id INTEGER NOT NULL,
#    role_name VARCHAR(128) NOT NULL,
#	primary key (user_id)
#);

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
	title VARCHAR(256),
    author VARCHAR(256),
    edition VARCHAR(20),
    publisher VARCHAR(256),
    ISBN VARCHAR(256) NOT NULL,
    primary key(ISBN)
);

# We will create our relation tables below
# I don't believe adding this is required because we can manage permissions website side
# and just give the staff the authority to modify the professor table as they see fit
#create table maintain ( );

create table request(
	request_id INTEGER NOT NULL AUTO_INCREMENT,
    user_id INTEGER NOT NULL REFERENCES user(user_id),
    book_ISBN VARCHAR(256) NOT NULL REFERENCES book(ISBN),
    primary key(request_id)
    
);