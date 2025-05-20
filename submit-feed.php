<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['id'])) {
    die("User not logged in");
}

$user_id = $_SESSION['id'];
$feedback = $_POST['feedback'];

// Fetch username and email from the database (without modifying fetch_user.php)
$sql = "SELECT username, email FROM sign_up WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found");
}

$username = $user['username'];
$email = $user['email'];

// Insert feedback into feedback table
$sql = "INSERT INTO feedback (username, email, feedback) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $email, $feedback);

if ($stmt->execute()) {
    echo "Feedback submitted successfully";
} else {
    echo "Error submitting feedback: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
