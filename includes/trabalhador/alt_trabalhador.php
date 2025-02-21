<!DOCTYPE HTML>

<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/estilo_comp_emp.css" />
  <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/estilo_alt_trab.css" />
  
  <script src="/js/consulta_cep.js" type="text/javascript"></script>
</head>

<body>
       <?php
       ?><h2>Altera dados do cadastro</h2><br><hr><?php

                        $sql = mysqli_query($conn, "SELECT * FROM tab_trabalhador WHERE cpf = '$cpf'");

                        // Verifica se recebeu ao menos um resultado (o que se espera)
                        if($exibe = mysqli_fetch_array($sql)) {
                            // Se recebeu, faz a leitura dos dados
                            $nome = $exibe['nome'];
                            $sobrenome = $exibe['sobrenome'];
                            $dn = $exibe['dn'];

                            $cnh = $exibe['cnh'];
                            $veiculo = $exibe['veiculo'];
                            $sexo = $exibe['sexo'];
                            $pcd = $exibe['pcd'];
                            $tipo_pcd = $exibe['tipo_pcd'];

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
                            ?>
                            <form action="salva_alt_trabalhador.php" method="POST">
                                <div class="campo">
                                    <label><strong>
                                    CPF: <?php echo $cpf; ?></label>
                                    <input type="hidden" name="cpf" value="<?php echo $cpf; ?>" size="11">
                                    <br><br>
                                    <label>Nome: <input type="text" name="nome" value="<?php echo $nome; ?>" size="30" required></label>
                                    <label>Sobrenome: <input type="text" name="sobrenome" value="<?php echo $sobrenome; ?>" size="30" required></label>
                                    <label>Data de Nascimento: <input type="date" name="dn" value="<?php echo $dn; ?>" required></label>
                                    <br><br>
                                </div><br><hr><br>
                                <div class="campo">
                                    <label><strong>CNH: </strong></label>
                                    <?php if ($cnh == "N") { ?>

                                        <select name="cnh" id="cnh" required>
                                        <option value="N" selected>Não possuo</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="ACC">ACC</option>
                                        </select><br>
                                    
                                    <?php } elseif ($cnh == "A"){ ?>
                                    
                                        <select name="cnh" id="cnh" required>
                                        <option value="N" >Não possuo</option>
                                        <option value="A" selected>A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="ACC">ACC</option>
                                        </select><br>
                                        
                                    <?php } elseif ($cnh == "B"){ ?>
                                    
                                        <select name="cnh" id="cnh" required>
                                        <option value="N" >Não possuo</option>
                                        <option value="A">A</option>
                                        <option value="B" selected>B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="ACC">ACC</option>
                                        </select><br><br>
                                        
                                    <?php } elseif ($cnh == "C"){ ?>
                                    
                                        <select name="cnh" id="cnh" required>
                                        <option value="N">Não possuo</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C" selected>C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="ACC">ACC</option>
                                        </select><br><br>
                                        
                                    <?php } elseif ($cnh == "D"){ ?>
                                    
                                        <select name="cnh" id="cnh" required>
                                        <option value="N" >Não possuo</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D" selected>D</option>
                                        <option value="E">E</option>
                                        <option value="ACC">ACC</option>
                                        </select><br><br>
                                        
                                    <?php } elseif ($cnh == "E"){ ?>
                                    
                                        <select name="cnh" id="cnh" required>
                                        <option value="N" >Não possuo</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E" selected>E</option>
                                        <option value="ACC">ACC</option>
                                        </select><br><br>
                                    
                                    <?php } elseif ($cnh == "ACC"){ ?>
                                    
                                        <select name="cnh" id="cnh" required>
                                        <option value="N" >Não possuo</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="ACC" selected>ACC</option>
                                        </select><br><br>
                                        
                                    <?php } ?>
                                    
                                </div><br><hr><br>
                                <div class="campo">
                                    <label><strong>Possui Veículo Próprio: </strong></label>
                                    <?php
                                     if ($veiculo == "s") {
                                        ?>
                                        <label><input type="radio" name="veiculo" value="s" checked>Sim</label>
                                        <label><input type="radio" name="veiculo" value="n">Não</label>
                                        <?php
                                     } else {
                                        ?>
                                        <label><input type="radio" name="veiculo" value="s">Sim</label>
                                        <label><input type="radio" name="veiculo" value="n" checked>Não</label>
                                        <?php
                                     }
                                     ?>
                                </div><br><hr><br>
                                <div class="campo">
                                    <label><strong>Sexo Genético: </strong></label>
                                    <?php
                                     if ($sexo == "m") {
                                        ?>
                                        <label><input type="radio" name="sexo" value="m" checked>Masculino</label>
                                        <label><input type="radio" name="sexo" value="f">Feminino</label>
                                        <?php
                                     } else {
                                        ?>
                                        <label><input type="radio" name="sexo" value="m">Masculino</label>
                                        <label><input type="radio" name="sexo" value="f" checked>Feminino</label>
                                        <?php
                                     }
                                     ?>
                                </div><br><hr><br>
                                <div class="campo">
                                    <label><strong>É PCD (pessoa com deficiência): </strong></label>
                                    <?php
                                     if ($pcd == "s") {
                                        ?>
                                        <label><input type="radio" name="pcd" value="s" checked>Sim</label>
                                        <label><input type="radio" name="pcd" value="n">Não</label>
                                        <?php
                                     } else {
                                        ?>
                                        <label><input type="radio" name="pcd" value="s">Sim</label>
                                        <label><input type="radio" name="pcd" value="n" checked>Não</label>
                                        <?php
                                     }
                                     ?>
                                     <label>Tipo de Deficiência: <input type="text" name="tipo_pcd" value="<?php echo $tipo_pcd; ?>" size="100"></label><br>
                                </div><hr><br>
                                <div class="campo">
                                    <label>Email: <input type="email" name="email" value="<?php echo $email; ?>" size="70" required></label><br><br>
                                    <label>Telefone1: <input type="text" name="telefone1" value="<?php echo $telefone1; ?>" size="15" required></label>
                                    <label>Telefone2: <input type="text" name="telefone2" value="<?php echo $telefone2; ?>" size="15"></label>
                                </div><br><hr><br>
                                <div class="campo">
                                    <strong><label>CEP: <input type="cep" name="cep" id="cep" size="10" value="<?php echo $cep; ?>" onblur="pesquisarCep(this.value)" required></label><br></strong>
                                    <label>Logradouro: <input type="text" name="logradouro" id="rua" value="<?php echo $logradouro; ?>" size="30" required></label>
                                    <label>Número: <input type="text" name="numero" id="numero" value="<?php echo $numero; ?>" size="6" required></label><br>
                                    <label>Bairro: <input type="text" name="bairro" id="bairro" value="<?php echo $bairro; ?>" size="20"></label>
                                    <label>Cidade: <input type="text" name="cidade" id="cidade" value="<?php echo $cidade; ?>" size="30" required></label>
                                    <label>UF: <input type="text" name="uf" id="uf" value="<?php echo $uf; ?>" size="2" required></label>
                                </div><br><hr><br>
                                <div class="campo">
                                    <center>
                                    <button type="submit" formaction="area_trabalhador.php" id="cancelButton">Cancelar</button>
                                    <button type="submit">Salvar</button>
                                    </center>
                                </div>
                            </form>
                        <?php
                        }
                        ?>

      </body>
      </html>