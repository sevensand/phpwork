<?php
include('_function/function.php');
include('_api/api.php');
include('_token/token.php');
$TOKEN = generateToken();
$server = $_SERVER['REQUEST_METHOD'];

if($server == 'POST') {

  if(isset($_POST['startpoint']) || isset($_POST['endpoint'])) {
      $point1 = startingPoint($_POST['startpoint']);
      $point2 = startingPoint($_POST['endpoint']);
      if($point1['status'] == 'OK' && $point2['status'] == 'OK') {
        $arr = array('token' => $TOKEN);
        echo json_encode($arr);
      }else {
        $arr_error = array('error' => 'ERROR_DESCRIPTION');
        echo json_encode($arr_error);
      }

  }

}elseif($server == 'GET') {
  if(isset($_GET['origin']) and isset($_GET['destination'])) {
    $distance= getdistancebetweenPoints($_GET['origin'], $_GET['destination']);

      $arry_shortest = array('status' => 'success', array('path' => $_GET['origin'], 'destination' => $_GET['destination']), 'total_distance' => $distance[0], 'total_time' => $distance[0]);
      echo json_encode($arry_shortest);
    // $arr = array("status"=>"success", "path"=>[$_GET['origin'], $_GET['destination']], "total_distance" => $dist_between[0], "total_duration"=>$dist_between[1]);
  }
  else {
    echo "ERROR_DESCRIPTION";
  }

}
?>
