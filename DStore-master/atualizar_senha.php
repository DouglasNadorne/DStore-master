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


    <title>DStore - Atualizar Senha</title>
</head>

<body>
    <?php
    $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);
    if (!empty($chave)) {
        $query_email = "SELECT id
                        FROM usuario 
                        WHERE recuperar_senha = :recuperar_senha 
                        LIMIT 1";
        $result_usuario = $conn->prepare($query_email);
        $result_usuario->bindParam(':recuperar_senha', $chave, PDO::PARAM_STR);
        $result_usuario->execute();
        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            var_dump($dados);
            if (!empty($dados['send_atualizar'])) {
                $senha_usuario = password_hash($dados['senha_usuario'], PASSWORD_DEFAULT);
                $recuperar_senha = 'NULL';

                $query_up_email = "UPDATE usuario 
                            SET senha =:senha_usuario, 
                            recuperar_senha =:recuperar_senha
                            WHERE id =:id 
                            LIMIT 1";
                $result_up_usuario = $conn->prepare($query_up_email);
                $result_up_usuario->bindParam(':senha_usuario', $senha_usuario, PDO::PARAM_STR);
                $result_up_usuario->bindParam(':recuperar_senha', $recuperar_senha);
                $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

                if ($result_up_usuario->execute()) {
                    $_SESSION['msg'] = "<p style='color:green'>Senha alterada com sucesso!</p>";
                    header("Location: index.php");
                } else {
                    echo "<p style='color:red'>Erro: Tente novamente!</p>";
                }
            }
        } else {
            $_SESSION['msg_rec'] = "<p style='color:red'>Erro: Link inválido, solicite um novo link para atualizar sua senha!</p>";
            header("Location: recuperar_senha.php");
        }
    } else {
        $_SESSION['msg_rec'] = "<p style='color:red'>Erro: Link inválido, solicite um novo link para atualizar sua senha!</p>";
        header("Location: recuperar_senha.php");
    }

    ?>
    <main>
        <div class="login-container">
            <div class="form-container">

                <form class="form form-login" method="POST" action="">

                    <h2 class="form-title">Atualizar senha</h2>

                    <div class="form-img">
                        <img src="./imagens/logo_transparentB.png" class="img-logo-empresa">
                    </div>
                    <div class="form-input-container">
                        <?php
                        $usuario = "";
                        if (isset($dados['senha_usuario'])) {
                            $usuario = $dados['senha_usuario'];
                        }
                        ?>
                        <input type="password" name="senha_usuario" class="form-input" placeholder="Digite a nova senha" required value="<?php echo $usuario; ?>">
                    </div>
                    <a href="index.php" class="form-link">Me lembrei da senha e desejo fazer o login!</a>

                    <button value="Atualizar" name="send_atualizar" type="submit" class="form-button">Alterar</button>
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