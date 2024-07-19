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
            background-color: #f7f7f7;
        }
        .progress-container {
            width: 100%;
            background-color: #e0e0e0;
            margin: 20px 0;
        }
        .progress-bar {
            width: 0;
            height: 20px;
            background-color: #4caf50;
        }
        .form-step {
            display: none;
        }
        .form-step.active {
            display: block;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            margin: 5px;
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
        <input type="number" id="age" name="age" required><br>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="">Select</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br>
        <label for="height">Height:</label>
        <input type="text" id="height" name="height" required><br>
        <label for="weight">Weight:</label>
        <input type="text" id="weight" name="weight" required><br>
    </div>

    <div class="form-step">
        <h2>Fitness Goals</h2>
        <label for="fitnessGoal">Fitness Goal:</label>
        <select id="fitnessGoal" name="fitnessGoal" required>
            <option value="">Select</option>
            <option value="weightLoss">Weight loss</option>
            <option value="muscleGain">Muscle gain</option>
            <option value="generalHealth">General health and wellness</option>
        </select><br>
    </div>

    <div class="form-step">
        <h2>Current Fitness Level</h2>
        <label for="fitnessLevel">Fitness Level:</label>
        <select id="fitnessLevel" name="fitnessLevel" required>
            <option value="">Select</option>
            <option value="beginner">Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="advanced">Advanced</option>
        </select><br>
    </div>

    <div class="form-step">
        <h2>Exercise Preferences</h2>
        <label for="exerciseTypes">Preferred types of exercises:</label>
        <input type="text" id="exerciseTypes" name="exerciseTypes" placeholder="e.g., strength training, cardio"><br>
        <label for="workoutDuration">Preferred workout duration:</label>
        <input type="text" id="workoutDuration" name="workoutDuration" placeholder="e.g., 45 mins, 1 hour"><br>
        <label for="workoutFrequency">Preferred workout frequency:</label>
        <input type="text" id="workoutFrequency" name="workoutFrequency" placeholder="e.g., daily, several times a week, weekly"><br>
    </div>

    <div class="form-step">
        <h2>Dietary Preferences</h2>
        <label for="dietaryRestrictions">Dietary restrictions:</label>
        <input type="text" id="dietaryRestrictions" name="dietaryRestrictions" placeholder="e.g., vegetarian, vegan, gluten-free, dairy-free"><br>
        <label for="mealPreferences">Meal preferences:</label>
        <input type="text" id="mealPreferences" name="mealPreferences" placeholder="e.g., breakfast, lunch, dinner, snacks"><br>
    </div>

    <div class="form-step">
        <h2>Health Conditions</h2>
        <label for="healthConditions">Any existing health conditions or medical issues:</label>
        <input type="text" id="healthConditions" name="healthConditions" placeholder="e.g., diabetes, hypertension"><br>
        <label for="physicalLimitations">Injuries or physical limitations:</label>
        <input type="text" id="physicalLimitations" name="physicalLimitations" placeholder="e.g., back pain, knee issues"><br>
    </div>

    <div class="form-step">
        <h2>Tracking and Monitoring Preferences</h2>
        <label for="trackingMethods">Preferred tracking methods:</label>
        <input type="text" id="trackingMethods" name="trackingMethods" placeholder="e.g., manual entry, wearable device integration"><br>
        <label for="progressUpdates">Frequency of progress updates:</label>
        <input type="text" id="progressUpdates" name="progressUpdates" placeholder="e.g., daily, weekly, monthly"><br>
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
