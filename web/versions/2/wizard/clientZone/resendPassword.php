<?php

// use function PHPSTORM_META\type;

require('./connection.php');
$result=["c"=>true,"g"=>false,"e"=>""];
date_default_timezone_set("Asia/Calcutta");
if(!$con){
    $result["c"]=false;
}else{
if(isset($_POST['i'])){
    $hash=$_POST['i'];
    $q=mysqli_query($con,"select email,dateSent from resendPassword where hash='$hash'");
    $res=mysqli_fetch_assoc($q);
    if(mysqli_num_rows($q)==0){
        $result['g']=false;
    }else{
        // $sent=new DateTime($res['dateSent']);
        // $cur=new DateTime(date('H:i:s'));
        // $interval = $sent->diff($cur);
        $sent=strtotime($res['dateSent']);
        $cur=strtotime(date('m/d/Y h:i:s a', time()));
        $inter=abs($sent-$cur);
        // $inter=($interval->h)*60 + ($interval->s);
        // $result['in']=type($inter);
        // $inter=25;
        // $result['inn']=$inter;
        if($inter>(30*60)){
            $result['g']=false;
            mysqli_query($con,"delete from resendPassword where hash='$hash'");
        }else{
            $result['g']=true;
            $result["e"]=$res["email"];
            // mysqli_query($con,"delete from resendPassword where hash='$hash'");
        }
    }
    mysqli_commit($con);
}
}

$result=json_encode($result);
print_r($result);

?>