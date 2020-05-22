<?php
    if(!isset($_SESSION['user'])){
        return;
    }
?>

<!-- BARRA DE UTILIZADOR E LOGOUT -->
<div class="bg-dark text-white text-right p-2">
    <i class="fa fa-user fa-lg"></i> <?php echo $_SESSION['user']?> | <a href="?p=logout">Logout</a> <i class="fa fa-sign-out fa-lg"></i>
</div>