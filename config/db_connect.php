<?php
$conn = mysqli_connect("localhost", "zitog", "swdrds", "ninjapizza");

if(!$conn){
    echo "Connection Error: " . mysqli_connect_error();
}
