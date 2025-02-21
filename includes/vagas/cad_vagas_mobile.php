<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Cadastro de Vagas</title>
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/est_form_emp.css" />
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/est_form_trab.css" />
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/vagas.css" />
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/estilo_tabela.css" />

    <script src="http://localhost/PIE3/js/consulta_cep.js" type="text/javascript"></script>
    <script src="http://localhost/PIE3/js/jquery-3.7.1.min.js" type="text/javascript"></script>
    <script src="http://localhost/PIE3/js/moment.min.js" type="text/javascript"></script>
    
</head>
<?php
    if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
        $cpf_cnpj = $_SESSION['cpf'];
    }

    require_once 'conecta.php';
?>
<body>



<hr>
    <form id="form1" method="POST" action="../vagas/salva_cad_vagas.php">
        <div>
            <h1>Cadastro de Vagas</h1>
        </div>
        <div class="campo">
		    <br>
            <label name="cpf_cnpj"><strong>CPF/CNPJ: <?php echo $cpf_cnpj; ?>
            <input name="cpf_cnpj" type="hidden" value="<?php echo $cpf_cnpj; ?>" /></strong></label>
        </div>
<hr><br>

        <div class="inf_trab">
            <label><strong>Função: </strong></label>
            <input type="text" class="procurar" id="procurar" placeholder="Filtrar a função abaixo"/>
            <br><br>
            <label><strong>Selecione e clique no botão adicionar abaixo: </strong></label><br>
            <select id="Entry_ID" Size="5" style="width:100%;">
            </select>
            <br><center>
            <button type="button" onclick="incluir_select();">Adicionar</button></center>

            <br><br>
            
            <table id="tabela_cbos" border="1">
                <tr id="linha0">
                    <th>CBO</th>
                    <th>Descrição</th>
                    <th>Função</th>
                </tr>
            <!-- Inicialmente todas as linhas estão vazias -->
            </table>
            
        <br><br>
        </div>
        <div class="campo">
            <label for="periodo"><strong>Período de trabalho:</strong></label>
            <input type="date" name="data_inicial" id="data_inicial" onchange="calc_intervalo();" required />
            <label> até </label>
            <input type="date" name="data_final" id="data final" onchange="calc_intervalo();" required />
            <div id="mesma_linha"><h4>Nº de dias</h4>&nbsp;&nbsp;<div id="inter"></div></div>
            <br><br>

            <label for="horario"><strong>Horário de Trabalho (formato hh:mm):</strong></label>
            <input type="time" name="hora_inicial" id="hora_inicial" size="5" onchange="calc_intervalo2();" required />
            <label> às </label>
            <input type="time" name="hora_final" id="hora_final" size="5" onchange="calc_intervalo2();" required /><br>
            <div id="mesma_linha"><h4>N. de Horas por dia:</h4>&nbsp;&nbsp;<div id="inter2"></div></div>
            <br>

            <label for="modalidade"><strong>Modalidades:</strong></label>
            <label><input type="checkbox" name="presencial" checked />Presencial</label>
            <label><input type="checkbox" name="ho" />Home-office</label><br><br>

            <label for="periodo"><strong>Publicar até:</strong></label>
            <input type="date" name="data_validade" required />
        </div>
<hr><br>
        <div class="campo">
            <label><strong>Necessário Veículo Próprio:</strong></label>
            <label><input type="radio" name="veiculo" value="n" checked />Não</label>
            <label><input type="radio" name="veiculo" value="s" />Sim</label>

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

            <label><strong>Necessário CNPJ:</strong></label>
            <label><input type="radio" name="cnpj" value="n" checked />Não</label>
            <label><input type="radio" name="cnpj" value="s" />Sim</label /><br><hr><br>

            <label><strong>Prazo Pagamento</strong></label>
            <label><input type="radio" id="prazo_pag" name="prazo_pag" value="h" checked />Por Hora</label>
            <label><input type="radio" id="prazo_pag2" name="prazo_pag" value="d" />Por dia</label>
            <label><input type="radio" id="prazo_pag3" name="prazo_pag" value="s" />Por semana</label>
            <label><input type="radio" id="prazo_pag4" name="prazo_pag" value="s" />Por mês</label><br><br>

            <label><strong>Valor Pagamento (no prazo selecionado, somente números): R$</strong></label>
            <input type="number" name="valor_pag" style="width:100px" step="0.01" id="valor" onblur="muda_valor(this.value)" required /><br><br>
            <label id="valor_total_l" for="valor_total"><strong>Valor Total (sem intervalos): </strong>R$&nbsp;<input type="text" id="v_total" style="width:100px" readonly/>&nbsp;(cálculo ilustrativo).</label>
        </div>

