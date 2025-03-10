<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Dropdown Hover Styling */
        .navbar-nav .dropdown:hover > .dropdown-menu {
            display: block;
            margin-top: 0;
        }

        /* Styling for nested dropdown (submenu) */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu > .dropdown-menu {
            display: none;
            position: absolute;
            top: 0;
            left: 100%;
            margin-top: -1px;
        }

        .dropdown-submenu:hover > .dropdown-menu {
            display: block;
        }

        /* Hide all dropdown menus by default */
        .navbar-nav .dropdown-menu {
            display: none;
        }

        /* Header spacing fixes */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .social-icons a {
            margin-right: 10px;
        }

        .shop_cart .btn-block {
            margin-top: 10px;
        }

        /* Navbar link alignment fix */
        .navbar-nav .nav-link {
            margin-right: 15px;
        }

        /* Cart button adjustments */
        #cart .btn {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Ensure consistent height in cart items */
        .cart-product-name {
            max-width: 150px;
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body>
    <header>
        <nav id="top">
            <div class="container">
                <div class="row margin-top header-container">
                    <div class="col-md-3 col-sm-5 col-xs-6 social-icons">
                        <div>
                            <a href="https://www.facebook.com" target="blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="blank"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.instagram.com" target="blank"><i class="fa fa-instagram"></i></a>
                            <a href="https://plus.google.com" target="blank"><i class="fa fa-google-plus"></i></a>
                        </div>
                    </div>
                    <div class="col-md-7 col-md-offset-2 col-sm-7 col-xs-6">
                        <div class="nav pull-right" id="top-links">
                            <ul class="list-inline">
                                <li><a><i class="fa fa-phone i_gray_color"></i> <span class="hidden-xs">+91-9104504114</span></a></li>
                                <li><a href="register.php"><i class="fa fa-sign-in"></i> <span class="hidden-xs">Register</span></a></li>
                                <?php session_start();
                                    if (isset($_SESSION["user"])) {
                                        if ($_SESSION["user"] != "dharmik@gmail.com") {
                                            include("connect.php");
                                            $sql = "select concat(fname,' ',lname) from register where email=  '" . $_SESSION["user"] . "' ";
                                            $rs1 = mysqli_query($con, $sql);
                                            $r = mysqli_fetch_array($rs1); ?>
                                            <li><a href="logout.php"><i class="fa fa-user"></i> <span class="hidden-xs">Logout <i class="fa fa-meh-o"></i>
                                            <u><b><i><?php echo "$r[0]"; ?></i></b></u><i class="fa fa-meh-o"></i></span></a></li>
                                        <?php } else { ?>
                                            <li><a href="logout.php">Logout</a></li>
                                            <li><a href="admin.php"><i class="fa fa-gear"></i> <span class="hidden-xs">Admin: <b><u><i>Dharmik</i></u></b></span></a></li>
                                        <?php }
                                    } else { ?>
                                        <li><a href="logout.php"><i class="fa fa-user"></i> <span class="hidden-xs">Login</span></a></li>
                                        <li><a href="logout.php"><i class="fa fa-gear"></i> <span class="hidden-xs">Admin</span></a></li>
                                <?php } ?>
                                <li><a title="Wish List (0)" id="wishlist-total"><i class="fa fa-heart i_gray_color"></i> <span class="hidden-xs">Wish List (0)</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 remove-padding-left">
                    <a class="logo-text" href="home.php">
                        Jems<span style="color:#fff; font-size:50px">And Jewels</span>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 bookings">
                    <div class="col-md-6">
                        <p><strong>CUSTOMER SERVICES</strong><br><a href="mailto:jemsndjewels@gmail.com">jemsndjewels@gmail.com</a></p>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 shop_cart">
                    <<div class="row">
                        <div class="col-md-12 col-md-offset-0 col-sm-6 col-sm-offset-6 col-xs-12 ">
                            <div class="btn-group btn-block" id="cart">
							<?php
								if(isset($_SESSION["user"]))
								{
									include("connect.php");
									$sql1="select * from register where email='".$_SESSION["user"]."'" ;
									$rs1=mysqli_query($con,$sql1);
									$row1=mysqli_fetch_array($rs1);
									$sql="select * from cart where userid='".$row1[0]."'";
									$rs1=mysqli_query($con,$sql);
									$count=mysqli_num_rows($rs1);
									if($count>0)
									{
									$sql="SELECT sum(pqty) FROM cart where userid='".$row1[0]."'";
									$rs=mysqli_query($con,$sql);
									$row=mysqli_fetch_array($rs);
									$qty=$row[0];
									$sql="SELECT sum(pcost*pqty) FROM cart where userid='".$row1[0]."'";
									$rs=mysqli_query($con,$sql);
									$row=mysqli_fetch_array($rs);
									$subtotal=$row[0];
									$gst=$row[0]*3.00/100;
									$total=$subtotal+$gst;
									}
									else
									{
									$qty=0;
									$subtotal=0;
									$gst=0;
									$total=$subtotal+$gst;
									}
								
							?>
                                <button width= "600 px" class="btn btn-default btn-lg dropdown-toggle btn-block"  data-toggle="dropdown" type="button"><span id="cart-total"><i class="fa fa-shopping-cart"></i><?=$qty?> item(s) - ₹ <?=$total?></span>
                                </button>
								
                                <ul class="dropdown-menu btn-block cartView">
                                    <li>
                                        <table class="table">
                                            <tbody>
											<?php
											if($count>0)
											{
											while($row1=mysqli_fetch_array($rs1))
												{
											?>
												<tr>
                                                    <td class="text-center">                        
                                                        <a href="single-product.php?pid=<?=$row1[1]?>"><img class="img-responsive" src="<?=$row1[5]?>" style="width: 100%"></a>
                                                    </td>
                                                    <td class="text-left"><a class="view_cart cart-product-name" href="single-product.php?pid=<?=$row[1]?>"><?=$row1[2]?></a>
                                                    </td>
                                                    <td class="product-remove text-center"><a><i class="fa fa-times margin-top"></i></a></td>
                                                </tr>
												<?php
												}
											}
												?>
                                                <tr style="border-bottom: 1px solid #D4D4D4" class="clearfix">
                                                    <td class="text-right cart-qty"><span>Qty:</span><?=$qty?></td>
                                                    <td class="text-left cart-product-total">₹ <?=$total?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </li>
									<li>
                                        <div>
                                            <table class="table">
                                                <tbody><tr>
                                                        <td class=""><strong>Sub-Total</strong></td>
                                                        <td class="">₹<?=$subtotal?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class=""><strong>GST</strong></td>
                                                        <td class="">₹<?=$gst?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class=""><strong>Total</strong></td>
                                                        <td class="">₹ <?=$total?></td>
                                                    </tr>
                                                </tbody></table>
                                            <a class="btn btn-primary btn-lg" href="cart.php"><i class="fa fa-shopping-cart"></i> 
                                                View Cart</a>
                                            <a class="btn btn-primary btn-lg" href="checkout.php">
                                                <i class="fa fa-share"></i> 
                                                Checkout                   
                                            </a>
                                        </div>
                                    </li></ul>
                            
							<?php
							}
							else
							{
							?>
							<a class="btn btn-default btn-lg dropdown-toggle btn-block" href="login.php">Login/Register to access Cart</a>
                             
							<?php
							}
							?>
							</div>

                        </div>
                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="productDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Product</a>
                            <ul class="dropdown-menu" aria-labelledby="productDropdown">
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Men</a>
                                    <ul class="dropdown-menu">
                                    <?php
                                include('connect.php');
                                // Fetch Men categories from the database
                                $sql = "SELECT * FROM men_category";
                                $rs = mysqli_query($con, $sql);
                                if (mysqli_num_rows($rs) > 0) {
                                    while ($row = mysqli_fetch_array($rs)) {
                                        echo '<li><a class="dropdown-item" href="product.php?id=' . $row[0] . '">' . $row[1] . '</a></li>';
                                    }
                                }
                                ?>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Women</a>
                                    <ul class="dropdown-menu">
                                        <!-- Fetch Women categories -->
                                        <?php
                                // Fetch Women categories from the database
                                $sql = "SELECT * FROM women_category";
                                $rs = mysqli_query($con, $sql);
                                if (mysqli_num_rows($rs) > 0) {
                                    while ($row = mysqli_fetch_array($rs)) {
                                        echo '<li><a class="dropdown-item" href="product.php?id=' . $row[0] . '">' . $row[1] . '</a></li>';
                                    }
                                }
                                ?>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Kids</a>
                                    <ul class="dropdown-menu">
                                        <!-- Fetch Kids categories -->
                                        <?php
                                // Fetch Kids categories from the database
                                $sql = "SELECT * FROM kid_category";
                                $rs = mysqli_query($con, $sql);
                                if (mysqli_num_rows($rs) > 0) {
                                    while ($row = mysqli_fetch_array($rs)) {
                                        echo '<li><a class="dropdown-item" href="product.php?id=' . $row[0] . '">' . $row[1] . '</a></li>';
                                    }
                                }
                                ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="checkout.php">Checkout</a>
                        </li>
                      <!--  <li class="nav-item">
                            <a class="nav-link" href="#">Blog</a>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact Us</a>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </nav>
    </header>
</body>
</html>
