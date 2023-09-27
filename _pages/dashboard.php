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
    <script src="../_js/script.js"></script>
    <title>Dashboard</title>
</head>
<body>
<div class="principal">
    <header>
        <?php include('../_include/header.php'); ?>
        <h1>Dashboard</h1>
        <p class="login">Olá, <?php echo $_SESSION['email']; ?></p>
    </header>
    <br>
    <nav>
    <?php include('../_include/menu.php'); ?>
    </nav>
    <section>
        <br><br>
    </section>
    <footer>
        <?php include('../_include/footer.php'); ?>
        </footer>
</body>
</html>

