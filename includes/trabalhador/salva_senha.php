<?php

require_once "conecta.php";

    $cpf = $_POST['cpf'];

    # verificar se já possui cadastro
    $sql = mysqli_query($conn, "SELECT cpf FROM tab_trabalhador WHERE cpf = '$cpf'");
    
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
    

    $cpf_cnpj =  $_POST['cpf'];
    $senha = $_POST['senhac'];
        
    $sql = "UPDATE tab_trabalhador SET senha='$senhac' WHERE cpf='$cpf'";
    
    if ($conn->query($sql) === TRUE) {
        ?>
        <script>
            alert("Senha alterada com sucesso!");
            window.location.href = "http://localhost/PIE3/index.php";
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
