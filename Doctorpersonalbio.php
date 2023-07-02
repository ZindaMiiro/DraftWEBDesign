<?php
session_start(); // Start the session

require_once("connect.php"); // Assuming "connect.php" contains the database connection code

// Check if the Username session variable is set
if (isset($_SESSION['Username'])) {
    // Retrieve the username from the session
    $username = $_SESSION['Username'];

    // Prepare and execute the SQL query to retrieve the row with the username
    $sql = "SELECT * FROM doctor WHERE Username = '$username'";
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        // Display the doctor information
        $row = $result->fetch_assoc();
        echo "DoctorID: " . $row['DoctorID'] . "<br>";
        echo "Username: " . $row['Username'] . "<br>";
        echo "Password: " . $row['Password'] . "<br>";
        echo "Name: " . $row['Name'] . "<br>";
        echo "SSN: " . $row['SSN'] . "<br>";
        echo "Email: " . $row['Email'] . "<br>";
        echo "Number: " . $row['Number'] . "<br>";
        echo "Date_JOINED: " . $row['Date_Joined'] . "<br>";
        echo "Date_of_birth: " . $row['Date_of_birth'] . "<br>";
        // Add more fields as needed

    } else {
        echo "Doctor not found. Session Username: " . $_SESSION['Username'];
    }
} else {
    echo "Username not found. Please log in again. Session: " . print_r($_SESSION, true);
}

// Close the database connection
$conn->close();
?>
