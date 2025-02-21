<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
        <title>Consulta Vagas de Trabalho Candidatadas</title>
        <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/vagas.css" />
</head>
<body>

<?php
# consulta as vagas em que a empresa incluiu o trabalhador na vaga cadastrada
# tab_vaga_trabalhador

$sql_vagas = mysqli_query($conn, "SELECT * FROM tab_desc_vagas WHERE cpf_cnpj='$cpf_cnpj'");

?>
    <br><br>
    <center>
    <form id="form1" method="POST" action="">
        <input type="hidden" name="id_ret_tvt" id="id_ret_tvt">
        <div class="campo">
        <table border="2">
            <tr id="tr1">
                <td>Código da Vaga</td>
                <td>Nome Inscrito</td>
                <td>Função</td>
                <td>Período</td>
                <td>Horário</td>
                <td>Local de Trabalho</td>
                <td>Cidade</td>
                <td>Data do Cadastro</td>
                <td></td>
            </tr>
        
        <?php
        while($row = mysqli_fetch_array($sql_vagas)) {
            $sql_vaga_t = mysqli_query($conn, "SELECT * FROM tab_vaga_trabalhador WHERE id_vaga='$row[0]'");
            while($row2 = mysqli_fetch_array($sql_vaga_t)) {

                echo '<tr>';
                echo '<td>'.$row2[1].'</td>';
                $nome_candidato = mysqli_query($conn, "SELECT nome, sobrenome FROM tab_trabalhador WHERE id='$row2[2]'");
                $nome = mysqli_fetch_array($nome_candidato);
                echo '<td>'.$nome[0]. " " . $nome[1].'</td>';

                $sql_desc_vagas = mysqli_query($conn, "SELECT * FROM tab_desc_vagas WHERE id='$row2[1]'");
                $tab_desc_vagas = mysqli_fetch_array($sql_desc_vagas);

                $cbo = unserialize($tab_desc_vagas[2]);
                $cbos= " ";
                foreach ($cbo as $chave => $valor) {
                    $tab_cbo = mysqli_query($conn, "SELECT * FROM tab_cbo WHERE cbo='$valor'");
                    $tab_cbo_array = mysqli_fetch_array($tab_cbo);
                    $cbos = $cbos . " - " .$tab_cbo_array['descricao'];
                }
                echo '<td>'.$cbos.'</td>';    

                echo '<td>De '.$row[3]. ' até ' .$row[4].'</td>';
                echo '<td>Das '.$row[5]. ' até ' .$row[6].'</td>';

                $local = $row[11] . ", ". $row[12] . " - " . $row[13];
                $cid_uf = $row[16] . " - " . $row[17];
                echo '<td>'.$local.'</td>';
                echo '<td>'.$cid_uf.'</td>';
                echo '<td>'.$row2[3].'</td>';
                echo "<td> <button type='submit' onclick='retirar($row2[0]);'>Retirar Candidato</button> </td>";

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
function retirar(v1){
    const id_tvt = v1;
    const id_ret_tvt = document.getElementById('id_ret_tvt');
    id_ret_tvt.value = id_tvt;
}
</script>
</html>