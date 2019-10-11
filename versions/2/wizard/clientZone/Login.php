<?php
$con=mysqli_connect("localhost","root","19101972","wasche","3306");
$result=["g"=>false,"c"=>true,'ee'=>false];
if(!$con){
    $result['c']=false;
}else{
    $email = $_POST["clientEmail"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result['ee']=true;
    }
    if($result['ee']==false){
        $inv=false;
        $pswd=md5($_POST["clientPassword"]);
        $q=mysqli_query($con,"select email from users where email='$email' and pswd='$pswd'");
        if(mysqli_num_rows($q)==0){
            $inv=true;
        }
        if($inv){
            $q=mysqli_query($con,"select email from users where email='$email'");
            if(mysqli_num_rows($q)==0){
                $result["ie"]=true;
            }else{
                $result["ip"]=true;
            }
        }else{
            $result['g']=true;
        }
    }   
}

$result=json_encode($result);
print_r($result);

?>