<?php
include('config.php');
session_start();
if(!isset($_SESSION["email"]))
{
    header("location:index.php?mes=<p> Please login here </p>");
}

$email = $_SESSION['email'];
$result = mysqli_query($con,"SELECT * FROM admin WHERE Email='$email'");
$row = mysqli_fetch_assoc($result);

$aID= $row['aID'];
$Fname= $row['Fname'];
$Lname= $row['Lname'];
$Lname= $row['Lname'];
$position= $row['Position'];

if(isset($_POST['addAdmin'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $dir="profile/";
    $image=$_FILES['adminProfile']['name'];
    $temp_name=$_FILES['adminProfile']['tmp_name'];

    // checking empty fields
    if ($fname != "" && $lname != "" && $email != "") {
        if (file_exists($dir . $image)) {
            $image = time() . '_' . $image;
        }

        $fdir = $dir . $image;
        move_uploaded_file($temp_name, $fdir);

        $insersql = "INSERT INTO admin(image,Fname,Lname,Email,Position,Password,Status)VALUES('$image','$fname','$lname','$email','Admin','$password',1)";
        if ($con->query($insersql)) {
            header("location:admin-home.php");
        } else {
            $notice_suc = "<i style='color:red;'> added faild </i>";
        }
    }
}
?>

<!doctype html>
<html class="no-js h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Add New Admin</title>
    <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="../css/css2.css">
    <link rel="stylesheet" href="../css/css1.css">

    <script>
        function triggerClick() {
            document.querySelector('#profileImage').click();
        }
        function displayImage(e) {
            if (e.files[0]){
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.querySelector('#profileDisplay').setAttribute('src',e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>
</head>
<body class="h-100">

<div class="container-fluid">
    <div class="row">
        <!-- Main Sidebar -->
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
            <div class="main-navbar">
                <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                    <a class="navbar-brand w-100 mr-0" href="admin-home.php" style="line-height: 25px;">
                        <div class="d-table m-auto">
                            <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="../images/logo.png" alt="Shards Dashboard">
                            <span class="d-none d-md-inline ml-1">ad World</span>
                        </div>
                    </a>
                    <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                        <i class="material-icons">&#xE5C4;</i>
                    </a>
                </nav>
            </div>
            <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
                <div class="input-group input-group-seamless ml-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
            </form>
            <div class="nav-wrapper">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link " href="admin-home.php">
                            <i class="material-icons">edit</i>
                            <span>Blog Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="admin-view-post.php">
                            <i class="material-icons">vertical_split</i>
                            <span>Blog Posts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="admin-add-new-post.php">
                            <i class="material-icons">note_add</i>
                            <span>Add New Post</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin-profile.php">
                            <i class="material-icons">person</i>
                            <span>User Profile</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <!-- End Main Sidebar -->
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
            <div class="main-navbar sticky-top bg-white">
                <!-- Main Navbar -->
                <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
                    <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                        <div class="input-group input-group-seamless ml-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">

                                </div>
                            </div>
                            <a class="navbar-brand w-100 mr-0" href="../index.php" style="line-height: 25px;">View Site</a>
                        </div>
                    </form>
                    <ul class="navbar-nav border-left flex-row ">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <img class="user-avatar rounded-circle mr-2" src="../images/avatars/0.jpg" alt="User Avatar">
                                <span class="d-none d-md-inline-block"><?php echo $Lname; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-small">
                                <a class="dropdown-item" href="admin-profile.php">
                                    <i class="material-icons">&#xE7FD;</i> Profile</a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="logout.php">
                                    <i class="material-icons text-danger">&#xE879;</i> Logout </a>
                            </div>
                        </li>
                    </ul>
                    <nav class="nav">
                        <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
                            <i class="material-icons">&#xE5D2;</i>
                        </a>
                    </nav>
                </nav>
            </div>
            <!-- / .main-navbar -->
            <div class="main-content-container container-fluid px-4">
                <!-- Page Header -->
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                        <span class="text-uppercase page-subtitle">Dashboard</span>
                        <h3 class="page-title">Add New Admin</h3>
                    </div>
                    <a class="btn btn-sm btn-accent ml-auto" href="add-admin.php" style="line-height: 25px;">Add admin </a>
                </div>
                <!-- End Page Header -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <!-- Default Light Table -->
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card card-small mb-4">
                                    <div class="card-header border-bottom">
                                        <h6 class="m-0">Account Details</h6>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item p-3">
                                            <div class="row">
                                                <div class="col">
                                                    <form method="post">
                                                        <img src="profile/user.png" onclick="triggerClick()" alt="profile" id="profileDisplay" style="display:block;width:100px; height:100px; margin:10px auto;">
                                                        <input type='file' name='adminProfile'  id="profileImage" style="display: none;" onchange="displayImage(this)">
                                                        <label style="font-weight: bold;">Choose Image</label>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="feFirstName">First Name</label>
                                                                <input type="text" class="form-control" id="feFirstName" name="fname" required> </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="feLastName">Last Name</label>
                                                                <input type="text" class="form-control" id="feLastName" name="lname" required> </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="feEmailAddress">Email</label>
                                                                <input type="email" class="form-control" id="feEmailAddress" name="email" required> </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="fePassword">Password</label>
                                                                <input type="password" class="form-control" id="fePassword" name="password" placeholder="Password" required> </div>
                                                        </div>

                                                        <button type="submit" name="addAdmin" class="btn btn-accent">Add Account</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End Default Light Table -->
                    </div>
                </div>
            </div>
            <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
            <span class="copyright ml-auto my-auto mr-2">Copyright � 2018
              <a href="https://designrevision.com" rel="nofollow">DesignRevision</a>
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