<?php
require_once("connect.php"); // Assuming "connect.php" contains the database connection code

// Select the database
if (!mysqli_select_db($conn, "drugdispensingtools")) {
    die("Error: " . mysqli_error($conn));
}

// Check if the search form is submitted
if(isset($_GET['search'])) {
    $search = $_GET['search'];

    $sql = "SELECT * FROM drug WHERE Drug_Name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM drug";
}

$results = $conn->query($sql);

if ($results === false) {
    die("Error: " . $conn->error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pharma Inventory</title>
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
    <h1>Pharma Inventory</h1>

    <h2>Search Drug</h2>
    <form method="GET" action="">
        <label for="search">Search by Drug Name:</label>
        <input type="text" name="search" id="search" placeholder="Enter drug name">
        <input type="submit" value="Search">
    </form>
    <p>Enter the drug name in the search bar above and click "Search" to display the drug information.</p>

    <?php if ($results->num_rows > 0) { ?>
        <table>
            <tr>
                <th>Drug_No</th>
                <th>Drug_Name</th>
                <th>Serial_Number</th>
                <th>Quantity</th>
                <th>Man_DATE</th>
                <th>Exp_DATE</th>
            </tr>
            <?php while ($row = $results->fetch_assoc()) { ?>
                <tr>
                
                    <td><?php echo $row["Drug_No"]; ?></td>
                    <td><?php echo $row["Drug_Name"]; ?></td>
                    <td><?php echo $row["Serial_Number"]; ?></td>
                    <td><?php echo $row["Quantiy"]; ?></td>
                    <td><?php echo date("Y-m-d", strtotime($row["Man_DATE"])); ?></td>
                    <td><?php echo date("Y-m-d", strtotime($row["Exp_Date"])); ?></td>
                
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No data found in the Drug table.</p>
    <?php } ?>
    <!-- Insert this code where you want to display the table -->

</body>
</html>

<?php
$results->close();
$conn->close();
?>
