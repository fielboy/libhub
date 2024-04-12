<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- DOWNLOADED CSS -->
    <link rel="stylesheet" href="bootstrap/boots.css">
	<link rel="stylesheet" href="fontawesome/all.min.css">
	<link rel="stylesheet" href="fontawesome/fontawesome.min.css">
    <link rel="stylesheet" href="bootstrap-icons-1.11.1/bootstrap-icons.css">
    <!-- CSS -->
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="style/a_mobile.css">
    <link rel="stylesheet" href="toaster/toastr.min.css">
    <link rel="icon" type="image/x-icon" href="images/logo.png">

    <title>Library Hub | Dashboard</title>

</head>

<body>
    <!-- Start Side bar -->
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box p-1">
                <h1 class="text-center fw-bold mt-2">Library Hub</h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i
                        class="bi bi-justify"></i></button>
            </div>               
            <div class="py-1">
                <ul class="list-unstyled px-3 mt-2">
                    <li class="text-white mb-2">
                    <i class="bi bi-house-door"></i>
                    <a href="a_dashboard.php" class="a text-decoration-none px-2">
                            Dashboard</a>
                    </li>

                    <li class="text-white mb-2">
                    <i class="bi bi-book"></i>
                    <a href="a_m_book.php" class="a text-decoration-none px-2">
                            Manage Books</a>
                    </li>

                    <!-- <li class="text-white mb-2">
                    <i class="bi bi-person"></i>
                    <a class="a text-decoration-none px-2 "
                        href="a_author.php">Book Authors</a>
                    </li>

                    <li class="text-white mb-2">
                    <i class="bi bi-person-circle"></i>
                    <a class="a text-decoration-none px-2 " 
                        href="a_publisher.php">Book Publishers</a>
                    </li> -->
                    
                    <li class="text-white mb-2">
                    <i class="bi bi-journal-bookmark"></i>
                    <a class="a text-decoration-none px-2 " 
                        href="a_issued.php">Issued Books</a>
                    </li>
                    <hr class="h-color mx-1">
                    <li class="text-white mb-2">
                    <i class="bi bi-people"></i>
                    <a class="a text-decoration-none px-2 " 
                        href="a_user.php">User Management</a>
                    </li>
                </ul>

                <hr class="h-color mx-1">
                <ul class="list-unstyled px-3">
                    <li ><a href="logout.php" class="btn btn-danger text-white btn-sm px-3">LOGOUT</a></li>
                </ul>
            </div>
        </div>
        <!-- End Side Bar -->
        <div class="content">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <div class="d-flex justify-content-space-between">
                        <img class="logo mx-2" src="images/logo.png" alt="LOGO">
                        <button class="btn px-1 py0 open-btn"><i class="bi bi-justify d-md-none d-block"></i></button>
                    </div>
                </div>
            </nav>
            <section class="Dashboard">
                <div class="container">
                    <h4 class="m-2">Dashboard</h4>
                    <div class="container mt-4">
                        <div class="row">
                           
                        </div>
                    </div>
    
                </div> 
            </section>
        </div>
    </div>
 
    <script src="js/jquery.js"></script>    
    <!-- DOWNLOADED JS -->
    <script src="toaster/toastr.min.js"></script>
    <script src="sweetalert/alert.js"></script>
    <script src="bootstrap/boots.js"></script>
    <script>
        $(document).ready(function () {
            $('.open-btn').on('click', function () {
                $('.sidebar').addClass('active');
            });

            $('.close-btn').on('click', function () {
                $('.sidebar').removeClass('active');
            });

            $(document).on('click', function (event) {
               
                if (!$(event.target).closest('.sidebar, .open-btn').length) {
                    
                    $('.sidebar').removeClass('active');
                }
            });
        });
    </script>
</body>

</html>