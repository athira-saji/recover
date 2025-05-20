<?php
session_start();
include 'config/db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT username, name, email, age FROM sign_up WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($db_username, $name, $email, $age);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="container">
        <h2>Profile Settings</h2>
        <form action="update-profile.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($db_username) ?>" readonly>

            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>">

            <label for="age">Age</label>
            <input type="number" id="age" name="age" value="<?= htmlspecialchars($age) ?>">

            <label for="password">Change Password</label>
            <input type="password" id="password" name="password" placeholder="New password">

            <button type="submit" class="btn save-btn">Save Changes</button>
            <a href="delete_account.php" class="btn delete-btn">Delete Account</a>
        </form>
    </div>

</body>
</html>
