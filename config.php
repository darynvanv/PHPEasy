<?php

// Edit These Config Lines Below To Your Requirements;

    // Database Settings;
    // You can create multiple Database connections below:

    $Con = new Connection();
    $Con->Host = "localhost";
    $Con->User = "root";
    $Con->Pass = "";
    $Con->DB = "admium";

    $Conn = Connect($Con, false);
    // PLEASE NOTE: Connection variable names must be unique;

// // // // // // // // // // // // // // // // // // // // // // // // // // // // //

// DO NOT
// Edit
// Below 
// These
// LINES
// !!!!

$ErrorPrefix = "<b>ERROR:</b> ";


?>