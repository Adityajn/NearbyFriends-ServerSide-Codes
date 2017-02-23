<?php
$data_back = json_decode(file_get_contents('php://input'));

$email = $data_back->{"email"};
$pass = $data_back->{"pass"};
$name= $data_back->{"name"};

$dbc = mysqli_connect('mysql.hostinger.in' , 'u7101698_adi96' , 'aytida' , 'u710169871_nbfs') or die('cant connect to database');
$query = "SELECT * FROM friends WHERE email = '$email' ";
$result = mysqli_query($dbc,$query) or die('Some error occured');
$row=mysqli_fetch_array($result);
header("Content-Type: application/json;charset=utf-8");
if($row){
	$data = [ 'status' => "error", 'uid'=>"0" ];
}
else{
	$query = "INSERT INTO friends(email,password,name,lastupdated) VALUES('$email',SHA1('$pass'),'$name',(now()+INTERVAL 5 HOUR +INTERVAL 30 MINUTE))";
	$result=mysqli_query($dbc,$query) or die('Email id already registered with us..');
	$query ="SELECT * FROM friends WHERE email = '$email' ";
	$result = mysqli_query($dbc,$query) or die('Some error occured2');
	$row=mysqli_fetch_array($result);
	$data = [ 'status' => "ok", 'uid'=>$row['uid'] ];

	$uid=$row['uid'];
	$msg = "$name, you are registered at Friends Nearby, an app to track friends and have Fun.\n\nYour Unique Id- $uid.\nUse this id to connect with Friends.\n\nIf you are not $name or have not registered then Please ignore this email.\n\nRegards,\nTeam Friends Nearby\nsupport@friendsnearby.com";
	$to = $email;
	$subject = "Friends Nearby - An app to track friends and have fun.";
	mail($to , $subject, $msg) or die('cant send confirmation mail');
}
$json = json_encode($data);
echo $json;
?>