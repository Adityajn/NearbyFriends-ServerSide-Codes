<?php

$uid=$_POST['uid'];
$accpt="true";
$dbc = mysqli_connect('mysql.hostinger.in' , 'u7101698_adi96' , 'aytida' , 'u710169871_nbfs') or die('cant connect to database');
$query = "SELECT fuid FROM friendslist WHERE uid = '$uid' AND accepted='$accpt'";
$result = mysqli_query($dbc,$query) or die('Some error occured');
$arr=array();
while ($row=mysqli_fetch_array($result)) {
    array_push($arr,$row['fuid']);
}
header("Content-Type: application/json;charset=utf-8");
$data = ['count'=>sizeof($arr) ,'list' => $arr ];
$json = json_encode($data);
echo $json;
?>