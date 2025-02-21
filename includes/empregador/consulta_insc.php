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
# consulta as vagas em que o trabalhador se candidatou e pode retirar da candidatura

$sql_emp = mysqli_query($conn, "SELECT * FROM tab_empregador WHERE cpf_cnpj='$cpf_cnpj'");
$dado_emp = mysqli_fetch_array($sql_emp);

$sql_vagas = mysqli_query($conn, "SELECT * FROM tab_cand_vaga WHERE id_emp='$dado_emp[0]'");
$sql_vagas2 = mysqli_query($conn, "SELECT * FROM tab_cand_vaga WHERE id_emp='$dado_emp[0]'");

if (mysqli_num_rows($sql_vagas) > 0) {
    // A consulta retornou alguns resultados
    $dados_vaga = mysqli_fetch_array($sql_vagas);
} else {
    // A consulta não retornou nenhum resultado
    echo "<center><h1>Não encontrou nenhum candidato!</h1></center>";
    exit;
}

?>
    <br><br>
    <center>
    <form id="form1" method="" action="">
        <div class="campo">
        <table border="2">
            <tr id="tr1">
                <td>Código da Vaga</td>
                <td>Nome Interessado</td>
                <td>Ocupação</td>
                <td>Data de Início</td>
                <td>Data do Término</td>
                <td>Hora de Início</td>
                <td>Hora do Término</td>
                <td>Local de Trabalho</td>
                <td>Cidade</td>
                <td>Currículo</td>
                <td></td>
            </tr>
        
        <?php
        while($row = mysqli_fetch_array($sql_vagas2)) {
            echo '<tr>';
            echo '<td>'.$dados_vaga[0].'</td>';
            $nome_candidato = mysqli_query($conn, "SELECT nome, sobrenome, curriculo, cpf FROM tab_trabalhador WHERE id='$row[2]'");
            $nome = mysqli_fetch_array($nome_candidato);
            echo '<td>'.$nome[0]. " " . $nome[1].'</td>';

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
            if ($nome[2] == 1){
                $c = '<a href="../trabalhador/upload/'.$nome[3].'.pdf" target = "_ blank">Visulizar</a>';
            }else{
                $c = 'Não Cadastrado';
            }
            
            echo '<td>'.$c.'</td>';
            echo "<td> <button type='button' onclick='chamar($dados_vaga[3], $row[2]);'>Entrar em contato</button> </td>";

            echo '</tr>';      
        }
        ?>
     </table>
        </div>
    </form>
    </center>
    <div id="newEventModal2">
        <center>
        <h2>Confirma o interesse no candidato?</h2><hr><br>
        </center>
        <form method="POST" action="exec_int_insc.php">
            <input type="hidden" name="id_trab" id="id_trab"><br><br>
            <input type="hidden" name="id_vaga" id="id_vaga"/>
            <center>
            <button type="submit" id="salvar">Sim</button>
            <button type="button" id="cancelButton">Não</button></center>
        </form> 
    </div>
</body>
<script>
function chamar(v1, v2){
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
        id_t.value = id_trab;
        id_v.value = id_vaga;
    }
}

</script>
</html>