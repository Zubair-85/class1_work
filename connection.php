<?php 

$conn = mysqli_connect("localhost", "root", "", "music_website");

if(!$conn){
    die("Error". mysqli_connect_error());
}else{
    echo "connected";
}

?>