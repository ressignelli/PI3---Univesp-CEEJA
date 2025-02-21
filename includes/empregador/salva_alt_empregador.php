<?php

require_once "conecta.php";

    $cpf_cnpj = $_POST['cpf_cnpj'];
    $nome_empresa= $_POST['nome_empresa'];
    $ramo_atividade=$_POST['ramo_atividade'];

    $nome_responsavel= $_POST['nome_responsavel'];
    $cpf_responsavel= $_POST['cpf_responsavel'];

    $email= $_POST['email'];
    $telefone1= $_POST['telefone1'];

    if (isset($_POST['telefone2'])){
        $telefone2= $_POST['telefone2'];
    }else{
        $telefone2= "0";
    }
     
    $cep= $_POST['cep'];
    $logradouro= $_POST['logradouro'];

    if (isset($_POST['numero'])){
        $numero= $_POST['numero'];
    }else{
        $numero= "s/n";
    }

    if (isset($_POST['bairro'])){
        $bairro= $_POST['bairro'];
    }else{
        $bairro= "s/b";
    } 

    $cidade= $_POST['cidade'];
    $uf= $_POST['uf'];

    if (isset($_POST['complemento'])){
        $complemento= $_POST['complemento'];
    }else{
        $complemento= "s/c";
    } 

    $sql = "UPDATE tab_empregador SET nome_empresa='$nome_empresa', ramo_atividade='$ramo_atividade', nome_responsavel='$nome_responsavel', cpf_resp='$cpf_responsavel', email='$email', telefone1='$telefone1', telefone2='$telefone2', logradouro='$logradouro', numero='$numero', complemento='$complemento',  bairro='$bairro', cep='$cep', cidade='$cidade', uf='$uf' WHERE cpf_cnpj='$cpf_cnpj'";
    
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










 