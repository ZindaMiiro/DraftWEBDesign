<?php
session_start(); // Start the session

require_once("connect.php"); // Assuming "connect.php" contains the database connection code

$Username = $_POST['Username'];
$Password = $_POST['Password'];

// Prepare and execute the SQL query to check if the username and password exist in the table
$sql = "SELECT * FROM doctor WHERE Username = '$Username' AND Password = '$Password'";
$result = $conn->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Username and password are correct, store the username in the session
    $_SESSION['Username'] = $Username;
    $_SESSION['LoggedIn'] = true;
    header("Location: DoctorHome.html?Username=$Username");
    exit(); // Stop further execution of the script
} else {
    // Username or password is incorrect, display an error message
    echo "Invalid username or password.";
}

// Close the database connection
$conn->close();
?>


