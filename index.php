<?php
require 'config.php';

$Conn = new Connection;

$Conn->Host = "localhost";
$Conn->User = "root";
$Conn->Password = "";
$Conn->DB = "";

DBTestConnect($Conn);
?>