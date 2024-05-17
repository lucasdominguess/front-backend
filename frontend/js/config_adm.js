document.getElementById('form_config').addEventListener('submit', function(event) {
    event.preventDefault();


    const formData = new FormData(this);


    fetch('/admin/upload_arquivo', {
        method: 'POST', 
        body: formData
    })
    .then(response => response.json())
    .then(newResponse=> {
     
     
        let icon = newResponse.data.status == 'fail' ? 'error' : 'success' 
        let reload = newResponse.data.status=='fail' ? false : true
      
        let rotas = newResponse.data.location 
        let msg = newResponse.data.msg

        if(icon=='error'){
            fnMensagem(icon,msg)
            
        }else {
            fnMensagem(icon,msg,reload,rotas)
      
        }
        }
      
    )
    .catch(error => {
       
        console.error('Erro:', error);
    });
});

// buscando arquivos da pasta arquivo 
document.addEventListener("DOMContentLoaded",async ()=>{

    const response = await buscar('/admin/listar_arquivos')

   
    console.log(response)

    for(let i =0; i < response.length ; i++ ) { 
        const num = Math.floor(Math.random() * (1000 - 1) + 1);
        const item = response[i] ; 
        let tr = document.createElement('tr')
        // tr.id = "tr""+num
        tr.innerHTML = `
     
            <td><a id="a${num}"   onclick="requestGETdir('${item}')">${item}</a></td>
            <td>????</td>
            <td>????</td>
            <td><button id="btn_arquivo${num}" class="btn btn-outline-primary" onclick="requestGETdir(${num})" type="button">Download</button></td>
        
        
        `
        $("#tb_arq").append(tr)
        // 
        
    }
    
        // <div>

      
        
        // </div>



});
