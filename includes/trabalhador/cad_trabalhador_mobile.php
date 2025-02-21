<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Faça seu cadastro</title>
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/est_form_emp.css" />
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/est_form_trab.css" />
    <script src="http://localhost/PIE3/js/validacpf.js" type="text/javascript"></script>
    <script src="http://localhost/PIE3/js/validar_senha.js" type="text/javascript"></script>
    <script src="http://localhost/PIE3/js/consulta_cep.js" type="text/javascript"></script>
    <script src="http://localhost/PIE3/js/validar_check.js" type="text/javascript"></script>
    <script src="http://localhost/PIE3/js/jquery-3.7.1.min.js"></script>

</head>

<body>

    <div id="principal">
        <img id="logoprincipal" src="http://localhost/PIE3/img/logos/logoprincipal.png"  alt="Lotipo Principal" />
    </div>

    <div>
        <h1>Cadastro do Candidato/Trabalhador</h1>
    </div>

<hr>

        <form id="form1" method="POST" action="salva_cad_trab.php">
            <div class="campo">
		    <br>
                <label for="cpf"><strong>CPF (somente números): </strong></label>
                <input id="cpfInput" type="text" name="cpf" onblur="checkCPFValidity()" oninput="checkCPFValidity()" size="11" required>

            <div id="cpfStatus"></div>
                <br>
                <label for="senha"><strong>Senha de Acesso</strong></label>
                <input type="password" name="senha" id="senha" size="12" onblur="validarsenha()" oninput="validarsenha()">
            <div id="senhaStatus"></div>
                <br>
                <label for="senhac"><strong>Confirme a Senha de Acesso</strong></label>
                <input type="password" name="senhac" id="senhac" size="12" onblur="confere()" oninput="confere()">
            <div id="senhaStatus2"></div>
                <h2>Contendo 8 à 12 caracteres, com ao menos 1 letra maiúscula, 1 minúscula, 1 numero e 1 caracter especial entre esses "'!@#%¨&_~><,;:</h2>
            </div>
<hr><br>

            <div class="campo">
                <input type="text" name="nome" id="nome" size="30" placeholder="Nome" required>
                <input type="text" name="sobrenome" id="sobrenome" size="30" placeholder="Sobrenome" required><br><br>
                <label for="dn"><strong>Data de Nascimento: </strong></label>
                <input type="date" name="dn" id="dn" required>
            </div><br>
            <div class="campo">
                <label><strong>CNH: </strong></label>
                <select name="cnh" id="cnh" required>
                    <option value="N" selected>Não possuo</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="ACC">ACC</option>
                </select><br><br>
                <label><strong>Veículo Próprio</strong></label>
                <label><input type="radio" name="veiculo" value="s" checked>Sim</label>
                <label><input type="radio" name="veiculo" value="n">Não</label>
            </div><hr>
            <div class="campo">
                <label><strong>Sexo Genético</strong></label>
                <label><input type="radio" name="sexo" value="m" checked>Masculino</label>
                <label><input type="radio" name="sexo" value="f">Feminino</label>
        	</div><hr>
            <div class="campo">
                <label><strong>Pessoa com Deficiência</strong></label>
                <label><input type="radio" name="pcd" value="n" checked>Não</label>
                <label><input type="radio" name="pcd" value="s">Sim</label>
                <br>
                <input type="text" name="tipo_pcd" size="40" placeholder="Qual deficência?">
        	</div>
<hr><br>
            <!-- Campo de email com-->
            <div class="campo">
                <input type="email" name="email" id="email" size="40" placeholder="E-mail">
                <br><br>

                <input type="text" name="telefone1" id="telefone1" size="15" placeholder="Telefone/Celular 1" required>
                <input type="text" name="telefone2" id="telefone2" size="15" placeholder="Telefone/Celular 2"><br>
            </div>
<hr><br>
            <div class="campo">
                <label><strong>Endereço:</strong></label><br>
                <input type="text" name="cep" id="cep" size="10" onblur="pesquisarCep(this.value)" placeholder="CEP" required><br><br>
                <input type="text" name="logradouro" id="rua" size="30" placeholder="Logradouro (r., av., al.)" required><br>

                <input type="text" name="numero" id="numero" size="6" placeholder="Número" required>
                
                <input type="text" name="complemento" id="complemento" size="20" placeholder="Complemento">
<br><br>
                <input type="text" name="bairro" id="bairro" size="20" placeholder="Bairro" required>

<br><br>
                <input type="text" name="cidade" id="cidade" size="30" placeholder="Cidade" required>
                
                <input type="text" name="uf" id="uf" size="2" placeholder="UF" required>
            </div><hr>
<center>
    <div class="campo">
        <?php
            include '../geral/contrato_mobile.php';
        ?>

        <input type="checkbox" id="termo" name="termo" onclick="validarcheck()">
        <label for="termo">Li e aceito os termo e condições acima.</label><br>

        <button type="submit" id="enviar" disabled>Enviar</button>
        <a href="/index.php"><input type="button" value="Cancelar"></a>
    </div>
</center>

    </form>
</body>

</html>


