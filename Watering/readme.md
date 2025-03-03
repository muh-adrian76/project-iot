# IoT Smart Garden Watering System

## Deskripsi Proyek
Sistem penyiraman tanaman otomatis berbasis IoT menggunakan Raspberry Pi. Penyiraman dilakukan berdasarkan kelembapan tanah dan waktu tertentu. Jika tanah terlalu kering atau sudah mencapai waktu penyiraman, pompa air akan menyala selama 5 menit dan data akan tersimpan dalam database MySQL. Data juga dapat dipantau secara real-time melalui web server menggunakan AJAX.

## Komponen yang Dibutuhkan
1. Raspberry Pi (seri 3B atau 4B)
2. Sensor kelembapan tanah
3. Modul relay
4. Pompa air 5V
5. Breadboard dan kabel jumper
6. Catu daya 5V untuk Raspberry Pi dan pompa air

## RAB
![image](https://github.com/user-attachments/assets/8cf17189-830a-49a2-935a-228c5c6af39d)

## Diagram Wiring / Pengkabelan
![image](https://github.com/user-attachments/assets/319dfb6c-0dbc-44e5-bd4f-10a13ee4e4aa)

## Contoh Instalasi Hardware
![image](https://github.com/user-attachments/assets/39baf790-534e-4140-bd55-2c2ac4a69828)

![image](https://github.com/user-attachments/assets/190aa9cc-78b0-417a-9ec8-3c5a8eacc939)

## Instalasi Software (Database dan Web Server)
### 1. Instalasi MySQL dan Apache di Raspberry Pi
```sh
sudo apt update && sudo apt upgrade -y
sudo apt install apache2 mariadb-server php php-mysql libapache2-mod-php -y
```
### 2. Konfigurasi Database
```sh
sudo mysql -u root -p
CREATE DATABASE smart_garden;
USE smart_garden;
CREATE TABLE sensor_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kelembapan INT NOT NULL,
    waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Kode Program di Raspberry Pi (Python)
Buat file `smart_garden.py`:
```python
import time
import pymysql
import RPi.GPIO as GPIO
from datetime import datetime

# Konfigurasi GPIO
SENSOR_PIN = 17
RELAY_PIN = 27
GPIO.setmode(GPIO.BCM)
GPIO.setup(SENSOR_PIN, GPIO.IN)
GPIO.setup(RELAY_PIN, GPIO.OUT)
GPIO.output(RELAY_PIN, GPIO.HIGH)

# Koneksi ke Database
conn = pymysql.connect(host='localhost', user='root', password='', database='smart_garden')
cursor = conn.cursor()

def baca_sensor():
    return GPIO.input(SENSOR_PIN)

def simpan_data(kelembapan):
    cursor.execute("INSERT INTO sensor_data (kelembapan) VALUES (%s)", (kelembapan,))
    conn.commit()

def penyiraman():
    print("Menyiram tanaman...")
    GPIO.output(RELAY_PIN, GPIO.LOW)
    time.sleep(300)
    GPIO.output(RELAY_PIN, GPIO.HIGH)
    print("Penyiraman selesai.")

try:
    while True:
        kelembapan = baca_sensor()
        simpan_data(kelembapan)
        jam_sekarang = datetime.now().hour

        if kelembapan == 0 or jam_sekarang in [6, 12, 18]:
            penyiraman()
        
        time.sleep(10)
except KeyboardInterrupt:
    GPIO.cleanup()
    conn.close()
```

## Kode Web Server (PHP + AJAX)
### 1. Buat File `index.html`
```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Smart Garden</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Monitoring Sensor Kelembapan</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kelembapan</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody id="data">
        </tbody>
    </table>
    
    <script>
        function loadData() {
            $.ajax({
                url: "data.php",
                method: "GET",
                success: function(response) {
                    $("#data").html(response);
                }
            });
        }
        setInterval(loadData, 2000);
        loadData();
    </script>
</body>
</html>
```

### 2. Buat File `database.php`
```php
<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'smart_garden';
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
?>
```

## Cara Menjalankan
1. Jalankan script Python dengan perintah:
```sh
cd ./Direktori-file-program
python3 smart_garden.py
```
2. Pastikan server web berjalan:
```sh
sudo systemctl restart apache2
```
3. Akses web monitoring melalui browser dengan alamat:
```sh
http://<IP_RASPBERRY_PI>/index.php
```

## Tutorial Lainnya
- Install Raspi OS : 
https://www.tomshardware.com/reviews/raspberry-pi-headless-setup-how-to,6028.html
- Untuk meremote raspi pada laptop dengan GUI (Tutorial sudah ada pada web diatas) :
  - Remote raspi menggunakan SSH.
  - Aktifkan port VNC.
  - Download VNC viewer.
  - Remote raspi menggunakan VNC. 
- Menggunakan konektor splicing untuk menyambung 2 kabel jumper : 
https://www.youtube.com/watch?v=PoSJHY2Y1ys

## Referensi
- https://medium.com/technology-hits/simplified-raspberry-pi-plant-watering-system-942099e4e2cd
- https://www.makerspace-online.com/watering-pi-2/
