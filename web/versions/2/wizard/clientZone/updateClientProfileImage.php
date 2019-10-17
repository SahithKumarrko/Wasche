<?php
$img=$_FILES['upload_profile_image'];
// print_r($_POST);
require('./connection.php');
$result=["g"=>false,"c"=>true,"invalid"=>false];
if(!$con){
    $result['c']=false;
}else{
$result['c']=true;
$email=$_POST['email'];
// if($img['type'])

$type=explode("/",$img["type"]);
$t=$type[1];
$arr=["gif","png","jpg","jpeg"];
if(in_array($type[1],$arr)){
    $file=addslashes(file_get_contents($img["tmp_name"]));
    $q=mysqli_query($con,"select email from user_images where email='$email'");
    if( mysqli_num_rows($q)==0 ){
        
        mysqli_query($con,"insert into user_images values('$email','$file','$t')");

    }else{
        mysqli_query($con,"update user_images set image='$file',type='$t' where email='$email'");
    }
    $q=mysqli_query($con,"select image,type from user_images where email='$email'");
    if(mysqli_num_rows($q)!=0){
       $img= mysqli_fetch_array($q);
       $t=$img[1];
       $im=$img[0];
        $result['client']["profile_image"]="data:image/".$t.";base64,".base64_encode($im);
    }
    // $result["profile_image"]="data:image/".$t.";base64,".base64_encode($file);
    $result["g"]=true;
    mysqli_commit($con);
}else{
    $result['invalid']=true;
}
mysqli_close($con);
}

$result=json_encode($result);
print_r($result);

// $im="Sa\sa";
// print_r($type);
// print_r($img);

?>