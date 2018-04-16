<?php
include('_function/function.php');
include('_api/api.php');

$server = $_SERVER['REQUEST_METHOD'];

if($server == 'POST') {

  if(isset($_POST['startpoint']) || isset($_POST['endpoint'])) {
      $point1 = startingPoint($_POST['startpoint']);
      $point2 = startingPoint($_POST['endpoint']);

      $arr = array('token' => 'TOKEN');
      echo json_encode($arr);
      // $point2 = endingPoint($_POST['endpoint']);
      // $arr = array([$point1, $point2]);
      // echo json_encode($arr);
  }else {
    echo "ERROR_DESCRIPTION";
  }
}elseif($server == 'GET') {
  if(isset($_GET['origins']) and isset($_GET['destinations'])) {

    $dist_between = getdistancebetweenPoints($_GET['origins'], $_GET['destinations']);

    $arr = array("status"=>"success", "path"=>[$_GET['origins'], $_GET['destinations']], "total_distance" => $dist_between[0], "total_duration"=>$dist_between[1]);
    echo json_encode($arr);

  }
  else {
    echo "ERROR_DESCRIPTION";
  }

}
?>
