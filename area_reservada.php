<?php if(isset($_SESSION['user'])):?>

<div class="container">
    <div class="row">
        <div class="offset-3 col-6 text-center mt-3">
            <h3>Área Reservada</h3>
        </div>
    </div>
</div>

<?php else: ?>

    <div class="container">
        <div class="row mt-4">
            <div class="offset-4 col-4 text-center">
                <h3>Formulário de Login</h3>
                <div class="mt-4">
                    <form action="?p=area_reservada" method="post">
                        <div class="form-group">
                            <input type="text" name="text_utilizador" class="form-control" placeholder="Utilizador">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="text_senha" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-160 form-control" value="Login">
                        </div>
                    
                        <!-- Caso exista Login Invalido -->
                        <?php if($erro) :?>
                            <div class="alert alert-danger text-center" id="erro">
                                Login inválido
                            </div>
                        <?php endif; ?>

                    </form>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<!-- Script de JQuery para a mensagen de Login Inválido -->
<script>
    // $ - Aliases do JQuery
    $('#erro').delay(1500).fadeOut('slow');
</script>