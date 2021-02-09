<?php
/*    This file contains the database access information.
    his file also establishes a connection to MySQL,
    selects the database, and sets the encoding.*/

    // Session starts
    session_start();

    header('Content-Type: text/html; charset=utf-8'); // utf-8 encoding

    $conn_string = "host=host_name port=port_number dbname=database_name user=user_name password=password";
    $dbconn = pg_connect($conn_string) or die("Could not connect");

    if(PGSQL_CONNECTION_OK === pg_connection_status($dbconn)) {     
        echo 'Connection status ok';      
    } else {
        pg_set_client_encoding($dbconn, "utf8");
        echo 'Connection status bad';   
    }

    // function for sql query
    function mq($sql)
    {
        global $dbconn;        
        $result = pg_query($dbconn, $sql);
        
        if ($result === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . pg_last_error(), E_USER_ERROR);
            exit;
        }
        
        return $result;
    }
?>