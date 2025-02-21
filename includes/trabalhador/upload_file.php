<?php

$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;

 // Verificações

 if($_FILES["arquivo"]["size"] > 1000000) { 
    echo 
    "<script>
    alert ('Arquivo superior à 1MB!');
    window.history.back();
    </script>";
    exit;  
}

// Diretório para onde o arquivo será movido 
$diretorio = "./upload/"; 

// nome do arquivo é o cpf
$nome = $_POST['cpf'];

// Caminho completo do arquivo 
$nome = $diretorio . $nome . ".pdf"; 

// Tudo ok! Então, move o arquivo 
if($_FILES["arquivo"]["error"] == UPLOAD_ERR_FORM_SIZE) { 
    echo     
    "<script>
    alert ('Arquivo superior à 1MB!');
    window.history.back();
    </script>";
    exit;   
}

if(move_uploaded_file($arquivo["tmp_name"], $nome)) { 
    echo 
    "<script>
    alert ('Enviado com sucesso!');
    window.history.back();
    </script>";
} else { 
    echo 
    "<script>
    alert ('Erro ao enviar o arquivo!');
    window.history.back();
    </script>";
}

?>