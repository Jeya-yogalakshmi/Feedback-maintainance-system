<?php


$con=new mysqli('localhost','root','','feedback_maintainance_system');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

?>