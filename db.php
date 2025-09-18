<?php
// db.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitness_db"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Create tables if they don't exist (for initial setup)
//function create_tables($conn) {
//
//  $sql_users = "CREATE TABLE IF NOT EXISTS users (
//
//      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//
//      name VARCHAR(255) NOT NULL,
//
//      age INT(3) NOT NULL,
//
//      email VARCHAR(255) NOT NULL UNIQUE,
//
//      phone VARCHAR(20),
//
//      username VARCHAR(50) NOT NULL UNIQUE,
//
//      password VARCHAR(255) NOT NULL,
//
//      reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
//
//  )";
//
//
//
//  $sql_exercise_records = "CREATE TABLE IF NOT EXISTS exercise_records (
//
//      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//
//      username VARCHAR(50) NOT NULL,
//
//      date DATE NOT NULL,
//
//      part VARCHAR(100) NOT NULL,
//
//      history TEXT NOT NULL,
//
//      record_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
//
//  )";
//
//
//
//  $sql_cardio_records = "CREATE TABLE IF NOT EXISTS cardio_records (
//
//      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//
//      username VARCHAR(50) NOT NULL,
//
//      date DATE NOT NULL,
//
//      history TEXT NOT NULL,
//
//      record_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
//
//  )";
//
//
//
//  $sql_yoga_records = "CREATE TABLE IF NOT EXISTS yoga_records (
//
//      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//
//      username VARCHAR(50) NOT NULL,
//
//      date DATE NOT NULL,
//
//      history TEXT NOT NULL,
//
//      record_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
//
//  )";
//
//
//
//  $sql_bodybuilding_records = "CREATE TABLE IF NOT EXISTS bodybuilding_records (
//
//      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//
//      username VARCHAR(50) NOT NULL,
//
//      date DATE NOT NULL,
//
//      history TEXT NOT NULL,
//
//      record_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
//
//  )";
//
//
//
//  if ($conn->query($sql_users) === TRUE &&
//
//      $conn->query($sql_exercise_records) === TRUE &&
//
//      $conn->query($sql_cardio_records) === TRUE &&
//
//      $conn->query($sql_yoga_records) === TRUE &&
//
//      $conn->query($sql_bodybuilding_records) === TRUE) {
//
//      // echo "Tables created successfully or already exist.";
//
//  } else {
//
//      // echo "Error creating tables: " . $conn->error;
//
//  }
//}

// Call this function once to set up your database tables
// create_tables($conn);
?>