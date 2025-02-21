<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Pesquisa Candidatos</title>
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/pesquisa_cand.css" />
    <script src="http://localhost/PIE3/js/jquery-3.7.1.min.js"></script>
</head>

<?php
    if (!isset($_POST['cbo'])){
        ?>
        <script>
            alert("É necessário selecionar ao menos uma função!")
            history.back()
        </script>
        <?php
    }

    $cbo = ($_POST['cbo']);

            $cnh = $_POST['cnh'];
            if ($cnh == "N"){
                $cnh="%";
            }
            $veiculo = $_POST['veiculo'];
            if ($veiculo == "n"){
                $veiculo="%";
            }           
            $modalidade = 0;

            if (isset($_POST['presencial'])){
                $modalidade += 1;
            }

            if (isset($_POST['ho'])){
                $modalidade += 2;
            }

            $cnpj = $_POST['cnpj'];
            $cidade = $_POST['cidade'];
            if ($cidade == 0){
                $cidade="%";
            }
            $uf = $_POST['uf'];
            if ($uf == 0){
                $uf="%";
            }

            $query = "SELECT * FROM tab_trabalhador WHERE cnh LIKE '$cnh' and veiculo LIKE '$veiculo' and modalidades='$modalidade' and cnpj='$cnpj' and cidade LIKE '$cidade' and uf LIKE '$uf' ";

         #comparar o CBO dos trabalhadores com os selecionados

            $dados_trab = mysqli_query($conn, "SELECT id, cbo FROM tab_trabalhador");
            if (mysqli_num_rows($dados_trab) > 0) {
                // A consulta retornou alguns resultados
                while ($row = mysqli_fetch_array($dados_trab)) {
                    $id = $row['id'];
                    $cbo_uns = unserialize($row['cbo']);
                    $dados_comp[$id] = $cbo_uns;
                }
            } else {
                // A consulta não retornou nenhum resultado
                echo "<center><h1>Não encontrou nenhuma correspondência!</h1></center>";
                exit;
            }

            $passou = 0;
            if (!is_null($dados_comp)){
            foreach ($cbo as $id=>$val){
                foreach ($dados_comp as $chave=>$valor){
                    foreach ($valor as $chave2 => $valor2) {
                        
                        if ($val == $valor2){
                            if ($passou==1){
                                $query .= "or id = '$chave' ";
                            }else{
                                $query .= "and (id = '$chave' ";
                            }
                            $passou = 1;
                        }
                    }
                }
            }
            }
            if ($passou==1){
                $query .= ")" ;
                mysqli_multi_query($conn, $query);
                $result = mysqli_store_result($conn);
            }else{
                $result = "";
                echo "<h1>Não encontrou nenhuma correspondência!</h1>";
            }

?>

<body>
    <br><center>
    <form method="POST" action="">
            <input type="hidden" name="id_trab" id="id_trab"/>
    <div class="campo">
        <table border="2">
            <tr id="tr1">
                <td>Nome</td>
                <td>Ocupação</td>
                <td>Data Nascimento</td>
                <td>Sexo</td>
                <td>PCD</td>
                <td>Currículo</td>
                <td></td>
            </tr>
        
        <?php

        if (!is_null($result) && $result !== ""){
            while($row = mysqli_fetch_array($result)) {
            echo '<tr>';
            echo '<td>'.$row[3].'</td>';

            if (!is_null($row[21])){
                $cbo = unserialize($row[21]);
                $cbos= " ";
                foreach ($cbo as $chave => $valor) {
                    $tab_cbo = mysqli_query($conn, "SELECT * FROM tab_cbo WHERE cbo='$valor'");
                    $tab_cbo_array = mysqli_fetch_array($tab_cbo);
                    $cbos = $cbos . " - " .$tab_cbo_array['descricao'];
                }
                echo '<td>'.$cbos.'</td>';
            }
            echo '<td>'.$row[5].'</td>';
            if ($row[8]=='m'){
                $s = "Masculino";
            }else{
                $s = "Feminino";
            }
            echo '<td>'.$s.'</td>';
            if ($row[9]=='n'){
                $pcd = "Não possui";
            }else{
                $pcd = "Possui";
            }
            if ($row[24]==0){
                $c = "Não Cadastrado";
            }else{
                $c = '<a href="../trabalhador/upload/'.$row[1].'.pdf" target = "_blank">Visulizar</a>';
            }
            echo '<td>'.$pcd.'</td>';
            echo '<td>'.$c.'</td>';

            echo "<td><button type='submit' onclick='ver_vagas($row[0]);'>Incluir nas Vagas Disponíveis</button> </td>";
            
            echo '</tr>';       
            }
        }
        ?>
        </table>
    </div>
    </form>
    </center>

</body>
<script>
function ver_vagas(v1){
    const id_trab = v1;
    const id_t = document.getElementById('id_trab');
    id_t.value = id_trab;

}
</script>
</html>