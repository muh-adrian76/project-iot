<?php
require './Database/database.php';

// MySQL
// $result = $conn->query("SELECT * FROM iot");
// // Display the data in a table
// echo "<table border='1'>";
// echo "<tr><th>id</th><th>ruang</th><th>pesan</th><th>waktu</th></tr>";
// while ($row = $result->fetch_assoc()) {
//     echo "<tr>";
//     echo "<td>" . $row["id"] . "</td>";
// echo "<td>" . $row["ruang"] . "</td>";
// echo "<td>" . $row["pesan"] . "</td>";
// echo "<td>" . $row["waktu"] . "</td>";
// echo "</tr>";
// }
// echo "</table>";
// $conn->close();

// PostgreSQL
$result = pg_query($conn, 'SELECT * FROM iot');
if ($result) {
    echo "<table border='1'>";
    echo "<tr>
        <th>id</th>
        <th>ruang</th>
        <th>pesan</th>
        <th>waktu</th>
    </tr>";
    while ($row = pg_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["ruang"] . "</td>";
        echo "<td>" . $row["pesan"] . "</td>";
        echo "<td>" . $row["waktu"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Error: " . $query . "<br>" . pg_last_error($conn);
}
pg_close($conn);
