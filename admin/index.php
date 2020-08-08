<?php
include('config.php');
session_start();
if(isset($_SESSION["email"]))
{
    header("location:admin-home.php");
}

if(isset($_POST["submit"]))
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    if($email!=""&&$password!="")
    {
        $sql="SELECT * FROM admin WHERE Email='$email' AND Password='$password' AND Status='1'";
        $result=$con->query($sql);
        $row = mysqli_fetch_assoc($result);

        $Email= $row['Email'];
        if($result->num_rows==1)
        {
            if($email == $Email) {

                $_SESSION["email"] = $Email;
                header("location:admin-home.php");
            }
        }
        else {
            $login_err = "Invalid username or password";
        }
    }
    else {
        $login_err = "Enter username or password";
    }
}

if(isset($_GET["mes"]))
{
    $login_err = $_GET["mes"];
}
?>

<!doctype html>
<html class="no-js h-100" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin-login</title>
    <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="../css/css2.css">
    <link rel="stylesheet" href="../css/css1.css">
  </head>
  <body class="h-100">
    
    <div class="container-fluid">
      <div class="row">
        
        <main class="main-content col-lg-12 col-md-12 col-sm-12 p-0 ">
          <div class="main-navbar sticky-top bg-white">
            <!-- Main Navbar -->
            <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
              <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                <div class="input-group input-group-seamless ml-3">
                  <div class="input-group-prepend">
                    <div class="d-table m-auto">
                  <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="../images/logo.png" alt="Shards Dashboard">
                  <span class="d-none d-md-inline ml-1">Ad World</span>
                </div>
                  </div>
				  </div>
              </form>
            </nav>
          </div>
          <!-- / .main-navbar -->
          <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
              
            </div>
            <!-- End Page Header -->
            
			<!-- Login Blocks -->
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">

            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin" method="post">
              <div class="form-label-group">
				<label for="inputEmail">Email address</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
              </div>

              <div class="form-label-group">
				<label for="inputPassword">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit" >Sign in</button>
              <hr class="my-4">
                <!-- invalid login error -->
                <?php
                if(isset($login_err))
                {
                    ?>

                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                        <strong style="color:white; "><?php if(isset($login_err)) echo $login_err; ?></strong>
                    </div>
                    <?php
                }
                ?>
                <!-- invalid login error -->
            </form>
          </div>
        </div>
      </div>
            <!-- End Login Blocks -->

          </div>
          <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
            <span class="copyright ml-auto my-auto mr-2">Copyright © 2018 adworld
            </span>
          </footer>
        </main>
      </div>
    </div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="../js/js1.js"></script>
    <script src="../js/js2.js"></script>
  </body>
</html>