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

    function sortthedata($a, $b)
    {
        if ($a == $b) {
            return 0;
        }
        return ($a > $b) ? -1 : 1;
    }
  // $duration =  json_encode($data["legs"][0]["duration"], true);
  foreach($response["routes"] as $key => $data) {
    $route =  json_encode($data["legs"][0]["distance"]["value"], true);
    $distance = array($route);
    usort($distance, "sortthedata");
    print_r($distance);
  }


}else {
  echo "ERROR_DESCRIPTION";
}




}
