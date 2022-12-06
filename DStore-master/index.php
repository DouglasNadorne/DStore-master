<!----======== Inicia Banco e sessão ========-->
<?php
session_start();
ob_start();
include_once("config.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagens/logo_transparent.ico" type="image/ x=ico">

    <!----======== Imports icons ========-->
    <script src="https://kit.fontawesome.com/6d56c32453.js" crossorigin="anonymous"></script>

    <!----======== Imports Font: Red Hat Display ========-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@300;400;700;900&display=swap" rel="stylesheet">



    <!----======== CSS ========-->
    <link rel="stylesheet" href="./css/login/reset.css">
    <link rel="stylesheet" href="./css/login/colors.css">
    <link rel="stylesheet" href="./css/login/main.css">
    <link rel="stylesheet" href="./css/login/login-container.css">
    <link rel="stylesheet" href="./css/login/form-container.css">
    <link rel="stylesheet" href="./css/login/form.css">
    <link rel="stylesheet" href="./css/login/form-title.css">
    <link rel="stylesheet" href="./css/login/form-img.css">
    <link rel="stylesheet" href="./css/login/img-logo-empresa.css">
    <link rel="stylesheet" href="./css/login/form-input-container.css">
    <link rel="stylesheet" href="./css/login/form-input.css">
    <link rel="stylesheet" href="./css/login/form-button.css">
    <link rel="stylesheet" href="./css/login/overlay-container.css">
    <link rel="stylesheet" href="./css/login/overlay.css">
    <link rel="stylesheet" href="./css/login/imagem-overlay.css">


    <title>DStore</title>
</head>

<body>
    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($dados['send_login'])) {
        $query_email = "SELECT id, nome , email, senha, cargo 
                        FROM usuario 
                        WHERE email = :email_login 
                        LIMIT 1";
        $result_usuario = $conn->prepare($query_email);
        $result_usuario->bindParam(':email_login', $dados['email_login'], PDO::PARAM_STR);
        $result_usuario->execute();

        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            if (password_verify($dados['senha_login'], $row_usuario['senha'])) {
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                $_SESSION['cargo'] = $row_usuario['cargo'];
                header("Location:dashboard.php");
            } else {
                $_SESSION['msg'] = "<p style='color:red'>Erro: Usuário
                                ou senha invalida!</p>";
            }
        } else {
            $_SESSION['msg'] = "<p style='color:red'>Erro: Usuário ou 
                            senha invalida!</p>";
        }
    }
    ?>

    <main>

        <div class="login-container">
            <div class="form-container">
                <form class="form form-login" method="POST" action="">
                    <h2 class="form-title">Entrar com</h2>
                    <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                    ?>
                    <div class="form-img">
                        <img src="./imagens/logo_transparentB.png" class="img-logo-empresa">
                    </div>
                    <div class="form-input-container" method="POST" action="">
                        <input type="email" name="email_login" class="form-input" placeholder="Email" required value="<?php if (isset($dados['email_login'])) {
                                                                                                                            echo $dados['email_login'];
                                                                                                                        } ?>">
                        <input type="password" name="senha_login" class="form-input" placeholder="Senha" required value="<?php if (isset($dados['senha_login'])) {
                                                                                                                                echo $dados['senha_login'];
                                                                                                                            } ?>">
                    </div>
                    <a href="recuperar_senha.php" class="form-link">Esqueceu a senha?</a>
                    <button value="Acessar" name="send_login" type="submit" class="form-button">Logar</button>
                </form>

            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="imagem-overlay">
                        <img src="imagens/logo_transparentB.png" alt="">
                    </div>

                </div>
            </div>
        </div>
    </main>
</body>

</html>