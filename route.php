<?php
include('_function/function.php');
include('_api/api.php');
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
        echo json_encode($distance);
  }
  else {
    $arr_error = array('status' => 'failure', 'error' => 'ERROR_DESCRIPTION');
    echo json_encode($arr_error);
  }

}
?>
