Blood Bank App
==============

This is a blood bank application developed as part of assignment by [Internshala](https://internshala.com/) and deployed on Heroku at [https://bloodbank-prabhu.herokuapp.com/](https://bloodbank-prabhu.herokuapp.com/).

This app was made using [PHP](https://www.php.net).

Database Configuration
-------------
Run the following MySQL commands in PHPMyAdmin.

#### Hospital Accounts
```sh
CREATE TABLE IF NOT EXISTS `hospital_accounts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(100) NOT NULL,
    `hospital_name` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
```
#### Receiver Accounts
```sh
CREATE TABLE IF NOT EXISTS `receiver_accounts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `receiver_name` varchar(100) NOT NULL,
    `username` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(100) NOT NULL,
    `blood_group` varchar(3) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
```

#### Blood Banks
```sh
CREATE TABLE IF NOT EXISTS `blood_banks` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `hospital_id` int(11) NOT NULL,
    `blood_group` varchar(3) NOT NULL,
    `blood_litres` decimal(4, 1) DEFAULT 0.0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
```
```sh
ALTER TABLE blood_bank.blood_banks
  ADD CONSTRAINT blood_banks UNIQUE(hospital_id, blood_group);
```  

#### Blood Requests
```sh
CREATE TABLE IF NOT EXISTS `blood_requests` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `receiver_id` int(11) NOT NULL,
    `hospital_id` int(11) NOT NULL,
    `blood_group` varchar(3) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
```
```sh
ALTER TABLE blood_bank.blood_requests
  ADD CONSTRAINT blood_requests UNIQUE(receiver_id, hospital_id);
```

Then define foreign key relationships among the created tables as shown in the diagram below:

![Database Schema Design](Schema_Design.png)

All the foreign keys should be defined with these configurations:
- On Delete: CASCADE
- On Update: RESTRICT

How to run?
-------------
Now you can run the app by running a local apache server and MySQL on XAMPP.
The website will be available [here](https://localhost/blood_bank/).


## Tasks Completed
- [X] Completed Sign Up and Login Page
- [X] Completed Home and Profile Page of Hospital
- [X] Completed Home and Profile Page of Receiver
- [X] Designed and implemented database schemas
- [X] Create Add Blood Info Page
- [X] Create Available Blood Samples Page
- [X] Create View Requests Page
- [X] Login and Regsiter Screen Validation Errors Display
- [X] Jquery to implement successful redirect in case of failed validations
- [X] Available Blood Samples on home page + home page design
- [X] Refactor Code repeating php code using include
- [X] Add receiver alert on request sample
- [X] Add your signature + Internshala in the website
- [X] Sort Graphs
- [X] Deploy