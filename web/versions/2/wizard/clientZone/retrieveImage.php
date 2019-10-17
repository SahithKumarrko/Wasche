<?php
require('./connection.php');
if(!$con){
    echo "Not connected";
}else{
    $email="saa@www.ccc";
    $q=mysqli_query($con,"select image,type from user_images where email='$email'");
            if(mysqli_num_rows($q)!=0){
               $img= mysqli_fetch_array($q);
               $t=$img[1];
               $im=$img[0];
               header('Content-type: image/'.$t);
               echo $im;
            }
}