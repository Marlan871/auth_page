<?php
// File tempat data user disimpan
$file = 'users.json';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validasi input kosong
if (empty($email) || empty($password)) {
    exit('Email and password cannot be empty.');
}

// Ambil data lama
$users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Cek apakah email sudah terdaftar
foreach ($users as $user) {
    if ($user['email'] === $email) {
        exit('Email is already registered.');
    }
}

// Tambahkan user baru
$users[] = ['email' => $email, 'password' => $password];

// Simpan ke file JSON
file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

echo "Registration successful. <a href='login.html'>Login here</a>.";
?>
