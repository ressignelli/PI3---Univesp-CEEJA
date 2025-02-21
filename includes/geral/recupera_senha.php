<?php

$email = $_POST['email'];
$cpf = $_POST['cpf'];

    require_once('conecta.php');

    $consulta_trab = mysqli_query($conn, "SELECT * FROM tab_trabalhador WHERE cpf = '$cpf' and email = '$email'");
    $array_resul = mysqli_fetch_array($consulta_trab);

    if($array_resul==NULL){
        ?>
        <script>
            alert("Não localizado registro, algum dado preenchido incorretamente!")
            window.location.href = "/index.php";
        </script>
        <?php
        exit();
    }else{

        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789$%*+=#@!';
        $senha = '';
        for ($i = 0; $i < 8; $i++) {
            $senha .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        $sql = "UPDATE tab_trabalhador SET senha='$senha' WHERE cpf='$cpf'";

        if ($conn->query($sql) === TRUE) {
        } else {
            echo "OCORREU ALGUM ERRO: CONTATE O ADMINISTRADOR!";
        }
        
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = "";
        $to = $email;
        $subject = "Solicitação de Recuperação de Senha";
        $message = '
        <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <title>Solicitação de Recuperação de Senha</title>
            </head>
            <body>
            <p>Olá, segue as informações para Recuperação de Senha:</p>
            <p>Para acessar sua conta no Trabalho Temporário, use a seguinte senha de acesso: "' . $senha .' "  | Não esqueça de alterá-la ao acessar o sistema!";</p>
            <div>
                <p><img style="display: block; margin-left: auto; margin-right: auto;" src="" width="290" height="104" /></p>
                </div>
            </body>
        </html>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";       

        mail($to,$subject,$message, $headers);
    }
?>

<script>
    alert("O email de recuperação foi enviado com sucesso! Sempre verifique a caixa de SPAM")
    window.location.href = "/index.php";
</script>

