//botoes + eventos

// login 
$('#btn_entrar').on('click', async ()=> {
    let v_form = new FormData(document.getElementById('form_login')) 

    requestPOST('/logar',v_form)
  })


//home 
$('#btn_sair').on('click', async ()=> {
    
   requestPOST('/sair')
  })

  $("#btn_cadastrar").click(function(){
    Cadastrar();
   
  
  }); 

// botoes modal 
$('#btn_enviarCad').on('click', async ()=> {
    let v_form = new FormData(document.getElementById('form_cad')) 

    requestPOST('/cadastrar',v_form)
  

  })
$("#fechar").click(function(){
    $("#myModal").hide();
    // sair();
}) 
$("#btn_close").click(function(){
    $("#myModal").hide();
  //  sair();
})
// icones do modo dark

// iconhome.addEventListener('click' ,modoDark) ;
$("#icon_login").click( function (){ 
  modoDark()
});
// $("#icon_home").click( function (){ 
//   modoDark('icon_home','html_homeuser')
// });
$("#icon_home").click( function (){ 
  modoDark()
});

//CONFIGURAÇÕES DE ADM 

// $("#btn_enviar_foto").click ( function (){
//   let v_form = new FormData(document.getElementById('form_config')) 
//   requestPOST("/admin/arquivo" ,v_form)
// });

$("#btn_arquivo").click( function () { 
  console.log('atu')
  // requestGETdir()
});



// $("#btn_dowload_01").click( function () { 
//   requestGETDownload('/admin/download?filename=vendas.png')
// })