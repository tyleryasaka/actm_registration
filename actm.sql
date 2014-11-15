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

create table teams(
	team_id int(11) AUTO_INCREMENT,
	
	school_name varchar(64) NOT NULL,
	school_address_street varchar(64) NOT NULL,
	school_address_city varchar(64) NOT NULL,
	school_address_state char(2) NOT NULL,
	school_address_zip int(5) NOT NULL,
	
	division int(1) NOT NULL,
	site varchar(64) NOT NULL, #not sure what the data will be
	
	comprehensive int(4), 
	algebraII int(4),
	geometry int(4),
	
	PRIMARY KEY(team_id)
)ENGINE=InnoDB default CHARSET=ucs2;

create table mentors (
	mentor_id int(11) AUTO_INCREMENT,
	team_id int(11),
	name varchar(64) NOT NULL,
	email varchar(64) NOT NULL,
	# might be a phone type in sql. i know theres a date type
	phone_number int(11) NOT NULL,
	entry_id int(11) NOT NULL,
	primary_mentor tinyint NOT NULL DEFAULT 0,
	PRIMARY KEY(mentor_id),
	FOREIGN KEY(team_id) REFERENCES teams(team_id)
)ENGINE=InnoDB default CHARSET=ucs2;
