<?php
session_start(); // Start the session

require_once("connect.php"); // Assuming "connect.php" contains the database connection code

// Check if the Username session variable is set
if (isset($_SESSION['Username'])) {
    // Retrieve the username from the session
    $username = $_SESSION['Username'];

    // Prepare and execute the SQL query to retrieve the row with the username
    $sql = "SELECT * FROM pharmacist WHERE Username = '$username'";
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        // Display the pharmacist information
        $row = $result->fetch_assoc();
        echo "Username: " . $row['Username'] . "<br>";
        echo "Password: " . $row['Password'] . "<br>";
        echo "SSN: " . $row['SSN'] . "<br>";
        echo "Name: " . $row['Name'] . "<br>";
        echo "Email: " . $row['Email'] . "<br>";
        echo "Number: " . $row['Number'] . "<br>";
        echo "Branch: " . $row['branch'] . "<br>";
        echo "Date_of_birth: " . $row['Date_of_birth'] . "<br>";
        // Add more fields as needed

    } else {
        echo "Pharmacist not found.";
    }
} else {
    echo "Username not found. Please log in again.";
}

// Close the database connection
$conn->close();
?>
