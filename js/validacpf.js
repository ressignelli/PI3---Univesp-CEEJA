function validateCNPJ(cpf) {
        var b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        var c = String(cpf).replace(/[^\d]/g, '');
    
        if (c.length !== 14) return false;
        if (/0{14}/.test(c)) return false;
    
        for (var i = 0, n = 0; i < 12; n += c[i] * b[++i]);
        if (c[12] != (((n %= 11) < 2) ? 0 : 11 - n)) return false;
    
        for (var i = 0, n = 0; i <= 12; n += c[i] * b[i++]);
        if (c[13] != (((n %= 11) < 2) ? 0 : 11 - n)) return false;
    
        return true;
}
    
function sanitizeInput(input) {
    return input.replace(/[^0-9]/g,''); // Mantém apenas os dígitos numéricos
}
    // Função para validar um CPF
function validateCPF(cpf) {

      // Lista de CPFs inválidos conhecidos
    const invalidCPFs = [
        "00000000000", "11111111111", "22222222222", "33333333333", "44444444444",
        "55555555555", "66666666666", "77777777777", "88888888888", "99999999999"
    ];

      // Verifica se o CPF está na lista de CPFs inválidos
    if (invalidCPFs.includes(cpf)) {
        return false;
    }

      // Função para calcular um dígito verificador
    function calculateDigit(sumFunction) {
        let sum = sumFunction();
        let rev = 11 - (sum % 11);
        return (rev === 10 || rev === 11) ? 0 : rev;
    }

      // Função para calcular a soma dos dígitos multiplicados pelos pesos
    function calculateSum(multiplier) {
        let sum = 0;
        for (let i = 0; i < multiplier; i++) {
          sum += parseInt(cpf.charAt(i)) * (multiplier + 1 - i);
        }
        return sum;
      }

    try {
        // Calcula os dígitos verificadores
        const j = calculateDigit(() => calculateSum(9));
        const k = calculateDigit(() => calculateSum(10));

        // Verifica se os dígitos verificadores estão corretos
        if (j !== parseInt(cpf.charAt(9)) || k !== parseInt(cpf.charAt(10))) {
          return false;
        }
    } catch (error) {
        return false;
    }

    return true;
}

    // Função para evitar ataques de injeção
function preventInjection(input) {
    return input.replace(/['"\\]/g, ''); // Remove caracteres que podem causar injeção
}

    // Função para manipulação de erros
function sanitizar(){
    const cpf = document.getElementById('cpfInput').value;
    let novo = cpf.replace();
    document.getElementById('cpf').value = novo;
}
function checkCPFValidity() {
    const cpfInput = document.getElementById("cpfInput").value;
    const cpfStatus = document.getElementById("cpfStatus");
    
    const sanitizedInput = sanitizeInput(cpfInput);
    document.getElementById('cpfInput').value = sanitizedInput;
    const sanitizedCPF = preventInjection(sanitizedInput);

    const qtNumero = sanitizedCPF.length;

    if (qtNumero == 11){
    
        if (validateCPF(sanitizedCPF)){
            cpfStatus.textContent = "";
        } else {
            cpfStatus.textContent = "CPF inválido.";
        }
        
    }else if (qtNumero == 14){
        if (validateCNPJ(sanitizedCPF)){
            cpfStatus.textContent = "";
        } else {
            cpfStatus.textContent = "CNPJ inválido.";
        }
    }else {
        cpfStatus.textContent = "CNPJ inválido.";
    }
}

function checkCPFValidity2() {
    const cpfInput = document.getElementById("cpfInput2").value;
    const cpfStatus = document.getElementById("cpfStatus2");
    
    const sanitizedInput = sanitizeInput(cpfInput);
    const sanitizedCPF = preventInjection(sanitizedInput);

    if (validateCPF(sanitizedCPF)){
        cpfStatus.textContent = "";
    } else {
        cpfStatus.textContent = "CPF inválido.";
    }

}