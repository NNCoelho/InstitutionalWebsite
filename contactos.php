<?php
    // VALIDAÇÃO DO FORMULÁRIO
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // FORMULÁRIO DO EMAIL
        if($_POST['formulario'] == 'email'){

            $erro = '';
            $erro_newsletter = '';
            $sucesso_newsletter = '';

            // Verifica se existem todos os campos
            if(!isset($_POST['text_email'])   || 
               !isset($_POST['text_assunto']) ||
               !isset($_POST['text_mensagem'])){
                $erro = 'Pelo menos um dos campos não existe ou foi removido pelo utilizador.';
            }

            // Verifica se os campos estão preenchidos
            if(empty($erro)){

                $email = $_POST['text_email'];
                $assunto = $_POST['text_assunto'];
                $mensagem = $_POST['text_mensagem'];

                // Verifica se o email é valido
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $erro = 'Endereço ou formato de email inválido.';
                }
            }

            // Envio de email
            if(empty($erro)){
                include('enviar_email.php');
            }
        }

        // FORMULÁRIO DA NEWSLETTER
        if($_POST['formulario'] == 'newsletter'){

            $email = $_POST['text_email'];

            // Acesso a base de Dados
            include 'gestor.php';
            $gestor = new Gestor();

            // Parametro de segurança
            $params = array(
                ':e' => $email
            );

            // Verificar se o email já existe na base de dados
            $resultado = $gestor->EXE_QUERY('SELECT email FROM emails WHERE email = :e', $params);

            if(count($resultado) != 0){
                // Email já esta registado
                $erro_newsletter = "Este email já se encontra registado.";
            } else {
                // Inserir novo email na base de dados
                $gestor->EXE_NON_QUERY('INSERT INTO emails(email) VALUES(:e)', $params);
                $sucesso_newsletter = "Obrigado por ter registado o seu email.";
            }
        }
    }  
?>

<!-- MENSAGES DE ERRO E SUCESSO DA NEWSLETTER -->
<div class="container">
    <div class="row">
        <div class="offset-3 col-6 text-center">

            <?php if(!empty($erro)): ?> 
                <div class="alert alert-danger mt-3">
                    <?php echo $erro?>
                </div>
            <?php endif;?>

            <?php if(!empty($erro_newsletter)): ?>
                <div class="alert alert-danger mt-3">
                    <?php echo $erro_newsletter?>
                </div>
            <?php endif;?>

            <?php if(!empty($sucesso_newsletter)): ?> 
                <div class="alert alert-success mt-3">
                    <?php echo $sucesso_newsletter?>
                </div>
            <?php endif;?>

        </div>
    </div>
</div>

<!-- FORMULÁRIOS DOS CONTACTOS E DA NEWSLETTER -->
<div class="container">
    
    <div class="row mt-3 mb-4" >
        <div class="offset-3 col-6">
            <h3 class="text-center">Contactos</h3>

            <form action="?p=contactos" method="post">
                <input type="hidden" name="formulario" value="email">
                <div class="form-group">
                    <input type="email" name="text_email"  class="form-control" placeholder="Email" required>
                </div>                           
                <div class="form-group">
                    <input type="text" name="text_assunto" class="form-control" placeholder="Assunto" required>
                </div>
                <div class="form-group">
                    <textarea name="text_mensagem" cols="66" rows="6" class="form-control" placeholder="Escreva aqui a sua mensagem" required></textarea>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary btn-160" value="Enviar Mensagem">
                </div>
            </form>            

        </div>
    </div>

    <hr class="separador">

    <div class="row" style="margin-bottom: 90px">
        <div class="offset-3 col-6">
            <h3 class="text-center">Newsletter</h3>

            <form action="?p=contactos" method="post">
                <input type="hidden" name="formulario" value="newsletter">
                <div class="form-group">
                    <input type="email" name="text_email" class="form-control" placeholder="Email" required>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary btn-160" value="Receber Newsletter">
                </div>
            </form>

        </div>
    </div>
</div>