## Panduan Pembuatan Sistem 🛠
### A. Membuat Rangkaian: <a href="https://whimsical.com/iot-diklat-9wLshGKKeMcKN6F59n3QEG">(Desain Alat & Wiring/Pengkabelan)</a>
![image](https://github.com/user-attachments/assets/e6681b9b-e366-4427-ba35-1c7926bb32de)

### B. Menyiapkan Mikrokontroller <a href="https://github.com/muh-adrian76/project-iot/tree/main/Diklat/ESP32">ESP32</a>

### C. Menyiapkan API Whatsapp
1. Buat/Login ke console <a href="https://console.green-api.com/auth">Green API</a>
2. Buat instance baru pada menu sidebar ***Instance***
3. Pilih Developer
4. Pilih *Instance* yang sudah berhasil terbuat untuk melihat ***API Key***, seperti pada gambar berikut:
   ![image](https://github.com/user-attachments/assets/9ed5621c-df3d-4d96-ba3e-e4b7b72f6ee4)

5. Scroll kebawah untuk menautkan API dengan nomor Whatsapp Anda menggunakan QR Code:
   ![image](https://github.com/user-attachments/assets/6cb6e307-213c-46c6-ad88-0700c22b7d2b)

6. Berikut adalah hasil dari sinkronisasi Nomor Whatsapp dengan Green API:
   ![image](https://github.com/user-attachments/assets/545e46dd-8390-4b78-b153-1d40a25becfe)


### D. Men-Deploy Program di Local
1. Buka Terminal/Command Line Interface
2. Gunakan <a href="https://git-scm.com/book/id/v2/Memulai-Memasang-Git">Git</a> untuk meng-*copy* project dengan perintah berikut:
   ```
   git clone https://github.com/muh-adrian76/project-iot.git
   ```
3. Buka folder **project-iot** pada Code Editor Anda
4. Sesuaikan nilai dari variabel dengan kredensial akun Green API Anda ***(Langkah C.4)***
   ```c
   /* -----KIRIM PESAN KE WHATSAPP GROUP----- */
    // URL didapatkan dari dokumentasi Green API: https://console.green-api.com/app/api/sendMessage
    $api_url = 'https://7103.api.greenapi.com';
    $idInstance = '7103954187';
    $apiTokenInstance = 'd782b18fb25347f0ae97ac97ed0c6872885a72334177416aac';
    $url = "$api_url/waInstance$idInstance/sendMessage/$apiTokenInstance";
    
    $data = array(
        'chatId' => '120363297036256879@g.us', // <--- chatId: Tutorial dapat dilihat di folder 'Extract chatId Whatsapp'
        'message' => $pesan
    );
   ```
5. Migrasikan <a href="https://github.com/muh-adrian76/project-iot/tree/main/Diklat/Database">Database</a>
6. Aktifkan *web server* terlebih dahulu (Dapat menggunakan <a href="https://www.niagahoster.co.id/blog/membuat-website-localhost-xampp/">Apache</a> atau NGINX)
7. Tampilan log dapat dilihat pada **http://localhost/project-iot/Diklat/**
8. Secara default, riwayat log akan tersimpan di **server *staging*** (kecuali Anda merubah nilai URL Server pada program <a href="https://github.com/muh-adrian76/project-iot/blob/main/Diklat/ESP32/Testing/Testing.ino">Testing.ino</a>)

## Berikut Hasil Deploy <a href="http://10.14.41.185:8076">Sebelumnya</a> di Server *Staging* 💻
### Panduan Update Program pada Server *Staging*
1. Lakukan remote ke server menggunakan SSH di Terminal/Command Line Interface: ``ssh root@10.14.41.185``
2. Pindah ke direktori project menggunakan perintah berikut: ``cd /var/www/html/project-iot/``
3. Lakukan update menggunakan perintah berikut: ``git pull origin main``
4. Refresh <a href="http://10.14.41.185:8076">*website*</a>

## Referensi 📄
- https://www.reddit.com/r/esp8266/comments/61bjp1/my_rechargeable_iot_button_using_the_es01/?rdt=33951
- https://ejournal.unuja.ac.id/index.php/jeecom/article/view/1118/pdf
- https://forum.arduino.cc/t/arduino-nano-with-emergency-stop-button/1151280
- https://www.s4a-access.com/no-touch-exit-button-american-standard-infrared-sensor-exit-button_p560.html#parentHorizontalTab012
