<?php
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $PatientID = $_POST["PatientID"];
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];
    $Name = $_POST["Name"];
    $Number = $_POST["Number"];
    $Address = $_POST["Address"];
    $Email = $_POST["Email"];
    $Date_of_birth = $_POST["Date_of_birth"];

    $sql = "INSERT INTO patients (PatientID, Username, Password, Name, Number, Address, Email, Date_of_birth) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error: " . $conn->error);
    }

    $stmt->bind_param("isssissd", $PatientID, $Username, $Password, $Name, $Number, $Address, $Email, $Date_of_birth);
    $result = $stmt->execute();

    if ($result === false) {
        die("Error: " . $stmt->error);
    }

    if ($stmt->affected_rows > 0) {
        echo "Patient's information inserted successfully.";
    } else {
        echo "Failed to insert patient's information.";
    }

    $stmt->close();
}

$conn->close();
?>
