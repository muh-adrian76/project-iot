## Cara Menjalankan File Migrasi

### MySQL
1. **Download dan Install MySQL**
     - <a href="https://dev.mysql.com/doc/refman/8.4/en/windows-installation.html">Windows</a>
     - <a href="https://dev.mysql.com/doc/refman/8.4/en/linux-installation.html">Linux</a>
     - <a href="https://dev.mysql.com/doc/refman/8.4/en/macos-installation.html">MacOS</a>
3. **Buka Terminal/Command Prompt**
4. **Pindah ke Direktori Diklat/Database**
5. **Jalankan File Migrasi**:
   ```sh
   mysql -u <your_username> -p < migrasi-mysql.sql
   ```
### PostgreSQL
1. **Download dan Install PostgreSQL**: <a href="https://www.postgresql.org/download/">Disini</a>
2. **Buka Terminal/Command Prompt**
3. **Pindah ke Direktori Diklat/Database**
2. **Jalankan File Migrasi**:
   ```sh
   psql -U <your_username> -f migrasi-postgresql.sql
   ```
**Gantilah *<your_username>* dengan username MySQL**
