<?php

$email=$_POST['email'];
$dbc = mysqli_connect('mysql.hostinger.in' , 'u7101698_adi96' , 'aytida' , 'u710169871_nbfs') or die('cant connect to database');
$query="SELECT * FROM friends where email='$email'";
$res=mysqli_query($dbc,$query) or die("cant fire query 1");
if($row=mysqli_fetch_array($res)){
    $code=rand(10000,99999);
    $query="DELETE FROM pwdrecovery WHERE email='$email'";
    $res=mysqli_query($dbc,$query) or die("cant fire query 2");
    $query="INSERT INTO pwdrecovery VALUES('$email','$code')";
    $result=mysqli_query($dbc,$query) or die("cant fire query 3");
    $name=$row['name'];
    $msg="$name, your code for recover password at Friends Nearby is $code.\nUse this code at app Forget Password screen to set a new Password\n\nIf you are not $name or have not registered then Please ignore this email.\n\nRegards,\nTeam Friends Nearby\nsupport@friendsnearby.com";
    $subject="Friends Nearby- Password Recovery";
    mail($email,$subject,$msg) or die("email not send");
    $data=['status'=>'ok'];
}
else{
    $data=['status'=>'error'];
}
$json=json_encode($data);
echo $json;
?>