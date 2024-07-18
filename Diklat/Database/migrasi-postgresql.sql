/* -----MIGRASI----- */

// Create database
CREATE DATABASE IF NOT EXISTS diklat;

/* Connect to the newly created database (use psql command) */
/* \c diklat */

// Create table
CREATE TABLE IF NOT EXISTS iot (
    id SERIAL PRIMARY KEY,
    ruang VARCHAR(3) NOT NULL,
    pesan TEXT NOT NULL,
    waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
