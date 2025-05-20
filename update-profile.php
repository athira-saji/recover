<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['id'])) {
    die(json_encode(["success" => false, "message" => "User not logged in."]));
}

$user_id = $_SESSION['id'];
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$age = trim($_POST['age']);
$username = trim($_POST['username']);

// Validate username (only letters & numbers)
if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
    die(json_encode(["success" => false, "message" => "Username must contain only letters and numbers."]));
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die(json_encode(["success" => false, "message" => "Invalid email format."]));
}

// Validate age (must be a positive number)
if (!is_numeric($age) || $age <= 0) {
    die(json_encode(["success" => false, "message" => "Age must be a positive number."]));
}

// Check if email or username already exists (excluding current user)
$checkQuery = "SELECT id FROM sign_up WHERE (email = ? OR username = ?) AND id != ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("ssi", $email, $username, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die(json_encode(["success" => false, "message" => "Email or username already in use."]));
}

$stmt->close();

// Update user details
$sql = "UPDATE sign_up SET name=?, email=?, age=?, username=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisi", $name, $email, $age, $username, $user_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Profile updated successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error updating profile: " . $conn->error]);
}

$stmt->close();
$conn->close();
?>
