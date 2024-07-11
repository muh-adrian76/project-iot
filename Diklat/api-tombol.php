<?php
require 'database.php';

/* -----DATA----- */
$ruang = $_GET["ruang"];
$pesan = '';
$object = [
    '1' => 'Tolong ruang 1',
    '2' => 'Tolong ruang 2',
    '3' => 'Tolong ruang 3',
    '4' => 'Tolong ruang 4',
    '5' => 'Tolong ruang 5',
    '6' => 'Tolong ruang 6',
    '7' => 'Tolong ruang 7',
    '8' => 'Tolong ruang 8',
    '9' => 'Tolong ruang 9',
    '10' => 'Tolong ruang 10',
    '11' => 'Tolong ruang 11',
    '12' => 'Tolong ruang 12'
];

foreach ($object as $key => $value) {
    if ($ruang == $key) {
        $pesan = $value;
        break;
    }
}

/* -----KIRIM PESAN KE WHATSAPP GROUP----- */
//The idInstance and apiTokenInstance values are available in your account, double brackets must be removed
$url = 'https://7103.api.greenapi.com/waInstance7103954187/sendMessage/d782b18fb25347f0ae97ac97ed0c6872885a72334177416aac';

// {
//   "id": "120363297036256879@g.us", <---- 'chatId'
//   "name": "Excellent Service Diklat"
// }
$data = array(
    'chatId' => '120363021393964214@g.us',
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
$waktu = date("H:i:s"); // waktu saat tombol ditekan
$query = "INSERT INTO iot (ruang, pesan, waktu) VALUES ('$ruang', '$pesan', '$waktu')";

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

// CREATE TABLE iot (
//     id INT PRIMARY KEY,
//     ruang VARCHAR(3) NOT NULL,
//     pesan TEXT NOT NULL,
//     waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );
