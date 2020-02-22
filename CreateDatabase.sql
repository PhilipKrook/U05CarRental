DROP DATABASE IF EXISTS RentalCar;
CREATE DATABASE RentalCar;
USE RentalCar;

CREATE TABLE Customers (customerID VARCHAR(256) KEY, customerName VARCHAR(256),  
                        customerAddress VARCHAR(256), customerPostal VARCHAR(256), 
                        customerPhone VARCHAR(256));
 
CREATE TABLE Cars      (carID VARCHAR(256), carMake VARCHAR(256), carColour VARCHAR(256), 
                        carYear VARCHAR(256), carPrice VARCHAR(256), checkedOutBy VARCHAR(256),
                        checkedOutTime TIMESTAMP);

CREATE TABLE History   (carID VARCHAR(256) NOT NULL, time TIMESTAMP, customerID VARCHAR(256));

INSERT INTO Customers(customerID, customerName, customerAddress, customerPostal, customerPhone)
  VALUES ('6712200568', 'Emil Nilsson', 'Bondegatan 2', '678 39 Hamnstaden', '0708725343');

INSERT INTO Cars(carID, carMake, carColour, carYear, carPrice)
  VALUES ('XYX123','Toyota', 'Black', '2012', '100');


SELECT * FROM Customers;
SELECT * FROM Cars;
SELECT * FROM Events;