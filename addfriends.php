<?php

$uid = $_POST['uid'];
$fuid =$_POST['fuid'];

$dbc = mysqli_connect('mysql.hostinger.in' , 'u7101698_adi96' , 'aytida' , 'u710169871_nbfs') or die('cant connect to database');
$query = "SELECT * FROM friends WHERE uid = '$fuid'";
$result = mysqli_query($dbc,$query) or die('Some error occured');
$row=mysqli_fetch_array($result);
header("Content-Type: application/json;charset=utf-8");
if($row){
	$query = "SELECT * FROM friendslist WHERE uid = '$uid' AND fuid = '$fuid'";
	$result = mysqli_query($dbc,$query) or die('Some error occured');
	$row=mysqli_fetch_array($result);
	if($row){
		$data = [ 'status' => "error", 'uid'=>"0" ];
	}
	else{
		$query = "INSERT INTO friendslist(uid,fuid) VALUES('$uid','$fuid')";
		$result=mysqli_query($dbc,$query) or die('Email id already registered with us..');
		$data = [ 'status' => "ok", 'uid'=>$fuid ];
	}
}
else{
	$data = [ 'status' => "error", 'uid'=>"0" ];
}
$json = json_encode($data);
echo $json;
?>