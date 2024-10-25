<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connect.php';

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

if(isset($_POST['signup'])) {
    $name = sanitizeInput($_POST['name']);
    $email = filter_var(sanitizeInput($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = trim($_POST['pass']);
    $cpassword = trim($_POST['passc']);
  
    if(!$email) {
        die("<script>alert('Invalid email format!'); window.location.href='index.php';</script>");
    }
 
    if(strlen($password) < 8) {
        die("<script>alert('Password must be at least 8 characters long!'); window.location.href='index.php';</script>");
    }
    
    if($password !== $cpassword) {
        die("<script>alert('Passwords do not match!'); window.location.href='index.php';</script>");
    }
    
  
    $checkemail = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkemail);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        die("<script>alert('Email already exists!'); window.location.href='index.php';</script>");
    }
    
 
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $insert = "INSERT INTO users(name, email, password) VALUES(?, ?, ?)";
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("sss", $name, $email, $hashedPassword);
    
    if($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        die("<script>alert('Error occurred during registration!'); window.location.href='index.php';</script>");
    }
}

if(isset($_POST['signin'])) {
    $user = filter_var(sanitizeInput($_POST['user']), FILTER_VALIDATE_EMAIL);
    $password = $_POST['paw'];
    
    if(!$user) {
        die("<script>alert('Invalid email format!'); window.location.href='index.php';</script>");
    }
    
   
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if(password_verify($password, $row['password'])) {
            session_start();
          
            session_regenerate_id(true);
            $_SESSION['email'] = $row['email'];
            header("Location: home.php");
            exit();
        }
    }
    
    die("<script>alert('Invalid Username or Password!'); window.location.href='index.php';</script>");
}
?>