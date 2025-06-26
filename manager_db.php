<?php
$servername = "localhost";
$username = "root";
$password = ""; // Set your MySQL root password
$dbname = "manager_db"; // Make sure this DB exists

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$username = $_POST['username'] ?? null; // only for registration

if (isset($_POST['username'])) {
    $check = $conn->query("SELECT * FROM manager WHERE email='$email'");
    if ($check->num_rows > 0) {
        echo "Manager already exists!";
    } else {
        $sql = "INSERT INTO manager (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql)) {
            echo "Manager registered successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    // LOGIN
    $sql = "SELECT * FROM manager WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
       header("Location: manager.html");
        exit();
    } else {
        echo "Invalid email or password.";
    }
}

$conn->close();
?>
