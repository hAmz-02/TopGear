<?php
session_start();

require_once 'server.php';

if (!isset($_SESSION['logado'])):
    header('Location: index.php');
endif;

// Cadastro do carro

if (isset($_POST['create_car'])) {
    $name = $_POST['name_car'];
    $model = $_POST['model_car'];

    if (isset($_POST['showcase_car'])) {
        $showcase = $_POST['showcase_car'];
    } else {
        $showcase = 'Não';
    }

    if (isset($_FILES['filename_car']) && !empty($_FILES['filename_car'])) {
        $imagem = "./images/cars/" . $_FILES['filename_car']['name'];
        move_uploaded_file($_FILES["filename_car"]["tmp_name"], $imagem);
    } else {
        echo "<script language='javascript'>alert('Imagem é necessária para o cadastro')</script>";
    }


    $sql_cars = "INSERT INTO `cars` (`name`, `model`, `filename`, `showcase`) VALUES ('$name', '$model', '$imagem','$showcase');";

    if (mysqli_query($conn, $sql_cars)) {
        echo "<script language='javascript'>alert('Carro cadastrado com sucesso')</script>";
        header("Location: iven.php");
    }

}

//Atualização do Carro

if (isset($_POST['update_car'])) {
    $car_id = mysqli_real_escape_string($conn, $_POST['car_id']);
    $nameUp = mysqli_real_escape_string($conn, trim($_POST['name_car']));
    $modelUp = mysqli_real_escape_string($conn, trim($_POST['model_car']));
    if (isset($_FILES['filename_car']) && !empty($_FILES['filename_car'])) {
        $imagemUp = "./images/cars/" . $_FILES['filename_car']['name'];
        move_uploaded_file($_FILES["filename_car"]["tmp_name"], $imagemUp);
    } else {
        echo "<script language='javascript'>alert('Imagem é necessária para o cadastro')</script>";
    }
    if (isset($_POST['showcase_car'])) {
        $showcaseUp = $_POST['showcase_car'];
    } else {
        $showcaseUp = 'Não';
    }
    $sqlUp = "UPDATE cars SET name = '$nameUp', model = '$modelUp', filename = '$imagemUp', showcase = '$showcaseUp' WHERE id = '$car_id' ";

    mysqli_query($conn, $sqlUp);

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script language='javascript'>alert('Carro atualizado com sucesso')</script>";
        header("Location: iven.php");
    } else {
        echo "<script language='javascript'>alert('[ERRO] Não foi possível atualizar')</script>";
        header("Location: iven.php");
    }
}

// Deletar Carro
if (isset($_POST['delete_car'])) {
    $car_id = mysqli_real_escape_string($conn, $_POST['delete_car']);
    $sql = "DELETE FROM cars WHERE id = '$car_id'";
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        header("Location: iven.php");
        exit;
    }
}