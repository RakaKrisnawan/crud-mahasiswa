CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    prodi ENUM('Sistem Informasi','Teknologi Informasi','Sistem Komputer') NOT NULL,
    status ENUM('aktif','nonaktif') NOT NULL,
    foto VARCHAR(255) NOT NULL
);
