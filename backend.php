<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blackfitwarriors_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'login') {
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email='$email' AND phone='$phone'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Check password
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                echo "Login successful!";
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with this email and phone number.";
        }
    } elseif ($action === 'signup') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Check if user already exists
        $checkUserSql = "SELECT * FROM users WHERE email='$email'";
        $checkUserResult = $conn->query($checkUserSql);

        if ($checkUserResult->num_rows > 0) {
            echo "User already exists.";
        } else {
            $sql = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo "Signup successful!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>
