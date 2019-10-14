<?php
$img=$_FILES['upload_profile_image'];
// print_r($_POST);
$con=mysqli_connect("localhost","root","19101972","wasche","3306");
$result=["g"=>false,"c"=>true,"invalid"=>false];
if(!$con){
    $result['c']=false;
}else{
$result['c']=true;
$email=$_POST['email'];
// if($img['type'])

$type=explode("/",$img["type"]);
$arr=["gif","png","jpg","jpeg"];
if(in_array($type[1],$arr)){
    $file=addslashes(file_get_contents($img["tmp_name"]));
    $q=mysqli_query($con,"select email from user_images where email='$email'");
    if( mysqli_num_rows($q)==0 ){
        mysqli_query($con,"insert into user_images values('$email','$file')");

    }else{
        mysqli_query($con,"update user_images set image='$file' where email='$email'");
    }
    $result["g"]=true;
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