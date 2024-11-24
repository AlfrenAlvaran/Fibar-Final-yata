<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Handle user registration
if (isset($_POST['submit'])) {
    $name = $_POST['fullname'];
    $email = $_POST['emailid'];
    $contactno = $_POST['contactno'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con, "INSERT INTO users(name, email, contactno, password) VALUES('$name', '$email', '$contactno', '$password')");
    
    if ($query) {
        echo "<script>alert('You are successfully registered');</script>";
        echo '
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const name = "' . addslashes($name) . '";
                const email = "' . addslashes($email) . '";

                fetch("http://localhost:5000/api/user", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ name: name, email: email })
                })
                .then(function(response) {
                    if (!response.ok) throw new Error("HTTP error! status: " + response.status);
                    return response.json();
                })
                .then(function(data) {
                    console.log("Data sent to external API:", data);
                })
                .catch(function(error) {
                    console.error("Error in API request:", error);
                });
            });
        </script>';
    } else {
        echo "<script>alert('Not registered. Something went wrong');</script>";
    }
}

// Handle user login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $num = mysqli_fetch_array($query);
    
    if ($num > 0) {
        $_SESSION['login'] = $_POST['email'];
        $_SESSION['id'] = $num['id'];
        $_SESSION['username'] = $num['name'];
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 1;
        mysqli_query($con, "INSERT INTO userlog(userEmail, userip, status) VALUES('" . $_SESSION['login'] . "', '$uip', '$status')");
        header("location: my-cart.php");
        exit();
    } else {
        $_SESSION['errmsg'] = "Invalid email or password";
        header("location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title>Shopping Portal | Sign In | Signup</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/red.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/rateit.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <script type="text/javascript">
        function valid() {
            if (document.register.password.value != document.register.confirmpassword.value) {
                alert("Password and Confirm Password Fields do not match!");
                document.register.confirmpassword.focus();
                return false;
            }
            return true;
        }

        function userAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'email=' + $("#email").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status1").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>
</head>

<body class="cnt-home">
    <!-- Header Section -->
    <header class="header-style-1">
        <?php include('includes/top-header.php'); ?>
        <?php include('includes/main-header.php'); ?>
        <?php include('includes/menu-bar.php'); ?>
    </header>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li class='active'>Authentication</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Body Content -->
    <div class="body-content outer-top-bd">
        <div class="container">
            <div class="sign-in-page inner-bottom-sm">
                <div class="row">
                    <!-- Sign-in Form -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="text-center" style="font-size: 3rem; color: blue; margin: 20px 0;">Sign In</h4>
                        <form class="register-form outer-top-xs" method="post">
                            <span style="color:red;">
                                <?php
                                echo htmlentities($_SESSION['errmsg']);
                                $_SESSION['errmsg'] = "";
                                ?>
                            </span>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                <input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required>
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                                <input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" required>
                            </div>
                            <div class="radio outer-xs">
                                <a href="forgot-password.php" class="forgot-password pull-right">Forgot your Password?</a>
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="login"  style="background: #28a745;">Login</button>
                        </form>
                    </div>

                    <!-- Create New Account Form -->
                    <div class="col-md-6 col-sm-6 create-new-account">
                        <h4 class="text-center" style="font-size: 3rem; color: blue; margin: 20px 0;">Create a New Account</h4>
                        <form class="register-form outer-top-xs" method="post" name="register" onSubmit="return valid();">
                            <div class="form-group">
                                <label class="info-title" for="fullname">Full Name <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" name="fullname" required>
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" name="emailid" onBlur="userAvailability()" required>
                                <span id="user-availability-status1" style="font-size:12px;"></span>
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="contactno">Contact No. <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" name="contactno" maxlength="10" required>
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password">Password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input" name="password" required>
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="confirmpassword">Confirm Password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input" name="confirmpassword" required>
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="submit"  style="background: #28a745;">Create Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>
</body>
</html>
