create database s4_ras;
use s4_ras;

-- ADMINS
create table admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30),
    email VARCHAR(20),
    password VARCHAR(255) -- hashed
);

-- UTILISATEURS
create table users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30),
    password VARCHAR(255) , -- hashed
    email VARCHAR(100),
    genre ENUM('M','F'),        -- M ou F
    taille INT,           -- en cm
    poids DECIMAL(5,2),   -- en kg
    gold TINYINT          -- non 0 ou oui 1
);

-- CODES
create table credits(
    id INT AUTO_INCREMENT PRIMARY KEY,
    valeur INT,
    code VARCHAR(14) -- 14

);
