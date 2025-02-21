    // Função para validar um CPF
function validasenha(senha) {
    if (senha.length >= 8 && senha.length <= 12){
        return true;
    }
}
function conferencia(senha, senhac) {
    if (senha === senhac){
        return true;
    }
}
function senhavalida(senha) {
    let str = senha;
    let re = /[A-Z]/g;
    let re2 = /[a-z]/g;
    let re3 = /[0-9]/g;
    let re4 = /["'!@#%¨&_~<>,;:?]/g;

    const maiusc = str.search(re);
    const minusc = str.search(re2);
    const numero = str.search(re3);
    const especial = str.search(re4);

    return (maiusc >= 0 && minusc >= 0 && numero >= 0 && especial >= 0);
}
function validarsenha() {
    const senha = document.getElementById("senha").value;
    const senhaStatus = document.getElementById("senhaStatus");

    if (validasenha(senha) && senhavalida(senha)){
        senhaStatus.textContent = "";
    }else {
        senhaStatus.textContent = "Senha inválida.";
        senha.focus();
    }
}
function confere(){
    const senhac = document.getElementById("senhac").value;
    const senha = document.getElementById("senha").value;

    const senhaStatus2 = document.getElementById("senhaStatus2");
    if (conferencia(senha, senhac)){
        senhaStatus2.textContent = "";
    }else {
        senhaStatus2.textContent = "Senhas não correspondem.";
    }
}