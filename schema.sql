CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    prodi ENUM('Sistem Informasi','Teknologi Informasi','Sistem Komputer') NOT NULL,
    status ENUM('aktif','nonaktif') NOT NULL,
    foto VARCHAR(255) NOT NULL
);

CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  name VARCHAR(150) NOT NULL,
  join_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);