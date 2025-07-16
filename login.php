<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['email']) || !isset($data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

$file = 'users.json';
$users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

foreach ($users as $user) {
    if ($user['email'] === $data['email']) {
        if ($user['password'] === $data['password']) {
            echo json_encode(['success' => true, 'message' => 'Login successful']);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Incorrect password']);
            exit;
        }
    }
}

echo json_encode(['success' => false, 'message' => 'Email not registered']);
?>
