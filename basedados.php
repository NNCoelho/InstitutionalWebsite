<?php
    // GESTOR DA BASE DE DADOS
    include 'gestor.php'; 

    $gestor = new Gestor();
    $gestor->EXE_QUERY("SELECT * FROM emails");
?>