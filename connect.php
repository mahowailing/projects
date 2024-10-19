<?php
    $con=mysqli_connect('localhost', 'root', '', 'activity');

    if(!$con){
        die('Please Check Your Connection'.mysqli_error($con));
    }
?>