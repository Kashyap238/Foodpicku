<?php
session_start();
include("../connection/connect.php");

// Check if the report ID is set in the URL parameters
$sql = "SELECT rp_id, r_name, r_number, r_data
FROM report;
";
$query = mysqli_query($db, $sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Details</title>
    <!-- Include Bootstrap CSS -->
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Report Details</h1>
        <div>
        <table id="ordersTable" class="table">
                        <thead>
                            <tr>
                                <th><span style="color:Red;">Review Id</span></th>
                                <th><span style="color:Red;">Name</span></th>
                                <th><span style="color:Red;">Number</span></th>
                                <th><span style="color:Red;">Issue</span></th>
                                <th><span style="color:Red;">Action</span></th>
                                <!-- Add more columns as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                                <tr>
                                <td><?php echo $row['rp_id']; ?></td>
                                    <td><?php echo $row['r_name']; ?></td>
                                    <td><?php echo $row['r_number']; ?></td>
                                    <td><?php echo $row['r_data']; ?></td>
                                    <td>
    <?php echo '<a href="delete_review.php?rp_id=' . $row['rp_id'] . '" onclick="return confirm(\'Are you sure?\');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>'; ?>
</td>

                                    
                                    <!-- Add more columns as needed -->
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
      
        </div>
        <a href="dashboard.php" class="btn btn-primary">Back to Admin Panel</a>
    </div>
</body>
</html>
