<?php
require_once("../../config/dbConnect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $matricula = filter_input(INPUT_POST, 'matricula');
    $cpf = filter_input(INPUT_POST, 'cpf');
    // Verificar se todos os campos foram preenchidos

// Preparar e executar a consulta
    $query = $dbh->prepare("
        SELECT 
            u.nome AS nome_usuario,
            CASE
                WHEN a.mat_aluno IS NOT NULL THEN a.mat_aluno
                WHEN p.mat_prof IS NOT NULL THEN p.mat_prof
            END AS matricula,
            CASE
                WHEN a.mat_aluno IS NOT NULL THEN 'Aluno'
                WHEN p.mat_prof IS NOT NULL THEN 'Professor'
            END AS tipo_usuario
        FROM 
            usuario u
        LEFT JOIN aluno a ON u.id_usuario = a.id_usuario
        LEFT JOIN prof p ON u.id_usuario = p.id_usuario
        WHERE 
            (a.mat_aluno = :matricula OR p.mat_prof = :matricula)
            AND u.cpf = :cpf;
    ");
    $query->bindParam(':matricula', $matricula);
    $query->bindParam(':cpf', $cpf);
    $query->execute();

    // Obter o resultado
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $tipoUsuario = $result['tipo_usuario'];
        $nomeUsuario = $result['nome_usuario'];
        $matriculaUsuario = $result['matricula'];

        // Redirecionar para rotas diferentes
        if ($tipoUsuario === 'Aluno') {
            session_start();
            $_SESSION["Nome_user"] = $result['nome_usuario'];
            $_SESSION["id_user"] = $result['matricula'];
            header("Location: ../../views/boletim.php"); // Substitua pelo caminho da página do aluno
        } elseif ($tipoUsuario === 'Professor') {
            session_start();
            $_SESSION["Nome_user"] = $result['nome_usuario'];
            $_SESSION["id_user"] = $result['matricula'];
            header("Location: ../../views/menu.php"); // Substitua pelo caminho da página do professor
        }
        exit();
    } else {
        // Login inválido
        header("Location: ../../views/login.php?erro=NotFound"); // Volta para a página de login
        exit();
    }  
}
?>