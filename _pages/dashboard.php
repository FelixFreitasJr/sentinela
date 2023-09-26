<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('../_include/head.php'); ?>
    <link rel="stylesheet" href="../_css/style.css">
    <title>Dashboard</title>
</head>
<div class="principal">
<body>
    <header>
        <?php include('../_include/header.php'); ?>
        <h1>Dashboard</h1>
        <p class="login">Olá, <?php echo $_SESSION['email']; ?></p>
    </header>
    <br>
    <nav>
    <?php include('../_include/menu.php'); ?>
    </nav>
    <section></section>
</body>
</html>