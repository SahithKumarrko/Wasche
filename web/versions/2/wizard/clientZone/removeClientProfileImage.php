<?php
require('./connection.php');

if(!$con){
    echo "error";
}else{
// $result['c']=true;
$email=$_POST['email'];
mysqli_query($con,"delete from user_images where email='$email'");
echo "success";
}
?>