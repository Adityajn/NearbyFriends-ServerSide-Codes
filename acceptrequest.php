<?php
$uid=$_POST['uid'];
$fuid=$_POST['fuid'];
$accpt="true";
$dbc = mysqli_connect('mysql.hostinger.in' , 'u7101698_adi96' , 'aytida' , 'u710169871_nbfs') or die('cant connect to database');
$query = "Update friendslist set accepted='$accpt' WHERE uid='$fuid' AND fuid='$uid' ";
$result = mysqli_query($dbc,$query) or die('Some error occured');
$data = ["status"=>"ok",'uid'=>$fuid ];
echo json_encode($data);
?>