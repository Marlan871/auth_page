<?php
$file = 'users.json';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    exit('Email and password are required.');
}

$users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

foreach ($users as $user) {
    if ($user['email'] === $email && $user['password'] === $password) {
        // Login berhasil
        header("Location: home.html");
        exit;
    }
}

echo "Invalid email or password. <a href='login.html'>Try again</a>.";
?>
