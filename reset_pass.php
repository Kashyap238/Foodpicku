<?php
session_start();
include("connection/connect.php");
error_reporting(0);

if (!isset($_SESSION["reset_user_id"])) {
    header("Location: forgot_password.php");
    exit();
}

if (isset($_POST['submit'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $user_id = $_SESSION["reset_user_id"];

    if ($new_password == $confirm_password) {
        $hashed_password = md5($new_password);
        $query = "UPDATE users SET password='$hashed_password' WHERE u_id='$user_id'";
        mysqli_query($db, $query);

        unset($_SESSION["reset_user_id"]);
        $success = "Password updated successfully!";
        header("refresh:2;url=login.php");
    } else {
        $message = "Passwords do not match!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="form-module">
        <h2>Reset Password</h2>
        <span style="color:red;"><?php echo $message; ?></span>
        <span style="color:green;"><?php echo $success; ?></span>
        <form action="" method="post">
            <input type="password" placeholder="New Password" name="new_password" required />
            <input type="password" placeholder="Confirm Password" name="confirm_password" required />
            <input type="submit" name="submit" value="Reset Password" />
        </form>
    </div>
</body>
</html>
