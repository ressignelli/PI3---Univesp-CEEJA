<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <meta name="author" content="José Augusto Ressignelli de Lima" />
    <meta name="copyright" content="© 2024 JARL" />
    <meta name="description" content="Plataforma web para cadastro de emprego temporário"  />
    <meta name="keywords" content="emprego, temporário, cubrir férias, serviços"/>
    <meta name="revisit-after" content="15 days" />
    <title>Projeto Integrador Extensionista - CEEJA/Trabalho</title>
    
    <link rel="stylesheet" type="text/css"  href="css/estilo_inicial.css" />
    <link rel="stylesheet" type="text/css"  href="css/ferramentas.css" />
    
    <script src="js/jquery-3.7.1.min.js" type="text/javascript"></script>
    
</head>
<body>

    <div id="principal">
        <img id="logoprincipal" src="img/logos/logoprincipal.png"  alt="Lotipo Principal" />
    </div>
    <div id="menu">
            <nav>
                <ul class="menu">
                <li id="cad_contratante"><img src="img/icones/marketing_m.png" alt="ic_cont"><a href="index.php?esc=1">Acesso Contratante</a></li>
                <li id="cad_trabalhador"><img src="img/icones/empregado_m.png" alt="ic_trab"><a href="index.php?esc=2">Acesso Candidato</a></li>
                <li id="contato"><img src="img/icones/contato_m.png" alt="ic_cont"><a href="index.php?esc=3">Contato</a></li>
                <li id="sobre"><img src="img/icones/sobre_m.png" alt="ic_sobre"><a href="index.php?esc=4">Sobre</a></li>
                </ul>
            </nav>
    </div>

    <?php
  
    if(!empty($_GET['esc'])){
        $var = $_GET['esc'];
        if ($var == 1){
            ?>
            <div id="newEventModal">
                <center>
                <h2>Login Empregador</h2><hr><br>
                </center>
                <form method="POST" action="includes/geral/login.php">
                    <label><strong>CPF/CNPJ (somente números): </strong></label><input type="text" name="cpf" id="cpf" onkeypress="sanitizar()"><br><br>
                    <label><strong>Senha: </strong></label><input type="password" name="senha" id="senha">
                    <input type="hidden" name="opcao" value="empresa"><br><br>
                    <center>
                    <button type="submit">Acessar</button><br><br>
                    <a href="includes/empregador/cad_empregador.php">Não possui acesso, cadastre-se aqui!</a><br><br>
                    <a href="index.php?var=6">Esqueceu sua senha?</a>

                    <br><hr>
                    <button type="submit" formaction="index.php" id="cancelButton">Fechar</button></center>
                </form>
            </div>
            <?php
            
        }elseif ($var==2){
            ?>
            <div id="newEventModal">
                <center>
                <h2>Login Trabalhador/Candidato</h2><hr><br>
                </center>
                <form method="POST" action="includes/geral/login.php">
                    <label><strong>CPF (somente números): </strong></label><input type="text" name="cpf" id="cpf" onkeypress="sanitizar()"><br><br>
                    <label><strong>Senha: </strong></label><input type="password" name="senha" id="senha">
                    <input type="hidden" name="opcao" value="trabalhador"><br><br>
                    <center>
                    <button type="submit">Acessar</button><br><br>
                    <a href="includes/trabalhador/cad_trabalhador.php">Não possui acesso, cadastre-se aqui!</a><br><br>
                    <a href="index.php?var=5">Esqueceu sua senha?</a>

                    <br><hr>
                    <button type="submit" formaction="index.php" id="cancelButton">Fechar</button></center>
                </form>
            </div>
            <?php
        }elseif ($var==3){
            include('includes/geral/contato.php');
            exit();
        }elseif ($var==4){
            include('includes/geral/sobre.php');
            exit();
        }
        
    }
    if (isset($_GET['var'])) {
        $var = $_GET['var'];
        if ($var==5){
            ?>
            <center>
            <h2>Recuperação de Acesso</h2><hr><br>

            <form method="POST" action="includes/geral/recupera_senha.php">
                <label><strong>CPF (somente números): </strong></label><input type="text" name="cpf" size="11"><br><br>
                <label><strong>E-mail cadastrado: </strong></label><input type="email" name="email" size="70">
                <br><br>
                <button type="submit">Enviar</button>
            </form>
            </center>
            <?php
            exit();
        }elseif ($var==6){
            ?>
            <center>
            <h2>Recuperação de Acesso</h2><hr><br>

            <form method="POST" action="includes/geral/recupera_senha2.php">
                <label><strong>CPF/CNPJ (somente números): </strong></label><input type="text" name="cpf" size="14"><br><br>
                <label><strong>E-mail cadastrado: </strong></label><input type="email" name="email" size="70">
                <br><br>
                <button type="submit">Enviar</button>
            </form>
            </center>
            <?php
            exit();
        }
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
    document.getElementById('cpf').addEventListener('change',()=>sanitizar());
    document.getElementById('cpf').addEventListener('blur',()=>sanitizar());
function sanitizar(){
    const cpf = document.getElementById('cpf').value;
    let novo = cpf.replace(/[^0-9]/g,'');
    document.getElementById('cpf').value = novo;
}
    
</script>

<script type="text/javascript">
    var userAgent = navigator.userAgent.toLowerCase();
    var devices = new Array('nokia','iphone','blackberry','sony','lg','htc_tattoo','samsung','symbian','SymbianOS','elaine','palm','series60','windows ce','android','obigo','netfront','openwave','mobilexplorer','operamini');
    var url_redirect = 'index_mobile.php';
    function mobiDetect(userAgent, devices) {
        for(var i = 0; i < devices.length; i++) {
            if (userAgent.search(devices[i]) > 0) {
                return true;
            }
        }
        return false;
    }

    if (mobiDetect(userAgent, devices)) {
        window.location.href = url_redirect;
    }
    if (screen.width < 640 || screen.height < 480) { 
        window.location.href = url_redirect; 
    } else if (screen.width < 1024 || screen.height < 768) { 
        window.location.href = url_redirect; 
    }
</script>

</html>
