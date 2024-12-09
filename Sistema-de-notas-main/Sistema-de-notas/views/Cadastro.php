<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Sistema de Menções</title>
    <link rel="stylesheet" href="../public/css/estilo.css">
</head>
<body>

    
    <div class="login-container">
        <div class="login-box">  
            <img class="boneco-medio" src="../public/imgs/bonecomediotec.png" alt="Logo MedioTec Menções">
               <h1>CADASTRO</h1>
            <form action="../src/controller/controller_cadastro.php" method="POSt">
                <label for="username">NOME</label>
                <input placeholder="Inserir Nome" type="text" id="username" name="username" required>
                
                <label for="password">E-MAIL</label>
                <input placeholder="Inserir E-mail" id="password" name="email" required>

                <label for="password">CPF</label>
                <input placeholder="Digite seu CPF" id="password" name="cpf" required>

                <label for="password">MATRICULA</label>
                <input placeholder="Inserir Matricula" id="password" name="matricula" required>


                <button type="submit">CADASTRAR</button>

               
            
            </form>
        </div>
    </div>
</body>
</html>