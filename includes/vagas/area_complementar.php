<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Consulta Vagas</title>
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/vagas.css" />
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/area_complementar.css" />
    <script src="http://localhost/PIE3/css/js/jquery-3.7.1.min.js" type="text/javascript"></script>
</head>

<body>

<?php

require_once('conecta.php');

$dados = mysqli_query($conn, "SELECT * FROM tab_trabalhador WHERE cpf='$cpf'");
$dado = mysqli_fetch_array($dados);

$cbo = unserialize($dado['cbo']);

        if(isset($_POST['data_inicial'])and ($_POST['data_inicial'])!=="") {
            $data_inicial = $_POST['data_inicial'];
        }else{
            $data_inicial = date('Y-m-d');
        }
        if(isset($_POST['data_final']) and ($_POST['data_final'])!=="") {
            $data_final = $_POST['data_final'];
        }else{
            $data_hoje = date('Y-m-d');
            $data_final = date('Y-m-d', strtotime('+6 month', strtotime($data_hoje)));
        }
        if(isset($_POST['hora_inicial'])and ($_POST['hora_inicial'])!=="") {
            $hora_inicial = $_POST['hora_inicial'];
        }else{
            $hora_inicial = "%";
        }
        if(isset($_POST['hora_final'])and ($_POST['hora_final'])!=="") {
            $hora_final = $_POST['hora_final'];
        }else{
            $hora_final = "%";
        }
        $modalidades = 0;
        if(isset($_POST['presencial'])) {
            $modalidades += 1;
        }
        if(isset($_POST['ho'])) {
            $modalidades += 2;
        }
        $cnpj = $_POST['cnpj'];
        $veiculo = $_POST['veiculo'];
        $cnh = $_POST['cnh'];

        if(isset($_POST['cidade'])and ($_POST['cidade'])!=="todas"){
            $cidade = $_POST['cidade'];
        }else{
            $cidade = "%";
        }

        if(isset($_POST['uf'])and ($_POST['uf'])!=="todos"){
            $uf = $_POST['uf'];
        }else{
            $uf = "%";
        }

        $query = "SELECT * FROM tab_desc_vagas WHERE data_inicial >= '$data_inicial' and data_final <= '$data_final' and hora_inicial LIKE '$hora_inicial' and hora_final LIKE '$hora_final' and modalidades='$modalidades' and cnpj='$cnpj' and veiculo='$veiculo' and cidade LIKE '$cidade' and uf LIKE '$uf' and veiculo='$veiculo' and cnh='$cnh' ";
        
        $dados_vagas = mysqli_query($conn, "SELECT id, funcoes FROM tab_desc_vagas");
        
        while($row = mysqli_fetch_array($dados_vagas)){
            $dado_isolado = $row;
            $dados_comp[$dado_isolado['id']] =  unserialize($dado_isolado['funcoes']);
        }
        
        $passou = 0;
        if (!is_null($dados_comp)){
        foreach ($cbo as $id=>$val){
            foreach ($dados_comp as $chave=>$valor){
                foreach ($valor as $chave2 => $valor2) {
                    if ($val == $valor2){
                        if ($passou==1){
                            $query .= "or id = '$chave' " ;
                        }else{
                            $query .= "and (id = '$chave' " ;
                        }
                        $passou = 1;
                    }
                }
            }
        }
        }
        if ($passou===1){
            $query .= ") ORDER BY id";
        }else{
            echo "<script>alert('Consulta não retornou nenhuma vaga ralacionada ao seu interesse')
            window.history.go(-1);</script>";
            exit;
        }
               
        mysqli_multi_query($conn, $query);
        $result = mysqli_store_result($conn);
        
?>
    <br><br><center>
    <form id="form1" method="GET" action="">
        <div class="campo">
        <table border="2">
            <tr id="tr1">
                <td>Código da Vaga</td>
                <td>Empresa</td>
                <td>Ocupação</td>
                <td>Data de Início</td>
                <td>Data do Término</td>
                <td>Hora de Início</td>
                <td>Hora do Término</td>
                <td>Local de Trabalho</td>
                <td>Cidade</td>
                <td>Validade</td>
                <td>Opção</td>
            </tr>
        
        <?php
        while($row = mysqli_fetch_array($result)) {
            echo '<tr>';
            echo '<td>'.$row[0].'</td>';
            $nome_empresa = mysqli_query($conn, "SELECT nome_empresa FROM tab_empregador WHERE cpf_cnpj='$row[1]'");
            $nome = mysqli_fetch_array($nome_empresa);
            echo '<td>'.$nome[0].'</td>';

            if (!is_null($row[2])){
                $cbo = unserialize($row[2]);
                $cbos= " ";
                foreach ($cbo as $chave => $valor) {
                    $tab_cbo = mysqli_query($conn, "SELECT * FROM tab_cbo WHERE cbo='$valor'");
                    $tab_cbo_array = mysqli_fetch_array($tab_cbo);
                    $cbos = $cbos . " - " .$tab_cbo_array['descricao'];
                }
                echo '<td>'.$cbos.'</td>';
            }
            echo '<td>'.$row[3].'</td>';
            echo '<td>'.$row[4].'</td>';
            echo '<td>'.$row[5].'</td>';
            echo '<td>'.$row[6].'</td>';

            echo '<td>'.$row[11].'</td>';
            echo '<td>'.$row[16].'</td>';
            echo '<td>'.$row[19].'</td>';

            # retirar vagas que o trabalhador já se candidatou
            $query2 = "SELECT * FROM tab_cand_vaga WHERE id_vaga='$row[0]' AND id_trab='$dado[0]'";
            $res = $conn->query($query2);
            
            if ($res->num_rows > 0){
                echo '<td> Já cadidatado</td>';
            }else{
                echo "<td> <button type='button' onclick='candidatar($row[0], $dado[0]);'>Candidatar</button> </td>";
            }
            echo '</tr>';
        }

        ?>
     </table>
        </div>
    </form></center>

    <div id="newEventModal2">
        <center>
        <h2>Deseja se candidatar a esta vaga?</h2><hr><br>
        </center>
        <form method="GET" action="">
            <input type="hidden" name="" value=""><br><br>
            <center>
            <input type="hidden" name="id_vaga" id="id_vaga"/>
            <input type="hidden" name="id_trab" id="id_trab" />

            <button type="submit" id="salvar">Sim</button>
            <button type="button" id="cancelButton">Cancelar</button></center>
        </form> 
    </div>
   
</body>
</html>

<script>
function candidatar(v1, v2){
    const id_vaga = v1;
    const id_trab = v2;
    const newEvent = document.getElementById('newEventModal2');
    newEvent.style.display = 'block';
    document.getElementById('cancelButton').addEventListener('click',()=>closeModal());
    document.getElementById('salvar').addEventListener('click',()=>salvarModal());
    function closeModal(){
        newEvent.style.display = 'none';
    }
    function salvarModal(){
        const id_v = document.getElementById('id_vaga');
        const id_t = document.getElementById('id_trab');
        id_v.value = id_vaga;
        id_t.value = id_trab;
    }
}
</script>
</html>
