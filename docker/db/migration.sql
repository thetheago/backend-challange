CREATE DATABASE IF NOT EXISTS payment;

USE payment;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    shopkeeper BOOLEAN NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    UNIQUE KEY unique_email_cpf (email, cpf)
);
