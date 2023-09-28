<div style="display: none;">
<?php
session_start();
include('../_php/verifica_login.php');
?>
</div>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include('../_include/head.php'); ?>
        <link rel="stylesheet" href="../_css/style.css">
        <title>Dashboard</title>
    </head>

<body>
<div class="principal">
    <header>
        <?php include('../_include/header.php'); ?>
        <nav>
            <hr>
            <?php include('../_include/menu.php'); ?>
        </nav>
            <br><br>
        <h1>Dashboard</h1>
        <p><div class="data" id="data"></div></p>
        <p><div class="relogio" id="relogio"></div></p>
        <?php include('../_include/data_hora.php'); ?>
        <p class="login">Olá, <?php echo $_SESSION['email']; ?></p>
            <br>
    </header>
        <hr>
    <section>
        <br><br>
    </section>
    <footer>
        <?php include('../_include/footer.php'); ?>
    </footer>
</div><!-- div principal -->
</body>
</html>

