<?php
$x = true;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopGear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <header>
        <div class="headContainer">
            <div class="headNavbar">
                <div class="logoHead">Top<span>Gear</span></div>
                <nav class="listaNav navbar">
                    <ul>
                        <li><a href="#about" class="linkNav">Sobre</a></li>
                        <li><a href="#iventario" class="linkNav">Galeria</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main class="mainContainer">
        <!-- Carousel with autoplay derived from bootstrap -->
        <div class='slideAuto'>
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    session_start();
                    include 'server.php';

                    $sql = "SELECT * FROM cars WHERE showcase = 'Sim'";
                    $dados = mysqli_query($conn, $sql);

                    if ($dados) {
                        while ($linha = mysqli_fetch_assoc($dados)) {
                            if ($x == true) {
                                $x = false
                                    ?>
                                <div class='carousel-item active'>
                                    <img src="<?php echo $linha['filename']; ?>" class="d-block w-100" alt="<?= $linha['model'] ?>">
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class='carousel-item'>
                                    <img src="<?php echo $linha['filename']; ?>" class="d-block w-100" alt="<?= $linha['model'] ?>">
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="headContainer ivenTitle" id="iventario">
            <h2 class="logoHead logoHead02">Galeria</h2>
        </div>
        <!-- Iventário -->
        <div class="tableCard container-fluid">
            <?php
            include 'server.php';

            $sqlIven = "SELECT * FROM cars";
            $dadosIven = mysqli_query($conn, $sqlIven);

            if ($dadosIven) {
                while ($linha = mysqli_fetch_assoc($dadosIven)) {
                    ?>
                    <div class="card bg-dark text-white">
                        <img class="card-img img-fluid" src="<?php echo $linha['filename']; ?>" alt="<?= $linha['model'] ?>">
                        <div class="card-img-overlay">
                            <div class="textEffect container-sm">
                                <h5 class="card-title text-center text-wrap"><?php echo $linha['model']; ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        
        <div class="headContainer ivenTitle" id="iventario">
            <h2 class="logoHead logoHead02">Sobre Nós</h2>
        </div>
        <div class="aboutSection">
            <div class="aboutTitleSection" id="about">
                <h1 class="aboutTitle">TopGear</h1>
                <h2 class="aboutSubTitle">Velocidade Ilimitada</h2>

            </div>

            <div class="contentAbout">
                <h2 class="aboutTitleSub">Sobre Nós</h2>
                <div class="aboutText">
                    <p>Somos apaixonados por velocidade, design e inovação. Este site nasceu da vontade de
                        compartilhar
                        a
                        beleza
                        e o poder dos carros esportivos e de luxo com todos que, assim como nós, admiram a
                        excelência
                        automotiva. Aqui, você encontrará uma seleção visual dos modelos mais icônicos, modernos e
                        desejados
                        do
                        mundo automobilístico — sem fins comerciais, apenas com o objetivo de encantar, inspirar e
                        conectar
                        entusiastas. Nosso foco é proporcionar uma experiência visual envolvente, destacando
                        detalhes,
                        curvas,
                        motores e tudo o que torna cada máquina única. Acreditamos que carros não são apenas meios
                        de
                        transporte
                        — são obras de arte sobre rodas. Seja bem-vindo ao nosso universo automotivo. Acelere com a
                        gente!
                    </p>
                </div>

            </div>
        </div>

    </main>
    <footer>
        <div class="footerAlign">
            <div class="container footerContent">
                <div class="footerLogo">TopGear</div>
                <p class="copyright">@ <?= date('Y') ?> Todos os direitos reservados</p>
            </div>
        </div>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>


</body>

</html>