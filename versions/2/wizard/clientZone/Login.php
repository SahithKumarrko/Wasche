<?php
$con=mysqli_connect("localhost","root","19101972","wasche","3306");
$result=["success"=>false];
if(!$con){
    $result['success']=false;
}else{
    $result['success']=true;
}
$result=json_encode($result);
print_r($result);

?>