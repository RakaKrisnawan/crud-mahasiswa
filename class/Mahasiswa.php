<?php

class Mahasiswa {

    private $db;
    protected $table = "mahasiswa";

    public $id;
    public $nim;
    public $nama;
    public $prodi;
    public $status;
    public $foto;

    public function __construct($db) {
        $this->db = $db;
    }

    // Ambil satu data berdasarkan ID
    public function loadById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $this->id = $data["id"];
            $this->nim = $data["nim"];
            $this->nama = $data["nama"];
            $this->prodi = $data["prodi"];
            $this->status = $data["status"];
            $this->foto = $data["foto"];
            return true;
        }
        return false;
    }

    // Ambil semua mahasiswa
    public function getAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insert data baru
    public function create() {
        $sql = "INSERT INTO {$this->table} (nim, nama, prodi, status, foto)
                VALUES (:nim, :nama, :prodi, :status, :foto)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            "nim" => $this->nim,
            "nama" => $this->nama,
            "prodi" => $this->prodi,
            "status" => $this->status,
            "foto" => $this->foto
        ]);
    }

    // Update data mahasiswa
    public function update() {
        $sql = "UPDATE {$this->table}
                SET nim = :nim,
                    nama = :nama,
                    prodi = :prodi,
                    status = :status,
                    foto = :foto
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            "nim" => $this->nim,
            "nama" => $this->nama,
            "prodi" => $this->prodi,
            "status" => $this->status,
            "foto" => $this->foto,
            "id" => $this->id
        ]);
    }

    // Hapus mahasiswa
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(["id" => $id]);
    }

}
