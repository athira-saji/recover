<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    die(json_encode(["success" => false, "message" => "Error: Method Not Allowed"]));
}

$host = "localhost";
$user = "root"; // Change if needed
$pass = ""; // Change if needed
$dbname = "sigunup"; // Ensure database name is correct

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed."]));
}

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$age = (int) trim($_POST['age']);
$username = trim($_POST['username']);
$password = $_POST['password'];
$confirmPassword = $_POST['confirmpassword'];

// Validate input
if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
    die(json_encode(["success" => false, "message" => "Username must contain only letters and numbers."]));
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die(json_encode(["success" => false, "message" => "Invalid email format."]));
}
if ($age <= 0) {
    die(json_encode(["success" => false, "message" => "Age must be a positive number."]));
}
if (!preg_match("/^(?=.*[!@#$%^&*()_+{}:;<>,.?~\\/-]).{8,}$/", $password)) {
    die(json_encode(["success" => false, "message" => "Password must be at least 8 characters with 1 special character."]));
}
if ($password !== $confirmPassword) {
    die(json_encode(["success" => false, "message" => "Passwords do not match."]));
}

// Check if email or username already exists
$checkQuery = "SELECT * FROM sign_up WHERE email = ? OR username = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("ss", $email, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die(json_encode(["success" => false, "message" => "Username or Email already exists."]));
}

$stmt->close();

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Insert into database
$sql = "INSERT INTO sign_up (name, email, age, username, password) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssiss", $name, $email, $age, $username, $hashedPassword);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Signup successful!"]);
} else {
    echo json_encode(["success" => false, "message" => "Signup failed. Username might already exist."]);
}

$stmt->close();
$conn->close();
?>

