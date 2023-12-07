CREATE DATABASE IF NOT EXISTS nicetrymates;
USE nicetrymates;

-- Create users table
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    hashedpassword VARCHAR(255) NOT NULL,
    lastconnection DATETIME,
    token VARCHAR(255)
);
