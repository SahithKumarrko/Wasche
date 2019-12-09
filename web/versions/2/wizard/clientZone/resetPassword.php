<?php
require('./connection.php');
$result=["c"=>true,"g"=>false];
// date_default_timezone_set("Asia/Calcutta");
if(!$con){
    $result["c"]=false;
}else{
    $email=$_POST['email'];
    $pswd=md5($_POST['clientPassword']);
    mysqli_query($con,"update users set pswd='$pswd' where email='$email'");
    $result['g']=true;
    mysqli_query($con,"delete from resendPassword where email='$email'");
}

$result=json_encode($result);
print_r($result);

?>