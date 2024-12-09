<?php
$user = "root"; //variavel em PHP usa $
$pass = "123456";
try {
    $dbh = new PDO('mysql:host=localhost;dbname=mencoes2', $user, $pass);
    echo "Conexão estabelecida!";
} catch (PDOException $e) {
    echo "Erro!";
    echo $e;
}
?>
