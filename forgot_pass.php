<?php
session_start();
include("connection/connect.php");
error_reporting(0);

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    if (!empty($email)) {
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_array($result);

        if (is_array($row)) {
            $_SESSION["reset_user_id"] = $row['u_id'];
            header("Location: reset_pass.php");
        } else {
            $message = "Email address not found!";
        }
    } else {
        $message = "Please enter your email!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="form-module">
        <h2>Forgot Password</h2>
        <span style="color:red;"><?php echo $message; ?></span>
        <form action="" method="post">
            <input type="email" placeholder="Enter your email" name="email" required />
            <input type="submit" name="submit" value="Submit" />
        </form>
    </div>
</body>
</html>
