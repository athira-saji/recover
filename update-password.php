<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['id'])) {
    die("User not logged in");
}

$user_id = $_SESSION['id'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Ensure new passwords match
if ($new_password !== $confirm_password) {
    die("New passwords do not match");
}
if (!preg_match("/^(?=.*[!@#$%^&*()_+{}:;<>,.?~\\/-]).{8,}$/", $new_password)) {
    die(json_encode(["success" => false, "message" => "Password must be at least 8 characters long and contain at least 1 special character."]));
}

// Fetch current password hash from DB
$sql = "SELECT password FROM sign_up WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || !password_verify($current_password, $user['password'])) {
    die("Current password is incorrect");
}

// Hash the new password
$new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

// Update password in DB
$sql = "UPDATE sign_up SET password = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $new_password_hashed, $user_id);

if ($stmt->execute()) {
    echo "Password updated successfully";
} else {
    echo "Error updating password: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
