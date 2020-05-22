<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Importa o autoload do Composer
    require 'vendor/autoload.php';

    // Instanciação da classe PHPMailer
    $mail = new PHPMailer(true);

    $erro_mensagem = '';
    $sucesso_mensagem = '';

    try {

        // Configurações do Servidor                  
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                    
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'nncoelho@gmail.com';                     
        $mail->Password   = '!';                              
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
        $mail->Port       = 587;                                    

        // Recepientes
        $mail->setFrom('nncoelho@gmail.com', 'Empresa');
        $mail->addAddress($email, 'Destinatario');

        // Conteúdo
        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body    = $mensagem;

        $mail->send();
            $sucesso_mensagem = 'A sua mensagem foi enviada com Sucesso.';
    }   catch (Exception $e) {
            $erro_mensagem = "Houve um erro. A sua mensagem não pôde ser enviada. Mailer Error: {$mail->ErrorInfo}";
        }
?>

<!-- Mensagens de Erro e de Sucesso do Envio da Mensagem por Email -->
<div class="container">
    <div class="row">
        <div class="offset-3 col-6 text-center">

            <?php if(!empty($erro_mensagem)): ?>
                <div class="alert alert-danger mt-3">
                    <?php echo $erro_mensagem?>
                </div>
            <?php endif;?>

            <?php if(!empty($sucesso_mensagem)): ?> 
                <div class="alert alert-success mt-3">
                    <?php echo $sucesso_mensagem?>
                </div>
            <?php endif;?>

        </div>
    </div>
</div>