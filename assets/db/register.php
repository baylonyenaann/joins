<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $birthday = $_POST['birthday'];
    $age = $_POST['age'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $query->bind_param("ss", $username, $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        echo "Username or email already exists. Please try a different one.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = $conn->prepare("INSERT INTO users (fullname, email, username, birthday, age, password) VALUES (?, ?, ?, ?, ?, ?)");
        $insertQuery->bind_param("ssssis", $fullname, $email, $username, $birthday, $age, $hashedPassword);

        if ($insertQuery->execute()) {
            $userId = $insertQuery->insert_id;

            $insertProfileQuery = $conn->prepare("INSERT INTO profiles (user_id) VALUES (?)");
            $insertProfileQuery->bind_param("i", $userId);

            if ($insertProfileQuery->execute()) {
                $_SESSION['user_id'] = $userId; 
                $_SESSION['fullname'] = $fullname;
                echo "Registration successful. You can now log in.";
                header("Location: ../../index.php?registration=success");
                exit;
            } else {
                echo "Error creating profile: " . $insertProfileQuery->error;
            }
        } else {
            echo "Error: " . $insertQuery->error;
        }
    }
}
?>
