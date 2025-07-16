<?php
header('Content-Type: application/json');

// Ambil data POST
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['email']) || !isset($data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

$file = 'users.json';
$users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Cek apakah email sudah ada
foreach ($users as $user) {
    if ($user['email'] === $data['email']) {
        echo json_encode(['success' => false, 'message' => 'Email already registered']);
        exit;
    }
}

// Tambah user
$users[] = ['email' => $data['email'], 'password' => $data['password']];
file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

echo json_encode(['success' => true, 'message' => 'User registered']);
?>
