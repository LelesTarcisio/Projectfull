<?php
if (!isset($_SESSION)) {
    session_start();
}
if(isset($_POST['confirmarEnvio'])){
    $file = $_FILES['imagem'];
    print_r($file);
    $fileName = $_FILES['imagem']['name'];
    $fileTmpName = $_FILES['imagem']['tmp_name'];
    $fileSize = $_FILES['imagem']['size'];
    $fileError = $_FILES['imagem']['error'];
    $fileType = $_FILES['imagem']['type'];
    
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowed = array('jpg', 'jpeg', 'png');
    
    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){ 
            if($fileSize < 500000){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'upload/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
            } else{
                echo 'Seu arquivo é muito grande.';
            }
        } else{
            echo "Houve um erro no envio do seu arquivo.";
        }
    } else{
        echo "Você não pode enviar esse tipo de dado";
    }
}
 // https://www.youtube.com/watch?v=JaRq73y5MJk&t=601s