<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
</head>

 <?php

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $msg = $_POST['msg'];
            
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );

        $from = "";
        $to = "";
        $subject = "Envio de mensagem de cliente";
        $message = "Nome: " . $nome . " | Mensagem: " .$msg;
        $headers = "From:" . $from;
        mail($to,$subject,$message, $headers);
?>
        <script>
                alert("Mensagem enviada com sucesso, aguarde nosso contato, obrigado.");
                window.history.go(-2);

        </script> 

 </html>