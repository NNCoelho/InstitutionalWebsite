<?php
    session_start();

    include('layout/html_header.php'); 
    include('layout/nav.php');
    include('layout/user.php');
    
    // ROTAS (ROUTES) [ROTEAMENTO]
    $pag = 'inicio';

    if(isset($_GET['p'])){
        $pag = $_GET['p'];
    }

    switch ($pag) {

        // MECANISMO DE LOGOUT
        case 'logout':
            session_destroy();
            header('Location: '.$_SERVER['PHP_SELF']);
            return;
            break;

        case 'inicio':
            include('inicio.php');
            break;
        
        case 'empresa':
            include('empresa.php');
            break;

        case 'servicos':
            include('servicos.php');
            break;

        case 'contactos':
            include('contactos.php');
            break;

        // ÁREA RESERVADA 
        case 'area_reservada':
            // Verifica se houve submissão do formulário
            $erro = false;
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(verificarLogin()){
                    // Login Válido
                    include('layout/user.php');
                } else {
                    // Login Inválido
                    $erro = true;
                }
            }
            include('area_reservada.php');
            break;

        default:
            include('inicio.php');
            break;
    }

    include('layout/footer.php'); 
    include('layout/html_footer.php');
    
    // FUNÇÃO DE VERIFICAMENTO DO LOGIN
    function verificarLogin(){

        // Passar os valores do POST para variáveis
        $utilizador = trim($_POST['text_utilizador']);
        $senha = trim($_POST['text_senha']);

        // Acesso à Base de Dados 
        include 'gestor.php';
        $gestor = new Gestor();

        // Parametros de prevenção de SQL Injection
        $params = array(
             ':utilizador' => $utilizador
        );

        // Instrução de SQL para verificação do utilizador
        $resultado = $gestor->EXE_QUERY(
            "SELECT * FROM users
             WHERE utilizador = :utilizador"
             , $params);

        // Verifica se existe utilizador e se as senhas correspondem
        if(count($resultado) == 0){

            // Login Inválido (Utilizador não existe na Base de Dados)
            return FALSE;
        } else {
            // Login Válido (Utilizador existe na Base de Dados)
            $senha_bd = $resultado[0]['senha'];                
            if(password_verify($senha, $senha_bd)){

                // Cria a Sessão
                $_SESSION['user'] = $resultado[0]['utilizador'];
                return TRUE;
            } else {
                return FALSE;
            }
        }       
    }
?>