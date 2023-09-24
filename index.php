<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<style>
        *{margin: 0;padding: 0;box-sizing: border-box;}
        body{
            background-color: #009010;
        }

        form{
            background-color: white;
            max-width: 500px;
            width: 70%;
            padding: 20px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        form h3{
            text-align: center;
            color:#009010;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        form input[type=email],
        form input[type=password]{
            width: 100%;
            height: 45px;
            border: 1px solid #ccc;
            padding-left: 10px;
            margin: 10px 0;
        }

        form input[type=submit]{
            width: 100%;
            height: 40px;
            cursor: pointer;
            background: #009010;
            color: white;
            border: 0;
            border-radius: 30px;
        }

        form input[type=submit]:hover{
            background-color: #02af09;
            transition: 1s;
        }

        form input[type=email]:focus{
            outline: 0;
        }
        form input[type=password]:focus{
            outline: 0;
        }
        p{
            text-align: center;
            color:red;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
</style>

<body>
    <form action="login.php" method="POST">
        <h3>Sistema de Login!</h3>

        <input id="email" type="email" name="email" placeholder="Seu e-mail..." required autofocus/>
        <input id="senha" type="password" name="senha" placeholder="Sua senha..." required/>
        <input type="submit" name="acao" value="Enviar"/>
        <?php
        if(isset($_SESSION['nao_autenticado'])):
        ?>
        <div class="notification is-danger">
            <br><p><strong>ERRO: E-mail ou senha inválidos.</strong></p>
        </div>
        <?php
        endif;
        unset($_SESSION['nao_autenticado']);
        ?>
    </form>

</body>

<script>
    var email = document.getElementById('email');

    email.addEventListener('focus', ()=>{
        email.style.borderColor = "#02af09";
    })
    email.addEventListener('blur', ()=>{
        email.style.borderColor = "#ccc";
    })

    var senha = document.getElementById('senha');

    senha.addEventListener('focus', ()=>{
        senha.style.borderColor = "#02af09";
    })
    senha.addEventListener('blur', ()=>{
        senha.style.borderColor = "#ccc";
    })
</script>

</html>