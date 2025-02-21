<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
        <title>Consulta Vagas de Trabalho Candidatadas</title>
        <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/vagas.css" />
        <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/area_complementar.css" />
</head>
<body>

<?php
# consulta as vagas em que o trabalhador se candidatou e pode desistir da candidatura

$sql_trab = mysqli_query($conn, "SELECT * FROM tab_trabalhador WHERE cpf='$cpf'");
$dado_trab = mysqli_fetch_array($sql_trab);

$sql_vagas = mysqli_query($conn, "SELECT * FROM tab_cand_vaga WHERE id_trab='$dado_trab[0]'");
$sql_vagas2 = mysqli_query($conn, "SELECT * FROM tab_cand_vaga WHERE id_trab='$dado_trab[0]'");
$dados_vaga = mysqli_fetch_array($sql_vagas);

?>
    <br><br>
    <center>
    <form id="form1" method="" action="">
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
                <td></td>
            </tr>
        
        <?php
        while($row = mysqli_fetch_array($sql_vagas2)) {
            echo '<tr>';
            echo '<td>'.$dados_vaga[0].'</td>';
            $nome_empresa = mysqli_query($conn, "SELECT nome_empresa FROM tab_empregador WHERE id='$row[1]'");
            $nome = mysqli_fetch_array($nome_empresa);
            echo '<td>'.$nome[0].'</td>';

            $sql_desc_vagas = mysqli_query($conn, "SELECT * FROM tab_desc_vagas WHERE id='$row[3]'");
            $tab_desc_vagas = mysqli_fetch_array($sql_desc_vagas);

                $cbo = unserialize($tab_desc_vagas[2]);
                $cbos= " ";
                foreach ($cbo as $chave => $valor) {
                    $tab_cbo = mysqli_query($conn, "SELECT * FROM tab_cbo WHERE cbo='$valor'");
                    $tab_cbo_array = mysqli_fetch_array($tab_cbo);
                    $cbos = $cbos . " - " .$tab_cbo_array['descricao'];
                }
                echo '<td>'.$cbos.'</td>';    

            echo '<td>'.$tab_desc_vagas[3].'</td>';
            echo '<td>'.$tab_desc_vagas[4].'</td>';
            echo '<td>'.$tab_desc_vagas[5].'</td>';
            echo '<td>'.$tab_desc_vagas[6].'</td>';

            $local = $tab_desc_vagas[11] . ", ". $tab_desc_vagas[12] . " - " . $tab_desc_vagas[13];
            $cid_uf = $tab_desc_vagas[16] . " - " . $tab_desc_vagas[17];
            echo '<td>'.$local.'</td>';
            echo '<td>'.$cid_uf.'</td>';

            echo "<td> <button type='button' onclick='desistir($dados_vaga[0]);'>Desistir da Vaga</button> </td>";

            echo '</tr>';      
        }
        ?>
     </table>
        </div>
    </form>
    </center>
    <div id="newEventModal2">
        <center>
        <h2>Tem certeza que deseja desistir da vaga?</h2><hr><br>
        </center>
        <form method="GET" action="">
            <input type="hidden" name="" value=""><br><br>
            <center>
            <input type="hidden" name="id_vaga" id="id_vaga"/>

            <button type="submit" id="salvar">Sim</button>
            <button type="button" id="cancelButton">Não</button></center>
        </form> 
    </div>
</body>
<script>
function desistir(v1){
    const id_vaga = v1;
    const newEvent = document.getElementById('newEventModal2');
    newEvent.style.display = 'block';
    document.getElementById('cancelButton').addEventListener('click',()=>closeModal());
    document.getElementById('salvar').addEventListener('click',()=>salvarModal());
    function closeModal(){
        newEvent.style.display = 'none';
    }
    function salvarModal(){
        const id_v = document.getElementById('id_vaga');
        id_v.value = id_vaga;
    }
}
</script>
</html>
