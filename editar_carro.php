<?php
session_start();

require_once 'server.php';

if (!isset($_SESSION['logado'])):
    header('Location: index.php');
endif;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopGear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style02.css">
</head>

<body>
    <h1>Editar Carro</h1>
    <a href="return.php" class="linkLog">Retornar</a>

    <div class="container">
        <?php
        if (isset($_GET['id'])) {
            $user_id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "SELECT * FROM cars WHERE id='$user_id'";
            $query = mysqli_query($conn, $sql);

            if (mysqli_num_rows($query) > 0) {
                $user = mysqli_fetch_array($query);

                ?>
                <form action="cadastro_carro.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="car_id" value="<?= $user['id']?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Marca</label>
                            <input type="text" class="form-control" value="<?= $user['name'] ?>" id="inputMarca"
                                placeholder="Marca" name="name_car">
                        </div>
                        <br>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Modelo</label>
                            <input type="text" class="form-control" id="inputText" value="<?= $user['model'] ?>"
                                placeholder="Modelo" name="model_car">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Capa</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" value="<?= $user['model'] ?>"
                            name="filename_car" accept="image/*">
                    </div>
                    <br>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="showcase_car"
                            value="Sim">
                        <label class="form-check-label" for="exampleCheck1">Destaque</label>
                    </div>
                    <br>
                    <button type="submit" name='update_car' class="btn btn-primary">Salvar</button>
                </form>
                <?php
            } else {
                echo "<h5>Usuário não encontrado</h5>";
            }
        }
        ?>
    </div>

</body>

</html>