# actm.sql
drop database actm;
create database actm;
use actm;

create table schools(
	school_id int(11) AUTO_INCREMENT,
	name varchar(64) NOT NULL,
	
	address_street varchar(64) NOT NULL,
	address_city varchar(64) NOT NULL,
	address_state char(2) NOT NULL,
	address_zip int(5) NOT NULL, #should we plan for extended zip codes?
	

	PRIMARY KEY(school_id)
)ENGINE=InnoDB default CHARSET=ucs2;


create table mentors (
	mentor_id int(11) AUTO_INCREMENT,
	name varchar(64) NOT NULL,
	email varchar(64) NOT NULL,
	# might be a phone type in sql. i know theres a date type
	phone_number int(11) NOT NULL,
	entry_id int(11) NOT NULL,
	PRIMARY KEY(mentor_id)
#	FOREIGN KEY(entry_id) references team(entry_id) #ON UPDATE CASECADE something something
)ENGINE=InnoDB default CHARSET=ucs2;

create table teams(
	entry_id int(11) AUTO_INCREMENT,
	division int(1) NOT NULL,
	
	site varchar(64) NOT NULL, #not sure what the data will be
	
	comprehensive int(4), 
	algebraII int(4),
	geometry int(4),
	school_id int(11),
	
	PRIMARY KEY(entry_id),
	FOREIGN KEY(mentor_id) REFERENCES mentors(mentor_id)
	FOREIGN KEY(school_id) references schools(school_id)
)ENGINE=InnoDB default CHARSET=ucs2;


	
