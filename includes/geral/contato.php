

<body><center>
    <form name="mensagem" method="POST" action="/includes/geral/envia_contato.php">

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
                
                <br><strong><p>Digite suas dúvidas, sugestões e reclamações abaixo:</p></strong><br>
                <textarea name="msg" id="msg" style="width:50%;height:100px;" maxlength="400" required></textarea>
                <br><br>
                <button type="input">Enviar</button>
    </center>
    </form>
</body>

