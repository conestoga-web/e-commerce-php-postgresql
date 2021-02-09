<?php

    require('util.php'); // redirect() was declared in the file
    require('db.php'); // session_start() was already called in the file.

    if(isset($_GET['product_id'])) {
		$bno = $_GET['product_id']; // Assign the product id from URL to a variable      
    } else {
        $bno = 1; // default product id
    }

    $_SESSION['product_id'] = $bno;

    // Select the product id taken
    $sql = mq("select * from inventory where product_id='".$bno."'"); 
    $shopinfo = pg_fetch_array($sql, 0, PGSQL_ASSOC);

    // Set the session data -> assign the records from DB to each session variable
    $_SESSION['name'] = $shopinfo['name'];
    $_SESSION['image_file'] = $shopinfo['image_file'];
    $_SESSION['description'] = $shopinfo['description'];
    $_SESSION['specification'] = $shopinfo['specification'];
    $_SESSION['colour'] = $shopinfo['colour'];
    $_SESSION['on_hand'] = $shopinfo['on_hand'];
    $_SESSION['warranty'] = $shopinfo['warranty'];
    $_SESSION['unit_price'] = $shopinfo['unit_price'];

    // Redirect to the checkout page
    redirect('checkout.php');
?>