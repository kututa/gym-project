CREATE DATABASE blackfitwarriors_db;

USE blackfitwarriors_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255)
);

CREATE TABLE user_preferences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    age INT NOT NULL,
    gender VARCHAR(10) NOT NULL,
    height VARCHAR(10) NOT NULL,
    weight VARCHAR(10) NOT NULL,
    fitness_goal VARCHAR(50) NOT NULL,
    fitness_level VARCHAR(20) NOT NULL,
    exercise_types VARCHAR(255),
    workout_duration VARCHAR(50),
    workout_frequency VARCHAR(50),
    dietary_restrictions VARCHAR(255),
    meal_preferences VARCHAR(255),
    health_conditions VARCHAR(255),
    physical_limitations VARCHAR(255),
    tracking_methods VARCHAR(255),
    progress_updates VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
