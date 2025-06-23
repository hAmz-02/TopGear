<?php
require_once 'server.php';

session_start();

// verificação
if (!isset($_SESSION['logado'])):
    header('Location: index.php');
endif;

//dados
$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM admin_user WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$dados = mysqli_fetch_array($result);


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
    <?php
    $search = $_POST['busca'] ?? '';

    include 'server.php';

    $sql = "SELECT * FROM cars WHERE name LIKE '%$search%'";

    $dadosCarro = mysqli_query($conn, $sql);
    ?>

    <h1>Olá <?php echo $dados['name']; ?></h1>
    <a href="logout.php" class="linkLog">Sair</a>
    <div class="container">
        <form action="cadastro_carro.php" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Marca</label>
                    <input type="text" class="form-control" id="inputMarca" placeholder="Marca" name="name_car">
                </div>
                <br>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Modelo</label>
                    <input type="text" class="form-control" id="inputText" placeholder="Modelo" name="model_car">
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="exampleFormControlFile1">Capa</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="filename_car" accept="image/*">
            </div>
            <br>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="showcase_car" value="Sim">
                <label class="form-check-label" for="exampleCheck1">Destaque</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Pesquisar</h1>
                <nav class="navbar navbar-light bg-light">
                    <form action="iven.php" class="form-inline" method="POST">
                        <input type="search" class="form-control mr-sm-2" placeholder="Nome" aria-label="Search"
                            name="busca">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                    </form>
                </nav>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Capa</th>
                            <th scope="col">Destaque</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($linha = mysqli_fetch_assoc($dadosCarro)) {
                            $codCar = $linha['id'];
                            $nome = $linha['name'];
                            $model = $linha['model'];
                            $capa = $linha['filename'];
                            $showcase = $linha['showcase'];

                            echo "<tr>
                                    <th scope='row'>$nome</th>
                                    <td>$model</td>
                                    <td>$capa</td>
                                    <td>$showcase</td>
                                 </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>