<hr><br>

        <div class="campo">
            <h1>Local da Prestação de Serviço:</h1><br>

                <center><input type="text" name="cep" id="cep" size="10" style="width:150px" placeholder="CEP" onblur="pesquisarCep(this.value)" required /></center>

                <input type="text" name="logradouro" id="rua" size="30" style="width:200px" placeholder="Logradouro (Rua/Av./Al.)" required />
                <input type="text" name="numero" id="numero" size="6" style="width:50px" placeholder="Número" />
<br>             
                <input type="text" name="complemento" id="complemento" style="width:150px" placeholder="Número" size="20" />
                <input type="text" name="bairro" id="bairro" style="width:150px" placeholder="Bairro" size="20" />
<br>
                <input type="text" name="cidade" id="cidade" size="30" style="width:200px" placeholder="Cidade" required />
                <input type="text" name="uf" id="uf" size="2" style="width:40px" placeholder="UF" required />
        </div>
<br><hr><br>
        <div class="campo">
            <label for="inf"><strong>Informações Adicionais:</strong></label>
            <input type="text" name="info" id="info" size="100" />
        </div>

<hr><center>
    
    <div class="campo">
        <button type="submit" id="enviar">Salvar</button>
        <button type="submit" formaction="../empregador/area_empregador.php" id="cancelButton">Cancelar</button></center>
        </>
    </center>

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
            cell1.innerHTML = '<input style="text-align: center; padding:0; margin:0; height:100%; width:100%;" type="text" name="cbo[]" value="' + valor + '" readonly>';
    
            const cell2 = linha.insertCell(1);
            cell2.setAttribute('style', 'width: 350px;'); // Aumenta a largura da segunda coluna
            cell2.innerHTML = '<input style="text-align: center; padding:0; margin:0; height:100%; width:100%;" type="text" name="descricao[]" value="' + valor2 + '" readonly>';
    
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

function muda_valor(valor) {

    var interv = document.getElementById('inter').textContent;
    var intervFloat = parseFloat(interv);

    var interv2 = document.getElementById('inter2').textContent;
    var intervFloat2 = parseFloat(interv2);

    if (document.getElementById('prazo_pag').checked) {
        var total = interv * interv2 * valor;
    }else if (document.getElementById('prazo_pag2').checked) {
        var total = interv * valor;
    }else if (document.getElementById('prazo_pag3').checked) {
        var total = interv/7 * valor;
    }else if (document.getElementById('prazo_pag4').checked) {
        var total = interv/30 * valor;
    }

    document.getElementById('v_total').value = total;


}

function calc_intervalo(){
    const dataInicial = document.getElementsByName('data_inicial')[0];
    const dataFinal = document.getElementsByName('data_final')[0];

    const inicio = new Date(dataInicial.value);
    const fim = new Date(dataFinal.value);
  
    const diferenca = Math.abs(inicio - fim) / 1000.0;
    const diferencaEmDias = (diferenca/86400) +1;
    
    document.getElementById('inter').innerText = diferencaEmDias;
}

function calc_intervalo2(){
    const startTime = document.getElementById('hora_inicial').value;
    const endTime = document.getElementById('hora_final').value;

    var inicio = moment(startTime, 'HH');
    var fim = moment(endTime, 'HH');

    var diff = moment.duration(fim.diff(inicio));

    diff2 = diff.toString();
    diff2 = diff2.replace(/[^0-9]/g,'');

    document.getElementById('inter2').innerText = diff2;

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