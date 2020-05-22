<?php
    include 'gestor.php';
    $gestor = new Gestor();

    $utilizador = "Nuno";
    $senha = "abc123";

    $params = array(
        ':utilizador' => $utilizador,
        ':senha'      => password_hash($senha, PASSWORD_DEFAULT)
    );

    // INSERE OS UTILIZADORES NA BASE DE DADOS 
    $gestor->EXE_NON_QUERY(
        "INSERT INTO users VALUES(0, :utilizador, :senha)"
    ,$params);

?>