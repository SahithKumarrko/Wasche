<?php
// $data=json_decode($_POST['data']);
$email=$_POST['email'];
$con=mysqli_connect("localhost","root","19101972","wasche","3306");
$result=["g"=>false,"c"=>true,'ec'=>false];
if(!$con){
    $result['c']=false;
}else{
    // $em=$dataclient;
// echo "CLIENT :   ";
//     //  print_r($data);
    
//     print_r($data);
//     // print_r($em);
// $em="s";
// // print_r(type($data));
//     echo "       CLIENT 2    :    ";
    // $em.email;
    // print_r($em['email']);
    $q=mysqli_query($con,"select * from users where email='$email'");
    if(mysqli_num_rows($q)==0){
        $result["ec"]=true;
    }else{
        $result['client']=mysqli_fetch_assoc($q);
        unset($result['client']['pswd']);
        
    }
    mysqli_close($con);
}
$result=json_encode($result);
print_r($result);
?>