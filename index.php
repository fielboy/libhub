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

    <title>Library Hub</title>
    
</head>
<style>
     body {
            background-image: url('images/bg.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
    /* Table styles */
    table.custom-table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
    }

    table.custom-table th,
    table.custom-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table.custom-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    /* Table hover effect */
    table.custom-table tbody tr:hover {
        background-color: #f5f5f5;
    }

    /* Button styles */
    .btn {
        padding: 5px 10px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="d-flex justify-content-space-between">
                <img class="logo mx-2" src="images/logo.png" alt="LOGO">
            </div>
            <button class="btn btn-sm btn-secondary"><a class="text-white text-decoration-none"
                    href="login.php">LOGIN</a></button>
        </div>
    </nav>

    
    <section class="mt-4 mx-auto">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" class="form-control" style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;" placeholder="Search..." id="searchInput">
                    <div class="input-group-append">
                        <button class="btn btn-primary px-3"  style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;" id="searchBtn"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="input-group rounded">
                    <select class="custom-select" id="bookType">
                        <option value="">Book Type</option>
                        <option value="English">English</option>
                        <option value="Filipino">Filipino</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="filterBtn">Filter</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive mt-4" id="tableContainer">
            <table class="table">
                <thead>
                    <tr>
                       
                    </tr>
                </thead>
                <tbody id="tableBody">
                    
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
       $(document).ready(function () {
    // Function to perform AJAX search
    function performSearch() {
        var searchQuery = $('#searchInput').val();
        var bookType = $('#bookType').val(); // Get the selected book type
        if (searchQuery.length > 0) {
            $('#tableContainer').show(); // Show the table container
            $.ajax({
                type: "GET",
                url: "search.php",
                data: { search: searchQuery, bookType: bookType }, // Pass the selected book type to the server
                success: function (response) {
                    $('#tableBody').html(response);
                }
            });
        } else {
            $('#tableContainer').hide(); // Hide the table container if search query is empty
        }
    }

    // Function to perform filter action
    function performFilter() {
        var bookType = $('#bookType').val(); // Get the selected book type
        $.ajax({
            type: "GET",
            url: "filter.php", // Path to your filter script
            data: { bookType: bookType }, // Pass the selected book type to the server
            success: function (response) {
                $('#tableBody').html(response);
            }
        });
    }

    // Perform search on button click
    $('#searchBtn').click(function () {
        performSearch();
    });

    // Perform filter on button click
    $('#filterBtn').click(function () {
        performFilter();
    });

    // Perform search on typing
    $('#searchInput').on('input', function () {
        performSearch();
    });
});

    </script>
</body>

</html>
