<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
</head>

<body>

<?php

    $cpf = $_POST['cpf'];
    $nome= $_POST['nome'];
    $sobrenome=$_POST['sobrenome'];
    $dn= $_POST['dn'];

    $cnh= $_POST['cnh'];
    $veiculo= $_POST['veiculo'];
    $sexo= $_POST['sexo'];
    $pcd= $_POST['pcd'];
    $tipo_pcd= $_POST['tipo_pcd'];

    $email= $_POST['email'];
    $telefone1= $_POST['telefone1'];
    $telefone2= $_POST['telefone2']; 

    $cep= $_POST['cep']; 
    $logradouro= $_POST['logradouro']; 
    $numero= $_POST['numero'];  
    $bairro= $_POST['bairro']; 
    $cidade= $_POST['cidade'];
    $uf= $_POST['uf'];
    
require_once "conecta.php";

    $sql = "UPDATE tab_trabalhador SET nome='$nome', sobrenome='$sobrenome', dn='$dn', cnh='$cnh', veiculo='$veiculo', sexo='$sexo', pcd='$pcd', tipo_pcd='$tipo_pcd', email='$email', telefone1='$telefone1', telefone2='$telefone2', logradouro='$logradouro', numero='$numero',  complemento='$complemento', bairro='$bairro', cep='$cep', cidade='$cidade', uf='$uf' WHERE cpf='$cpf'";
    
    if ($conn->query($sql) === TRUE) {
        ?>
        <script>
            alert("Cadastro alterado com sucesso!");
            window.history.go(-3);
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("Ocorreu um erro inesperado!")
        </script>
        <?php
    }

?>

</body>
</html>