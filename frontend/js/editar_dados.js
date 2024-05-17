


function Cadastrar(key) { 
   
    $("#myModal").show(1000)
    $("#title_h3").text('Cadastrar')
    limparCampos() 
  }
function limparCampos(){ 
    $('#id').val('')
    $('#nome').val('')
    $('#data').val('')
   
}
  //Criando Modal & dados para alterar/cadastrar na table
// function createModal(key) {
  
//     // console.log(key[0])


//     let keys = Object.keys(key)
    
//     $("#myModal").fadeToggle(1000)
//     $('#title_h3').text('Editar Cadastro')

// // valores nos Inputs
//     let values = Object.values(key) 
   
//       $("#id").val(values[0])
//       $("#nome").val(values[1])
//       $("#data").val(values[2])

// };


function gerarModal(key,obj) {
    if(key == 'usuario'){
      Modal(obj[0])
    }
    if(key == 'admin'){ 
      modalEditarAdm(obj[0][0])
    }

}

//exibir o tempo restante da sessao do usuario
function atualizarTempo() {
  const tempo =  document.getElementById('temposessao').textContent;   


 

  var dataAtual = new Date(); // Cria uma instância de Date()
  var timestamp = dataAtual.getTime(); // Obtém o timestamp em milissegundos

  // console.log(timestamp); // 

  let temtoken = new Date(tempo); 
  let timestampTempo = temtoken.getTime();

  let difereca = timestampTempo - timestamp;


  let n = new Date(difereca); // criando instancia da diff entre as datas

  var horasAtuais = n.getHours();  
  var minutosAtuais = n.getMinutes();
  let segundos = n.getSeconds();

  //adcionando 0 caso o valor contenha apenas um digito 
  let formattedHoras = horasAtuais.toString().padStart(2, "0");
  let formattedMinutos = minutosAtuais.toString().padStart(2, "0");
  let formattedSegundos = segundos.toString().padStart(2, "0");



  let tempoRestante = `${formattedMinutos}:${formattedSegundos}` 

  // console.log(tempoRestante)
let tempoRest =  document.getElementById('temposessao2').textContent = tempoRestante


  
//    let  tempoRest = document.getElementById('temposessao2').textContent
if(/^00:\d{2}$/.test(tempoRest)){
    $('#temposessao2').css('color', 'red');
  }
  if(tempoRest == "00:00"){
    setTimeout( deslogMensagem('error',"Sessão Expirada",true) ,1000)

      
    
      // return false
  }
}
setInterval(atualizarTempo, 1000);


