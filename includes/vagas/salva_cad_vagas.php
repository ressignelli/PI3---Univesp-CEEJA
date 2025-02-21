<?php

if (!isset($_POST['descricao'])){
?>
<script>
  alert("É necessário cadastrar ao menos uma função!");
  window.history.back();
</script>
<?php
die();
}

$cpf_cnpj = $_POST['cpf_cnpj'];

require_once 'conecta.php';

$cbo = serialize($_POST['descricao']);
$data_inicial = $_POST['data_inicial'];
$data_final = $_POST['data_final'];
$hora_inicial = $_POST['hora_inicial'];
$hora_final = $_POST['hora_final'];
$modalidades = 0;

if (isset($_POST['presencial'])){
    $modalidades +=1;
}
if (isset($_POST['ho'])){
    $modalidades +=2;
}
$veiculo = $_POST['veiculo'];
$cnh = $_POST['cnh'];
$cnpj = $_POST['cnpj'];
$prazo_pag = $_POST['prazo_pag'];
$valor_pag = $_POST['valor_pag'];

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

$info = $_POST['info'];
$data_validade = $_POST['data_validade'];

$sql2 = "INSERT INTO tab_desc_vagas (cpf_cnpj, funcoes, data_inicial, data_final, hora_inicial, hora_final, modalidades, cnpj, prazo_pag, valor_pag, logradouro, numero, complemento, bairro, cep, cidade, uf, info, data_validade, veiculo, cnh) 
VALUES ('$cpf_cnpj', '$cbo', '$data_inicial', '$data_final', '$hora_inicial', '$hora_final', '$modalidades', '$cnpj', '$prazo_pag', '$valor_pag', '$logradouro', '$numero', '$complemento', '$bairro', '$cep', '$cidade', '$uf', '$info', '$data_validade', '$veiculo', '$cnh')";

if ($conn->query($sql2) === TRUE) {
    echo "<center><h1>Cadastro Realizado com Sucesso!</h1>";
    echo "<a href='../empregador/area_empregador.php'><input type='button' value='Voltar'></a></center>";
} else {
    echo "<h3>OCORREU UM ERRO: </h3>: " . $sql . "<br>" . $conn->error;
}

?>