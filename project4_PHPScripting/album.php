// https://www.php.net/manual/en/function.json-encode.php 
<?php
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
                    $fileDestination = 'images/' . $fileName;
                    move_uploaded_file($fileTempName, $fileDestination);
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
    }
    ?>
