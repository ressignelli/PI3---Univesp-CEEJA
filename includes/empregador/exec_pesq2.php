<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/pesquisa_cand.css" />
</head>
<body>
    <?php

    $id_func = ($_POST['id_trab']); #cbos do trabalhador selecionado
    $cod_emp = $cpf_cnpj;

    # vagas cadastradas compatíveis:

    $sql_trab = mysqli_query($conn, "SELECT * FROM tab_trabalhador WHERE id = '$id_func'");

    $sql_trab2 = mysqli_query($conn, "SELECT id, nome, sobrenome FROM tab_trabalhador WHERE id = '$id_func'");
    $nome_trab = mysqli_fetch_array($sql_trab2);
    echo "<br><center>Para o candidato: ". $nome_trab['nome']. " ". $nome_trab['sobrenome']."</center>";


    $sql_vagas = mysqli_query($conn, "SELECT * FROM tab_desc_vagas WHERE cpf_cnpj = '$cod_emp'");

    while($row = mysqli_fetch_array($sql_trab)){
        $cbo_isol_func =  unserialize($row['cbo']);
    }
  
    while($row = mysqli_fetch_array($sql_vagas)){
        $cbo_isol_vaga[$row['id']] =  unserialize($row['funcoes']);
    }

    $query = [];
     foreach ($cbo_isol_func as $id=>$val){
        foreach ($cbo_isol_vaga as $chave=>$valor){
            foreach ($valor as $chave2 => $valor2) {
                if ($val == $valor2){
                    $query[] = $chave;
                }
            }
        }
    }
    echo "<br><hr>";

    ?>

    <br><center>
    <form method="POST" action="salva_vaga_trab.php">
            <input type="hidden" name="id_vaga" id="id_vaga"/>
            <input type="hidden" name="id_trab" id="id_trab"/>
    <div class="campo">
        <table border="2">
            <tr id="tr1">
                <td>Id Vaga</td>
                <td>Função</td>
                <td>Período</td>
                <td>Horário</td>
                <td>Endereço</td>
                <td>Cidade/UF</td>
                <td></td>
            </tr>
        
        <?php
        foreach ($query as $chave=>$id){
            $sql = mysqli_query($conn, "SELECT * FROM tab_desc_vagas WHERE id = '$id'");
            while($row = mysqli_fetch_array($sql)) {
            echo '<tr>';
            echo '<td>'.$row[0].'</td>';

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
            echo '<td>De '.$row[3]. ' até '. $row[4].'</td>';

            echo '<td>Das '.$row[5].' até '. $row[6].'</td>';

            echo '<td>'.$row[11].', nº'.$row[12].' '. $row[13].' '. $row[14].  '</td>';
            echo '<td>'.$row[16].'/'.$row[17].'</td>';

            echo "<td><button type='submit' onclick='salvar($id, $id_func)'>Incluir nesta Vaga e Contactar</button> </td>";
            
            echo '</tr>';       
            }
        }
        ?>
        </table>
    </div>
    </form>
    </center>

    <script>
function salvar(v1, v2){
    const id_vaga = v1;
    const id_trab = v2;
    const id_v = document.getElementById('id_vaga');
    const id_t = document.getElementById('id_trab');
    id_v.value = id_vaga;
    id_t.value = id_trab;

}
</script>

</body>
</html>
