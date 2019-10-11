<?php
$con=mysqli_connect("localhost","root","19101972","wasche","3306");
// $result=["success"=>false];
print_r($con);
if($con){
    // $result['success']=false;
    echo "<h2>Connected</h2>";
}else{
    echo "<h2>Connection error</h2>";
    exit();
    // $result['success']=true;
}

// mysqli_query($con,"create table if not exists users(email varchar(30) PRIMARY KEY,pswd varchar(30),first_name varchar(20),lastName varchar(20),phno int,college varchar(60),address varchar(40) Default 'None')");

try{
$email="sahiht@gmail.com";
$pswd="1234";
    $q=mysqli_query($con,"select email from users where email='$email' and pswd='$pswd'");
    echo "yup";
    print_r(mysqli_fetch_all($q,MYSQLI_ASSOC));
    // mysqli_query($con,"insert into users value('sahiht@gmail.com','1234','sahith','k','9874563214','GCET','4-7-7/5/3')");
    // mysqli_commit($con);
    // echo "yup";
    // $q=mysqli_query($con,"show tables");
    // print_r($q);
}catch(Exception $e){
    echo "Error";
}

// $result=json_encode($result);
// print_r($result);

?>