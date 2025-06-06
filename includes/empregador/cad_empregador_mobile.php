<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Faça seu cadastro</title>
    <link rel="stylesheet" type="text/css"  href="http://localhost/PIE3/css/est_form_emp.css" />
    <script src="http://localhost/PIE3/js/validacpf.js" type="text/javascript"></script>
    <script src="http://localhost/PIE3/js/validar_senha.js" type="text/javascript"></script>
    <script src="http://localhost/PIE3/js/consulta_cep.js" type="text/javascript"></script>
    <script src="http://localhost/PIE3/js/validar_check.js" type="text/javascript"></script>
</head>

<body>

    <div id="principal">
        <img id="logoprincipal" src="http://localhost/PIE3/img/logos/logoprincipal.png"  alt="Lotipo Principal" />
    </div>

    <div>
        <h1>Cadastro do Empregador</h1>
    </div>

<hr>

        <form id="form1" method="POST" action="salva_cad_empregador.php">
            <div class="campo">
		    <br>
                <label for="cpf_cnpj"><strong>CPF ou CNPJ: (somente números): </strong></label>
                <input id="cpfInput" type="text" name="cpf_cnpj" onblur="checkCPFValidity()" oninput="checkCPFValidity()" required>

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
                <input type="text" name="nome_empresa" id="nome_empresa" size="40" placeholder="Nome Fantasia/ Marca:" required>
                <br><br>
                <label><strong>Ramo de Atividade</strong></label>
                <select name="ramo_atividade" id="ramo_atividade" size="40" required>
                    <option value="" selected = selected>Selecione a área de atuação</option>
                    <option value="X"> SEM ATIVIDADE DECLARADA </option>
                    <option value="A"> AGRICULTURA, PECUÁRIA, PRODUÇÃO FLORESTAL, PESCA E AGRICULTURA </option>
                    <option value="B"> INDÚSTRIAS EXTRATIVAS </option>
                    <option value="C"> INDÚSTRIAS DE TRANSFORMAÇÃO </option>
                    <option value="D"> ELETRICIDADE E GÁS </option>
                    <option value="E"> ÁGUA, ESGOTO, ATIVIDADES DE GESTÃO DE RESÍDUOS E DESCONTAMINAÇÃO </option>
                    <option value="F"> CONSTRUÇÃO </option>
                    <option value="G"> COMÉRCIO; REPARAÇÃO DE VEÍCULOS AUTOMOTORES E MOTOCICLETAS </option>
                    <option value="H"> TRANSPORTE, ARMAZENAGEM E CORREIO </option>
                    <option value="I"> ALOJAMENTO E ALIMENTAÇÃO </option>
                    <option value="J"> INFORMAÇÃO E COMUNICAÇÃO </option>
                    <option value="K"> ATIVIDADES FINANCEIRAS, DE SEGUROS E SERVIÇOS RELACIONADOS </option>
                    <option value="L"> ATIVIDADES IMOBILIÁRIAS </option>
                    <option value="M"> ATIVIDADES PROFISSIONAIS, CIENTÍFICAS E TÉCNICAS </option>
                    <option value="N"> ATIVIDADES ADMINISTRATIVAS E SERVIÇOS COMPLEMENTARES </option>
                    <option value="O"> ADMINISTRAÇÃO PÚBLICA, DEFESA E SEGURIDADE SOCIAL </option>
                    <option value="P"> EDUCAÇÃO </option>
                    <option value="Q"> SAÚDE HUMANA E SERVIÇOS SOCIAIS </option>
                    <option value="R"> ARTES, CULTURA, ESPORTE E RECREAÇÃO </option>
                    <option value="S"> OUTRAS ATIVIDADES DE SERVIÇOS </option>
                    <option value="T"> SERVIÇOS DOMÉSTICOS </option>
                    <option value="U"> ORGANISMOS INTERNACIONAIS E OUTRAS INSTITUIÇÕES EXTRATERRITORIAIS </option>
                </select>
                <br><br>


            <div class="campo">    
                <input id="cpfInput2" type="text" name="cpf_resp" onblur="checkCPFValidity2()" oninput="checkCPFValidity2()" size="20" placeholder="CPF do Responsável" required>
                <input type="text" name="nome_responsavel" id="nome_responsavel" size="40" placeholder="Nome Completo do Responsável" required>
                <div id="cpfStatus2"></div>
            </div>

<hr><br>
            <!-- Campo de email com-->
            <div class="campo">
                <input type="email" name="email" id="email" size="40" placeholder="E-mail">
                <br>
                <input type="text" name="telefone1" id="telefone1" size="15" placeholder="Telefone/Celular 1" required>
                <input type="text" name="telefone2" id="telefone2" size="15" placeholder="Telefone/Celular 2"><br>
            </div>
<hr><br>
            <div class="campo">
                <input type="text" name="cep" id="cep" size="10" onblur="pesquisarCep(this.value)" placeholder="CEP" required>
                <br>
                <input type="text" name="logradouro" id="rua" size="30" placeholder="Logradouro (Rua/Av./Al.)" required><br>

                <input type="text" name="numero" id="numero" size="6" placeholder="Número" required>
                
                <input type="text" name="complemento" id="complemento" size="20" placeholder="Complemento">
<br><br>
                <input type="text" name="bairro" id="bairro" size="20" placeholder="Bairro">

                
<br><br>
                <input type="text" name="cidade" id="cidade" size="30" placeholder="Cidade" required>
                
                <input type="text" name="uf" id="uf" size="2" placeholder="UF" required>
            </div>

<hr><center>
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


