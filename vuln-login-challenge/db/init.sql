-- init.sql

CREATE DATABASE IF NOT EXISTS vulnlogin;
USE vulnlogin;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- a dummy user for testing
INSERT INTO users (username, password) VALUES ('admin', 'password123');
