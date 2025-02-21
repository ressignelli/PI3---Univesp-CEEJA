<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
</head>

<body>
    
<?php
require_once 'conecta.php';

$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

if (isset($_POST['opcao'])){
  $opcao = $_POST['opcao'];
  if ($opcao=='empresa') {
    $verifica = mysqli_query($conn, "SELECT * FROM tab_empregador WHERE cpf_cnpj = '$cpf' AND BINARY senha = '$senha'") or die("erro ao selecionar");
      if (mysqli_num_rows($verifica)<=0){
          ?>
            <script>
              alert("CPF/CNPJ e/ou senha incorretos!");
              window.location = '/index.php';
            </script>
          <?php
      }else{
        #setcookie($cpf);
        session_start();
        $_SESSION['cpf'] = $cpf;
        header("Location:../empregador/area_empregador.php");
        exit;
      }
  } elseif ($opcao=='trabalhador'){
    $verifica = mysqli_query($conn, "SELECT * FROM tab_trabalhador WHERE cpf = '$cpf' AND BINARY senha = '$senha'") or die("erro ao selecionar");
    if (mysqli_num_rows($verifica)<=0){
        ?>
          <script>
            alert("CPF e/ou senha incorretos!");
            window.location = '/index.php';
          </script>
        <?php
    }else{
      #setcookie($cpf);
      session_start();
      $_SESSION['cpf'] = $cpf;
      
        $conn->query("UPDATE tab_trabalhador SET data_acesso=NOW() WHERE cpf='$cpf'");
      
      header("Location:../trabalhador/area_trabalhador.php");
      exit;
    }
  }
}



?>

</body>
</html>