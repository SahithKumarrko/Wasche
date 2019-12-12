<?php
require('./connection.php');
$result=["g"=>false,"c"=>true,'ee'=>false,"inve"=>false,'client'=>['profile_image'=>'']];
if(!$con){
    $result['c']=false;
}else{
    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result['ee']=true;
    }
    if($result['ee']==false){
        $inv=false;
        $pswd=md5($_POST["pswd"]);
        // $pswd=$_POST["clientPassword"];
        $q=mysqli_query($con,"select email from users where email='$email'");
        if(mysqli_num_rows($q)==1){
            $inv=true;
            $result['inve']=true;
        }else{
            $fn=$_POST["first_name"];
            $ln=$_POST["last_name"];
            $phno=$_POST["phno"];
            $addr=$_POST["address"];
            $gender=$_POST["gender"];
            $col=$_POST["college"];
            $coladd=$_POST['coladdress'];
            $result['client']=['email'=>$email,"first_name"=>$fn,'gender'=>$gender];
            $uns='on';
            // $result['client']=["email"=>$email,"first_name"=>$fn,"last_name"=>$ln,"phno"=>$phno,"gender"=>$gender,"college"=>$col,"address"=>$addr];
            mysqli_query($con,"insert into users values('$email','$pswd','$fn','$ln','$phno','$gender','$col','$coladd','$addr','$uns')");
          mysqli_commit($con);
        //   $q=mysqli_query($con,"select image,type from user_images where email='$email'");
        //     if(mysqli_num_rows($q)!=0){
        //        $img= mysqli_fetch_array($q);
        //        $t=$img[1];
        //        $im=$img[0];
        //         $result['client']["profile_image"]="data:image/".$t.";base64,".base64_encode($im);
        //     }
                $result["g"]=true;
                mysqli_commit($con);
        }
    }
    mysqli_close($con);
}

$result=json_encode($result);
print_r($result);

?>