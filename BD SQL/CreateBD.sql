
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

DROP DATABASE IF EXISTS touristSystem;
CREATE DATABASE touristSystem DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE touristSystem;





/*---------------------------category table-------------------------------------*/

DROP TABLE IF EXISTS category;
CREATE TABLE category(
idCategory int NOT NULL auto_increment, 
typeCategory varchar(50) NOT NULL COLLATE utf8_spanish_ci,
PRIMARY KEY(idCategory)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*---------------------------person table-------------------------------------*/

DROP TABLE IF EXISTS person;
CREATE TABLE person(
idPerson int auto_increment,
idCard int (15) NOT NULL, 
namePerson varchar(50) NOT NULL COLLATE utf8_spanish_ci,
firstLastNamePerson varchar(50) NOT NULL COLLATE utf8_spanish_ci,
secondLastNamePerson varchar(50) NOT NULL COLLATE utf8_spanish_ci,
personPhone int(50) NOT NULL,
personAddress varchar(100) NOT NULL COLLATE utf8_spanish_ci,
personEmail varchar(100) NOT NULL COLLATE utf8_spanish_ci,
personPassword varchar(255) NOT NULL COLLATE utf8_spanish_ci,
rolDescription varchar(25) NOT NULL COLLATE utf8_spanish_ci,
token varchar(255),
PRIMARY KEY(idPerson)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*---------------------------recommendation table-------------------------------------*/

DROP TABLE IF EXISTS recommendation;
CREATE TABLE recommendation(
idRecommendation int NOT NULL auto_increment, 
idPerson int NOT NULL,
idCategory int NOT NULL,
PRIMARY KEY(idRecommendation),
FOREIGN KEY(idPerson) REFERENCES person(idPerson),
FOREIGN KEY(idCategory) REFERENCES category(idCategory)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*---------------------------preference table-------------------------------------*/

DROP TABLE IF EXISTS preference;
CREATE TABLE preference(
idPreference int NOT NULL auto_increment, 
idPerson int NOT NULL,
idCategory int NOT NULL,
PRIMARY KEY(idPreference),
FOREIGN KEY(idPerson) REFERENCES person(idPerson),
FOREIGN KEY(idCategory) REFERENCES category(idCategory)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*---------------------------Booking table-------------------------------------*/

DROP TABLE IF EXISTS booking;
CREATE TABLE booking(
idBooking int(25) NOT NULL auto_increment,
description varchar(255) NOT NULL COLLATE utf8_spanish_ci,
state boolean,
price float,
location varchar(255) NOT NULL COLLATE utf8_spanish_ci,
totalPossibleReservation int(100),
idPerson int NOT NULL,
PRIMARY KEY(idBooking),
FOREIGN KEY(idPerson) REFERENCES person(idPerson)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*---------------------------Booking_gallery table-------------------------------------*/

DROP TABLE IF EXISTS booking_Gallery;
CREATE TABLE booking_Gallery(
idBooking_gallery int(25) NOT NULL auto_increment,
image varchar(255) COLLATE utf8_spanish_ci,
idBooking int NOT NULL,
PRIMARY KEY(idBooking_gallery),
FOREIGN KEY(idBooking) REFERENCES booking(idBooking)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*---------------------------housing table-------------------------------------*/

DROP TABLE IF EXISTS housing;
CREATE TABLE housing(
idHousing int(25) NOT NULL auto_increment,
initial_date date,
final_date date,
arrival_date date,
total_person int,
idPerson int NOT NULL,
idBooking int NOT NULL,
PRIMARY KEY(idHousing),
FOREIGN KEY(idPerson) REFERENCES person(idPerson),
FOREIGN KEY(idBooking) REFERENCES booking(idBooking)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*---------------------------valoration table-------------------------------------*/

DROP TABLE IF EXISTS valoration;
CREATE TABLE valoration(
idValoration int(25) NOT NULL auto_increment,
score float(2,1) NOT NULL,
commentary varchar(255) NOT NULL COLLATE utf8_spanish_ci,
idPerson int NOT NULL,
idBooking int NOT NULL,
PRIMARY KEY(idValoration),
FOREIGN KEY(idPerson) REFERENCES person(idPerson),
FOREIGN KEY(idBooking) REFERENCES booking(idBooking)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

COMMIT;#end of transaction
