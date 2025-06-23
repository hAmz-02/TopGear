<?php
require_once 'server.php';
session_start();

if(isset($_POST['entrar'])):
    $login = mysqli_escape_string($conn, $_POST['login']);
    $password = mysqli_escape_string($conn, $_POST['password']);

    if(empty($login) or empty($password)):
        echo "<script language='javascript'> alert('Não pode haver campos vazios') </script>";
    else:
        $sql = "SELECT name FROM admin_user WHERE name = '$login' ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0):

            $sql = "SELECT * FROM admin_user WHERE name = '$login' AND password = '$password'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1):
                $dados = mysqli_fetch_array($result);
                $_SESSION['logado'] = true;
                $_SESSION['id_usuario'] = $dados['id'];
                header('Location: iven.php');
            else:
                echo "<script language='javascript'> alert('[ERRO] : USUÁRIO E SENHA NÃO CONFEREM') </script>";
            endif;
        else:
            echo "<script language='javascript'> alert('[ERRO] : USUÁRIO INEXISTENTE') </script>";
        endif;

    endif;
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
    <h1>Login Admin User</h1>
    <div class="container-sm">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="inputUser" class="form-label">User</label>
            <input type="text" id="inputUser" class="form-control" name="login">
            <br>
            <label for="inputPassword5" class="form-label">Password</label>
            <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="password">
            <br>
            <button class="btn btn-primary" type="submit" name="entrar">Submit</button>
        </form>
    </div>

</body>
</html>