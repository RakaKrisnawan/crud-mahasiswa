<?php

class User {

  private $db;
  // public properties
  public $id;
  public $username;
  public $name;
  public $password;

  // protected properties
  protected $table = "user";

  // constructor
  public function __construct($db) {
    $this->db = $db;
  }

  // Authenticate user credentials
  public function getUserByUsername($username) {
      $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE username = ?");
      $stmt->execute([$username]);
      return $stmt->fetch();
  }

  public function setFromArray($data) {
      $this->id = $data["id"];
      $this->username = $data["username"];
      $this->password = $data["password"];
      $this->name = $data["name"];
  }

  public function verifyPassword($inputPassword) {
      return password_verify($inputPassword, $this->password);
  }

  // Update last login (tidak dipakai karena tabel ga ada kolom last_login)
  public function updateLastLogin($id) {
      return true;
  }

  // Get all users (optional)
  public function getAllUsers() {
    $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Set user properties by ID
  public function loadById($id) {
    $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["id" => $id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $this->id = $data["id"];
        $this->username = $data["username"];
        $this->name = $data["name"];
        $this->password = $data["password"];
        return true;
    }
    return false;
  }

  // Get ID
  public function getId() {
    return $this->id;
  }

  // Get password
  public function getPassword() {
    return $this->password;
  }

  // Set password (hashed)
  public function setPassword($password) {
    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }

  // Save user (insert or update)
  public function save() {
    if ($this->id) {
        $sql = "UPDATE {$this->table}
                SET username = :username, name = :name, password = :password
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            "username" => $this->username,
            "name" => $this->name,
            "password" => $this->password,
            "id" => $this->id
        ]);
    } else {
        $sql = "INSERT INTO {$this->table} (username, name, password, join_date)
                VALUES (:username, :name, :password, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            "username" => $this->username,
            "name" => $this->name,
            "password" => $this->password
        ]);
    }
  }

  // Remove user
  public function delete($id) {
    $sql = "DELETE FROM {$this->table} WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute(["id" => $id]);
  }

}
