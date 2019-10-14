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
        // $pswd=$_POST["clientPassword"];
        $q=mysqli_query($con,"select first_name,email from users where email='$email' and pswd='$pswd'");
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
            $result['client']=mysqli_fetch_assoc($q);
            // unset($result['client']['pswd']);
            // $q=mysqli_query($con,"select image from user_images where email='$email'");
            // if(mysqli_num_rows($q)!=0){
            //    $img= mysqli_fetch_array($q);
            //     $result["profile_image"]=$img[0];
            // }
            $result['g']=true;
            
        }
    }  
    mysqli_close($con); 
}

$result=json_encode($result);
print_r($result);

?>