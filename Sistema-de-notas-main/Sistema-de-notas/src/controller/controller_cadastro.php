<?php

require_once('../../config/dbConnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $nome = filter_input(INPUT_POST, 'username');
    $email = filter_input(INPUT_POST, 'email');
    $cpf = filter_input(INPUT_POST, 'cpf');
    $matricula = filter_input(INPUT_POST, 'matricula');

    // Verificar se todos os campos foram preenchidos
    if (!empty($nome) && !empty($email) && !empty($cpf) && !empty($matricula)) {

        // Inserção na tabela usuario
        $insertusuario = "INSERT INTO usuario (id_usuario, nome, email, cpf) VALUES (null, :nome, :email, :cpf)";
        $req = $dbh->prepare($insertusuario);
        $req->bindValue(':nome', $nome);
        $req->bindValue(':email', $email);
        $req->bindValue(':cpf', $cpf);

        if ($req->execute()) {
            // Pegar o ID do usuário recém inserido
            $id_usuario = $dbh->lastInsertId();

            // Verificar se a matrícula é numérica ou contém letras
            if (is_numeric($matricula)) {
                // Matrícula é numérica, inserir na tabela aluno
                $insertaluno = "INSERT INTO aluno (mat_aluno, id_usuario) VALUES (:matricula, :id_usuario)";
                $reqAluno = $dbh->prepare($insertaluno);
                $reqAluno->bindValue(':matricula', $matricula);
                $reqAluno->bindValue(':id_usuario', $id_usuario);

                // Executar a inserção na tabela aluno
                $reqAluno->execute();
            } else {
                // Matrícula contém letras, inserir na tabela prof
                $insertprof = "INSERT INTO prof (mat_prof, id_usuario) VALUES (:matricula, :id_usuario)";
                $reqProf = $dbh->prepare($insertprof);
                $reqProf->bindValue(':matricula', $matricula);
                $reqProf->bindValue(':id_usuario', $id_usuario);

                // Executar a inserção na tabela prof
                $reqProf->execute();
            }

            // Redirecionar para a página de sucesso
            header("Location: ../../views/Cadastro.php?sucesso=1");
        } else {
            // Caso erro na inserção do usuário
            header("Location: ../../views/Cadastro.php?sucesso=0");
        }
    } else {
        // Caso algum campo não tenha sido preenchido
        header("Location: ../../views/Cadastro.php?sucesso=0");
    }
} else {
    // Se não for uma requisição POST
    header("Location: ../../views/Cadastro.php");
}
