<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    
<?php
require_once 'conecta.php';

$cpf = $_POST['cpf'] ?? '';
$senha = $_POST['senha'] ?? '';
$opcao = $_POST['opcao'] ?? '';

if ($cpf && $senha && $opcao) {
    $query = '';
    if ($opcao == 'empresa') {
        $query = "SELECT * FROM tab_empregador WHERE cpf_cnpj = ? AND BINARY senha = ?";
    } elseif ($opcao == 'trabalhador') {
        $query = "SELECT * FROM tab_trabalhador WHERE cpf = ? AND BINARY senha = ?";
    }

    if ($query) {
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $cpf, $senha);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows <= 0) {
            echo "<script>
                    alert('CPF/CNPJ e/ou senha incorretos!');
                    window.location = 'http://localhost/PIE3/index.php';
                  </script>";
        } else {
            session_start();
            $_SESSION['cpf'] = $cpf;

            if ($opcao == 'trabalhador') {
                $conn->query("UPDATE tab_trabalhador SET data_acesso=NOW() WHERE cpf='$cpf'");
                header("Location:../trabalhador/area_trabalhador.php");
            } else {
                header("Location:../empregador/area_empregador.php");
            }
            exit;
        }
    }
}
?>

</body>
</html>
