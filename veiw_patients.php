<?php
require_once("connect.php"); // Assuming "connect.php" contains the database connection code

// Select the database
if (!mysqli_select_db($conn, "drugdispensingtools")) {
    die("Error: " . mysqli_error($conn));
}

// Check if the search form is submitted
if(isset($_GET['search'])) {
    $search = $_GET['search'];

    $sql = "SELECT * FROM patients WHERE Name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM patients";
}

$results = $conn->query($sql);

if ($results === false) {
    die("Error: " . $conn->error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Patients List </title>
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
    <h1>Patients Table</h1>

    <h2>Search Patient</h2>
    <form method="GET" action="">
        <label for="search">Search by Patient Name:</label>
        <input type="text" name="search" id="search" placeholder="Enter patient name">
        <input type="submit" value="Search">
    </form>
    <p>Enter the patient's name in the search bar above and click "Search" to display the patient's information.</p>

    <?php if ($results->num_rows > 0) { ?>
        <table>
            <tr>
                <th>PatientID</th> 
                <th>Username</th>
                <th>Name</th>
                <th>Number</th>
                <th>Address</th>
                <th>Email</th>
                <th>Date_of_birth</th>
            </tr>
            <?php while ($row = $results->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["PatientID"]; ?></td> 
                    <td><?php echo $row["Username"]; ?></td>
                    <td><?php echo $row["Name"]; ?></td>
                    <td><?php echo $row["Number"]; ?></td>
                    <td><?php echo $row["Address"]; ?></td>
                    <td><?php echo $row["Email"]; ?></td>
                    <td><?php echo $row["Date_of_birth"]; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No data found in the Patients table.</p>
    <?php } ?>
    <!-- Insert this code where you want to display the table -->

</body>
</html>

<?php
$results->close();
$conn->close();
?>
