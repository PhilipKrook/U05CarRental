DROP DATABASE IF EXISTS RentalCar;
CREATE DATABASE RentalCar;
USE RentalCar;

CREATE TABLE Customers (customerNumber INTEGER NOT NULL AUTO_INCREMENT KEY,
                        customerName VARCHAR(256), customerID VARCHAR(256), 
                        customerAddress VARCHAR(256), customerPostal VARCHAR(256), 
                        customerPhone VARCHAR(256));
 
CREATE TABLE Cars      (carMake VARCHAR(256), carName VARCHAR(256), carID VARCHAR(256), 
                        carColour VARCHAR(256), carYear VARCHAR(256), 
                        carPrice VARCHAR(256));

CREATE TABLE Events (carNumber INTEGER NOT NULL,
                     time TIMESTAMP,
                     amount REAL, -- FLOAT
                     FOREIGN KEY (carID) REFERENCES Cars(carID));

INSERT INTO Customers(customerName, customerID, customerAddress, customerPostal, customerPhone)
  VALUES ('Philip Krook', '8612160575', 'Skolvägen 13a', '184 30 Åkersberga', '0704253487')


/*
select * from Customers;
select * from Cars;
select * from Events;