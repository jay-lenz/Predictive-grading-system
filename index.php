<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Predictive Grading System</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="assets/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="assets/css/style.sea.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <head>
  <body>
    <div class="login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>Dashboard</h1>
                  </div>
                  <p>Predictive Grading System</p>
                </div>
              </div>
            </div>
            <?php
            if(isset($_GET['register'])){
              ?>
              <div class="col-lg-6 bg-white">
                <div class="form d-flex align-items-center">
                  <div class="content">
                    <form method="post" autocomplete="off" class="text-left form-validate">
                      <div class="form-group-material">
                        <input id="register-username" type="text" name="registerUsername" required data-msg="Please enter your username" class="input-material">
                        <label for="register-username" class="label-material">Username</label>
                      </div>
                      <div class="form-group-material">
                        <input id="register-email" type="email" name="registerEmail" required data-msg="Please enter a valid email address" class="input-material">
                        <label for="register-email" class="label-material">Email Address      </label>
                      </div>
                      <div class="form-group-material">
                        <input id="register-password" type="password" name="registerPassword" required data-msg="Please enter your password" class="input-material">
                        <label for="register-password" class="label-material">Password        </label>
                      </div>
                      <div class="form-group terms-conditions text-center">
                        <input id="register-agree" name="registerAgree" type="checkbox" required value="1" data-msg="Your agreement is required" class="checkbox-template">
                        <label for="register-agree">I agree with the terms and policy</label>
                      </div>
                      <div class="form-group text-center">
                        <input id="register" type="submit" value="Register" class="btn btn-primary">
                      </div>
                    </form>
                    <!-- <small>Already have an account? </small><a href="index.php?login" class="signup">Login</a> -->
                  </div>
                </div>
              </div>
              <?php 
            }else{
              ?>
              <div class="col-lg-6">
                <div class="form d-flex align-items-center">
                  <div class="content">
                    <?php
                    if(isset($_GET['incorrect'])){
                      echo "Incorrect Username or Password";
                    }
                    ?>
                    <form method="post" autocomplete="off" action="process.php" class="form-validate mb-4">
                      <div class="form-group">
                        <input id="login-username" type="text" name="loginUsername" required data-msg="Please enter your username" class="input-material">
                        <label for="login-username" class="label-material">User Name</label>
                      </div>
                      <div class="form-group">
                        <input id="login-password" type="password" name="loginPassword" required data-msg="Please enter your password" class="input-material">
                        <label for="login-password" class="label-material">Password</label>
                      </div>
                      <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </form>
                    <!-- <a href="#" class="forgot-pass">Forgot Password?</a><br><small>Do not have an account? </small><a href="index.php?register" class="signup">Signup</a> -->
                  </div>
                </div>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
      </div>
      <div class="copyrights text-center">
        <p>Design by <a href="#" class="external">Group 16</a></p>
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="assets/vendor/chart.js/Chart.min.js"></script>
    <script src="assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/js/front.js"></script>
  </body>
</html>
