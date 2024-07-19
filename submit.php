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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = 1; // You should dynamically get the user ID based on the logged-in user
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $fitnessGoal = $_POST['fitnessGoal'];
    $fitnessLevel = $_POST['fitnessLevel'];
    $exerciseTypes = $_POST['exerciseTypes'];
    $workoutDuration = $_POST['workoutDuration'];
    $workoutFrequency = $_POST['workoutFrequency'];
    $dietaryRestrictions = $_POST['dietaryRestrictions'];
    $mealPreferences = $_POST['mealPreferences'];
    $healthConditions = $_POST['healthConditions'];
    $physicalLimitations = $_POST['physicalLimitations'];
    $trackingMethods = $_POST['trackingMethods'];
    $progressUpdates = $_POST['progressUpdates'];

    $stmt = $conn->prepare("INSERT INTO user_preferences (user_id, age, gender, height, weight, fitness_goal, fitness_level, exercise_types, workout_duration, workout_frequency, dietary_restrictions, meal_preferences, health_conditions, physical_limitations, tracking_methods, progress_updates) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissssssssssssss", $user_id, $age, $gender, $height, $weight, $fitnessGoal, $fitnessLevel, $exerciseTypes, $workoutDuration, $workoutFrequency, $dietaryRestrictions, $mealPreferences, $healthConditions, $physicalLimitations, $trackingMethods, $progressUpdates);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
