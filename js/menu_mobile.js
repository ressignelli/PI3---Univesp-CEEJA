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
    
