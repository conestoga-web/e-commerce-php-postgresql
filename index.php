<!DOCTYPE html>

<html lang="en">
<head>
    <title>Online Mobilephone Showroom</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="css/bootstrap2.min.css" rel="stylesheet" />
    <link href="css/application.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	<link href="css/colorbox.css" rel="stylesheet" />
    <script src="scripts/jquery-1.9.1.min.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>-->
    <script src="scripts/bootstrap.min.js"></script>
    <script src="scripts/jquery.colorbox.js"></script>    
    <script src="scripts/slides.js"></script>

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
        <form id="form1" class="form-horizontal">
            
            <header class="jumbotron"></header>
            <main class="row">
                <div class="col-sm-12">

                    <div id="introduction">
                        <h1>Choose your best!</h1>
                        <div id="sample">
                            <div id="caption">iPhone XS</div>
                            <img src="images/first/iPhone_XS.jpg" id="image" alt="" />
                            <div id="btn"><input type="button" id="play_pause" value="Pause" />
                            <input type="button" id="change_speed" value="Speed" />
                            <input type="button" id="view_slides" value="Slides" /></div>   
                        </div>
                        <p class="px">A Better Way to Shop for Phones and Plans</p>
                        <p id="p1">Conestoga Online Mobile Shop offers the best choice if you are in the market for a new phone or seeking a new carrier to provide your wireless service. However you connect with the wider world, be it with the top operating systems, like Android or Apple's iOS, you can shop for the latest devices from the best manufacturers. It’s the Conestoga Online Mobile Shop Promise.
                        </p>

                        <p class="px">The Benefits of Best Buy Mobile</p>
                        <p>Experienced staff will cover all the bases for you, helping you select from devices by a variety of vendors, including Apple, Google, Samsung, LG,  ASUS, and more.
                            Whether you’re committed to the simple layout of iOS, or prefer the customization Android offers, you’ll love the huge selection of phones available. 
                            You will also have the chance to sign up for a plan with any of the major carriers, or upgrade your own way with any of the unlocked devices available in-store or on the Conestoga Online Mobile Shop website.
                        </p>

                        <p>Do it all without having to worry about long lineups at any of our stand-alone Conestoga Online Mobile locations. Helpful staff stay on top of all the latest products, providing you with impartial and knowledgeable information on whatever you are shopping for. Straightforward pricing means you won’t have to guess how much you can expect to pay.
                        </p>

                        <p class="px">Mobile Services</p>
                        <p>You can walk away from a Conestoga Online Mobile location ready to go with your new phone. Specialists can help you set up your new device, transfer data to a new handset, and help pair a new accessory. No matter what you come in for, you will get great service from non-commissioned staff eager to help.
                        </p> 

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

        </form>
    </div>

    </div>
</body>
</html>