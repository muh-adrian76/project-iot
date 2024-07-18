/* -----MIGRASI----- */

// Create database
CREATE DATABASE IF NOT EXISTS diklat;

/* Switch to the newly created database */
USE diklat;

// Create table
CREATE TABLE IF NOT EXISTS iot (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ruang VARCHAR(3) NOT NULL,
    pesan TEXT NOT NULL,
    waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
