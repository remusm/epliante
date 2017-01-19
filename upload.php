<?php
    $target_dir = 'system/storage/upload/';
    
    if ( 0 < $_FILES['fisier']['error'] ) {
        echo 'Error: ' . $_FILES['fisier']['error'] . '<br>';
        echo '1: '.$_FILES['fisier'];
    }
    else {
        echo '2<br>';
        $target_file = $target_dir . basename($_FILES["fisier"]["name"]);
        if (move_uploaded_file($_FILES["fisier"]["tmp_name"], $target_file)) {
            echo '3';
        }
    }
    
    if (isset($_FILES["fisier"]["name"])) echo 'da';
    else echo 'nu';
    
    if (!empty($_FILES['fisier']['name'])) echo 'uploadat1: '.$_FILES['fisier']['name'];
    