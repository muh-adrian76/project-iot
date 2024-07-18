## Panduan Mencari chatId Group Whatsapp
### A. Menyiapkan Akun Fonnte
1. Buat/Login akun fonnte: <a href="https://fonnte.com/">(Website Fonnte)</a>
2. Buka menu Device dan tambahkan device
3. Masukkan nama, dan nomor whatsapp anda serta checklist Personal dan Group
4. Klik menu connect pada list device
5. Scan QR Code menggunakan smartphone Anda untuk menautkan perangkat
   
   ![image](https://github.com/user-attachments/assets/daafcc45-87a2-43e4-80a9-9cc5e5100c32)

6. Setelah berhasil terkoneksi, Klik tombol Token untuk meng-copy API Key

### B. Melakukan Pencarian chatId
1. Buka folder ```Extract chatId Whatsapp``` code editor Anda
2. Buka file ```getGroupChatId.php``` dan ganti variabel TOKEN dengan API Key Anda
   
   ```c
   CURLOPT_HTTPHEADER => array(
        'Authorization: TOKEN'      // <--- ganti dengan token akun fonnte
    ),
   ```
4. Simpan dan jalankan file php pada Terminal/Command Line Interface
   
   ![image](https://github.com/user-attachments/assets/c65fd8d4-e98a-4ae0-893b-496375ba3634)

5. Buka file ```response.json``` dan cari **chatId** berdasarkan nama (orang atau grup)
