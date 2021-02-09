<?php
//header("Cache-Control: no cache");
//session_cache_limiter("private_no_expire");

    require('util.php');
    require('db.php');

    // Check if the request is from the checkout page
    if($_SESSION['checkout'] == true) {

        // Assign the values of session variables to variables
        $first_name = $_SESSION['first_name'];     
        $last_name = $_SESSION['last_name'];
        $payment = $_SESSION['payment'];     
        $order_product = $_SESSION['name']; 
        $on_hand = (int)$_SESSION['on_hand'];  
        $quantity = 1;

        // Make the query
        $q1 = "INSERT INTO orders (first_name, last_name, payment, order_product, quantity) VALUES ($1, $2, $3, $4, $5)";    
        
        $result = pg_prepare($dbconn, "insertOrder", $q1) or die("insertOrder prepare fail: " . pg_last_error());        
        $result = pg_execute($dbconn, "insertOrder", array("$first_name", "$last_name", "$payment", "$order_product", "$quantity")) or die("insertOrder execute fail: " . pg_last_error());

        $error = [];
        
        // Print a message based upon the result
        if(pg_affected_rows($result) == 0) {
            $error[] = 'Insert Failure'; 
        }
        
        // Free result
        pg_free_result($result);                     

        // Reduce the quantity of inventory by 1
        $q2 = "UPDATE inventory SET on_Hand = $on_hand - 1 WHERE name = '$order_product'";

        if(!mq($q2)) {
            $error[] = 'Update Failure'; 
        }

        // Close the database connection:
        pg_close($dbconn);

        $_SESSION['checkout'] = false;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // Reset the entire $_SESSION variable as a new array, erasing its existing values
        $_SESSION = [];
        // Remove the data from the server
        session_destroy();
        
        // Redirect to the store.php 
        redirect('store.php');
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Checkout</title>
    <link href="css/bootstrap2.min.css" rel="stylesheet" />
    <link href="css/application.css" rel="stylesheet" />
    <link href="css/store.css?after" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="scripts/jquery-1.9.1.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <div id="wrapper">
    <header>
    
    <nav class="navbar navbar-default">
        <a class="navbar-brand" href="index.php"><img src="images/logo_m.jpg" alt="logo" class="img-responsive" /></a>
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" 
                    data-toggle="collapse" data-target="#mainMenu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- navbar body - nav content for toggling -->
            <div class="collapse navbar-collapse" id="mainMenu">
                <ul id="navList" class="nav navbar-nav navbar-right">
                    <li> 
                        <a href="index.php">
                            <span class="glyphicon glyphicon-home"></span>Home
                        </a></li>
                    <li class="dropdown">
                        <a href="store.php" 
                            CssClass="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-tasks"></span>Store
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="store.php">
                                    <span class="glyphicon glyphicon-tags"></span>All
                                </a></li>
                            <li>
                                <a href="store.php?catID=1">
                                    <span class="glyphicon glyphicon-phone"></span>Apple
                                </a></li>
                            <li>
                                <a href="store.php?catID=2">
                                    <span class="glyphicon glyphicon-phone"></span>Samsung
                                </a></li>
                            <li>
                                <a href="store.php?catID=3">
                                    <span class="glyphicon glyphicon-phone"></span>LG
                                </a></li>
                            <li>
                                <a href="store.php?catID=4">
                                    <span class="glyphicon glyphicon-phone"></span>Blackberry
                                </a></li>
                            <li>
                                <a href="store.php?catID=5">
                                    <span class="glyphicon glyphicon-phone"></span>Google
                                </a></li>
                        </ul>
                    </li>
                    <li> 
                        <a href="checkout.php">
                            <span class="glyphicon glyphicon-usd"></span>Checkout
                        </a></li>
                        
                    <li>
                        <a href="contact.php">
                            <span class="glyphicon glyphicon-phone-alt"></span>Contact
                        </a></li>

                </ul>
            </div>
        </div>
    </nav>
    </header>
    
    <div class="container">
        <div id="form1" class="form-horizontal">
            
            <header class="jumbotron"></header>
            <main class="row">
                <div class="col-sm-12">
                    <div id="main_out">
                        <div id="menu">
                            <h1 id="orderDetail">Order Details</h1>
                                <div id="content">
                                    <div id="order_info">
                                        <ul>
                                            <li><strong>First Name : </strong><?php echo $_SESSION['first_name']; ?></li>
                                            <li><strong>Last Name : </strong><?php echo $_SESSION['last_name']; ?></li>
                                            <li><strong>Product : </strong><?php echo $_SESSION['name']; ?></li>
                                            <li><strong>Price : </strong>$<?php echo $_SESSION['unit_price']; ?></li>
                                            <li><strong>Payment Method : </strong><?php echo $_SESSION['payment']; ?></li>
                                        </ul>
                                    </div>

                                </div>				
                            
                        </div>
                    </div>
                    <div id="conf">               
                        <form action="order_confirm.php" method="POST" id="confirm_form">
                            <p align="center"><input type="submit" name="submit" value="Confirm" id="btnSubmit"></p>
                        </form>
                    </div>
                </div>
            </main>                    

	        <footer>
                <div id="footerwidget" class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <aside id="contact-info-widget-1" class="widget">
                            <h3 class="widget-title">Newsletter</h3>

                            <div id="news" method="post" action="#news">
                                <p>
                                    <label>Email <span>*</span></label>

                                    <input type="text" name="wysija[user][email]" class="wysija-input validate[required,custom[email]]" title="Email" value="">
                                </p>

                                <input type="submit" value="Subscribe!">


                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-3 col-md-2  col-sm-6">
                        <aside id="contact-info-widget-2" class="widget">
                            <h3 class="widget-title">Latest Tweets</h3>
                            <div class="tweets-box">
                                <ul>
                                    <li><span class="status"><i class="fa fa-twitter"></i> Great choice! Apart from giving you the power to share, #GalaxyS10 comes with Ultrasonic Fingerprint Sensor, Infinity-O Display, &amp; Pro-grade Cameras, making it the next generation phone. https://bit.ly/2H49wiJ ??<a href="https://twitter.com/hashtag/galaxys10?lang=en">https://twitter.com/hashtag/galaxys10?lang=en</a></span><span class="meta"> <a href="http://twitter.com/uniquescriptz/status/1065791438783434752">02:17 AM Nov 23rd</a></span></li>
                                    <li><span class="status"><i class="fa fa-twitter"></i> The new huge-screen ?œiPhone XS Max??is intriguing in a big way #mobile #technology #iPhone ??<a href="https://twitter.com/hashtag/iphone%20xs?f=news&vertical=default&lang=en">https://twitter.com/hashtag/iphone%20xs?f=news&amp;vertical=default&amp;lang=en</a></span><span class="meta"> <a href="http://twitter.com/uniquescriptz/status/1063189128492302341">09:56 PM Nov 15th</a></span></li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-3 col-md-3  col-sm-6">
                        <aside id="contact-info-widget-3" class="widget">
                            <h3 class="widget-title">Contact Us</h3>
                            <div class="contact-info">
                                <ul class="contact-details list list-icons">
                                    <li><i class="fa fa-map-marker"></i> <strong>Address:</strong> <span>299 Doon Valley Dr, Kitchener, ON N2G 4M4, Canada</span></li>
                                    <li><i class="fa fa-envelope"></i> <strong>Email:</strong> <span><a href="mailto:support@onlineshop.com">support@onlineshop.com</a></span></li>
                                    <li><i class="fa fa-clock-o"></i> <strong>Working Days/Hours:</strong> <span>Mon - Sun / 10:00 AM - 6:00 PM</span></li>
                                </ul>
                                <p><strong>Skype ID</strong>: <a href="skype:mobileshowroom?chat">mobileshowroom</a></p>
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-3 col-md-3  col-sm-6">
                        <aside id="contact-info-widget-4" class="widget">
                            <h3 class="widget-title">Follow Us</h3>
                            <div class="share-links">
                                <a href="https://twitter.com/onlineshop" rel="nofollow" target="_blank" title="" class="fa fa-twitter" ></a>
                                <a href="https://www.youtube.com/channelonlineshop" rel="nofollow" target="_blank" title="" class="fa fa-youtube"></a>
                                <a href="skype:onlineshop?chat" rel="nofollow" target="_blank" title="" class="fa fa-skype"></a>
                                <a href="https://plus.google.com/onlineshop" rel="nofollow" target="_blank" title="" class="fa fa-google-plus" ></a>
                            </div>

                        </aside>
                    </div>
                </div>	    
	        </footer>
            </div>
        </div>
    </div>	
</body>
</html>