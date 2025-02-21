<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Faça seu cadastro</title>
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/est_form_emp.css" />
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/est_form_trab.css" />
    <script src="http://localhost/PIE3/js/jquery-3.7.1.min.js"></script>

</head>
 <script>

        var quantidade = 0;
        
        function inserirLinha(v1, v2){
            const tabela = document.getElementById("tabela_cbos");
            const linha = tabela.insertRow();

            linha.insertCell(0).innerHTML = '<input type="text" name="cbo[]" value="' + v1 + '" readonly>';
            linha.insertCell(1).innerHTML = '<input type="text" name="descricao[]" value="' + v2 + '" readonly>';
            
            const cell = linha.insertCell(2);
            const btn = criarBotao(linha);
            cell.appendChild(btn);
            quantidade++;
        }       

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

            linha.insertCell(0).innerHTML = '<input type="text" name="cbo[]" value="' + valor2 + '" readonly>';
            linha.insertCell(1).innerHTML = '<input type="text" name="descricao[]" value="' + valor + '" readonly>';
            
            const cell = linha.insertCell(2);
            const btn = criarBotao(linha);
            cell.appendChild(btn);
            quantidade++;
        }

        function criarBotao(linha) {
            const btn = document.createElement("input");
            btn.setAttribute('type', 'button');
            btn.setAttribute('value', 'Retirar');
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
<body>

                                
    <div>
        <h1>Cadastro de Interesse em Vagas</h1>
    </div>

<hr>
<?php
    require_once "conecta.php";
    $dados = mysqli_query($conn, "SELECT * FROM tab_trabalhador WHERE cpf='$cpf'");
    $dado = mysqli_fetch_array($dados);
    $modalidades = $dado['modalidades'];
    $id = $dado['id'];
    $cnpj = $dado['cnpj'];
    if ($dado['cbo']!=='0'){
        $cbo = unserialize($dado['cbo']);
    }else{
        $cbo = "0";
    }

?>
    <form enctype="multipart/form-data" action="upload_file.php" method="POST">
        <!-- MAX_FILE_SIZE deve preceder o campo input -->
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <input type="hidden" name="cpf" value="<?php echo $cpf; ?>"><br><hr>
        <?php
            if ($dado[24]==1){
                echo '<label><strong>Possui currículo cadastado: </strong></label><a href="../trabalhador/upload/'.$cpf.'.pdf" target = "_ blank">Clique aqui para visualizar</a>';
            }else{
                echo '<label><strong>Trabalhador não possui currículo cadastado</strong></label>';
            }
        ?>
        <br><hr>
        <!-- O nome do elemento input determina o nome do array $_FILES -->
        <label><strong>Adicionar currículo (somente .pdf de até 1mb)</strong></label>
        <input name="arquivo" type="file" />
       
        <button type="submit" id="cad_curr" onclick="incluir_curriculo();">Enviar Arquivo</button>
    </form>

        <form id="form1" method="POST" action="salva_int.php">
            <div class="campo">
                <input type="hidden" name="cpf" value="<?php echo $cpf; ?>">
                <input type="hidden" name="curr" id="curr">
            </div>
<hr><br>
            <div class="inf_trab">
                <h4>Informações de Trabalho:</h4><br>

                <label><strong>Função: </strong></label>
                <input type="text" class="procurar" id="procurar" size="30" placeholder="Pesquise aqui e selecione abaixo"/><br>
                <label><strong>Selecione: </strong></label>
                <select id="Entry_ID" style="width:300px;"></option>
                </select>

                <button type="button" onclick="incluir_select();">Adicionar</button>
                <center>
                <br><hr><br>
                        <table id="tabela_cbos" border="1">
                        <tr id="linha0">
                            <th>CBO</th>
                            <th>Descrição</th>
                            <th>Função</th>
                        </tr>
             <?php
                    if (!is_null($cbo)) {
                        if ($cbo!=="0"){
                            foreach ($cbo as $chave => $valor) {
                                // Usando prepared statements para evitar injeção de SQL
                                $stmt = $conn->prepare("SELECT * FROM tab_cbo WHERE cbo = ?");
                                $stmt->bind_param("s", $valor);  // "s" indica que o parâmetro é uma string
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $tab_cbo_array = $result->fetch_array(MYSQLI_ASSOC);

                                // Escapando valores para uso no JavaScript
                                $descricao_escapada = addslashes($tab_cbo_array["descricao"]);
                                ?>
                                    <script>inserirLinha('<?=$valor?>', '<?=$descricao_escapada?>');</script>
                                <?php
                            }
                        }
                    }

                ?>

                        </table>     
                <hr><br>
                </center>
                <div>
                    <label><strong>Modalidades:</strong></label><br>
                    <?php
                    if ($modalidades==1){
                        ?>
                        <label><input type="checkbox" name="presencial" value="1" checked>Presencial</label><br>
                        <label><input type="checkbox" name="ho" value="2">Home-office</label><br>
                        <?php
                    } elseif ($modalidades==2){
                        ?>
                        <label><input type="checkbox" name="presencial" value="1">Presencial</label><br>
                        <label><input type="checkbox" name="ho" value="2" checked>Home-office</label><br>
                        <?php
                    } elseif ($modalidades==3){
                        ?>
                        <label><input type="checkbox" name="presencial" value="1" checked>Presencial</label><br>
                        <label><input type="checkbox" name="ho" value="2" checked>Home-office</label><br>
                        <?php
                    }else{
                        ?>
                        <label><input type="checkbox" name="presencial" value="1">Presencial</label><br>
                        <label><input type="checkbox" name="ho" value="2">Home-office</label><br>
                        <?php
                    }
                    ?>
                </div><br>
                <div>
                    <label><strong>Possui Pessoa Jurídica (CNPJ?): </strong></label><br>
                    <?php
                    if ($cnpj=='s'){
                        ?>
                        <label><input type="radio" name="possui_cnpj" value="n">&nbspNão</label>
                        <label><input type="radio" name="possui_cnpj" value="s" checked>&nbspSim</label>
                        <?php
                    } else{
                        ?>
                        <label><input type="radio" name="possui_cnpj" value="n" checked>&nbspNão</label>
                        <label><input type="radio" name="possui_cnpj" value="s">&nbspSim</label>
                        <?php
                    }
                    ?>
                </div>
            </div>
<hr><center>
    <div class="campo">
        <button type="submit" id="enviar">Salvar</button>
        <button type="submit" formaction="../trabalhador/area_trabalhador.php" id="cancelButton">Cancelar</button></center>
    </div>
    </center>

    </form>

   
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
function incluir_curriculo(){
    document.getElementById("curr").value = "s";
}
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
</script>
</html>