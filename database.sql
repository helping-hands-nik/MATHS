CREATE DATABASE registration_db;
USE registration_db;

CREATE TABLE candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    father_name VARCHAR(100) NOT NULL,
    mother_name VARCHAR(100) NOT NULL,
    dob DATE NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    certificate_paths TEXT NOT NULL
);