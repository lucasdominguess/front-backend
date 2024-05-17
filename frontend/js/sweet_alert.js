
function fnMensagem(icon,msg,reload=false,location=''){
    Swal.fire({
      title: msg,
      icon: icon,
      confirmButtonText: 'Ok',
      timer: 4000,
      timerProgressBar: true,
      customClass: {
        container: 'dark-mode-alert'
      },
      willClose: () => {
        
        if(reload){
          window.location.reload();
      }
      if (location != ''){
        window.location.href=location
      }
    }
    });
}
function admMensagem(msg,icon){ 
  Swal.fire({
    title: msg,
    icon: icon,
    confirmButtonText: 'Ok',
    timer: 3500,
    timerProgressBar: true,
    customClass: {
      container: 'dark-mode-alert'
    }
})
}function sair() {
    Swal.fire({ 
    title: 'Deseja realmente sair? Dados serão Perdidos! ',
    showDenyButton: true,            
    confirmButtonText: "Sim",
    denyButtonText: `Não`,
    icon : 'question',
    
  
    }).then((result) => {
   
    if (result.isConfirmed) {  
   
        $("#myModal").fadeToggle('slow');
     
      // Swal.fire(`O ID do paciente é ${button.id}`, "", "info");
    } else if (result.isDenied) {
      // Swal.fire("OK!");
      
    }
  })}
function confirmExcluir(key) {
    Swal.fire({
      title: "Deseja realmente Excluir? \n Todos os dados serao Apagados! ",
      showDenyButton: true,
      confirmButtonText: "Sim",
      denyButtonText: `Não`,
      icon: "question",
    }).then((result) => {
      if (result.isConfirmed) {
      //  let id= key.target.id
      //  console.log(key.target.id)
        requestDELETE(key,'/admin/excluir')
  
        // Swal.fire(`O ID do paciente é ${button.id}`, "", "info");
      } else if (result.isDenied) {
        // Swal.fire("OK!");
      }
    });
  }
  function msgErroCep(key) { 
    Swal.fire({
      title: 'Cep Invalido!',
      text: `o Cep "${key}" Nao é valido`,
      icon: 'error',
      confirmButtonText: 'Ok'
    })
  }


function deslogMensagem(icon,msg,reload){
  Swal.fire({
    title: msg,
    icon: icon,
    confirmButtonText: 'Ok',
    timer: 2500,
    timerProgressBar: true,

  willClose: () => {
  
 
  if(reload){
    window.location.reload();
  }
  }
  })};

// outros sweetalert
  // Swal.fire({
  //   title: "Custom animation with Animate.css",
  //   showClass: {
  //     popup: `
  //       animate__animated
  //       animate__fadeInUp
  //       animate__faster
  //     `
  //   },
  //   hideClass: {
  //     popup: `
  //       animate__animated
  //       animate__fadeOutDown
  //       animate__faster
  //     `
  //   }
  // });