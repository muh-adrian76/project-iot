<?php
session_start();
date_default_timezone_set("Asia/Jakarta");

// Bisa dikembangkan untuk menerapkan environment untuk mengenkripsi kredensial database
$db_servername = 'localhost';
$db_username = 'developer';
$db_password = '12345678';
$db_name = 'diklat';

/* -----MySQL----- */
// $conn = mysqli_connect($db_servername, $db_username, $db_password, $db_name);
// if ($conn->connect_error) {
//     die("Gagal terkoneksi ke database: " . $conn->connect_error);
// }

/* -----PostgreSQL----- */
$db_port = 5432;
$conn_string = "host=$db_servername port=$db_port dbname=$db_name user=$db_username password=$db_password";
$conn = pg_connect($conn_string);
if (!$conn) {
    die("Gagal terkoneksi ke database: " . pg_last_error());
}
