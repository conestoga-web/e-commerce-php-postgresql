<?php
    //header("Cache-Control: no cache");
    //session_cache_limiter("private_no_expire");

    require('util.php');
    require('db.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = [];

        // Validate if the input field for first name was filled
        if(!empty($_REQUEST['first_name'])) {
            
            // To prevent apostrophes and other problematic characters from breaking the syntax of the SQL command
            $_SESSION['first_name'] = pg_escape_string($dbconn, trim($_POST['first_name']));
        } else {
            $errors[] = 'You forgot to enter your first name!';
        }

        // Validate if the input field for last name was filled
        if(!empty($_REQUEST['last_name'])) {
            
            // To prevent apostrophes and other problematic characters from breaking the syntax of the SQL command
            $_SESSION['last_name'] = pg_escape_string($dbconn, trim($_POST['last_name']));
        } else {
            $errors[] = 'You forgot to enter your last name!';        
        }

        // Validate if the input field for payment method was selected
        if(!empty($_REQUEST['payment'])) {
            
            // To prevent apostrophes and other problematic characters from breaking the syntax of the SQL command
            $_SESSION['payment'] = pg_escape_string($dbconn, trim($_POST['payment']));
        } else {
            $errors[] = 'You forgot to select a payment method!';        
        }

        if(empty($errors)) {

            // To check later if having gone through the checkout page
            $_SESSION['checkout'] = true;
            
            // Redirect to the order_confirm page 
            redirect('order_confirm.php');
        }
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
<!--	<link href="css/colorbox.css" rel="stylesheet" />-->
    <script src="scripts/jquery-1.9.1.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            
          // For input validation and response with JavaScript    
          $("#submit_form").submit(function(event){
              
              var isValid = true;
              
              // Get the value of the first name field and trim it
              var first_name = $("#first_name").val().trim();
              
              // Validate if the first name entry is empty and response if it is empty
              if(first_name == "") {
                  $("#first_name").next().text("  ***This field is required.***");
                  isValid = false;
              } else {
                  $("#first_name").next().text("");
              }
              $("#first_name").val(first_name);
              
              
              var last_name = $("#last_name").val().trim();
              
              // Validate if the last name entry is empty and response if it is empty
              if(last_name == "") {
                  $("#last_name").next().text("  ***This field is required.***");
                  isValid = false;
              } else {
                  $("#last_name").next().text("");
              }
              $("#last_name").val(last_name);
              
              
              var payment = $("#payment").val();
              
              // Validate if the payment entry is empty and response if it is empty
              if(payment == "") {
                  $("#payment").next().text("  ***An item should be selected.***");
                  isValid = false;
              } else {
                  $("#payment").next().text("");
              }
              
              // Prevent the submission of the form if any entries are invalid
              if(isValid == false) {
                  event.preventDefault();
              }
          });
        });
    </script>

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
            <!--	<div id="bg1"></div>-->
                    <div id="main_out">
                        <div id="menu">
                            <div>
                                <div id="content">
                                    <div id="shop_p_img">
                                        <img src="images/<?php if(isset($_SESSION['image_file'])){echo $_SESSION['image_file'];}else{echo 'test2pro.jpg';} ?>" alt="propic" title="propic" />
                                    </div>
                                    <div id="shop_p_info">
                                        <ul>
                                            <li><strong>Product : </strong><?php if(isset($_SESSION['name'])){echo $_SESSION['name'];}else{echo 'Not selected';} ?></li>
                                            <li><strong>Description : </strong><?php if(isset($_SESSION['description'])){echo $_SESSION['description'];}else{echo 'Not applicable';} ?></li>
                                            <li><strong>Specification : </strong><?php if(isset($_SESSION['specification'])){echo $_SESSION['specification'];}else{echo 'Not applicable';} ?></li>
                                            <li><strong>Colour : </strong><?php if(isset($_SESSION['colour'])){echo $_SESSION['colour'];}else{echo 'Not applicable';} ?></li>
                                            <li><strong>On Hand : </strong><?php if(isset($_SESSION['on_hand'])){echo $_SESSION['on_hand'];}else{echo 'Not applicable';} ?></li>
                                            <li><strong>Warranty: </strong><?php if(isset($_SESSION['warranty'])){echo $_SESSION['warranty'];}else{echo 'Not applicable';} ?></li>
                                            <li><strong>Price : </strong><?php if(isset($_SESSION['unit_price'])){echo '$'. $_SESSION['unit_price'];}else{echo 'Not applicable';} ?></li>
                                        </ul>
                                    </div>

                                </div>				
                            </div>
                            
                        </div>
                    </div>
                    
                    <div id="sub">
                        <h1 id="order">Order Form</h1><br>               
                        <form action="checkout.php" method="post" id="submit_form">
                            <p><label>First Name: <input type="text" id="first_name" name="first_name" maxlength="120" size="35"><span class="valid">*</span></label></p>
                            <p><label>Last Name: <input type="text" id="last_name" name="last_name" maxlength="120" size="35"><span class="valid">*</span></label></p>
                            <p><label>Payment Options: <select id="payment" name="payment">
                                <option value=""></option>
                                <option value="Cash">Cash</option>
                                <option value="Debit Card">Debit Card</option>
                                <option value="Credit Card">Credit Card</option>
                                </select><span class="valid">*</span>
                           </label></p>
                            <p align="center"><input type="submit" name="submit" value="Submit" id="btnSubmit"></p>
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
                                    <li><span class="status"><i class="fa fa-twitter"></i> Great choice! Apart from giving you the power to share, #GalaxyS10 comes with Ultrasonic Fingerprint Sensor, Infinity-O Display, &amp; Pro-grade Cameras, making it the next generation phone. https://bit.ly/2H49wiJ … <a href="https://twitter.com/hashtag/galaxys10?lang=en">https://twitter.com/hashtag/galaxys10?lang=en</a></span><span class="meta"> <a href="http://twitter.com/uniquescriptz/status/1065791438783434752">02:17 AM Nov 23rd</a></span></li>
                                    <li><span class="status"><i class="fa fa-twitter"></i> The new huge-screen “iPhone XS Max” is intriguing in a big way #mobile #technology #iPhone … <a href="https://twitter.com/hashtag/iphone%20xs?f=news&vertical=default&lang=en">https://twitter.com/hashtag/iphone%20xs?f=news&amp;vertical=default&amp;lang=en</a></span><span class="meta"> <a href="http://twitter.com/uniquescriptz/status/1063189128492302341">09:56 PM Nov 15th</a></span></li>
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