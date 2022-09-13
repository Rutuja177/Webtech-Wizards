<?php
// put your generated access token here (should have No Expiration)
$auth_token = 'kpuKU3oIYOoAAAAAAAAAAe7a6hHl7IxM2Z1Rqcp-pfOq3Px8-5ft6ehqyE3Psu7H';
// set it to true to display debugging info
$debug = true;

function download ($path,$target_path) {
   global $auth_token, $debug;
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $auth_token,
      		    'Content-Type:', 'Dropbox-API-Arg: {"path":"/'.$path.'"}'));
   curl_setopt($ch, CURLOPT_URL, 'https://content.dropboxapi.com/2/files/download');
   try {
     $result = curl_exec($ch);
   } catch (Exception $e) {
     echo 'Error: ', $e->getMessage(), "\n";
   }
   file_put_contents($target_path,$result);
   curl_close($ch);
}

function upload($path) {
  global $auth_token, $debug;
  $args = array("path" => $path, "mode" => "add");
  $fp = fopen($path, 'rb');
  $size = filesize($path);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_PUT, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Authorization: Bearer ' . $auth_token,
          'Content-Type: application/octet-stream',
          'Dropbox-API-Arg: {"path":"/'.$path.'", "mode":"add"}'));
  curl_setopt($ch, CURLOPT_URL, 'https://content.dropboxapi.com/2/files/upload');
  curl_setopt($ch, CURLOPT_INFILE, $fp);
  curl_setopt($ch, CURLOPT_INFILESIZE, $size);
  try {
    $result = curl_exec($ch);
  } catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
  }
  if ($debug)
     print_r($result);
  curl_close($ch);
  fclose($fp);
}

    if (isset($_FILES['file']['name'])) {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTempName = $_FILES['file']['tmp_name'];
        $fileError = $_FILES['file']['error'];
        $fileExt = explode('.', $fileName);
        $fileActualExtenstion = strtolower(end($fileExt));
        $allowed_files = array('jpg','jpeg');
            if (in_array($fileActualExtenstion, $allowed_files)) {
                if ($fileError == 0) {
                    $fileDestination = './images/'.$fileName;
                    $filetempDestination = 'images/UploadedImages/'. $fileName;
                    //echo $filetempDestination;
                    move_uploaded_file($fileTempName, $filetempDestination);
                    upload($filetempDestination);
                    download($fileTempName,$fileDestination);
                    
                    } 
                    echo json_encode($fileName);
                    exit;
                } else {
                        echo "There was an error while uploading the image!!";
                        exit;
                        }
            }   else {
                    echo "You cannot upload this type of files!!";
                    exit;
                }
  
?>
