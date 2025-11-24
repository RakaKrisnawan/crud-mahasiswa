1. **Deskripsi Aplikasi**

    Entitas yang dipilih.
        Aplikasi ini menggunakan dua entitas utama, yaitu entitas User dan entitas Mahasiswa. Entitas User berfungsi sebagai pengelola autentikasi, di mana setiap pengguna dapat melakukan registrasi, login, memperbarui kata sandi, serta menghapus akun yang sedang digunakan. Setelah berhasil login, pengguna memperoleh akses ke seluruh fitur aplikasi untuk mengelola data mahasiswa. Sementara itu, entitas Mahasiswa menjadi objek utama pendataan, mencakup informasi seperti nama, NIM, angkatan, program studi, status aktif, serta foto mahasiswa.

    Penjelasan singkat fungsi aplikasi.
        Fitur aplikasi berfokus pada pengelolaan data mahasiswa melalui operasi Create, Read, Update, dan Delete. Pengguna dapat menambahkan data mahasiswa baru lengkap dengan unggahan foto, menampilkan daftar mahasiswa dalam tampilan terstruktur, melakukan pembaruan data tertentu, dan menghapus data yang tidak diperlukan. Seluruh proses pengolahan data dilakukan melalui antarmuka yang sederhana dan terintegrasi dengan sistem autentikasi, sehingga hanya pengguna terverifikasi yang dapat melakukan perubahan pada data mahasiswa.

2. **Spesifikasi Teknis**

    Versi PHP, DBMS yang digunakan.
        Spesifikasi teknis aplikasi ini dibangun menggunakan PHP versi 8.4.8 yang berjalan melalui instalasi PHP mandiri di sistem operasi pengguna, sementara sistem manajemen basis data yang digunakan adalah MySQL bawaan XAMPP.

    Struktur folder secara ringkas.
        Seluruh konfigurasi koneksi database dikelola melalui berkas inc/config.php, yang memuat inisialisasi sesi, pemanggilan class Database dan User, serta parameter host, nama basis data, username, dan password untuk membuat koneksi aktif ke database crud_mahasiswa. Struktur folder aplikasi disusun secara ringkas namun terorganisasi, mencakup folder class yang berisi komponen inti seperti Database.php, User.php, dan Mahasiswa.php; folder inc untuk file konfigurasi; folder mahasiswa yang menampung halaman create, edit, delete, dan detail; folder user untuk fitur manajemen akun seperti penggantian password dan penghapusan akun; folder uploads/foto_mahasiswa untuk penyimpanan foto; serta berkas-berkas fungsional utama di root seperti authenticate.php, index.php, login.php, logout.php, register.php, dan schema.sql. Selain itu, terdapat folder css yang memuat style.css sebagai stylesheet utama tampilan aplikasi.

    Penjelasan class utama (Database, Entity, Repository).
        Struktur class dalam aplikasi mengikuti pola sederhana dan mudah dipahami. Class Database berperan sebagai pengelola koneksi ke MySQL menggunakan PDO, menyediakan satu instance koneksi yang dapat digunakan oleh seluruh bagian aplikasi. Class User bertanggung jawab menangani seluruh proses autentikasi dan manajemen akun, termasuk registrasi, validasi login, pemanggilan data pengguna, pembaruan password, serta penghapusan akun. Sementara itu, class Mahasiswa menangani seluruh operasi CRUD untuk entitas mahasiswa, mulai dari pengambilan data, penyimpanan, pembaruan, penghapusan, hingga pengelolaan file foto di folder uploads. Tidak terdapat class Utility dalam proyek ini karena sudah dihapus sebagai bagian dari proses pembersihan file. Dengan struktur teknis ini, aplikasi dapat dijalankan dengan jelas, modular, serta mudah dipahami dalam konteks pengembangan CRUD berbasis PHP dan MySQL.

3. **Instruksi Menjalankan Aplikasi**

    Lokasi Penempatan Folder Aplikasi
        1.Jika ingin menjalankan menggunakan PHP built-in server, ekstrak folder proyek di lokasi mana saja pada komputer.

        2.Jika menggunakan XAMPP, ekstrak folder proyek ke direktori :
            C:\xampp\htdocs\
        sehingga struktur akhirnya menjadi :~
            C:\xampp\htdocs\crud-mahasiswa\

    Langkah impor basis data (`schema.sql`).
        0.Pastikan MySQL berjalan

        0.1.Database
            nama db : crud_mahasiswa (default dari schema.sql)

        1.Buka phpMyAdmin / MySQL client lain
        2.Pilih menu Import.
        3.Klik Choose File dan arahkan ke file schema.sql yang ada di direktori utama project.
        4.Tekan tombol Import / Go.

    Database dan seluruh tabel akan otomatis dibuat tanpa perlu setup manual.
        Cara mengatur konfigurasi koneksi database.
            1.Buka folder inc/, lalu buka file config.php
            2.sesuaikan nilai host, username dan password dengan konfigurasi MySQL lokal. 
            (XAMPP biasanya menggunakan username "root" dan password "" / kosong)

        Cara menjalankan aplikasi 
            1.Jika menggunakan PHP bawaan, jalankan server lokal dengan perintah berikut dari folder proyek:
                php -S localhost:8000

            2.Jika memakai XAMPP, cukup letakkan folder aplikasi di htdocs dan jalankan Apache.

    URL utama untuk mengakses aplikasi

        Setelah server berjalan, buka browser dan akses halaman utama aplikasi melalui:
            http://localhost/crud-mahasiswa/index.php 
        atau
            http://localhost:8000/index.php 
            
            setelah kehalaman index.php. user yang tidak memiliki session yang didapat dari login akan dikembalikan ke halaman login.php

4. **Contoh Skenario Uji Singkat**

    User
        1.Melakukan registrasi akun baru melalui halaman register.
        2.Melakukan login menggunakan akun yang telah ter register.
        3.Mengubah password akun yang sedang login melalui halaman change password. (tombol terletak di halaman index.php)
            user mengisi password lama, password baru, dan konfirmasi password baru, jika berhasil maka user akan dikembalikan ke halaman login
        4.Menghapus akun yang sedang login melalui halaman delete account. (tombol terletak di halaman index.php)
            akan ada halaman konfirmasi (menghindari user salah tekan)

    Mahasiswa
        1.Menambahkan data mahasiswa baru melalui form tambah mahasiswa.
        2.Menampilkan seluruh data mahasiswa pada halaman index.php.
        3.Menampilkan detail mahasiswa berdasarkan id melalui halaman detail.
        4.Mengedit data mahasiswa berdasarkan id melalui halaman edit.
            hanya field nama,prodi, dan status (aktif/nonaktif) yang hanya bisa di edit
        5.Menghapus data mahasiswa berdasarkan id melalui halaman delete.
            akan ada halaman konfirmasi (menghindari user salah tekan)