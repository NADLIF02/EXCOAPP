-- Création de la base de données si elle n'existe pas
CREATE DATABASE IF NOT EXISTS employee_leaves;
USE employee_leaves;

-- Création de la table des congés si elle n'existe pas
CREATE TABLE IF NOT EXISTS conges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    description TEXT
);

-- Création de la table des utilisateurs si elle n'existe pas
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Création d'un utilisateur de base de données spécifique pour l'application si non existant
CREATE USER IF NOT EXISTS 'admin'@'%' IDENTIFIED BY 'admin123';

-- Attribution des privilèges à l'utilisateur
GRANT ALL PRIVILEGES ON employee_leaves.* TO 'admin'@'%';

-- Application des changements de privilèges
FLUSH PRIVILEGES;
