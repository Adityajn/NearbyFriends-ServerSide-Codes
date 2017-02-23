<?php
$data_back = json_decode(file_get_contents('php://input'));

$email = $data_back->{"email"};
$pass = $data_back->{"pass"};
$code= $data_back->{"code"};

$dbc = mysqli_connect('mysql.hostinger.in' , 'u7101698_adi96' , 'aytida' , 'u710169871_nbfs') or die('cant connect to database');
$query="SELECT * FROM pwdrecovery where email='$email' and code='$code'";
$res=mysqli_query($dbc,$query) or die("cant fire query 1");
if($row=mysqli_fetch_array($res)){
    $query="DELETE FROM pwdrecovery WHERE email='$email'";
    $res=mysqli_query($dbc,$query) or die("cant fire query 2");
    $query="UPDATE friends SET password=SHA1('$pass') where email='$email'";
    $result=mysqli_query($dbc,$query) or die("cant fire query 3");
    $msg="Your password for Friends Nearby have been recovered successfully.\n\nIf you are not $name or have not registered then Please ignore this email.\n\nRegards,\nTeam Friends Nearby\nsupport@friendsnearby.com";
    $subject="Friends Nearby- Password Successfully Recovered";
    mail($email,$subject,$msg) or die("email not send");
    $data=['status'=>'ok'];
}
else{
    $data=['status'=>'error'];
}
$json=json_encode($data);
echo $json;
?>