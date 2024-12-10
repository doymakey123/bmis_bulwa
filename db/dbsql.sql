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
    household_number VARCHAR(100) NOT NULL,
    fname VARCHAR(100) NOT NULL,
    mname VARCHAR(100) NOT NULL,
    lname VARCHAR(100) NOT NULL,
    suffix VARCHAR(15),
    gender VARCHAR(10) NOT NULL,
    dob VARCHAR(10) NOT NULL,
    civil_status VARCHAR(10) NOT NULL,
    nationality VARCHAR(10) NOT NULL,
    religion VARCHAR(50) NOT NULL,
    purok VARCHAR(100) NOT NULL,
    address VARCHAR(200) NOT NULL,
    mobile VARCHAR(11) NOT NULL,
    email VARCHAR(100) NOT NULL,
    voter_status VARCHAR(50) NOT NULL,
    Precinct_number VARCHAR(50),
    philhelth_number VARCHAR(100),
    sss_gsis_number VARCHAR(100),
    tin_number VARCHAR(100),
    educational_attainment VARCHAR(200) NOT NULL,
    employment_status VARCHAR(100) NOT NULL,
    occupation VARCHAR(200),
    monthly_annual_income VARCHAR(50),
    pwd_status VARCHAR(50) NOT NULL,
    solo_parent_status VARCHAR(50) NOT NULL,
    relationship_household_head VARCHAR(100),
    head_of_the_family VARCHAR(100),
    type_of_dwelling VARCHAR(100) NOT NULL,
    health_condition VARCHAR(200) NOT NULL,
    vaccination_status VARCHAR(50) NOT NULL,
    blood_type VARCHAR(5) NOT NULL,
    beneficiary_program VARCHAR(100),
    emergency_contact_person VARCHAR(150) NOT NULL,
    emergency_contact_relationship VARCHAR(50) NOT NULL,
    emergency_contact_number VARCHAR(11) NOT NULL,
    image_path VARCHAR(255) DEFAULT NULL,
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



CREATE TABLE tbl_activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    user_type VARCHAR(15) NOT NULL,
    activity_type VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE tbl_sk_official (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    mname VARCHAR(50),
    lname VARCHAR(50) NOT NULL,
    suffix VARCHAR(50),
    position VARCHAR(15) NOT NULL,
    rank VARCHAR(50) NOT NULL,
    assign_area VARCHAR(100) NOT NULL,
    committee  VARCHAR(100) NOT NULL,
    term VARCHAR(5) NOT NULL,
    year_elected VARCHAR(100) NOT NULL,
    status VARCHAR(15) NOT NULL,
    date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP    
);



CREATE TABLE tbl_brgy_official (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    mname VARCHAR(50),
    lname VARCHAR(50) NOT NULL,
    suffix VARCHAR(50),
    position VARCHAR(15) NOT NULL,
    rank VARCHAR(50) NOT NULL,
    assign_area VARCHAR(100) NOT NULL,
    committee  VARCHAR(100) NOT NULL,
    term VARCHAR(5) NOT NULL,
    year_elected VARCHAR(100) NOT NULL,
    status VARCHAR(15) NOT NULL,
    date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP    
);