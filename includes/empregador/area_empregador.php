<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Área do Empregador</title>
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/estilo_inicial.css" />
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/estilo_comp_emp.css" />
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/ferramentas.css" />
    <script src="http://localhost/PIE3/js/jquery-3.7.1.min.js" type="text/javascript"></script>
</head>

<body>

<?php

    session_start();
    $cpf_cnpj = $_SESSION['cpf'];

    require_once('conecta.php');

    $consulta = mysqli_query($conn, "SELECT * FROM tab_empregador WHERE cpf_cnpj = '$cpf_cnpj'");
        $exibe = mysqli_fetch_array($consulta);

        $nome_empresa = $exibe["nome_empresa"];

?>
    <div id="principal">
        <img id="logoprincipal" src="http://localhost/PIE3/img/logos/logoprincipal.png"  alt="Lotipo Principal" />
    </div>
    <div id="menu">
            <nav>
                <ul class="menu">
                <li id=""><a href="area_empregador.php?esc=1">&nbsp;&nbsp;Alterar Cadastro&nbsp;&nbsp;</a></li>
                <li id=""><a href="area_empregador.php?esc=2">&nbsp;&nbsp;Alterar Senha&nbsp;&nbsp;</a></li>
                <li class="dropdown"><a href="javascript:void(0)" class="dropbtn">&nbsp;&nbsp;Vagas&nbsp;&nbsp;</a>
                        <div class="dropdown-content">
                            
                        <a href="area_empregador.php?esc=3">Cadastrar</a>
                        <a href="area_empregador.php?esc=6">Consultar</a>
                        
                        </div>
                </li>
                <li class="dropdown"><a href="javascript:void(0)" class="dropbtn">&nbsp;&nbsp;Consultar&nbsp;&nbsp;</a>
                        <div class="dropdown-content">
                            
                        <a href="area_empregador.php?esc=4">&nbsp;&nbsp;Trabalhadores&nbsp;&nbsp;</a>
                        <a href="area_empregador.php?esc=5">&nbsp;&nbsp;Inscritos em Vagas&nbsp;&nbsp;</a>
                        <a href="area_empregador.php?esc=7">&nbsp;&nbsp;Selecionados para Vagas&nbsp;&nbsp;</a>
                        </div>
                </li>
                </ul>
            </nav>
    </div>
<hr>
            <div class="ident">
                <br>
                <h3>Bem vindo: <?php echo " ". $nome_empresa; ?></h3>
                <br>
            </div>
            <?php
            if (isset($_GET['esc'])){
                $esc = $_GET['esc'];
                if ($esc==1){
                    include_once 'alt_empregador.php';
                }elseif ($esc==2){
                    ?>
                    <div id="newEventModal">
                        <center>
                        <h2>Alterar Senha</h2><hr><br>
                        </center>
                        <form method="POST" action="salva_senha.php">
                            <label><strong>Nova Senha: </strong></label><input type="password" name="senha" id="senha"><br><br>
                            <label><strong>Nova Senha (confimar): </strong></label><input type="password" name="senhac" id="senhac">
                            <input type="hidden" id="cpf_cnpj" name="cpf_cnpj" value="<?php echo $cpf_cnpj; ?>">
                            <center><br>
                            <button type="submit">Salvar</button>
                            <br><hr>
                            <button type="submit" formaction="area_empregador.php" id="cancelButton">Cancelar</button></center>
                        </form>
                    </div>
                    <?php                
                }elseif ($esc==3){
                    include_once '../vagas/cad_vagas_mobile.php';
                }elseif ($esc==6){
                    include_once '../vagas/cons_vagas_emp.php';
                }elseif ($esc==4){
                    include_once 'pesquisa_cand.php';
                }elseif ($esc==5){
                    include_once 'consulta_insc.php';
                }elseif ($esc==7){
                    include_once 'consulta_selec.php';
                }
            }

    if (isset($_POST['execute'])){
        include 'exec_pesq.php';
    }
    if (isset($_POST['id_trab'])){
        include 'exec_pesq2.php';
    }
    if (isset($_POST['id_ret_tvt'])){
        include 'exec_retirada_func.php';
    }
    if (isset($_POST['id_vaga'])){
        include 'exec_int_insc.php';
    }


    ?>
    </body>

    <script>
        const newEvent = document.getElementById('newEventModal');
        newEvent.style.display = 'block';
        document.getElementById('cancelButton').addEventListener('click',()=>closeModal());
        function closeModal(){
            newEvent.style.display = 'none';
        }
    </script> 
</html>