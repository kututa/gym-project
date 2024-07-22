<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Preferences Quiz</title>
    <style>
          body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('images/bg2.jpg'); /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            background-color: #f7f7f7; /* Fallback color */
        }
        
        .progress-container {
            width: 80%;
            max-width: 600px;
            background-color: #e0e0e0;
            border-radius: 10px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .progress-bar {
            width: 0;
            height: 20px;
            background-color: #4caf50;
            transition: width 0.4s ease;
        }
        form {
            width: 80%;
            max-width: 600px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            overflow: hidden;
        }
        .form-step {
            display: none;
        }
        .form-step.active {
            display: block;
        }
        h2 {
            margin-top: 0;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }
        input[type="text"], input[type="number"], select {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }
        input[type="text"]::placeholder, input[type="number"]::placeholder {
            color: #888;
        }
        .buttons {
            margin-top: 20px;
            text-align: center;
        }
        .buttons button {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            color: #fff;
            background-color: #4caf50;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .buttons button:hover {
            background-color: #45a049;
        }
        .buttons button:disabled {
            background-color: #d3d3d3;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<div class="progress-container">
    <div class="progress-bar" id="progressBar"></div>
</div>

<form id="quizForm" method="POST" action="submit.php">
    <div class="form-step active">
        <h2>Personal Information</h2>
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="">Select</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        <label for="height">Height:</label>
        <input type="text" id="height" name="height" required>
        <label for="weight">Weight:</label>
        <input type="text" id="weight" name="weight" required>
    </div>

    <div class="form-step">
        <h2>Fitness Goals</h2>
        <label for="fitnessGoal">Fitness Goal:</label>
        <select id="fitnessGoal" name="fitnessGoal" required>
            <option value="">Select</option>
            <option value="weightLoss">Weight loss</option>
            <option value="muscleGain">Muscle gain</option>
            <option value="generalHealth">General health and wellness</option>
        </select>
    </div>

    <div class="form-step">
        <h2>Current Fitness Level</h2>
        <label for="fitnessLevel">Fitness Level:</label>
        <select id="fitnessLevel" name="fitnessLevel" required>
            <option value="">Select</option>
            <option value="beginner">Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="advanced">Advanced</option>
        </select>
    </div>

    <div class="form-step">
        <h2>Exercise Preferences</h2>
        <label for="exerciseTypes">Preferred types of exercises:</label>
        <input type="text" id="exerciseTypes" name="exerciseTypes" placeholder="e.g., strength training, cardio">
        <label for="workoutDuration">Preferred workout duration:</label>
        <input type="text" id="workoutDuration" name="workoutDuration" placeholder="e.g., 45 mins, 1 hour">
        <label for="workoutFrequency">Preferred workout frequency:</label>
        <input type="text" id="workoutFrequency" name="workoutFrequency" placeholder="e.g., daily, several times a week, weekly">
    </div>

    <div class="form-step">
        <h2>Dietary Preferences</h2>
        <label for="dietaryRestrictions">Dietary restrictions:</label>
        <input type="text" id="dietaryRestrictions" name="dietaryRestrictions" placeholder="e.g., vegetarian, vegan, gluten-free, dairy-free">
        <label for="mealPreferences">Meal preferences:</label>
        <input type="text" id="mealPreferences" name="mealPreferences" placeholder="e.g., breakfast, lunch, dinner, snacks">
    </div>

    <div class="form-step">
        <h2>Health Conditions</h2>
        <label for="healthConditions">Any existing health conditions or medical issues:</label>
        <input type="text" id="healthConditions" name="healthConditions" placeholder="e.g., diabetes, hypertension">
        <label for="physicalLimitations">Injuries or physical limitations:</label>
        <input type="text" id="physicalLimitations" name="physicalLimitations" placeholder="e.g., back pain, knee issues">
    </div>

    <div class="form-step">
        <h2>Tracking and Monitoring Preferences</h2>
        <label for="trackingMethods">Preferred tracking methods:</label>
        <input type="text" id="trackingMethods" name="trackingMethods" placeholder="e.g., manual entry, wearable device integration">
        <label for="progressUpdates">Frequency of progress updates:</label>
        <input type="text" id="progressUpdates" name="progressUpdates" placeholder="e.g., daily, weekly, monthly">
    </div>

    <div class="buttons">
        <button type="button" id="prevBtn" onclick="changeStep(-1)">Previous</button>
        <button type="button" id="nextBtn" onclick="changeStep(1)">Next</button>
        <button type="submit" id="submitBtn" style="display:none;">Submit</button>
    </div>
</form>
<script>  
let currentStep = 0;

function showStep(step) {
    const steps = document.getElementsByClassName("form-step");
    steps[step].classList.add("active");

    const progressBar = document.getElementById("progressBar");
    progressBar.style.width = ((step + 1) / steps.length) * 100 + "%";

    document.getElementById("prevBtn").style.display = step === 0 ? "none" : "inline";
    document.getElementById("nextBtn").style.display = step === (steps.length - 1) ? "none" : "inline";
    document.getElementById("submitBtn").style.display = step === (steps.length - 1) ? "inline" : "none";
}

function changeStep(n) {
    const steps = document.getElementsByClassName("form-step");
    steps[currentStep].classList.remove("active");
    currentStep += n;
    showStep(currentStep);
}

document.getElementById("quizForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('submit.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Handle success message
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

showStep(currentStep);


</script>
</body>
</html>
