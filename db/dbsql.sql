CREATE DATABASE db_bmis_bulwa;

USE db_bmis_bulwa;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tbl_resident (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(100) NOT NULL,
    mname VARCHAR(100) NOT NULL,
    lname VARCHAR(100) NOT NULL,
    suffix VARCHAR(15),
    gender VARCHAR(10) NOT NULL,
    bod VARCHAR(10) NOT NULL,
    civil_status VARCHAR(10) NOT NULL,
    nationality VARCHAR(10) NOT NULL,
    religion VARCHAR(50) NOT NULL,
    mobile VARCHAR(11) NOT NULL,
    email VARCHAR(100) NOT NULL,
    house_number VARCHAR(100) NOT NULL,
    purok VARCHAR(100) NOT NULL,
    brgy VARCHAR(100) NOT NULL,
    Head_of_family VARCHAR(50) NOT NULL,
    household_composition VARCHAR(50) NOT NULL,
    educational_attainment VARCHAR(100) NOT NULL,
    occupation VARCHAR(100) NOT NULL,
    type_of_residency VARCHAR(50) NOT NULL,
    blood_type VARCHAR(10) NOT NULL,
    disabilities VARCHAR(100) NOT NULL,
    beneficiary_status VARCHAR(100) NOT NULL,
    emergency_contact_person VARCHAR(150) NOT NULL,
    emergency_contact_relationship VARCHAR(50) NOT NULL,
    emergency_contact_number VARCHAR(11) NOT NULL,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE tbl_blotter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    complainant_fname VARCHAR(100) NOT NULL,
    complainant_mname VARCHAR(100),
    complainant_lname VARCHAR(100) NOT NULL,
    complainant_suffix VARCHAR(10),
    complainant_address VARCHAR(200) NOT NULL,
     complainant_contact VARCHAR(11) NOT NULL,
    respondent_fname VARCHAR(100) NOT NULL,
    respondent_mname VARCHAR(100),
    respondent_lname VARCHAR(100) NOT NULL,
    respondent_suffix VARCHAR(10),
    respondent_contact VARCHAR(11),
    blotter_type VARCHAR(50) NOT NULL,
    details TEXT NOT NULL,
    status VARCHAR(15) NOT NULL,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);