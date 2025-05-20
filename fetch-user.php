<?php
session_start();
include 'db_connect.php';

header('Content-Type: application/json');

// Debugging: Print session values
if (!isset($_SESSION['id'])) {
    echo json_encode([
        "error" => "User not logged in",
        "session_data" => $_SESSION // Debugging: Print session data
    ]);
    exit;
}

$user_id = $_SESSION['id'];

$sql = "SELECT username, name, email, age FROM sign_up WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["error" => "User not found"]);
}

$stmt->close();
$conn->close();
?>
