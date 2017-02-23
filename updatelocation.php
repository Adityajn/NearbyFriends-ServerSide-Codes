<?php
$data_back = json_decode(file_get_contents('php://input'));

$uid = $data_back->{"uid"};
$lat = $data_back->{"lat"};
$lon= $data_back->{"lon"};

$dbc = mysqli_connect('mysql.hostinger.in' , 'u7101698_adi96' , 'aytida' , 'u710169871_nbfs') or die('cant connect to database');
$query = "Update friends SET lat='$lat' ,lon='$lon' ,lastupdated=(now()+INTERVAL 5 HOUR +INTERVAL 30 MINUTE) WHERE uid='$uid'";
$result=mysqli_query($dbc,$query) or die('Some error occured');
$data = [ 'status' => "ok", 'uid'=>$uid ];
$json = json_encode($data);
echo $json;
?>