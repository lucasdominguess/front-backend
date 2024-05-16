// Capturando valor do campo de cep
$("#cep").on('input', ()=>{ 
    let value = $("#cep").val()
    
    let newValue = value.replace(/[^0-9]/,'')
    buscaCep(newValue); 
    
    
  })
  
  //Apagando dados dos campos Backspace
  
        //  $('#cep').on({
        //     keydown:()=> {$('input') == 8 | 127  
        //         $('#nome_rua').val('')
        //         $('#bairro').val('')
        //         $('#uf').val('')
        //       }
  // })
  async function buscaCep(key) { 
        const cep = key
            if (cep == /^\d{5}\-?\d{3}$/.exec(key) ){
                const dadosEnd = await fetch(`https://opencep.com/v1/${cep}`);
  
              if (dadosEnd.status !== 200 ) {
                  msgErroCep(key)
                  return false
              
              }
                const EndCompl = await dadosEnd.json()
                preencheCep(EndCompl);
         
          }else { 
            limparCamposCep()
  }
  
  function preencheCep(key) { 
  
      valor = Object.values(key)
      // $('#cep').val(valor[0])
      $('#nome_rua').val(valor[1])
      $('#uf').val(valor[5])
      $('#bairro').val(valor[3])
  }    
  
  };