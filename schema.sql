-- DB

CREATE DATABASE IF NOT EXISTS crud_mahasiswa;
USE crud_mahasiswa;

-- Tabel mahasiswa 
DROP TABLE IF EXISTS mahasiswa;
CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    nim VARCHAR(20) NOT NULL,
    prodi ENUM('Sistem Informasi','Teknologi Informasi','Sistem Komputer') NOT NULL,
    angkatan INT NOT NULL,
    foto VARCHAR(255) NOT NULL,
    status ENUM('aktif','nonaktif') NOT NULL
);

-- Tabel user
DROP TABLE IF EXISTS user;
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(150) NOT NULL,
    join_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);
