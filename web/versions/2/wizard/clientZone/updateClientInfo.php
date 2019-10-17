<?php
require('./connection.php');

if(!$con){
    echo "error";
}else{
// $result['c']=true;
$email=$_POST['email'];

$fn=$_POST["first_name"];
$ln=$_POST["last_name"];
$addr=$_POST["address"];
$unsub='off';
if(isset($_POST['unsubscribe'])){
$unsub=$_POST['unsubscribe'];
}
// if($unsub=='on'){
//     $unsub=
// }
// print_r($_POST);
mysqli_query($con,"update users set first_name='$fn',lastName='$ln',address='$addr',unsubscribe='$unsub' where email='$email'");
echo "success";
mysqli_commit($con);
}
?>