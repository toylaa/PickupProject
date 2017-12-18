<?php
   //https://community.c9.io/t/setting-up-mysql/1718
    /*
    Hostname - $IP (The same local IP as the application you run on Cloud9)
    Port - 3306 (The default MySQL port number)
    User - $C9_USER (Your Cloud9 user name)
    Password - "" (No password since you can only access the DB from within the workspace)
    Database - c9 (The database username)
    */
     //>> mysql-ctl cli 

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);

   

?>