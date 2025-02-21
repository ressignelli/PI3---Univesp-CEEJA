<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title>Emprego Temporário.com</title>

    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/mobile_style24.css" />
    <script src="http://localhost/PIE3//js/jquery-3.7.1.min.js" type="text/javascript"></script>
     <script src="http://localhost/PIE3//js/menu_mobile.js" type="text/javascript"></script>
</head>

<body><center>
    <form name="mensagem" method="POST" action="envia_contato.php">

                <br><br>
                <h2>Preencha o Formulário abaixo</h2><br>

                <label for="nome"><strong>Nome: </strong></label><br>
                <input type="text" name="nome" id="nome" size="30" required /><br>
                <br>
                
                <label for="email"><strong>E-mail</strong></label><br>
                <input type="email" name="email" id="email" size="40" required /><br>
                <br>
                
                <label for="telefone"><strong>Telefone/Celular</strong></label><br>
                <input type="text" name="telefone" id="telefone" size="15" required /><br>
                
                <br><strong><p>Digite suas dúvidas, sugestões ou críticas abaixo:</p><strong><br>
                <textarea name="msg" id="msg" style="width:100%;height:100px;" maxlength="400" required></textarea>
                <br><br>
                <button type="input">Enviar</button>
    </center>
    </form>
</body>

</html>