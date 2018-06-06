<?php
include('_token/token.php');
$token = generateToken();

  $g_key = '';
  $api_geocode = 'https://maps.googleapis.com/maps/api/geocode/json?';
  $api_googleapis = 'https://maps.googleapis.com/maps/api/directions/json?';
