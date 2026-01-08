<?php
session_start();
error_reporting(0);
include("connection/connect.php");
if (empty($_SESSION["user_id"])) {
    header('location: login.php');
    exit(); // Stop further execution
}
$message = "";
$success = "";


// Your existing PHP code

if(isset($_POST['submit'])) {
    if(empty($_POST['r_name']) || empty($_POST['r_number']) || empty($_POST['r_data'])) {
        $message = "All fields must be Required!";
    } else {
        // Prepare the insert statement
        $stmt = $db->prepare("INSERT INTO report (r_name, r_number, r_data) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $_POST['r_name'], $_POST['r_number'], $_POST['r_data']);

        // Execute the statement
        if($stmt->execute()) {
            // Success! Call the JavaScript function to show success message and countdown
            echo '<script>showSuccessMessage();</script>';
            header("Location: index.php");
            exit();
        } else {
            $message = "Error: " . $db->error;
        }

        // Close the statement
        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/images/logo.png">
    <title>Contact Us</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>
<body>
     
         <!--header starts-->
         <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
               <div class="container">
                  <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                  <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/food-picky-logo.png" alt=""> </a>
                  <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                     <ul class="nav navbar-nav">
							<li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">signup</a> </li>';
							}
						else
							{
									
									
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Order</a> </li>';
                              echo  '<li class="nav-item"><a href="profile.php" class="nav-link active"><img src="images/profile.png" width="30"/></a> </li>';
							}

						?>
							 
                        </ul>
                  </div>
               </div>
            </nav>
            <!-- /.navbar -->
         </header>
         <div class="page-wrapper">
            <div class="breadcrumb">
               <div class="container">
                  <ul>
                     <li><a href="#" class="active">
                     <span style="color:red;"><?php echo $message; ?></span>
					   <span style="color:green;">
								<?php echo $success; ?>
										</span>
					</a></li>
                    
                  </ul>
               </div>
            </div>
            <section class="contact-page inner-page">
            <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Contact Us</h1>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="r_name">Name</label>
                        <input type="text" class="form-control" id="r_name" name="r_name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="r_number">Phone Number</label>
                        <input type="text" class="form-control" id="r_number" name="r_number" placeholder="Enter your phone number" required>
                    </div>
                    <div class="form-group">
                        <label for="r_data">Description</label>
                        <textarea class="form-control" id="r_data" name="r_data" rows="5" placeholder="Write a description" required></textarea>
                    </div>
                    <button type="submit" class="btn theme-btn" name="submit">Submit</button>
                    <script>
        // Function to display success message after a delay and count down
        function showSuccessMessage() {
            // Show success message after 2 seconds
            setTimeout(function() {
                var successMessage = document.getElementById('success-message');
                successMessage.style.display = 'block';

                // Countdown for 3 seconds
                var count = 3;
                var countdown = setInterval(function() {
                    count--;
                    if (count <= 0) {
                        clearInterval(countdown);
                        successMessage.style.display = 'none';
                    } else {
                        successMessage.innerHTML = 'Issue reported successfully! This message will disappear in ' + count + ' seconds.';
                    }
                }, 1000);
            }, 2000);
        }

        // Function to execute on form submission
        function onSubmit() {
            showSuccessMessage();
        }
    </script>
                </form>
                
            </div>
        </div>
    </div>
            </section>
            
         </div>
         <!-- end:page wrapper -->
      
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>
