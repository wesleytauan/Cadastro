<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Menções</title>
    <link rel="stylesheet" href="../public/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <img src="../public/imgs/bonecomediotec.png" alt="Imagem de Perfil" class="profile-image">
            <h1>Login</h1>
            <form action="../src/controller/controller_login.php" method="post">
                <label for="matricula">Matrícula</label>
                <input placeholder="Inserir Matrícula" type="text" id="matricula" name="matricula" required>
                
                <label for="cpf">CPF</label>
                <input placeholder="Digite seu CPF" type="password" id="cpf" name="cpf" required>

                <button type="submit">Entrar</button>
                <p><a href="#">Esqueceu a senha?</a></p>
                
                <?php
                if (isset($_GET["erro"])){
                    if ($_GET["erro"] == "NotFound"){
                        echo '<p class="error">CPF ou senha incorretos</p>';
                    }
                }
                ?>
            </form>  
        </div>
    </div>
</body>
</html>
