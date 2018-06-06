<?php

//my staring point
function startingPoint($lat=null, $lng=null){
   global $g_key;
   global $api_geocode;
   $url = ''.$api_geocode.'address='.$lat.''.$lng.'&sensor=false&key='.$g_key.'';
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   $startpoint_content = curl_exec($ch);


   curl_close($ch);
    $response_a = json_decode($startpoint_content, true);
    if($response_a['status']=='OK'){
      return $response_a;
    } else {
      return false;
    }
}
// my ending point
function endingPoint($lat1=null, $lng1=null) {
  global $g_key;
  global $api_geocode;
 $url = ''.$api_geocode.'address='.$lat1.''.$lng1.'&sensor=false&key='.$g_key.'';
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 $endpoint_content = curl_exec($ch);

 curl_close($ch);
  $response_a = json_decode($endpoint_content, true);

  if($response_a['status']=='OK'){
    return $response_a;
  } else {
    echo "ERROR_DESCRIPTION";
    return false;
  }

}

// geting distance between two point
function getdistancebetweenPoints($lat=null, $lng=null, $lat1=null, $lng1=null) {
  global $TOKEN;
  global $g_key;
  global $api_googleapis;
  $file_content = ''.$api_googleapis.'origin='.$lat.'&destination='.$lng.'&alternatives=true&sensor=false&key='.$g_key.'';

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $file_content);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $distbetween_content = curl_exec($ch);

  curl_close($ch);

$response =  json_decode($distbetween_content, true);

if($response['status']=='OK') {


  foreach($response["routes"] as $key => $data) {

$route =  json_encode($data["legs"][0]['distance']['value'], true);
$duration =  json_encode($data["legs"][0]['duration']['value'], true);
$lat_start =  json_encode($data["legs"][0]['start_location']['lat'], true);
$lng_start =  json_encode($data["legs"][0]['start_location']['lng'], true);
$lat_end =  json_encode($data["legs"][0]['end_location']['lat'], true);
$lng_end =  json_encode($data["legs"][0]['end_location']['lng'], true);


    $distance = array(
      'status' => 'success',
      'path' => array(array($lat_start, $lng_start),
            array($lat_end, $lng_end)),
      'total_distance' => $route,
      'total_time' => $duration);
    return $distance;
  }


}else {
$arr_error = array('status' => 'failure', 'error' => 'ERROR_DESCRIPTION');
echo json_encode($arr_error);
return 0;
}




}
