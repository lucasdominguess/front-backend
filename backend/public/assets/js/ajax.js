//enviando dados com medoto POST
async function requestPOST(rota,v_form=null){
    const rots = rota 
  
  //   const headers = {
  //     'Authorization': `Bearer ${token}`
  // };
    const response = await fetch(`${rots}`
,{

    method : 'post' , 
    body : v_form,
 
});

let newResponse = await response.json()
// console.log(newResponse)
let icon = newResponse.data.status == 'fail' ? 'error' : 'success' 
let reload = newResponse.data.status=='fail' ? false : true
// let reload2 = newResponse.data.reload =='fail' ? false : true
let rotas = newResponse.data.location 
let msg = newResponse.data.msg

if(icon=='error'){
    fnMensagem(icon,msg)
    
}else {
    fnMensagem(icon,msg,reload,rotas)
    // window.location.href='registrar' 
}
}
// buscar dados com metodo GET 
async function requestGET(key) { 
   
  let id = key.target.id
//   console.log(id);
  let response = await fetch(`/admin/editar?id=${id}`);
  let obj = await response.json()

  // console.log(obj.data[0][0])
  gerarModal(obj.data.code,obj.data) 
  // createModal(obj.data[0]);
  // modalEditarAdm(obj.data);
}

// buscar dados com metodo GET
async function requestGETrota(rota) { 
   

//   console.log(id);
  let response = await fetch(`${rota}`);
  // let obj = await response.json()
  // // console.log(obj) 
  let newResponse = await response.json()
  // console.log(newResponse)
  let icon = newResponse.data.status == 'fail' ? 'error' : 'success' 
  let reload = newResponse.data.status=='fail' ? false : true
  let rotas = newResponse.data.location 
  let msg = newResponse.data.msg
  
  if(icon=='error'){
      fnMensagem(icon,msg)
  }else {
      fnMensagem(icon,msg,reload,rotas)
      // window.location.href='registrar' 
  }
}


async function requestDELETE(key,rota) {
    try {
      let id = key.target.id;
      // console.log(key.target.emails);
      
      const response = await fetch(
        `${rota}?id=${id}`,
        {
          method: "post",
          body: id,
          
          
        }
      );
      
    // capturando resposta para enviar no sweetAlert
    let newResponse = await response.json();

    // verificando valores de variaveis para formação do sweetalert
    let icon = newResponse.data.status == "fail" ? "error" : "success";
    let reload = newResponse.data.status == "fail" ? false : true;

    fnMensagem(icon, newResponse.data.msg, reload);
  } catch {}
}
// Bucando dados do backend para listar tabela
async function buscar(rota)
    {
    try {
        let response = await fetch(`${rota}`);
        let obj = await response.json()
      //  console.log(obj.data[4])
        return obj.data

    }catch(error) {  //Identificando possivel erro 
      console.log('erro na busca',error)
    }finally {
      
    };
    };
  
// buscar dados com metodo GET
  async function requestGETdir(key) { 
    // let id = key.target.id

    console.log(key);
    let response = await fetch(`/admin/listar_diretorio?name=${key}`);
 
    let newResponse = await response.json()
   

    console.log(newResponse)

    for(let i =0; i < newResponse.length ; i++ ) { 
        const num = Math.floor(Math.random() * (1000 - 1) + 1);
        const item = newResponse[i] ; 
        let tr = document.createElement('tr')
        // tr.id = "tr""+num
        tr.innerHTML = `
      
            <td><a id="a${num}" class="bi bi-card-image" onclick="requestGETdir(${item})">${item}</a></td>
            <td>????</td>
            <td>????</td>
            <td><button id="btn_arquivo${num}" class="btn btn-outline-primary" onclick="requestGETdir(${num})" type="button">Download</button></td>
        
        
        `
        $("#tb_arq").append(tr)
  }


  }
  async function requestGETDownload (rota){
    // let id = key.target.id
      console.log(rota);
      let response = await fetch(`${rota}`);
      console.log(response)
      let obj = await response.json()
    
  }
