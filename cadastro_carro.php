<?php
session_start();

require_once 'server.php';

if (!isset($_SESSION['logado'])):
    header('Location: index.php');
endif;


//dados carro
$name = $_POST['name_car'];
$model = $_POST['model_car'];

if (isset($_POST['showcase_car'])) {
    $showcase = $_POST['showcase_car'];
} else {
    $showcase = 'Não';
}

if (isset($_FILES['filename_car']) && !empty($_FILES['filename_car'])) {
    $imagem = "./images/cars/".$_FILES['filename_car']['name'];
    move_uploaded_file($_FILES["filename_car"]["tmp_name"], $imagem);
} else {
    echo "<script language='javascript'>alert('Imagem é necessária para o cadastro')</script>";
}


$sql_cars = "INSERT INTO `cars` (`name`, `model`, `filename`, `showcase`) VALUES ('$name', '$model', '$imagem','$showcase');";

if (mysqli_query($conn, $sql_cars)) {
    echo "<script language='javascript'>alert('Carro cadastrado com sucesso')</script>";
    header("Location: iven.php");
}

