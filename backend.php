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
                header("Location:data.php");
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
            // Handle photo upload

            
           // Ensure the 'uploads' directory exists and is writable
if (!is_dir('uploads')) {
    mkdir('uploads', 0755, true);
}

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $photoTmpPath = $_FILES['photo']['tmp_name'];
    $photoName = basename($_FILES['photo']['name']);
    $photoSize = $_FILES['photo']['size'];
    $photoType = $_FILES['photo']['type'];
    $photoExt = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    
    if (in_array($photoExt, $allowedExtensions)) {
        $photoNewName = uniqid('photo_', true) . '.' . $photoExt;
        $photoUploadPath = 'uploads/' . $photoNewName;
        
        if (move_uploaded_file($photoTmpPath, $photoUploadPath)) {
            $sql = "INSERT INTO users (name, email, phone, password, photo) VALUES ('$name', '$email', '$phone', '$password', '$photoNewName')";

            if ($conn->query($sql) === TRUE) {
                echo "Signup successful!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading the photo. Ensure the 'uploads' directory exists and is writable.";
            echo "Additional error info: ";
            var_dump(error_get_last());
        }
    } else {
        echo "Invalid photo format.";
    }
} else {
    echo "Error with the photo upload: ";
    switch ($_FILES['photo']['error']) {
        case UPLOAD_ERR_INI_SIZE:
            echo "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            echo "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
            break;
        case UPLOAD_ERR_PARTIAL:
            echo "The uploaded file was only partially uploaded.";
            break;
        case UPLOAD_ERR_NO_FILE:
            echo "No file was uploaded.";
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            echo "Missing a temporary folder.";
            break;
        case UPLOAD_ERR_CANT_WRITE:
            echo "Failed to write file to disk.";
            break;
        case UPLOAD_ERR_EXTENSION:
            echo "A PHP extension stopped the file upload.";
            break;
        default:
            echo "Unknown error.";
            break;
    }
}
        }
    }
}

$conn->close();


?>
