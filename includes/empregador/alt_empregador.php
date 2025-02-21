<!DOCTYPE HTML>

<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/estilo_comp_emp.css" />
  <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/estilo_alt_trab.css" />
  <script src="http://localhost/PIE3/js/consulta_cep.js" type="text/javascript"></script>
</head>

<body>
       <?php

                        $sql = mysqli_query($conn, "SELECT * FROM tab_empregador WHERE cpf_cnpj = '$cpf_cnpj'");
                        $sql2 = mysqli_query($conn, "SELECT * FROM tab_ramo_atividade");

                        // Verifica se recebeu ao menos um resultado (o que se espera)
                        if($exibe = mysqli_fetch_array($sql)) {
                            // Se recebeu, faz a leitura dos dados
                            $nome_empresa = $exibe['nome_empresa'];
                            $ramo_atividade = $exibe['ramo_atividade'];
                            $nome_responsavel = $exibe['nome_responsavel'];
                            $cpf_resp = $exibe['cpf_resp'];
                        
                            $email = $exibe['email'];
                        
                            $telefone1 = $exibe['telefone1'];
                            $telefone2 = $exibe['telefone2'];
                        
                            $logradouro = $exibe['logradouro'];
                            $numero = $exibe['numero'];
                            $complemento = $exibe['complemento'];
                            $bairro = $exibe['bairro'];
                            $cep = $exibe['cep'];
                            $cidade = $exibe['cidade'];
                            $uf = $exibe['uf'];
                            
                            // Imprime formulário pré carregado
                            ?><br><br>
                            <form action="salva_alt_empregador.php" method="POST">
                                <h2>Altera dados do cadastro</h2><br><hr>
                                <div class="campo">
                                    <label><strong>
                                    CPF/CNPJ: <?php echo $cpf_cnpj; ?></label>
                                    <input type="hidden" name="cpf_cnpj" value="<?php echo $cpf_cnpj; ?>">
                                    <br><br>
                                    <label>Nome Empresa: <input type="text" name="nome_empresa" value="<?php echo $nome_empresa; ?>" required></label><br><br>
                                    <label>Nome Responsável: <input type="text" name="nome_responsavel" value="<?php echo $nome_responsavel; ?>" required></label>
                                    <label>CPF Responsável: <input type="text" name="cpf_responsavel" value="<?php echo $cpf_resp; ?>" required></label>
                                    <br><br>
                                    <div>
                                    
                                    <label><strong>Ramo de Atividade</strong></label>
                                    <input type="text" name="ramo_atividade" id="ramo_atividade" value="<?php echo $ramo_atividade; ?>" size="1"> 
                                    <select name="" id="sel_r_a" onchange="atualizar_ra()">
                                        <?php
                                            while($linha = mysqli_fetch_array($sql2)) {
                                                echo "<option value=".$linha[1]."> $linha[1] </option>";
                                            }
                                        ?>
                                    </select> 
                                        </div>             
                                </div><br><hr><br>
                                <div class="campo">
                                    <label>Email: <input type="email" name="email" size:"40" value="<?php echo $email; ?>" required></label><br><br>
                                    <label>Telefone1: <input type="text" name="telefone1" value="<?php echo $telefone1; ?>" required></label>
                                    <label>Telefone2: <input type="text" name="telefone2" value="<?php echo $telefone2; ?>"></label>
                                </div><br><hr><br>
                                <div class="campo">
                                    <label>CEP: <input type="cep" name="cep" id="cep" size="10" value="<?php echo $cep; ?>" onblur="pesquisarCep(this.value)" required></label>
                                    <label>Logradouro: <input type="text" name="logradouro" id="rua" value="<?php echo $logradouro; ?>" size="30" required></label>
                                    <label>Número: <input type="text" name="numero" id="numero" value="<?php echo $numero; ?>" size="6"></label><br><br>
                                    <label>Complemento: <input type="text" name="complemento" id="complemento" value="<?php echo $complemento; ?>" size="20"></label><br><br>
                                    <label>Bairro: <input type="text" name="bairro" id="bairro" value="<?php echo $bairro; ?>" size="20"></label>
                                    <label>Cidade: <input type="text" name="cidade" id="cidade" value="<?php echo $cidade; ?>" size="30" required></label>
                                    <label>UF: <input type="text" name="uf" id="uf" value="<?php echo $uf; ?>" size="2" required></label>
                                </div><br><hr><br>
                                <div class="campo">
                                    <center>
                                    <button type="submit" formaction="area_empregador.php" id="cancelButton">Cancelar</button>
                                    <button type="submit">Salvar</button>
                                    </center>
                                </div>
                            </form>
                        <?php
                        }
                        ?>

      </body>
      <script>
        const objra = document.getElementById("sel_r_a");
        const ra = document.getElementById("ramo_atividade").value;
        document.getElementById('ramo_atividade').readOnly = true;

        if (ra == "A"){
            objra.selectedIndex = 0;
        }else if (ra == "B"){
            objra.selectedIndex = 1;
        }else if (ra == "C"){
            objra.selectedIndex = 2;
        }else if (ra == "D"){
            objra.selectedIndex = 3;
        }else if (ra == "E"){
            objra.selectedIndex = 4;
        }else if (ra == "F"){
            objra.selectedIndex = 5;
        }else if (ra == "G"){
            objra.selectedIndex = 6;
        }else if (ra == "H"){
            objra.selectedIndex = 7;
        }else if (ra == "I"){
            objra.selectedIndex = 8;
        }else if (ra == "J"){
            objra.selectedIndex = 9;
        }else if (ra == "K"){
            objra.selectedIndex = 10;
        }else if (ra == "L"){
            objra.selectedIndex = 11;
        }else if (ra == "M"){
            objra.selectedIndex = 12;
        }else if (ra == "N"){
            objra.selectedIndex = 13;
        }else if (ra == "O"){
            objra.selectedIndex = 14;
        }else if (ra == "P"){
            objra.selectedIndex = 15;
        }else if (ra == "Q"){
            objra.selectedIndex = 16;
        }else if (ra == "R"){
            objra.selectedIndex = 17;
        }else if (ra == "S"){
            objra.selectedIndex = 18;
        }else if (ra == "T"){
            objra.selectedIndex = 19;
        }else if (ra == "U"){
            objra.selectedIndex = 20;
        }else if (ra == "X"){
            objra.selectedIndex = 21;
        }

        function atualizar_ra(){

            const ra = document.getElementById("ramo_atividade");

            if (objra.selectedIndex == 0){
                ra.value="A";
            }else if (objra.selectedIndex == 1){
                ra.value="B";
            }else if (objra.selectedIndex == 2){
                ra.value="C";
            }else if (objra.selectedIndex == 3){
                ra.value="D";
            }else if (objra.selectedIndex == 4){
                ra.value="E";
            }else if (objra.selectedIndex == 5){
                ra.value="F";
            }else if (objra.selectedIndex == 6){
                ra.value="G";
            }else if (objra.selectedIndex == 7){
                ra.value="H";
            }else if (objra.selectedIndex == 8){
                ra.value="I";
            }else if (objra.selectedIndex == 9){
                ra.value="J";
            }else if (objra.selectedIndex == 10){
                ra.value="K";
            }else if (objra.selectedIndex == 11){
                ra.value="L";
            }else if (objra.selectedIndex == 12){
                ra.value="M";
            }else if (objra.selectedIndex == 13){
                ra.value="N";
            }else if (objra.selectedIndex == 14){
                ra.value="O";
            }else if (objra.selectedIndex == 15){
                ra.value="P";
            }else if (objra.selectedIndex == 16){
                ra.value="Q";
            }else if (objra.selectedIndex == 17){
                ra.value="R";
            }else if (objra.selectedIndex == 18){
                ra.value="S";
            }else if (objra.selectedIndex == 19){
                ra.value="T";
            }else if (objra.selectedIndex == 20){
                ra.value="U";
            }else if (objra.selectedIndex == 21){
                ra.value="X";
            }
        }

      </script>
      </html>