<?php

$email=$_POST['email'];
$pass=$_POST['pass'];
$dbc = mysqli_connect('mysql.hostinger.in' , 'u7101698_adi96' , 'aytida' , 'u710169871_nbfs') or die('cant connect to database');
$query = "SELECT * FROM friends WHERE email = '$email' AND password=SHA1('$pass') ";
$result = mysqli_query($dbc,$query) or die('Some error occured');
header("Content-Type: application/json;charset=utf-8");
if ($row=mysqli_fetch_array($result)) {
    $data = ['status'=>'ok','uid'=>$row['uid'],'email'=>$row['email'], 'name'=>$row['name'], 'lat'=>$row['lat'], 'lon'=>$row['lon'] ];
}
else{
    $data =['status'=>'error'];
}
$json = json_encode($data);
echo $json;
?>