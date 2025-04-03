<?php
// Kredensial database
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'smart_garden';

// Response dari API
$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$sql = "SELECT * FROM sensor_data ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['id']}</td><td>{$row['kelembapan']}</td><td>{$row['waktu']}</td></tr>";
    }
} else {
    echo "<tr><td colspan='3'>Belum ada data</td></tr>";
}
$conn->close();
