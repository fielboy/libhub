<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library Hub</title>

    <!-- DOWNLOADED CSS -->
    <link rel="stylesheet" href="bootstrap/boots.css">
    <link rel="stylesheet" href="fontawesome/all.min.css">
    <link rel="stylesheet" href="fontawesome/fontawesome.min.css">
    <link rel="stylesheet" href="bootstrap-icons-1.11.1/bootstrap-icons.css">
    <!-- CUSTOM CSS -->

    <link rel="stylesheet" href="style/user.css">
    <link rel="stylesheet" href="toaster/toastr.min.css">
    <link rel="icon" type="image/x-icon" href="images/logo.png">

</head>

<body style="background:#eee">

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="d-flex justify-content-space-between">
                <img class="logo mx-2" src="images/logo.png" alt="LOGO">
            </div>
            <?php if (isset($_SESSION['email'])) { ?>
            <button class="btn btn-sm btn-secondary"><a class="text-white text-decoration-none"
                    href="logout.php">LOGOUT</a></button>
            <?php }?>
        </div>
    </nav>
    <section class="mt-4 mx-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-4" style="padding:10px;background:#fff;border-radius: 5px;" id="divvideo">
                    <center>
                        <p class="login-box-msg"> <i class="glyphicon glyphicon-camera"></i> TAP HERE</p>
                    </center>
                    <video id="preview" width="100%" height="50%" style="border-radius:10px;"></video>
                    <br>
                    <br>
                    <?php
            if (isset($_SESSION['error'])) {
                echo "
                <div class='alert alert-danger alert-dismissible' style='background:red;color:#fff'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <h4><i class='icon fa fa-warning'></i> Error!</h4>
                  " . $_SESSION['error'] . "
                </div>
              ";
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo "
                <div class='alert alert-success alert-dismissible' style='background:green;color:#fff'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <h4><i class='icon fa fa-check'></i> Success!</h4>
                  " . $_SESSION['success'] . "
                </div>
              ";
                unset($_SESSION['success']);
            }
            ?>

                </div>

                <div class="col-md-8">
                    <form action="BorrowReturnBook.php" method="post" class="form-horizontal"
                        style="border-radius: 5px;padding:10px;background:#fff;" id="divvideo">
                        <i class="glyphicon glyphicon-qrcode"></i> <label>SCAN QR CODE</label>
                        <p id="time"></p>
                        <input type="text" name="bookId" id="text" placeholder="Scan QR Code of the book"
                            class="form-control" autofocus>
                        <label><input type="radio" name="status" value="borrow" checked> Borrow</label>
                        <label><input type="radio" name="status" value="return"> Return</label>
                    </form>

                    <div style="border-radius: 5px;padding:10px;background:#fff;" id="divvideo">
                        <?php
                       // Check if the message session variable is set
                if (isset($_SESSION['message'])) {
                    echo "<p>{$_SESSION['message']}</p>";
                    // Unset the session variable to remove the message after displaying it
                    unset($_SESSION['message']);
                }
                    ?>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
            }
        }).catch(function (e) {
            console.error(e);
        });

        scanner.addListener('scan', function (c) {
            document.getElementById('text').value = c;
            //

            // Get the selected action (borrow or return)
            var action = document.querySelector('input[name="status"]:checked').value;
            // Append the action parameter to the URL
            document.forms[0].action = "BorrowReturnBook.php?action=" + action;
            // Submit the form
            document.forms[0].submit();
        });


        // Add event listener to radio buttons
        document.querySelectorAll('input[type=radio][name=action]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                // Automatically submit the form when a radio button is selected
                document.forms[0].submit();
            });
        });
    </script>

    <script type="text/javascript">
        var timestamp = '<?=time();?>';
        function updateTime() {
            $('#time').html(Date(timestamp));
            timestamp++;
        }
        $(function () {
            setInterval(updateTime, 1000);
        });
    </script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

</body>

</html>