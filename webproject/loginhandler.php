<?php

session_start();

// Include database connection
include 'DB.php';



// Function to redirect to homepage based on user type
function redirectToHomepage($userType) {
    if ($userType === 'designer') {
        header('Location: DesignerHomepage.php');
    } elseif ($userType === 'client') {
        header('Location: Clinet.php');
    }
    exit();
}

function verifyPassword($password, $hashedPassword) {
    // Use password_verify() function to compare the password with its hash
    if (password_verify($password, $hashedPassword)) {
        return true; // Passwords match
    } else {
        return false; // Passwords don't match
    }
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];
    
   
    // Query database to retrieve user information
  if ($userType === 'designer') {
     
      $sql ="SELECT id, password FROM designer WHERE emailAddress='$email'";
     
      $result= mysqli_query($conn, $sql);
     
  } else{
        $sql = "SELECT id, password FROM client WHERE emailAddress='$email'";
        $result= mysqli_query($conn, $sql);
         
    }
    
 $row = mysqli_fetch_assoc($result);
if ($row != null) {

  // Hash the password retrieved from the database
    //$hashedPasswordFromDB = password_hash($row['password'], PASSWORD_DEFAULT);
       

    if (verifyPassword($password, $row['password'])){
        $_SESSION['id'] = $row['id'];
        $_SESSION['userType'] = ($userType === 'designer') ? 'designer' : 'client';
        redirectToHomepage($userType);

    } else {
        // Passwords don't match
        // Handle the error or redirect the user
        $_SESSION['login_error'] = 'Incorrect password.';
        echo "Incorrect password.";
        header('Location: login.php');
        exit();
    }
} else {
    // User not found
    // Handle the error or redirect the user
    $_SESSION['login_error'] = 'User not found.';
    echo 'User Not Found';
    header('Location: login.php');
    exit();
}
}
?>
