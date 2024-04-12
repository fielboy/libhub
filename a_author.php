<?php
session_start(); 
include 'db_connection.php'; // Include database connection
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
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="style/a_mobile.css">
    <link rel="stylesheet" href="toaster/toastr.min.css">
    <link rel="icon" type="image/x-icon" href="images/logo.png">

    <title>Library Hub | Book Authors</title>

</head>
<style>
.custom-table {
    width: 100%;
    border-collapse: collapse;
}

.custom-table th,
.custom-table td {
    border: 1px solid #dddddd;
    padding: 6px;
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.custom-table th {
    background-color: #f2f2f2;
}

.custom-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

</style>

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
                    <!-- Sidebar Content -->
                    <li class="text-white mb-2">
                        <i class="bi bi-house-door"></i>
                        <a href="a_dashboard.php" class="a text-decoration-none px-2">
                            Dashboard
                        </a>
                    </li>

                    <li class="text-white mb-2">
                        <i class="bi bi-book"></i>
                        <a class="a text-decoration-none px-2" href="a_m_book.php">
                            Manage Books
                        </a>
                    </li>

                    <li class="text-white mb-2">
                        <i class="bi bi-person"></i>
                        <a href="a_author.php" class="a text-decoration-none px-2">
                            Book Authors
                        </a>
                    </li>

                    <li class="text-white mb-2">
                        <i class="bi bi-person-circle"></i>
                        <a class="a text-decoration-none px-2" href="a_publisher.php">
                            Book Publishers
                        </a>
                    </li>

                    <li class="text-white mb-2">
                        <i class="bi bi-journal-bookmark"></i>
                        <a class="a text-decoration-none px-2" href="a_issued.php">
                            Issued Books
                        </a>
                    </li>
                    <hr class="h-color mx-1">
                    <li class="text-white mb-2">
                        <i class="bi bi-people"></i>
                        <a class="a text-decoration-none px-2" href="a_user.php">
                            User Management
                        </a>
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
                    <h4 class="m-2">Book Authors</h4>
                    <button id="openAddAuthorModal" class="btn  btn-sm btn-secondary mx-2">Add Author</button>
                    <div class="modal fade" id="addAuthorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-muted" id="exampleModalLabel">Author Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="add_author.php" method="POST" class="row g-3">
                                        <div class="col-md-6">
                                            <input type="text" id="authorName" name="authorName" class="form-control" placeholder="Author Name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date" id="createDate" name="createDate" class="form-control" placeholder="Create Date" required>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-sm btn-primary">Add Author</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                    <!-- Edit Author Modal -->
                    <!-- Table for displaying authors -->

                    <div style="border-radius: 5px;padding:10px;background:#fff;" id="divvideo">
                        <table id="example1" class="custom-table">
                            <thead>
                                <tr>
                                    <th>Author Name</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $sql = "SELECT * FROM Authors";
                            $result = mysqli_query($conn, $sql);
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>".$row['AuthorName']."</td>";
                                    echo "<td>".$row['CreatedDate']."</td>";
                                    echo "<td>".$row['UpdatedDate']."</td>";
                                    echo "<td>";
                                    echo "<button class='btn btn-sm px-2 btn-primary mx-2 edit-author-btn' data-author-id='".$row['AuthorID']."' data-toggle='modal' data-target='#editAuthorModal'>Edit</button>";
                                    echo "<button class='btn btn-sm btn-danger delete-author-btn' data-author-id='".$row['AuthorID']."'>Delete</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No authors found</td></tr>";
                            }
                            ?>
                        </tbody>

                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- DOWNLOADED JS -->
    <script src="js/jquery.js"></script>
    <script src="toaster/toastr.min.js"></script>
    <script src="sweetalert/alert.js"></script>
    <script src="bootstrap/boots.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>


    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            function getQueryParam(name) {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get(name);
            }

            // Check if the message parameter exists and is equal to 'success'
            if (getQueryParam('message') === 'success') {
                toastr.success('Author added successfully!');
            }
        });

        $(document).ready(function () {
            $('#openAddAuthorModal').click(function () {
                $('#addAuthorModal').modal('show');
            });

            $('.close').click(function () {
                $('#addAuthorModal').modal('hide');
            });

            $(document).on('click', function (event) {
                if ($(event.target).hasClass('modal')) {
                    $('#addAuthorModal').modal('hide');
                }
            });
        });
    </script>
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

