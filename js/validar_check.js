
function validarcheck(){
    const checkbox = document.getElementById("termo");
    const isChecked = checkbox.checked;
    if(isChecked){
        document.getElementById("enviar").disabled = false;
    }else{
        document.getElementById("enviar").disabled = true;
    }
}



