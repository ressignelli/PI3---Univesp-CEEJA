const valortotal = document.getElementById('valor_total');
const qt = document.getElementById('quantity');

document.getElementById('quantity').addEventListener('change',()=>calcular());

function calcular(){
    let quantidade = qt.value;
    let total = 5 * quantidade;
    valor_total.innerHTML = "Valor Total: R$ " + total + ".00";
}
 