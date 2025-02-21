<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1"/>

    <title>Emprego Temporário.com</title>
    <link rel="icon" href="img/icones/ic_logo.png" type="image/png" />
    
    <link rel="stylesheet" type="text/css"  href="css/mobile_style24.css" />
    <script src="js/jquery-3.7.1.min.js" type="text/javascript"></script>

    
</head>
<body>
    
<div class="geral">
	<div class="menu_logo" id="menu_logo">
        <input type="image" id="abrir" class="abrir" src="img/icones/menu.png"  />
        	   		
        <div id="newEvento" class="newEvento">
            <ul class="menu_int">
                <li id="empregador"><img src="img/icones/marketing_m.png" alt="Ícone"><a href="index_mobile.php?esc=1"><strong>Empregador</strong></a></li>
                <li id="trabalhador"><img src="img/icones/empregado_m.png" alt="Ícone"><a href="index_mobile.php?esc=2"><strong>Candidato</strong></a></li>
                <li id="contato"><img src="img/icones/contato_m.png" alt="Ícone"><a href="index_mobile.php?esc=3"><strong>Contato</strong></a></li>
                <li id="sobre"><img src="img/icones/sobre_m.png" alt="Ícone"><a href="index_mobile.php?esc=4"><strong>Sobre</strong></a></li>
            </ul>
        	<hr>
        	<button class="cancelar" id="cancelButton">Fechar</button>
        </div>
        <div class="logotipo" id="logotipo">
            <img id="logoprincipal" src="img/logos/logoprincipal.png"  alt="Lotipo Principal" />
		</div>
			
	</div>
		<?php
		$esc = $_GET['esc'];
		if (is_null($esc)){
		?>
		<br>

        <?php
		}
		?>

    <div class="box4" id="box4">

    <?php
    if(!empty($_GET['esc'])){
        $var = $_GET['esc'];
        
        if ($var == 1){
            ?>
            <div id="newEvento2">
                <center>
                <h2>Login Empregador</h2><hr><br>
                </center>
                <form method="POST" action="includes/geral/login.php">
                    <center>
                    <label><strong>CPF/CNPJ (somente números): </strong></label><input type="text" name="cpf" id="cpf" onkeypress="sanitizar()"><br><br>
                    <label><strong>Senha: </strong></label><input type="password" name="senha" id="senha">
                    <input type="hidden" name="opcao" value="empresa"><br><br>
                    
                    <button type="submit">Acessar</button><br><br>
                    <a href="includes/empregador/cad_empregador_mobile.php">Não possui acesso, cadastre-se aqui!</a><br><br>
                    <a href="index_mobile.php?var=6">Esqueceu sua senha?</a>

                    <br><hr>
                    <button type="submit" formaction="index_mobile.php" id="cancela_janela" class="cancelButton2" onclick="fecha_Janela()">Fechar</button></center>
                </form>
            </div> 
            <?php
        }elseif ($var==2){
            ?>
            
            <div id="newEvento2">
                <center>
                <h2>Login Trabalhador/Candidato</h2><hr><br>
                </center>
                <form method="POST" action="includes/geral/login.php">
                    <center>
                    <label><strong>CPF (somente números): </strong></label><input type="text" name="cpf" id="cpf" onkeypress="sanitizar()"><br><br>
                    <label><strong>Senha: </strong></label><input type="password" name="senha" id="senha">
                    <input type="hidden" name="opcao" value="trabalhador"><br><br>
                    
                    <button type="submit">Acessar</button><br><br>
                    <a href="includes/trabalhador/cad_trabalhador_mobile.php">Não possui acesso, cadastre-se aqui!</a><br><br>
                    <a href="index_mobile.php?var=7">Esqueceu sua senha?</a>

                    <br><hr>
                    <button type="submit" formaction="index_mobile.php" id="cancela_janela" class="cancelButton2" onclick="fecha_Janela()">Fechar</button></center>
                </form>
            </div>
            <?php
        }elseif ($var==3){
            include('includes/geral/contato_mobile.php');
            exit();
        }elseif ($var==4){
            include('includes/geral/sobre_mobile.php');
            exit();
        }
    }
    
    if (isset($_GET['var'])) {
        $var = $_GET['var'];

        if ($var==7){
            ?>
            <script>
                const blog = document.getElementById('blog');
                blog.style.display = 'none';
            </script>
            <center>
            <h2>Recuperação de Acesso</h2><hr><br>

            <form method="POST" action="includes/geral/recupera_senha.php">
                <label></label><input type="text" name="cpf" size="20" id="cpf" onkeypress="sanitizar()" placeholder="CPF (somente números)"><br><br>
                <label></label><input type="email" name="email" size="30" placeholder="E-mail cadastrado">
                <br><br>
                <button type="submit" class="cancelButton">Enviar</button>
            </form>
            </center>
            <?php

        }elseif ($var==6){
            ?>
            <script>
                const blog = document.getElementById('blog');
                blog.style.display = 'none';
            </script>
            <center>
            <h2>Recuperação de Acesso</h2><hr><br>

            <form method="POST" action="includes/geral/recupera_senha2.php">
                <label></label><input type="text" name="cpf" size="20" id="cpf" onkeypress="sanitizar()" placeholder="CPF/CNPJ (somente números):"><br><br>
                <label></label><input type="email" name="email" size="30" placeholder="E-mail cadastrado">
                <br><br>
                <button type="submit" class="cancelButton">Enviar</button>
            </form>
            </center>
            <?php

        }
    }
    
    ?>
    </div>
</div>

</body>
<script>
    const evento2 = document.getElementById('newEvento2');
    const evento = document.getElementById('newEvento');

    evento.style.display = 'none';
    
    document.getElementById('abrir').addEventListener('click',()=>abrir_Menu());
    document.getElementById('cancelButton').addEventListener('click',()=>fecha_Menu());
    
    document.getElementById('cpf').addEventListener('change',()=>sanitizar());
    document.getElementById('cpf').addEventListener('blur',()=>sanitizar());

    function fecha_Janela(){
        evento2.style.display = 'none';
    }
    
    function fecha_Menu(){
        evento.style.display = 'none';
    }
    function abrir_Menu(){
        evento.style.display = 'block';
    }  
    
    function sanitizar(){
        const cpf = document.getElementById('cpf').value;
        let novo = cpf.replace(/[^0-9]/g,'');
        document.getElementById('cpf').value = novo;
    }
    
</script>
</html>