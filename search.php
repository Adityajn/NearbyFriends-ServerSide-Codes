<?php
$pattern=$_POST['pattern'];
$dbc = mysqli_connect('mysql.hostinger.in' , 'u7101698_adi96' , 'aytida' , 'u710169871_nbfs') or die('cant connect to database');
$query = "select * from friends where lower(name) like '%{$pattern}%' ";
$result = mysqli_query($dbc,$query) or die('Some error occured');
$arr=array();
while($row=mysqli_fetch_array($result)) {
    $data=[ 'uid'=>$row['uid'], 'name'=>$row['name'], 'email'=>$row['email'] ];
    array_push($arr,$data);
}
header("Content-Type: application/json;charset=utf-8");
$datam = ['status'=>'ok', 'list' => $arr ];
$json = json_encode($datam);
echo $json;
?>