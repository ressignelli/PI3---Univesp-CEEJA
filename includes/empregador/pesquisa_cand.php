<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Pesquisa Candidatos</title>
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/pesquisa_cand.css" />
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/estilo_tabela.css" />
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/est_form_cons_v.css" />
    <script src="http://localhost/PIE3/js/jquery-3.7.1.min.js"></script>
</head>

<body>



    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="showLoading()">
    <div>
        <h1>Pesquisa Candidatos</h1>
    </div>

    <div id="loading">⏳ Carregando...</div>
    <div class="inf_trab"><center>
    <h4>Informações de Trabalho:</h4><br>

        <input type="text" class="procurar" id="procurar" style="width:300px;" placeholder="Filtrar Função"/><br>
        <label><strong>Selecione e adicione: </strong></label><br>
        <select id="Entry_ID" Size="5"></option>
        </select>
        <br><br>
        <button type="button" onclick="incluir_select();" style="width:200px;">ADICIONAR FUNÇÕES A SEREM PESQUISADAS</button>

        <br><hr><br>
        <table id="tabela_cbos">
                <tr id="linha0">
                    <th>CBO</th>
                    <th>Descrição</th>
                    <th>Função</th>
                </tr>
            <!-- Inicialmente todas as linhas estão vazias -->
        </table>        
        <hr><br></center>
    </div>
    <div class="campo">
        <label><strong>CNH: </strong></label>
        <select name="cnh" id="cnh">
            <option value="N">Não é necessário</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="ACC">ACC</option>
        </select>
        <label><strong>Possuir Veículo Próprio:</strong></label>
        <label><input type="radio" name="veiculo" value="s">É obrigatório</label>
        <label><input type="radio" name="veiculo" value="n" checked>Não é obrigatório</label>
    </div><br><hr>
    <div>    
        <label for="modalidade"><strong>Modalidades:</strong></label>
        <label><input type="checkbox" name="presencial" checked>Presencial</label>
        <label><input type="checkbox" name="ho">Home-office</label><br><br>

        <label><strong>Necessário possuir CNPJ:</strong></label>
        <label><input type="radio" name="cnpj" value="n" checked>Não</label>
        <label><input type="radio" name="cnpj" value="s">Sim</label><br><hr><br>
    </div>
    <div>
        <label><strong>Cidade/Estado:</strong></label><br>
        <input type="text" class="procurar" id="proc_cidade" style="width:400px;" placeholder="Filtro de cidades"/>&nbsp;&nbsp;
        <?php
            $sql_cidades = mysqli_query($conn, "SELECT DISTINCT cidade FROM tab_trabalhador ORDER BY cidade ASC");

            echo '<select id="cidades" name="cidade">';
            echo '<option name="cidade" value="0">Todas</option>';
            while ($row = mysqli_fetch_array($sql_cidades)) {
                $c = strval($row[0]);
                echo '<option name="cidade" value="'.$c.'">'.$c.'</option>';
            }
            echo '</select>';
        ?>
        &nbsp;&nbsp;
        <?php
            $sql_uf = mysqli_query($conn, "SELECT DISTINCT uf FROM tab_trabalhador ORDER BY uf ASC");
            echo '<select id="uf" name="uf">';
            echo '<option name="uf" value="0">Todos</option>';
            while ($row = mysqli_fetch_array($sql_uf)) {
                echo '<option name="uf" value="' . $row[0] . '">' . $row[0] . '</option>';
            }
                echo '</select>';
        ?><center>
        <input type="hidden" name="execute" value="execute"/><br>
        <button type="submit" style="width:200px;">Buscar Candidatos</button>
        </center>
    </div>

    </form>
    <script>
    var quantidade = 0;
        function incluir_select() {
            if (quantidade >= 5) {
                alert("Podem no máximo 5 interesses!");
                return;
            }

            const comboboxobj = document.getElementById("Entry_ID");
            const valor = comboboxobj.options[comboboxobj.selectedIndex].text;
            const valor2 = comboboxobj.options[comboboxobj.selectedIndex].value;
            const tabela = document.getElementById("tabela_cbos");
            const linha = tabela.insertRow();

            linha.setAttribute('style', 'height: 10px;'); // Reduz a altura da linha
    
            const cell1 = linha.insertCell(0);
            cell1.setAttribute('style', 'width: 70px;'); // Reduz a largura da primeira coluna
            cell1.innerHTML = '<input style="text-align: center; padding:0; margin:0; height:100%; width:100%;" type="text" name="cbo[]" value="' + valor2 + '" readonly>';

            const cell2 = linha.insertCell(1);
            cell2.setAttribute('style', 'width: 350px;'); // Aumenta a largura da segunda coluna
            cell2.innerHTML = '<input style="text-align: center; padding:0; margin:0; height:100%; width:100%;" type="text" name="descricao[]" value="' + valor + '" readonly>';

            const cell3 = linha.insertCell(2);
            cell3.setAttribute('style', 'width: 20px;'); // Aumenta a largura da segunda coluna
            const btn = criarBotao(linha);
            cell3.appendChild(btn);
            quantidade++;
        }

        function criarBotao(linha) {
            const btn = document.createElement("input");
            btn.setAttribute('type', 'button');
            btn.setAttribute('value', 'X');
            btn.setAttribute('style', 'text-align: center; color:red; background-color:white; padding:0px; border:none;');
            btn.onclick = function() {
                excluir_select(linha);
            };
            return btn;
        }

        function excluir_select(linha) {
            const tabela = document.getElementById("tabela_cbos");
            tabela.deleteRow(linha.rowIndex);
            quantidade--;
        }
</script>
</body>

<script>
    $(document).ready(function() {
        $.ajax({
            url: 'http://localhost/PIE3/data/ocupacao.csv',
            dataType: 'text',
            success: function(data) {
                var linhas = data.split('\n');
                for (var i = 1; i < linhas.length; i++) { // Começa em 1 para pular o cabeçalho
                    var colunas = linhas[i].split(';');
                    $('#Entry_ID').append('<option value="' + colunas[0] + '">' + colunas[1] + '</option>');
                }
            }
        });
    });
</script>
<script>

$('#procurar').keyup(function () {
      var valthis = $(this).val().toLowerCase();
      valthis = valthis.replace(new RegExp('[ÁÀÂÃ]','gi'), 'a');
        valthis = valthis.replace(new RegExp('[ÉÈÊ]','gi'), 'e');
        valthis = valthis.replace(new RegExp('[ÍÌÎ]','gi'), 'i');
        valthis = valthis.replace(new RegExp('[ÓÒÔÕ]','gi'), 'o');
        valthis = valthis.replace(new RegExp('[ÚÙÛ]','gi'), 'u');
        valthis = valthis.replace(new RegExp('[Ç]','gi'), 'c');
      var num = 0;
      $('select#Entry_ID>option').each(function () {
          var text = $(this).text().toLowerCase();
          if(text.indexOf(valthis) !== -1){
               $(this).show(); $(this).prop('selected',true);
          }else{
             $(this).hide();
          }
      });
});
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

function showLoading() {
    document.getElementById('loading').style.display = 'block';
}

</script>

</html>