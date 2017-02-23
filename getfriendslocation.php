<?php

$uid=$_POST['uid'];
$fuid=$_POST['fuid'];
$accpt="true";
$dbc = mysqli_connect('mysql.hostinger.in' , 'u7101698_adi96' , 'aytida' , 'u710169871_nbfs') or die('cant connect to database');
$query = "SELECT fuid FROM friendslist WHERE uid = '$uid' AND fuid='$fuid' AND accepted='$accpt'";
$result = mysqli_query($dbc,$query) or die('Some error occured');
$i=0;
if ($row=mysqli_fetch_array($result)) {
    $i=1;
}
header("Content-Type: application/json;charset=utf-8");
if($i==1){
    $query = "SELECT * FROM friends WHERE uid = '$fuid' ";
    $result = mysqli_query($dbc,$query) or die('Some error occured');
    $row=mysqli_fetch_array($result);
    $data = ['status'=>'ok', 'name'=>$row['name'], 'lat'=>$row['lat'],'lon'=>$row['lon'],'time'=>$row['lastupdated'] ];
}
else{
    $data =['status'=>'error'];
}
$json = json_encode($data);
echo $json;
?>