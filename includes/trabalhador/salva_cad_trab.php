<?php

require_once "conecta.php";

    $cpf = $_POST['cpf'];

    # verificar se já possui cadastro
    $sql = mysqli_query($conn, "SELECT cpf FROM tab_trabalhador WHERE cpf = '$cpf'");
    $total = mysqli_num_rows($sql);
    
    if ($total>0){
        ?>
        <script>
            alert("CPF já possui cadastro! Caso necessário clique em 'Esqueceu sua senha' ou entre em contato com o administrador");
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
            alert("CPF inválido!");
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
    

    $cpf =  $_POST['cpf'];
    $senha = $_POST['senhac'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $dn = $_POST['dn'];

    $cnh = $_POST['cnh'];
    $veiculo = $_POST['veiculo'];

    $sexo = $_POST['sexo'];

    $pcd = $_POST['pcd'];
    $tipo_pcd = $_POST['tipo_pcd'];

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

    $cbo = '0';
    $modalidades = 0; 
    $cnpj = '0';
    $curriculo = '';

    $sql = "INSERT INTO tab_trabalhador (cpf, senha, nome, sobrenome, dn, cnh, veiculo, sexo, pcd, tipo_pcd, email, telefone1, telefone2, logradouro, numero, complemento, bairro, cep, cidade, uf, cbo, modalidades, cnpj, curriculo) VALUES ('$cpf', '$senha', '$nome', '$sobrenome', '$dn', '$cnh', '$veiculo', '$sexo', '$pcd', '$tipo_pcd', '$email', '$telefone1', '$telefone2', '$logradouro', '$numero',  '$complemento','$bairro', '$cep', '$cidade', '$uf', '$cbo', '$modalidades', '$cnpj', '$curriculo')";
    
    if ($conn->query($sql) === TRUE) {
        
        
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = "";
        $to = $email;
        $subject = "Cadastro Trabalho Temporário";
        $message =  '
        <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <title>Bem vindo</title>
            </head>
            <body>
            <p>Bem vindo ao Trabalho Temporário.</p><br>
            <p>Faça seu cadastro de interesses em VAGAS DE TRABAHLO -> CADASTRO DE INTERESSES!</p><br>
            <div>
                <p><img style="display: block; margin-left: auto; margin-right: auto;" src="" width="290" height="104" /></p>
                <p>&nbsp;</p>
            </div>
            </body>
        </html>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";       

        mail($to,$subject,$message, $headers);
        
        echo "<center><h1>Cadastro Realizado com Sucesso!</h1>";
        echo "<a href='http://localhost/PIE3/index.php'><input type='button' value='Voltar'></a></center>";
    } else {
        echo "<h3>OCORREU UM ERRO: </h3>: " . $sql . "<br>" . $conn->error;
    }

?>

</body>
</html>