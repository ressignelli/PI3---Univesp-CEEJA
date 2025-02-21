<?php

require_once('conecta.php');

$id1 = $_POST['id1'];

$sql2 = mysqli_query($conn, "SELECT * FROM tab_cand_vaga WHERE id_vaga = '$id1'");


    while ($row2 = mysqli_fetch_array($sql2)){
        $copia1 = "INSERT INTO tab_cand_vaga_backup (id, id_emp, id_trab, resp_excluir) VALUES ('$row2[0]', '$row2[1]', '$row2[2]', 'vencimento')";
        $conn->query($copia1);
        
        $sqlDelete = "DELETE FROM tab_cand_vaga WHERE id = '$row2[0]'";
        $conn->query($sqlDelete);
    }

    $sql3 = mysqli_query($conn, "SELECT * FROM tab_vaga_trabalhador WHERE id_vaga = '$id1'");
    while ($row3 = mysqli_fetch_array($sql3)){
        $copia1 = "INSERT INTO tab_vaga_trabalhador_b (id, id_vaga, id_trab) VALUES ('$row3[0]', '$row3[1]', '$row3[2]')";
        $conn->query($copia1);
        $sqlDelete = "DELETE FROM tab_vaga_trabalhador WHERE id = '$row3[0]'";
        $conn->query($sqlDelete); 
    }
        
        $sql = mysqli_query($conn, "SELECT * FROM tab_desc_vagas WHERE id = '$id1'");
        $row = mysqli_fetch_array($sql);
        
        $copia1 = "INSERT INTO tab_desc_vagas_b (id, cpf_cnpj, funcoes, data_inicial, data_final, hora_inicial, hora_final, logradouro, numero, cep, executante) VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', '$row[11]', '$row[12]', '$row[15]', 'empregador')";
        $conn->query($copia1);

        $sqlDelete = "DELETE FROM tab_desc_vagas WHERE id = '$id1'";

if ($conn->query($sqlDelete) === TRUE) {
    ?>
    <script>
        window.history.go(-2);
    </script>
    <?php
} else {
    echo "<h3>OCORREU UM ERRO: </h3>: ";
}
    


?>








        
