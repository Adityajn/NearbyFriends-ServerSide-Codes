<?php

$uid=$_POST['uid'];
$accpt="true";
$dbc = mysqli_connect('mysql.hostinger.in' , 'u7101698_adi96' , 'aytida' , 'u710169871_nbfs') or die('cant connect to database');
$query = "SELECT uid FROM friendslist WHERE fuid = '$uid' AND accepted='$accpt'";
$result = mysqli_query($dbc,$query) or die('Some error occured');
$arr=array();
while ($row=mysqli_fetch_array($result)) {
    $uid=$row['uid'];
	$query = "SELECT * FROM friends WHERE uid ='$uid'";
    $result1 = mysqli_query($dbc,$query) or die('Some error occured');
    $row1=mysqli_fetch_array($result1);
    $data = [ 'uid'=>$row1['uid'], 'name'=>$row1['name'], 'email'=>$row1['email'] ];
    array_push($arr,$data);
}
header("Content-Type: application/json;charset=utf-8");
$data = ['status'=>'ok' ,'list' => $arr ];
$json = json_encode($data);
echo $json;
?>