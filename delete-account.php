<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}

$userId = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $sql = "DELETE FROM sign_up WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        session_destroy(); // Log out the user
        echo json_encode(["success" => true, "message" => "Profile deleted successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error deleting profile"]);
    }

    $stmt->close();
    $conn->close();
}
?>
