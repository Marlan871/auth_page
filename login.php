<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['email']) || !isset($data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Email dan password wajib diisi.']);
    exit;
}

$email = trim($data['email']);
$password = trim($data['password']);

$file = 'users.json';
$users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

foreach ($users as $user) {
    if ($user['email'] === $email) {
        if ($user['password'] === $password) {
            echo json_encode(['success' => true, 'message' => 'Login berhasil']);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Password salah']);
            exit;
        }
    }
}

echo json_encode(['success' => false, 'message' => 'Email tidak terdaftar']);
?>
