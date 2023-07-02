<?php
session_start(); // Start the session

require_once("connect.php"); // Assuming "connect.php" contains the database connection code

// Check if the user is logged in
if (!isset($_SESSION['Username'])) {
    header("Location: PatientLogin.php"); // Redirect to the login page if not logged in
    exit();
}

// Get the username from the session
$username = $_SESSION['Username'];

// Retrieve the patient's information from the patients table based on the username
$sql = "SELECT PatientID, Name FROM patients WHERE Username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $patientID = $row['PatientID'];
    $patientName = $row['Name'];
} else {
    echo "Patient not found.";
    exit();
}

// Retrieve the prescription information from the prescription table
$sql = "SELECT p.PatientID, p.DoctorID, p.Drug_No, p.Dosage, p.Start_date, p.End_date, d.Name AS DoctorName, dg.Drug_Name
        FROM patient_prescription p
        JOIN doctor d ON p.DoctorID = d.DoctorID
        JOIN drug dg ON p.Drug_No = dg.Drug_No
        WHERE p.PatientID = '$patientID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display the patient's information and the prescription table
    echo "<h1>Patient Information</h1>";
    echo "<p>Patient Name: $patientName</p>";

    echo "<h1>Prescription Table</h1>";
    echo "<table>
            <tr>
                <th>Patient ID</th>
                <th>Doctor ID</th>
                <th>Doctor Name</th>
                <th>Drug No</th>
                <th>Drug Name</th>
                <th>Dosage</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        $patientID = $row['PatientID'];
        $doctorID = $row['DoctorID'];
        $doctorName = $row['DoctorName'];
        $drugNo = $row['Drug_No'];
        $drugName = $row['Drug_Name'];
        $dosage = $row['Dosage'];
        $startDate = $row['Start_date'];
        $endDate = $row['End_date'];

        echo "<tr>
                <td>$patientID</td>
                <td>$doctorID</td>
                <td>$doctorName</td>
                <td>$drugNo</td>
                <td>$drugName</td>
                <td>$dosage</td>
                <td>$startDate</td>
                <td>$endDate</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "No prescriptions found for the patient.";
}

// Close the database connection
$conn->close();
?>
