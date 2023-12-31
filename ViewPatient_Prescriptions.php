<?php
require_once("connect.php"); // Assuming "connect.php" contains the database connection code

// Select the database
if (!mysqli_select_db($conn, "drugdispensingtools")) {
    die("Error: " . mysqli_error($conn));
}

// Check if the search form is submitted
if(isset($_GET['search'])) {
    $search = $_GET['search'];

    $sql = "SELECT * FROM patient_prescription WHERE PatientID LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM patient_prescription";
}

$results = $conn->query($sql);

if ($results === false) {
    die("Error: " . $conn->error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient_Prescription</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Patient prescriptions table</h1>

    <h2>Search Patient Prescription</h2>
    <form method="GET" action="">
        <label for="search">Search by PatientID:</label>
        <input type="text" name="search" id="search" placeholder="Enter patient ID">
        <input type="submit" value="Search">
    </form>
    <p>Enter the patient's name in the search bar above and click "Search" to display the patient's prescription information.</p>

    <?php if ($results->num_rows > 0) { ?>
        <table>
            <tr>
                <th>PatientID</th>s
                <th>DoctorID</th>
                <th>Drug_No</th>
                <th>Dosage</th>
                <th>Start_date</th>
                <th>End_date</th>
            </tr>
            <?php while ($row = $results->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["PatientID"]; ?></td>
                    <td><?php echo $row["DoctorID"]; ?></td>
                    <td><?php echo $row["Drug_No"]; ?></td>
                    <td><?php echo $row["Dosage"]; ?></td>
                    <td><?php echo date("Y-m-d", strtotime($row["Start_date"])); ?></td>
                    <td><?php echo date("Y-m-d", strtotime($row["End_date"])); ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No data found in the Patient_Prescription table.</p>
    <?php } ?>
    <!-- Insert this code where you want to display the table -->

</body>
</html>

<?php
$results->close();
$conn->close();
?>
