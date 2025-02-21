<?php

require_once "conecta.php";

    $cpf = $_POST['cpf'];
    if (!isset($_POST['cbo'])){
        echo     
        "<script>
        alert ('É necessário incluir ao menos uma área de interesse para trabalhar!');
        window.history.back();
        </script>";
        exit;  
    }
    $cbo = serialize($_POST['cbo']);

    $modalidades = 0;

    if (isset($_POST['presencial'])){
        $modalidades +=1;
    }
    if (isset($_POST['ho'])){
        $modalidades +=2;
    }
        
    $cnpj = $_POST['possui_cnpj'];

    $filename = './upload/'. $cpf.".pdf";
    
    if (file_exists($filename)) {
        $curriculo = 1;
    } else {
        $curriculo = 0;
    }

    $sql = "UPDATE tab_trabalhador SET cbo='$cbo', modalidades='$modalidades', cnpj='$cnpj', curriculo='$curriculo' WHERE cpf='$cpf'";
 
    if ($conn->query($sql) === TRUE) {
        echo "<center><h1>Cadastro Realizado com Sucesso!</h1>";
        echo "<a href='http://localhost/PIE3/includes/trabalhador/area_trabalhador.php'><input type='button' value='Voltar'></a></center>";
    } else {
        echo "<h3>OCORREU UM ERRO: </h3>: " . $sql . "<br>" . $conn->error;
    }

?>
