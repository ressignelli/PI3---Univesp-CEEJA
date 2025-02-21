<?php
include_once 'conecta.php';

$id_vaga = ($_POST['id_vaga']);
$id_trab = ($_POST['id_trab']);

$sql_verifica = mysqli_query($conn, "SELECT * FROM tab_vaga_trabalhador WHERE id_vaga='$id_vaga' and id_trab='$id_trab'");
$sql_trabalhador = mysqli_query($conn, "SELECT * FROM tab_trabalhador WHERE id='$id_trab'");
$dados_trab = mysqli_fetch_array($sql_trabalhador);

$sql_vaga = mysqli_query($conn, "SELECT * FROM tab_desc_vagas WHERE id = '$id_vaga'");
$dados_vaga = mysqli_fetch_row($sql_vaga);

$cpf_cnpj = $dados_vaga[1];

$sql_empregador = mysqli_query($conn, "SELECT * FROM tab_empregador WHERE cpf_cnpj = '$cpf_cnpj'");
$dados_emp = mysqli_fetch_array($sql_empregador);

if (mysqli_fetch_row($sql_verifica) > 0){
    ?>
    <script>
        alert("Trabalhador já incluido nesta vaga!");
        window.history.go(-3);
    </script>
    <?php
    exit();
}

$sql = "INSERT INTO tab_vaga_trabalhador (id_vaga, id_trab) VALUES ('$id_vaga', '$id_trab')";
    
if ($conn->query($sql) === TRUE) {
    
    // envia email ao empregador:
    
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "";
    $to = $dados_emp[7];
    $subject = "Informações do Candidato a Vaga id: ".$id_vaga;
    $message = '
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Segue informações para contato:</title>
    </head>
    <body>
    <p>Olá, segue as informações para contato:</p>
     <p>Atenciosamente,</p>
     <p>JARL TRABALHO TEMPORÁRIO.<br></p>
    <p>Profissional: ' .$dados_trab[3].'</p>
    <p>e-mail: '.$dados_trab[11].'</p>
    <p>Telefone: '.$dados_trab[12].'</p><br>
    <div>
        <p><img style="display: block; margin-left: auto; margin-right: auto;" src="" width="290" height="104" /></p>
    </div>
    </body>
    </html>
    ';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    mail($to,$subject,$message, $headers);
    
    // envia email ao candidato: 
    
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "";
    $to = $dados_trab[11];
    $subject = "Selecionado para a vaga: ".$id_vaga;
    $message = '
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Vaga Trabalho</title>
    </head>
    <body>
    <p>Parabéns, você foi selecionado em uma das vagas, aguarde o contato do empregador. Boa Sorte!</p>
     <p>Atenciosamente,</p>
     <p>JARL TRABALHO TEMPORÁRIO.<br></p>
    <div>
        <p><img style="display: block; margin-left: auto; margin-right: auto;" src="" width="290" height="104" /></p>
    </div>
    </body>
    </html>
    ';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    mail($to,$subject,$message, $headers);
    ?>
    <script>
        alert("Salvo com sucesso, verifique no e-mail cadastrado o meio de contato do trabalhor!")
        window.location.href = "../empregador/area_empregador.php";
    </script>
    <?php

} else {
    echo "<h3>OCORREU UM ERRO: </h3>: " . $sql . "<br>" . $conn->error;
}



?>






