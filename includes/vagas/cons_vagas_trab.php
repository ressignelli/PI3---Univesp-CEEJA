<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
        <title>Consulta Vagas de Trabalho</title>
        <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/vagas.css" />
        <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/est_form_emp.css" />
        <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/est_form_trab.css" />
        <script type="text/javascript" src="http://localhost/PIE3/js/index.js" defer></script>
        <script src="http://localhost/PIE3/js/jquery-3.7.1.min.js"></script>
        <style>
        #loading {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
        }
        </style>
        <script>
        function showLoading() {
            document.getElementById('loading').style.display = 'block';
        }
        window.onbeforeunload = function(e) {
            document.getElementById('loading').style.display = 'none';
        };
        </script>
</head>
<body>

<?php
if (isset($_GET['cpf'])){
    $cpf = $_GET['cpf'];
}elseif (isset($_POST['cpf'])){
    $cpf = $_POST['cpf'];
}

require_once('conecta.php');

    $dados = mysqli_query($conn, "SELECT * FROM tab_trabalhador WHERE cpf='$cpf'");
    $dado = mysqli_fetch_array($dados);

    $cbo = unserialize($dado['cbo']);
    $cbos = '';
    if (!is_null($cbo)){
        foreach ($cbo as $chave => $valor) {
            $tab_cbo = mysqli_query($conn, "SELECT * FROM tab_cbo WHERE cbo='$valor'");
            $tab_cbo_array = mysqli_fetch_array($tab_cbo);
            $cbos = $cbos . " - " .$tab_cbo_array['descricao']; 
        }
        echo '<br> <h2> Funções Cadastradas:'.$cbos.'</h2>';
        echo '<br>';
    }

?>
    
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="showLoading()">
    <div id="loading">⏳ Carregando...</div>
    <div>
        <h1>Consulta Vagas Cadastradas</h1>
    </div>
    <div class="campo">

        <label for="periodo"><strong>Período de trabalho:</strong></label>
        <input type="date" name="data_inicial" id="data_inicial">
        <label> até </label>
        <input type="date" name="data_final" id="data final">
        <br><br>

        <label for="horario"><strong>Horário de Trabalho (formato hh:mm):</strong></label>
        <input type="time" name="hora_inicial" id="hora_inicial" size="5">
        <label> às </label>
        <input type="time" name="hora_final" id="hora_final" size="5"><br><br>


        <label for="modalidade"><strong>Modalidades:</strong></label>
        <label><input type="checkbox" name="presencial" value="1" checked>Presencial</label>
        <label><input type="checkbox" name="ho" value="2">Home-office</label><br><br>

        <label><strong>Necessário CNPJ:</strong></label>
        <label><input type="radio" name="cnpj" value="n" checked>Não</label>
        <label><input type="radio" name="cnpj" value="s">Sim</label><br><hr><br>

        <label><strong>Necessário Veículo Próprio:</strong></label>
        <label><input type="radio" name="veiculo" value="n" checked>Não</label>
        <label><input type="radio" name="veiculo" value="s">Sim</label>

        <label><strong> | Necessário CNH:</strong></label>
                <select name="cnh">
                    <option value="n">Não</option>
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                    <option value="E">E</option>
                    <option value="ACC">ACC</option>
                </select><br><hr><br>

        <label><strong>Cidade/Estado:</strong></label><br>
        <input type="text" class="procurar" id="proc_cidade" placeholder="Filtro cidades"/>
        <?php
        $sql_cidades = mysqli_query($conn, "SELECT DISTINCT cidade FROM tab_desc_vagas ORDER BY cidade ASC");
        $todas = [];
        echo '<select id="cidades" name="cidade">';
            echo '<option name="cidade" value="todas">Todas</option>';
            while ($row = mysqli_fetch_array($sql_cidades)) {
                $c = strval($row[0]);
                echo '<option name="cidade" value="'.$c.'">'.$c.'</option>';
            }
        echo '</select>';
        ?>
        <?php
        $sql_uf = mysqli_query($conn, "SELECT DISTINCT uf FROM tab_desc_vagas ORDER BY uf ASC");
        echo '<select id="uf" name="uf">';
            echo '<option name="uf" value="todos">Todos</option>';
            while ($row = mysqli_fetch_array($sql_uf)) {
                echo '<option name="uf" value="' . $row[0] . '">' . $row[0] . '</option>';
            }
        echo '</select>';
        ?>
        <input type="hidden" name="cpf" value="<?=$cpf?>"/>
        <input type="hidden" name="abrir" value="abrir"/><br><br>

        <center><button type="submit">Pesquisar Vagas</button></center>
    </div>
    </form>

</body>
<script>
    $('#proc_cidade').keyup(function () {
      var valthis = $(this).val().toLowerCase();
      var num = 0;
      $('select#cidades>option').each(function () {
          var text = $(this).text().toLowerCase();
          if(text.indexOf(valthis) !== -1){
               $(this).show(); $(this).prop('selected',true);
          }else{
             $(this).hide();
          }
      });
});
</script> 
</html>