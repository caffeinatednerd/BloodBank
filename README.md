# BloodBank

## Pending Tasks
- [ ] Available Blood Samples on home page + home page design
- [ ] Refactor Code repeating html & php code in a using include and require
- [ ] Deploy
- [ ] Customise theme of websites
- [ ] Pagination and Sorting

## Completed Tasks
- [X] Completed Sign Up and Login Page
- [X] Completed Home and Profile Page of Hospital
- [X] Completed Home and Profile Page of Receiver
- [X] Designed and implemented database schemas
- [X] Create Add Blood Info Page
- [X] Create Available Blood Samples Page
- [X] Create View Requests Page
- [X] Login and Regsiter Screen Validation Errors Display
- [X] Jquery to implement successful redirect in case of failed validations

## MySQL Database Setup Commands

#### Hospital

CREATE TABLE IF NOT EXISTS `hospital_accounts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(100) NOT NULL,
    `hospital_name` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#### Receiver

CREATE TABLE IF NOT EXISTS `receiver_accounts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `receiver_name` varchar(100) NOT NULL,
    `username` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(100) NOT NULL,
    `blood_group` varchar(3) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


#### Blood Banks

CREATE TABLE IF NOT EXISTS `blood_banks` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `hospital_id` int(11) NOT NULL,
    <!-- `hospital_name` varchar(100) NOT NULL, -->
    `blood_group` varchar(3) NOT NULL,
    `blood_litres` decimal(4, 1) DEFAULT 0.0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


ALTER TABLE blood_bank.blood_banks
  ADD CONSTRAINT blood_banks UNIQUE(hospital_id, blood_group);
  
#### Blood Requests

CREATE TABLE IF NOT EXISTS `blood_requests` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `receiver_id` int(11) NOT NULL,
    `hospital_id` int(11) NOT NULL,
    `blood_group` varchar(3) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

ALTER TABLE blood_bank.blood_requests
  ADD CONSTRAINT blood_requests UNIQUE(receiver_id, hospital_id);