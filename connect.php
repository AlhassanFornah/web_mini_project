<?php

    //here are the values of m y connectionm
    define("SERVER_NAME","localhost");
    define("USERNAME","root");
    define("DB_PASSWORD","usbw");
    define("DATABASE_NAME","drugs");



      //variable to the connection
    $con = new mysqli(SERVER_NAME, USERNAME, DB_PASSWORD, DATABASE_NAME);

               //To display message if enable to connect
    if(!$con){
        echo "<h3>ERROR ENABLE TO CONNECT</h3>";
        die();
    }
?>