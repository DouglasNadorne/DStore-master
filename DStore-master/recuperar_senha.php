<?php
session_start();
ob_start();
include_once("config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './lib/vendor/autoload.php';
$mail = new PHPMailer(true);
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


    <title>DStore - Recuperar Senha</title>
</head>

<body>
    <main>

        <div class="login-container">
            <div class="form-container">
                <form class="form form-login" method="POST" action="">
                    <h2 class="form-title">Recuperar senha</h2>
                    <?php
                    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                    if (!empty($dados['send_recuperar'])) {
                        $query_email = "SELECT id, nome , email 
                        FROM usuario 
                        WHERE email = :email_login 
                        LIMIT 1";
                        $result_usuario = $conn->prepare($query_email);
                        $result_usuario->bindParam(':email_login', $dados['email_login'], PDO::PARAM_STR);
                        $result_usuario->execute();

                        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
                            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                            $chave_recupera_senha = password_hash($row_usuario['id'], PASSWORD_DEFAULT);
                            $query_up_email = "UPDATE usuario 
                            SET recuperar_senha =:recuperar_senha 
                            WHERE id =:id 
                            LIMIT 1";
                            $result_up_usuario = $conn->prepare($query_up_email);
                            $result_up_usuario->bindParam(':recuperar_senha', $chave_recupera_senha, PDO::PARAM_STR);
                            $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

                            if ($result_up_usuario->execute()) {
                                $link = "http://localhost/Dstore/atualizar_senha.php?chave=$chave_recupera_senha";

                                try {
                                    /*$mail->SMTPDebug = SMTP::DEBUG_SERVER;*/
                                    $mail->CharSet = 'UTF-8';
                                    $mail->isSMTP();
                                    $mail->Host       = 'smtp.mailtrap.io';
                                    $mail->SMTPAuth   = true;
                                    $mail->Username   = '5eee611cfb456e';
                                    $mail->Password   = '4b52dffc0fe4f7';
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                    $mail->Port       = 2525;

                                    $mail->setFrom('atendimento@devenix.com', 'Atendimento');
                                    $mail->addAddress($row_usuario['email'], $row_usuario['nome']);

                                    $mail->isHTML(true);                                  //Set email format to HTML
                                    $mail->Subject = 'Recuperar senha';
                                    $mail->Body    = 'Prezado(a)' . $row_usuario['nome'] . "<br><br> Foi realizado um pedido para alterar a senha de sua conta. Para 
                                    continuar o processo de alteração clique no link que esta a baixo ou o cole em seu navegador:<br><br><a href='"
                                        . $link . "'>" . $link . "</a><br><br>Caso não tenha pedido a alteração da senha basta ignorar este e-mail.";

                                    $mail->AltBody = 'Prezado(a)' . $row_usuario['nome'] . "\n\nFoi realizado um pedido para alterar a senha de sua conta. Para continuar o processo de alteração clique no link que esta a baixo ou o cole em seu navegador:\n\n"
                                        . $link . "\n\nCaso não tenha pedido a alteração da senha basta ignorar este e-mail.";

                                    $mail->send();

                                    $_SESSION['msg'] = "<p style='color:green'>Um e-mail foi enviado para sua caixa de mensagens!</p>";
                                    header("Location: index.php");
                                } catch (Exception $e) {
                                    echo "Erro: Ocorreu um problema ao enviar o e-mail: {$mail->ErrorInfo}";
                                }
                            } else {
                                echo "<p style='color:red'>Erro: Tente novamente!</p>";
                            }
                        } else {
                            echo "<p style='color:red'>Erro: Este e-mail não esta cadastrado no sistema!</p>";
                        }
                    }
                    if (isset($_SESSION['msg_rec'])) {
                        echo $_SESSION['msg_rec'];
                        unset($_SESSION['msg_rec']);
                    }
                    ?>





                    <div class="form-img">
                        <img src="./imagens/logo_transparentB.png" class="img-logo-empresa">
                    </div>
                    <div class="form-input-container">
                        <input type="email" name="email_login" class="form-input" placeholder="Email" required>
                    </div>
                    <a href="index.php" class="form-link">Me lembrei da senha e desejo fazer o login!</a>
                    <button value="Recuperar" name="send_recuperar" type="submit" class="form-button">Enviar</button>
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