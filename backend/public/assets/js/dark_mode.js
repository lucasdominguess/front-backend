
 //Funcao Dark_Light 

//Evento reload da pagina 
document.addEventListener("DOMContentLoaded", function() {

      const isDarkMode = localStorage.getItem('darkMode')

// verifica se o darkmode esta ativo e salvo em localStorage
    const htmlpags = document.querySelectorAll('.htmlpags'); 
    const icones = document.querySelectorAll('.icons');
      if (isDarkMode =='true') {
        htmlpags.forEach(htmls => {
          htmls.setAttribute('data-bs-theme','dark');
          
        });
        icones.forEach(element => {
          element.classList.remove('fa-moon')
          element.classList.add('fa-sun')
          
        });
      }else{
        htmlpags.forEach(htmls => {
          htmls.setAttribute('data-bs-theme','ligth');
        });
        icones.forEach(element => {
          element.classList.remove('fa-sun')
          element.classList.add('fa-moon')

        });
}
})


function modoDark () { 
  const isDarkMode = localStorage.getItem('darkMode')
  const htmlpags = document.querySelectorAll('.htmlpags');
  const icones = document.querySelectorAll('.icons');
  // const classIcons = document.getElementById(`${icon}`)
 

 
  if ( isDarkMode == 'false') { 

        icones.forEach(element => {
        element.classList.remove('fa-moon')
        element.classList.add('fa-sun')

      });
        htmlpags.forEach(element => {
        element.setAttribute('data-bs-theme', 'dark');
        
      });
      localStorage.setItem('darkMode','true');
     
      return;
  }else {
      icones.forEach(element => {
      element.classList.remove('fa-sun')
      element.classList.add('fa-moon')
    });
    htmlpags.forEach(element => {
      element.setAttribute('data-bs-theme','ligth');
      

    });
      localStorage.setItem('darkMode', 'false');
     

}};

//       const icones = document.querySelectorAll('.icons');
//       const icones = document.querySelectorAll('.htmls');

//       const icone =document.getElementById(`${icon}`)
//       const htmlTag = document.getElementById(`${html}`);
//       if (icone.classList.contains('fa-moon')) { 

//           icone.classList.remove('fa-moon');
//           icone.classList.add('fa-sun');
          
//           localStorage.setItem('darkMode', 'true');
//           htmlTag.setAttribute('data-bs-theme', 'dark');
        
//           return;
//       }
          
//           icone.classList.remove('fa-sun');
//           icone.classList.add('fa-moon');
//           localStorage.setItem('darkMode', 'false');
//           htmlTag.setAttribute('data-bs-theme', 'ligth'); 
  
// }
// iconlogin.addEventListener('click', ()=> {
//     const html = document.getElementById('html');
//     if (iconlogin.classList.contains('fa-moon')) { 
//         iconlogin.classList.remove('fa-moon');
//         iconlogin.classList.add('fa-sun');
//         localStorage.setItem('darkMode', 'true');
//         document.querySelector('html').setAttribute(
//           'data-bs-theme', 'dark'
        
//         );
      
//         return;
//     }
        
//         iconlogin.classList.remove('fa-sun');
//         iconlogin.classList.add('fa-moon');
//         localStorage.setItem('darkMode', 'false');
//         document.querySelector('html_login').setAttribute(
//           'data-bs-theme', 'ligth'
        
       
//         ); 
// }); 



// document.addEventListener("DOMContentLoaded", function() {
//   function ativaLetra2(elemento) {
//     const arrTexto = elemento.innerHTML.split('');
//     elemento.innerHTML = '';
//     arrTexto.forEach((letra, i) => {
//       setTimeout(() => {
//         elemento.innerHTML += letra;
//       }, 75 * i);
//     });
//   }


  
//   function escrevendoLetra2() {
//     const titulo = $('.titletable');
//     ativaLetra2(titulo);
//   }
// escrevendoLetra2();
// });