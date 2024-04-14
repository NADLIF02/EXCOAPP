CREATE DATABASE IF NOT EXISTS employee_leaves;

CREATE USER 'admin'@'%' IDENTIFIED BY 'admin123';
GRANT ALL PRIVILEGES ON employee_leaves.* TO 'admin'@'%';
FLUSH PRIVILEGES;

USE employee_leaves;

CREATE TABLE conges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    description TEXT
);
