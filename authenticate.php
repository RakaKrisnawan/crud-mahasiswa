<?php

// require necessary files
require_once "inc/config.php";



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userObj = new User($db);
    // ==========================
    // PROCESS REGISTER
    // ==========================
    if (isset($_POST["register"])) {

        $username = trim($_POST["username"] ?? "");
        $name = trim($_POST["name"] ?? "");
        $password = trim($_POST["password"] ?? "");
        $confirm = trim($_POST["confirm_password"] ?? "");

        // cek kosong
        if ($username === "" || $name === "" || $password === "" || $confirm === "") {
            header("Location: register.php?error=empty");
            exit;
        }

        // cek konfirmasi password
        if ($password !== $confirm) {
            header("Location: register.php?error=confirm");
            exit;
        }

        // cek username sudah dipakai
        $user = new User($db);
        if ($user->getUserByUsername($username)) {
            header("Location: register.php?error=exists");
            exit;
        }

        // buat user baru
        $user->username = $username;
        $user->name = $name;
        $user->setPassword($password);

        if ($user->save()) {
            header("Location: login.php?success=registered");
            exit;
        }

        header("Location: register.php?error=failed");
        exit;
    }


    // ==========================
    // PROCESS LOGIN
    // ==========================
    if (isset($_POST["login"])) {

        $username = trim($_POST["username"] ?? "");
        $password = trim($_POST["password"] ?? "");

        if ($username === "" || $password === "") {
            header("Location: login.php?error=empty&username=" . urlencode($username));
            exit;
        }

        $user = new User($db);
        $data = $user->getUserByUsername($username);

        if ($data && password_verify($password, $data["password"])) {

            $_SESSION["user_id"] = $data["id"];
            $_SESSION["username"] = $data["username"];
            $_SESSION["name"] = $data["name"];

            $user->updateLastLogin($data["id"]);

            header("Location: index.php");
            exit;
        }

        header("Location: login.php?error=invalid&username=" . urlencode($username));
        exit;
    }
}

// redirect back to login when accessed directly
header("Location: login.php");
exit;
