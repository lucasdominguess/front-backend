  //Criando Modal & dados para alterar/cadastrar na table
  function Modal(key) {
  
    // console.log(key[0])


    let keys = Object.keys(key)
    
    $("#myModal").fadeToggle(1000)
    $('#title_h3').text('Editar Cadastro')

// valores nos Inputs
    let values = Object.values(key) 
   
    //   $("#id").val(values[0])
      $("#nome").val(values[1])
      $("#data").val(values[2])

};

function modalEditarAdm(key){ 
    
    $("#myModal").fadeToggle(1000)
    $('#title_h3').text('Editar Administrador')


    let keys = Object.keys(key)
       
    // $("#id").val(keys[0])
    // $("#nome").val(keys[1])
    // $("#email").val(keys[2])
    // $("#senha").val(keys[3])
    // $("#permissao").val(keys[4])




    let values = Object.values(key) 
   
    // $("#id").val(values[0])
    $("#nome").val(values[1])
    $("#email").val(values[2])
    $("#senha").val('')
    $("#nivel").val(values[4])
   
}