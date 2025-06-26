<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "employee_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$username = $_POST['username'] ?? null; // only for registration

// Check if it’s login or register
if (isset($_POST['username'])) {
    // REGISTRATION
    $check = $conn->query("SELECT * FROM employee WHERE email='$email'");
    if ($check->num_rows > 0) {
        echo "User already exists!";
    } else {
        $sql = "INSERT INTO employee (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql)) {
            echo "Employee registered successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    // LOGIN
    $sql = "SELECT * FROM employee WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        header("Location: employee.html");
        exit();
    } else {
        echo "Invalid email or password.";
    }
}

$conn->close();
?>
