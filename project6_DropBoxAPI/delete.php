<?php
$auth_token = 'kpuKU3oIYOoAAAAAAAAAAe7a6hHl7IxM2Z1Rqcp-pfOq3Px8-5ft6ehqyE3Psu7H';
// set it to true to display debugging info
$debug = true;

global $auth_token, $debug;
  $path = $_REQUEST["deleteImg1"];
  $args = array("path" => $path);
  $ch = curl_init();
  $paralink = json_encode(array(
      'path'=> "/images/UploadedImages/".$path));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Authorization: Bearer ' . $auth_token,
      'Content-Type: application/json'));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $paralink);
    curl_setopt($ch, CURLOPT_URL, 'https://api.dropboxapi.com/2/files/delete_v2');
    
    
    try{
      $result = curl_exec($ch);
      echo "Image got deleted.";
  } catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
  }
 // if ($debug)
 // print_r($result);
  curl_close($ch);
  unlink('images/UploadedImages/'.$path);
  unlink('images/'.$path);
  //fclose($fp);

  

  ?>