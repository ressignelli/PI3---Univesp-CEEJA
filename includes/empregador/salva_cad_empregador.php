<?php

require_once "conecta.php";

    $cpf_cnpj = $_POST['cpf_cnpj'];

    # verificar se já possui cadastro
    $sql = mysqli_query($conn, "SELECT cpf_cnpj FROM tab_empregador WHERE cpf_cnpj = '$cpf_cnpj'");
    $total = mysqli_num_rows($sql);
    
    if ($total>0){
        ?>
        <script>
            alert("CPF ou CNPJ já possui cadastro! Caso necessário clique em 'Esqueceu sua senha' ou entre em contato com o administrador");
            window.close();
        </script>
        <?php
        exit();
    }
    #validar cpf e cnpj
    ?>
    <script>
        let cpfInput = document.getElementById("cpfStatus").value;
        if (cpfInput<>""){
            alert("CPF ou CNPJ inválido!");
            window.close(); 
        }
    </script>
    <?php
    #validar senha

    if (!isset($_POST['senhac']) or !isset($_POST['senha'])){
        ?>
        <script>
            alert("É necessário cadastrar senha!");
        </script>
        <body onload='window.history.back();'>
        <?php
        exit();
    }else{
        $senhac = $_POST['senhac'];
        $senha = $_POST['senha'];
    }

    if (!preg_match('/[a-z]/', $senhac)){
        ?>
            <script>
                alert("Senha deve conter ao menos uma letra minúscula!");
            </script>
            <body onload='window.history.back();'>
            <?php
            exit();
        }elseif (!preg_match('/[A-Z]/', $senhac)){
        ?>
            <script>
                alert("Senha deve conter ao menos uma letra maiúscula!");
            </script>
            <body onload='window.history.back();'>
            <?php
            exit();
        } elseif (!preg_match('/[0-9]/', $senhac)){
            ?>
            <script>
                alert("Senha deve conter ao menos um número!");
            </script>
            <body onload='window.history.back();'>
            <?php
            exit();
        } elseif (!preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $senhac)){
            ?>
            <script>
                alert("Senha deve conter ao menos um caracter especial!");
            </script>
            <body onload='window.history.back();'>
            <?php
            exit();
        } elseif (strlen($senhac) < 8 or strlen($senhac) > 12){
            ?>
            <script>
                alert("Senha deve conter de 8 a 12 caracteres caracteres!");
                </script>
                <body onload='window.history.back();'>
            <?php
            exit();
        } elseif ($senhac !== $senha ){
            ?>
            <script>
                alert("Senhas não coincidem!");
                </script>
                <body onload='window.history.back();'>
            <?php
            exit();
    }
    
    $cpf_cnpj =  $_POST['cpf_cnpj'];
    $senha = $_POST['senhac'];
    $nome_empresa = $_POST['nome_empresa'];
    $ramo_atividade = $_POST['ramo_atividade'];
    $nome_responsavel = $_POST['nome_responsavel'];
    $cpf_resp = $_POST['cpf_resp'];

    $email = $_POST['email'];

    $telefone1 = $_POST['telefone1'];
    if (isset($_POST['telefone2'])){
       $telefone2 = $_POST['telefone2'];
    }else{
        $telefone2 = "0";
    }

    $logradouro = $_POST['logradouro'];

    if (isset($_POST['numero'])){
        $numero = $_POST['numero'];
    }else{
        $numero = "s/n";
    }
    
    if (isset($_POST['complemento'])){
        $complemento = $_POST['complemento'];
    }else{
        $complemento = "s/c";
    }

    if (isset($_POST['bairro'])){
        $bairro = $_POST['bairro'];
    }else{
        $bairro = "s/b";
    }

    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
        
    $sql = "INSERT INTO tab_empregador (cpf_cnpj, senha, nome_empresa, ramo_atividade, nome_responsavel, cpf_resp, email, telefone1, telefone2, logradouro, numero, complemento, bairro, cep, cidade, uf) 
    VALUES ('$cpf_cnpj', '$senha', '$nome_empresa', '$ramo_atividade', '$nome_responsavel', '$cpf_resp', '$email', '$telefone1', '$telefone2', '$logradouro', '$numero',  '$complemento','$bairro', '$cep', '$cidade', '$uf')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<br<br><br><center><h1>Cadastro Realizado com Sucesso!</h1>";
        echo "<a href='http://localhost/PIE3/index.php'><input type='button' value='Voltar'></a></center>";
    } else {
        echo "<h3>OCORREU UM ERRO: </h3>: " . $sql . "<br>" . $conn->error;
    }

?>
