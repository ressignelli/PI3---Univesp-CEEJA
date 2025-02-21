<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Consulta Vagas</title>
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/area_complementar.css" />
</head>

<body>

<?php

# Salvar o trabalhador na vaga selecionada</title>
include_once 'conecta.php';

$id_vaga = $_GET['id_vaga'];

if (isset($_GET['id_trab'])){

    $id_trab = $_GET['id_trab'];

    $tab_vaga = mysqli_query($conn, "SELECT * FROM tab_desc_vagas WHERE id='$id_vaga'");
    $tab_vaga_array = mysqli_fetch_array($tab_vaga);
    
    $cpf_cnpj = $tab_vaga_array['cpf_cnpj'];
    
    $tab_emp = mysqli_query($conn, "SELECT * FROM tab_empregador WHERE cpf_cnpj='$cpf_cnpj'");
    $tab_emp = mysqli_fetch_array($tab_emp);

    $tab_trab = mysqli_query($conn, "SELECT * FROM tab_trabalhador WHERE id='$id_trab'");
    $qt_inc_vagas = mysqli_fetch_array($tab_trab);
    
# area que identifica a necessidade de cobrança
#    if ($qt_inc_vagas[26] >= 3 ){

#        include_once '../financeiro/pagamento.php';
        
#        $qt_total = $qt_inc_vagas[26] + 1;
#        exit();

#    }else{
        $qt_total = $qt_inc_vagas[26] + 1;
#    }
    
    echo "<div>";
    echo "<h1>Vaga Candidatada</h1>";
    echo "</div>";
    $cbo = unserialize($tab_vaga_array['funcoes']);

    $cbos= " ";
    foreach ($cbo as $chave => $valor) {
        $tab_cbo = mysqli_query($conn, "SELECT * FROM tab_cbo WHERE cbo='$valor'");
        $tab_cbo_array = mysqli_fetch_array($tab_cbo);
        $cbos = $cbos . " - " .$tab_cbo_array['descricao'];
    }

    echo "Para as vagas de: " . $cbos . "<br><br><hr>";
    echo "Empresa: ". $tab_emp['nome_empresa']. "<br><br>";
    echo "Período de Trabalho: " . $tab_vaga_array['data_inicial']. " até " . $tab_vaga_array['data_final']."<br>";
    echo "Horário de Trabalho : " . $tab_vaga_array['hora_inicial'] . " às " . $tab_vaga_array['hora_final'] . "<br><br>";
    echo "Local de Trabalho: <br>";
    echo "Endereço: ". $tab_vaga_array['logradouro'] . ", nº ". $tab_vaga_array['numero']. " - Bairro ". $tab_vaga_array['bairro']. " ". $tab_vaga_array['complemento'] . ", CEP ". $tab_vaga_array['cep']."<br>";
    echo "Cidade de " . $tab_vaga_array['cidade'] . "-". $tab_vaga_array['uf']."<br><br><hr>";

    echo "Atenção, o candidato deverá aguardar o contato do contratante para finalizar o acordo ! <br><br>";

    echo "<button onclick='printTela()'>Imprimir</button>";

# enviar o e-mail a empresa e ao trabalhador
# salvar os dados no banco

    $conn->query("UPDATE tab_trabalhador SET cont_inc_vagas='$qt_total' WHERE id='$id_trab'");
    
    $sql = "INSERT INTO tab_cand_vaga (id_emp, id_trab, id_vaga) VALUES ('$tab_emp[0]', '$id_trab', '$id_vaga')";

    if ($conn->query($sql) === TRUE) {
        echo "<center><h1>Cadastro Realizado com Sucesso!</h1>";
    } else {
        echo "<h3>OCORREU UM ERRO: </h3>: " . $sql . "<br>" . $conn->error;
    }
}else{

    $tab_cand_vaga = mysqli_query($conn, "SELECT * FROM tab_cand_vaga WHERE id = '$id_vaga'");
    $tab_cand_vaga_array = mysqli_fetch_array($tab_cand_vaga);

    $sql = "INSERT INTO tab_cand_vaga_backup (id, id_emp, id_trab, id_vaga, resp_excluir) 
    VALUES ('$id_vaga', '$tab_cand_vaga_array[1]', '$tab_cand_vaga_array[2]', '$tab_cand_vaga_array[4]', 'trabalhador')";
    if ($conn->query($sql) === TRUE) {
    } else {
    }

    $sql = "DELETE FROM tab_cand_vaga WHERE id = '$id_vaga'";
    if ($conn->query($sql) === TRUE) {
        echo "<center><h1>Confirmado a desistência da vaga!</h1>";
    } else {
        echo "<h3>OCORREU UM ERRO: </h3>: " . $sql . "<br>" . $conn->error;
    }
}

?>

</body>
<script>
        function printTela() {
            window.print();
        }
    </script>
</html>
