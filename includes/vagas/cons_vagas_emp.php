<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
        <title>Consulta Vagas do Empregador</title>
        <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/vagas.css" />
        <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/est_form_cons_v.css" />
        <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/estilo_tabela.css" />
        <script src="http://localhost/PIE3/js/jquery-3.7.1.min.js" type="text/javascript"></script>
    </head>

<body>
<?php

if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
    $cpf_cnpj = $_SESSION['cpf'];
}

require_once('conecta.php');

if (!isset($_POST['clicado'])) {
?>
<br>
    <form id="form1">
        <div>
            <h1>Consulta Vagas Cadastradas</h1>
        </div>
        <div class="campo">
            <input type="hidden" id="clicado" />
            <?php
            $stmt = $conn->prepare("SELECT * FROM tab_desc_vagas WHERE cpf_cnpj = ?");
            $stmt->bind_param("s", $cpf_cnpj);
            $stmt->execute();
            $result = $stmt->get_result(); 
            ?>
            <center>
            <table border="2">
                <tr>
                    <th>Código da Vaga</th>
                    <th>Ocupação</th>
                    <th>Data de Início</th>
                    <th>Data do Término</th>
                    <th>Hora de Início</th>
                    <th>Hora do Término</th>
                    <th>Modalidade</th>
                    <th>Necessário CNPJ</th>
                    <th>Local de Trabalho</th>
                    <th>Cidade</th>
                    <th>Validade</th>
                    <th></th>
                </tr>

                <?php
                while ($row = $result->fetch_assoc()) { 
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>'; // Substitua 'codigo_vaga' pelo nome real do campo

                    if (!is_null($row['funcoes'])) { 
                        $cbo = unserialize($row['funcoes']);
                        $cbos = "";
                        foreach ($cbo as $valor) {
                            $stmt_cbo = $conn->prepare("SELECT descricao FROM tab_cbo WHERE cbo = ?");
                            $stmt_cbo->bind_param("s", $valor);
                            $stmt_cbo->execute();
                            $result_cbo = $stmt_cbo->get_result();
                            $tab_cbo_array = $result_cbo->fetch_assoc(); 
                            $cbos .= " - " . $tab_cbo_array['descricao'];
                            $stmt_cbo->close(); 
                        }
                        echo '<td>' . $cbos . '</td>';
                    } 

                    echo '<td>' . $row['data_inicial'] . '</td>'; 
                    echo '<td>' . $row['data_final'] . '</td>'; 
                    echo '<td>' . $row['hora_inicial'] . '</td>'; 
                    echo '<td>' . $row['hora_final'] . '</td>'; 

                    switch ($row['modalidades']) {
                        case 1:
                            $m = "Presencial";
                            break;
                        case 2:
                            $m = "Home-Office";
                            break;
                        case 3:
                            $m = "Presencial e/ou Home-Office";
                            break;
                        default:
                            $m = "";
                    }
                    echo '<td>' . $m . '</td>';

                    echo '<td>' . ($row['cnpj'] == 's' ? 'Sim' : 'Não') . '</td>'; 

                    echo '<td>' . $row['logradouro'] . ', nº ' .$row['numero'] .'</td>'; 
                    echo '<td>' . $row['cidade'] . '</td>'; 
                    echo '<td>' . $row['data_validade'] . '</td>'; 

                    echo '<td> <button id="excluir" type="button" onclick="excluir_clique('.$row['id'].');">Excluir</button> </td>'; 
                    echo '</tr>';
                }
                ?>
            </table></center>
        </div>
    </form>
<?php } ?>

    <div id="janela_cancelar">
        <center>
            <h2>Tem certeza que deseja excluir essa vaga?</h2><hr><br>
        </center>
        <form method="POST" action="../vagas/inativa_vag.php">
            <center>
                <input type="hidden" name="id1" id="id1">
                <button type="submit">Sim</button>
                <button type="button" formaction="../vagas/cons_vagas_emp.php" id="cancelButton">Não</button>
            </center>
        </form>
    </div>

</body>
<script>

function excluir_clique(id_vaga){
    let id_vag = id_vaga;

    const elem_id = document.getElementById('id1');
    
    const newEvent = document.getElementById('janela_cancelar');
    
    elem_id.value = id_vag;

    newEvent.style.display = 'block';
    document.getElementById('cancelButton').addEventListener('click',()=>closeModal());
    document.getElementById('clicado').value = "1";
    function closeModal(){
        newEvent.style.display = 'none';
    }
}

</script>
</html>