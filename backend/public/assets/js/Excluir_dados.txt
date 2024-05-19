//Excluir dados da tabela
async function ExcluirDados(key) {
  try {
    let id = key.target.id;
 
    const response = await fetch(
      `http://localhost:9000/excluir_dados.php?id=${id}`,
      {
        method: "post",
        body: id,
        
      }
    );

    // capturando resposta para enviar no sweetAlert
    let newResponse = await response.json();

    // verificando valores de variaveis para formação do sweetalert
    let icon = newResponse.status == "fail" ? "error" : "success";
    let reload = newResponse.status == "fail" ? false : true;

    fnMensagem(icon, newResponse.msg, reload);
  } catch {}
}

// function excluirLinha(key) {
//     id = key.target.id
//     // $('#tr'+id).fadeToggle(1500)
//     ExcluirDados(key)
//     // let Ocultos = [] ;
// };

