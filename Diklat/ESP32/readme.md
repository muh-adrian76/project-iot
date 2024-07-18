## Panduan Modul Mikrokontroler
1. **Install dan jalankan Arduino IDE: <a target="_blank" href="https://www.arduino.cc/en/software">(Link Download)</a>**
2. **Download ESP32 Board**: 
   - Buka menu boards manager
   - Cari esp32 by Espressif
   - Install dan tunggu hingga selesai
     
     ![image](https://github.com/user-attachments/assets/4b9a431a-6f5d-48cb-aa3e-31216bed0f70)
3. **Instalasi Library yang Diperlukan**:
   - Copy kedua folder library (HTTPClient dan WiFi): <a target="_blank" href="https://github.com/muh-adrian76/project-iot/tree/main/Diklat/ESP32/Library">(Disini)</a>
   - Paste ke direktori document pada laptop/PC Anda (C:/Users/NamaUserAnda/Documents/Arduino/libraries)
     
     ![image](https://github.com/user-attachments/assets/acc205c8-722e-4f1b-bd8c-dc0436d62fd7)

4. **Upload program ke ESP32**
   - Buka file program pada aplikasi Arduino IDE: <a target="_blank" href="https://github.com/muh-adrian76/project-iot/tree/main/Diklat/ESP32/Testing/Testing.ino">(Yang ini)</a>
   - Sesuaikan nilai SSID, password, dan ruang
   ```sh
   // Kredensial Wi-Fi/Access Point Ruangan
   const char* ssid = "Hotspot DIklat Lt 1";
   const char* password = "123@PetrokimiaJaya!";

   // URL server
   String host = "http://10.14.41.185:8076";   // <--- IP atau domain dari server
   String path = "/";                          // <--- Direktori file api-tombol.php
   String serverName = host + path + "api-tombol.php";   // <--- Sesuaikan dengan nama file php (API) jika ada perubahan
   
   // Tombol
   String ruang = "1";       // <--- Sesuaikan dengan ruangan yang akan diinstalasi (string = 1 hingga 25)
   const int buttonPin = 15; // <--- Sesuaikan dengan kaki yang tersolder dengan kabel relay NO/Normally Open (tombol)

   ```
   - (Opsional) Sesuaikan serverName, apabila ingin men-deploy ke server pribadi atau production
   - Klik tombol Upload dan tunggu hingga selesai

5. **Buka serial monitor dan lakukan ujicoba (Tekan tombol)**
