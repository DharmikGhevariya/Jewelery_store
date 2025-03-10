<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header-container {
            align-items: center;
        }

        .logo-text {
            font-size: 35px;
            font-weight: bold;
            color: #16558f;
        }

        #top-links {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .nav-item a {
            color: #16558f;
            text-decoration: none;
        }

        .nav-item a:hover {
            text-decoration: underline;
        }

        .i_gray_color {
            color: #666;
        }
    </style>
</head>
<body>
    <header>
        <nav id="top" class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <div class="row w-100 align-items-center">
                    <!-- Logo on the left -->
                    <div class="col-6 col-md-3">
                        <a class="logo-text" href="admin.php">
                            Jems<span style="color:#fff; font-size:40px">And Jewels</span>
                        </a>
                    </div>

                    <!-- Other options on the right -->
                    <div class="col-6 col-md-9">
                        <div class="nav" id="top-links">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link"><i class="fa fa-phone i_gray_color"></i> <span class="hidden-xs">+91-9104504114</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="register.php" class="nav-link"><i class="fa fa-sign-in"></i> <span class="hidden-xs">Register</span></a>
                                </li>
                                <?php session_start();
                                if (isset($_SESSION["user"])) {
                                    if ($_SESSION["user"] != "dharmik@gmail.com") {
                                        include("connect.php");
                                        $sql = "SELECT CONCAT(fname, ' ', lname) FROM register WHERE email = '" . $_SESSION["user"] . "'";
                                        $rs1 = mysqli_query($con, $sql);
                                        $r = mysqli_fetch_array($rs1); ?>
                                        <li class="nav-item">
                                            <a href="logout.php" class="nav-link"><i class="fa fa-user"></i> Logout <b><i><?php echo "$r[0]"; ?></i></b></a>
                                        </li>
                                    <?php } else { ?>
                                        <li class="nav-item">
                                            <a href="logout.php" class="nav-link">Logout</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="admin.php" class="nav-link"><i class="fa fa-gear"></i> Admin: <b><i>Dharmik</i></b></a>
                                        </li>
                                    <?php }
                                } else { ?>
                                    <li class="nav-item">
                                        <a href="login.php" class="nav-link"><i class="fa fa-user"></i> Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin.php" class="nav-link"><i class="fa fa-gear"></i> Admin</a>
                                    </li>
                                <?php } ?>
                                <li class="nav-item">
                                    <a class="nav-link" title="Wish List (0)" id="wishlist-total"><i class="fa fa-heart i_gray_color"></i> Wish List (0)</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
