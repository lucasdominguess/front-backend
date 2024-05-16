$(document).ready(async ()=>{


    let obj = await buscar('/admin/tentativas_acesso');
    
    tH(Object.keys(obj[0]));
    
        // loop para construir chave da tabela
        for (let index = 0; index < obj.length; index++) {
            // console.log(obj.length)
            const element = obj[index];
            
                arrumar(element)      
               
              }
              $('#table1').DataTable({
                //   language: {
                //     url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
                // },
                  dom: 'Blfrtip',
                  pageLength : 5,
                  lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
                  buttons: [
                  'copy', 'csv', 'excel'
                ],
                responsive: true,
                columnDefs: [
                   { target: [3], visible: false, searchable: false},
                  { title: 'Email', targets: 1 },
                  { title: 'Data ', targets: 2 },
                 
                
                  // // { title: 'Data de Nascimento', targets: 2 },
                  // { className: "text-center dt-center"}
                  // , targets: [0,1,2,3,4]},
                  
              ],
              initComplete: function () {
                $('.dt-buttons').removeClass('btn-group');
                $('.dt-buttons').addClass('d-flex');
                $("#h1_table").text('Tentativas de Acesso')
              }
              })
    });