(function(){
    var table = $('.js--lojas-index-table').DataTable({
        retrieve: true,
        scrollX: false,
        "info": false,
        "columns": [
            null,
            null,
            { "orderable": false }
        ],
        "drawCallback" : setEventDelete,
        "lengthChange": false,
        "language": {
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sSearch": "Pesquisar: ",
            "zeroRecords": "Nenhum registro encontrado.",
            "sEmptyTable": "Nenhum registro encontrado.",
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
    });

    function setEventDelete(){
        let elements_delete = document.querySelectorAll('.js--loja-delete');
        let token = document.querySelector('.token').value;

        elements_delete.forEach(function(elem) {
          elem.addEventListener("click", function(event){
            event.preventDefault()
            let link_delete = this.getAttribute('data-link-delete');
            let tr_delete = this.parentElement.parentElement;
            Swal.fire({
              title: 'Você deseja apagar esta loja?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Sim, quero apagar!',
              cancelButtonText: 'Cancelar'
            }).then((result) => {
              if (result.value) {

                let xhr = new XMLHttpRequest();
                xhr.open('DELETE', link_delete);
                xhr.setRequestHeader('X-CSRF-TOKEN', token);
                xhr.send();

                xhr.onload = function() {
                  if (xhr.status != 200) {
                    Swal.fire(
                      'Houve um erro inesperado ao apagar esta loja!',
                      'Faça logout e tente novamente, se o erro persistir entre em contato com o administrador',
                      'error'
                    );
                  } else {
                    let response = JSON.parse(xhr.responseText);

                    if(response.error === 0){
                      Swal.fire(
                        response.description,
                        '',
                        'success'
                      );

                      table.row(tr_delete).remove().draw();

                    }else{
                      Swal.fire(
                        'Houve um erro inesperado ao apagar esta loja!',
                        'Faça logout e tente novamente, se o erro persistir entre em contato com o administrador',
                        'error'
                      );
                    }
                  }
                };

                xhr.onerror = function() {
                  Swal.fire(
                    'Houve um erro inesperado ao apagar o lançamento!',
                    'Faça logout e tente novamento, se o erro persistir entre em contato com o administrador',
                    'error'
                  )
                };

              }
            })
          });
        });
    }
})();
