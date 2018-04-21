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
      echo "ERROR_DESCRIPTIONS";
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

  foreach($response["routes"] as $data) {
    $route =  json_encode($data["legs"][0]["distance"]["value"], true);
    $duration =  json_encode($data["legs"][0]["duration"], true);

    $distance = array($route);
    usort($distance, "sortthedata");

    print_r($distance);
    // usort($routes,create_function('$a,$b','return intval($a->legs[0]["distance"]["value"]) - intval($b->$a->legs[0]["distance"]["value"]);'));

  }
}else {
  echo "ERROR_DESCRIPTION";
}






  // print_r($response["routes"]);

// $response = json_decode($distbetween_content);
// foreach($response as $data) {
//   print_r($data[0]['copyrights']);
// }

  // $response =  json_decode($distbetween_content, true);
  // foreach($response as $data) {
  //     echo json_encode($data);
  // }

  // if($distbetween_content['status']=='OK'){
    // usort($routes,create_function('$a,$b','return intval($a->legs[0]->distance->value) - intval($b->legs[0]->distance->value);'));
    //
    // usort($response)
    //


        // $routes = isset($response['routes'][0]['legs'][0]['distance'] ) ? $response['routes'][0]['legs'][0]['distance']: "";
   //  $distance = isset($response['rows'][0]['elements'][0]['distance']['value']) ? $response['rows'][0]['elements'][0]['distance']['value'] : "" ;
   // $duration = isset($response['rows'][0]['elements'][0]['duration']['value']) ? $response['rows'][0]['elements'][0]['duration']['value'] : "" ;
                //
                // if($routes){
                //   $distance_between = array();
                //     array_push($distance_between,$routes);
                //     return $distance_between;
                //
                // } else {
                //   return false;
                // }
  // } else {
  //   echo "ERROR_DESCRIPTIONS";
  //   return false;
  // }




}
