<?php

$id1 = $_POST['id_ret_tvt'];

require_once('conecta.php');

$sql_vaga = mysqli_query($conn, "SELECT * FROM tab_vaga_trabalhador WHERE id='$id1'");
$row = mysqli_fetch_array($sql_vaga);

$sql = "INSERT INTO tab_vaga_trabalhador_b (id, id_vaga, id_trab) 
VALUES ('$id1', '$row[1]', '$row[2]')";

if ($conn->query($sql) === TRUE) {
} else {
}

$sqlDelete = "DELETE FROM tab_vaga_trabalhador WHERE id='$id1'";

if ($conn->query($sqlDelete) === TRUE) {
    ?>
    <script>
        alert("Candidato retirado do cadastro da vaga!");
        window.history.go(-1);
    </script>
    <?php
} else {
    echo "<h3>OCORREU UM ERRO: </h3>: ";
}

?>