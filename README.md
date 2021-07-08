# BloodBank

## Pending Tasks
- [ ] Refactor Code - Include repeating html code in a single header file
- [ ] Customise theme of website
- [ ] Create Add Blood Info Page
- [ ] Create Available Blood Samples Page
- [ ] Create View Requests Page

## Completed Tasks
- [X] Completed Sign Up and Login Page
- [X] Completed Home and Profile Page of Hospital
- [X] Completed Home and Profile Page of Receiver
- [X] Designed database schemas


## MySQL Database Setup

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

#### Blood Requests

CREATE TABLE IF NOT EXISTS `blood_requests` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `receiver_id` int(11) NOT NULL,
    `hospital_id` int(11) NOT NULL,
    `blood_group` varchar(3) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;