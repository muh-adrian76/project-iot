<?php
require 'database.php';

/* -----DATA----- */
$ruang = $_GET["ruang"];
$pesan = '';
$object = [
    '1' => '*Ruang 1:* Mohon bantuan operasional kelas',
    '2' => '*Ruang 2:* Mohon bantuan operasional kelas',
    '3' => '*Ruang 3:* Mohon bantuan operasional kelas',
    '4' => '*Ruang 4:* Mohon bantuan operasional kelas',
    '5' => '*Ruang 5:* Mohon bantuan operasional kelas',
    '6' => '*Ruang 6:* Mohon bantuan operasional kelas',
    '7' => '*Ruang 7:* Mohon bantuan operasional kelas',
    '8' => '*Ruang 8:* Mohon bantuan operasional kelas',
    '9' => '*Ruang 9:* Mohon bantuan operasional kelas',
    '10' => '*Ruang 10:* Mohon bantuan operasional kelas',
    '11' => '*Ruang 11:* Mohon bantuan operasional kelas',
    '12' => '*Ruang 12:* Mohon bantuan operasional kelas',
    '13' => '*Ruang 13:* Mohon bantuan operasional kelas',
    '14' => '*Ruang 14:* Mohon bantuan operasional kelas',
    '15' => '*Ruang 15:* Mohon bantuan operasional kelas'
];

foreach ($object as $key => $value) {
    if ($ruang == $key) {
        $pesan = $value;
        break;
    }
}

/* -----KIRIM PESAN KE WHATSAPP GROUP----- */
// URL didapatkan dari dokumentasi Green API
$url = 'https://7103.api.greenapi.com/waInstance7103954187/sendMessage/d782b18fb25347f0ae97ac97ed0c6872885a72334177416aac';

// {
//   "id": "120363297036256879@g.us", <---- 'chatId'
//   "name": "Excellent Service Diklat"
// }
$data = array(
    'chatId' => '120363297036256879@g.us',
    'message' => $pesan
);

$options = array(
    'http' => array(
        'header' => "Content-Type: application/json\r\n",
        'method' => 'POST',
        'content' => json_encode($data)
    )
);

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

echo $response;

/* -----INSERT DATA KE DATABASE----- */
$query = "INSERT INTO iot (ruang, pesan) VALUES ('$ruang', '$pesan')";
// Koneksi ke database menggunakan variabel $conn

// MySQL
// if ($conn->query($query) === TRUE) {
//     echo "Data berhasil dimasukkan ke database.";
// } else {
//     echo "Error: " . $query . "<br>" . $koneksi->error;
// }
// $conn->close();

// PostgresQL
$result = pg_query($conn, $query);
if ($result) {
    echo "Data berhasil dimasukkan ke database.";
} else {
    echo "Error: " . $query . "<br>" . pg_last_error($conn);
}
pg_close($conn);

/* -----MIGRASI----- */
// CREATE DATABASE diklat;

// MySQL
// CREATE TABLE iot (
//     id INT PRIMARY KEY AUTO_INCREMENT,
//     ruang VARCHAR(3) NOT NULL,
//     pesan TEXT NOT NULL,
//     waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );

// PostgreSQL
// CREATE TABLE iot (
//     id SERIAL PRIMARY KEY,
//     ruang VARCHAR(3) NOT NULL,
//     pesan TEXT NOT NULL,
//     waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );