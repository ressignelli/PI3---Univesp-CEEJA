function limpaFormularioCep() {
    document.getElementById('rua').value = "";
    document.getElementById('bairro').value = "";
    document.getElementById('cidade').value = "";
    document.getElementById('uf').value = "";
  }
  
  function meuCallback(conteudo) {
    if (!("erro" in conteudo)) {
      document.getElementById('rua').value = conteudo.logradouro;
      document.getElementById('bairro').value = conteudo.bairro;
      document.getElementById('cidade').value = conteudo.localidade;
      document.getElementById('uf').value = conteudo.uf;
    } else {
      limpaFormularioCep();
      alert("CEP não encontrado.");
    }
  }
  
  function pesquisarCep(valor) {
    var cep = valor.replace(/\D/g, '');
    if (cep != "") {
      var validacep = /^[0-9]{8}$/;
      if (validacep.test(cep)) {
        document.getElementById('rua').value = "...";
        document.getElementById('bairro').value = "...";
        document.getElementById('cidade').value = "...";
        document.getElementById('uf').value = "...";
  
        var script = document.createElement('script');
        script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meuCallback';
        document.body.appendChild(script);
      } else {
        limpaFormularioCep();
        alert("Formato de CEP inválido.");
      }
    } else {
      limpaFormularioCep();
    }
  }