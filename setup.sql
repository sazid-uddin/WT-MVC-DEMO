-- SQL script to set up the mvc_demo database and users table
CREATE DATABASE IF NOT EXISTS mvc_demo;
USE mvc_demo;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, phone) VALUES
('Alice Smith', 'alice@example.com', '123-456-7890'),
('Bob Johnson', 'bob@example.com', '234-567-8901'),
('Charlie Lee', 'charlie@example.com', '345-678-9012');
