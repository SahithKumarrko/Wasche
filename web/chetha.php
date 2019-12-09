<?php

$con=mysqli_connect("remotemysql.com","bO0fmbh7wa","crfENX2Hrl","bO0fmbh7wa","3306");
if(!$con){
    echo "error";
}else{
    $c=0;
    while($c<1050){
        mysqli_query($con,"insert into timetable values('Mon','1','CSE','4','E','123')");
        $c=$c+1;
    }
    mysqli_commit($con);
    print("completed");
}

?>