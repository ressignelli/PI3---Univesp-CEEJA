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

    $cpf = $_SESSION['cpf'];

    require_once('conecta.php');

    $consulta = mysqli_query($conn, "SELECT * FROM tab_trabalhador WHERE cpf = '$cpf'");
        $exibe = mysqli_fetch_array($consulta);

        $nome = $exibe["nome"];

?>
    <div id="principal">
        <img id="logoprincipal" src="http://localhost/PIE3/img/logos/logoprincipal.png"  alt="Lotipo Principal" />
    </div>
    <div id="menu">
            <nav>
                <ul class="menu">
                <li id=""><a href="area_trabalhador.php?esc=1">&nbsp;&nbsp;Alterar Cadastro&nbsp;&nbsp;</a></li>
                <li id=""><a href="area_trabalhador.php?esc=2">&nbsp;&nbsp;Alterar Senha&nbsp;&nbsp;</a></li>
                <li class="dropdown"><a href="javascript:void(0)" class="dropbtn">&nbsp;&nbsp;Vagas de Trabalho&nbsp;&nbsp;</a>
                        <div class="dropdown-content">
                            
                        <a href="area_trabalhador.php?esc=3">Cadastro de Interesses</a>
                        <a href="area_trabalhador.php?esc=4">Consultar Vagas</a>
                        <a href="area_trabalhador.php?esc=5">&nbsp;&nbsp;Consultar Vagas Candidatadas&nbsp;&nbsp;</a>
                        </div>
                </li>
                </ul>
            </nav>
    </div>
<hr>
            <div class="ident">
                <br>
                <h3>Bem vindo: <?php echo " ". $nome; ?></h3>
                <br>
            </div>
    <?php
            if (isset($_GET['esc'])){
                $esc = $_GET['esc'];
                if ($esc==1){
                    include_once 'alt_trabalhador.php';
                }elseif ($esc==2){
                    ?>
                    <div id="newEventModal">
                        <center>
                        <h2>Alterar Senha</h2><hr><br>
                        </center>
                        <form method="POST" action="salva_senha.php">
                            <label><strong>Nova Senha: </strong></label><input type="password" name="senha" id="senha"><br><br>
                            <label><strong>Nova Senha (confimar): </strong></label><input type="password" name="senhac" id="senhac">
                            <input type="hidden" name="cpf" value="<?php echo $cpf; ?>">
                            <center><br>
                            <button type="submit">Salvar</button>
                            <br><hr>
                            <button type="submit" formaction="area_trabalhador.php" id="cancelButton">Cancelar</button></center>
                        </form>
                    </div>
                    <?php                
                }elseif ($esc==3){
                    include_once 'cad_interesse.php';
                }elseif ($esc==4){
                    include_once '../vagas/cons_vagas_trab.php';
                }elseif ($esc==5){
                    include_once '../vagas/cons_vagas_candidatas.php';
                }
            }

            if (isset($_POST['abrir'])){
                include_once '../vagas/area_complementar.php';
            }

            if (isset($_GET['id_vaga'])){
                include_once '../vagas/salva_trab_vaga.php';
            }
            if (isset($_GET['quantidade'])){
                $quantidade = $_GET['quantidade'];
                $valor_total = 5 * $quantidade;
                include_once '/pagamento2.php';
                
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