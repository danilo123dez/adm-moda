(function(){

    var table = $('.js--lancamentos-index-table').DataTable({
      scrollX: false,
        "info": false,
        "columns": [
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            { "orderable": false }
        ],
        "lengthChange": false,
        searching: false,
        "language": {
            "sSearch": "Pesquisar: ",
            "zeroRecords": "Nenhum registro encontrado.",
            "sEmptyTable": "Nenhum registro encontrado.",
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });

    let elements_delete = document.querySelectorAll('.js--lancamento-delete');
    let token = document.querySelector('.token').value;

    elements_delete.forEach(function(elem) {
      elem.addEventListener("click", function(event){
        event.preventDefault()
        let link_delete = this.getAttribute('data-link-delete');
        let tr_delete = this.parentElement.parentElement;
        Swal.fire({
          title: 'Você deseja apagar este lançamento?',
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
                  'Houve um erro inesperado ao apagar o lançamento!',
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
                    'Houve um erro inesperado ao apagar o lançamento!',
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


    $('.js--pesquisa-data-inicio').datetimepicker({
        format: 'd/m/Y',
        timepicker: false,
        autoclose: true
    });

    $('.js--pesquisa-data-fim').datetimepicker({
        format: 'd/m/Y',
        timepicker: false,
        autoclose: true
    });

    document.querySelector('.js--tipo-pesquisa').addEventListener('change', function(){
        checkPesquisaSelecionada();
    });

    function checkPesquisaSelecionada(){
        let select = document.querySelector('.js--tipo-pesquisa').value
        let tipo = select.split('_');
        if(tipo[0] === 'data'){
            let div_pesquisa_data = document.querySelector('.js--pesquisa-data');
            div_pesquisa_data.style.display = 'flex';

            let inputs_pesquisa = document.querySelectorAll('.js--pesquisa-data input');
            inputs_pesquisa.forEach(element =>{
                element.removeAttribute('disabled');
            });

            let div_pesquisa_texto = document.querySelector('.js--pesquisa-texto');
            div_pesquisa_texto.style.display = 'none';

            let input_pesquisa_texto = document.querySelector('.js--input-pesquisa-texto');
            input_pesquisa_texto.setAttribute('disabled','disabled');
        }else{
            let div_pesquisa_data = document.querySelector('.js--pesquisa-data');
            div_pesquisa_data.style.display = 'none';

            let inputs_pesquisa = document.querySelectorAll('.js--pesquisa-data input');
            inputs_pesquisa.forEach(element =>{
                element.setAttribute('disabled', 'disabled');
            });

            let div_pesquisa_texto = document.querySelector('.js--pesquisa-texto');
            div_pesquisa_texto.style.display = 'flex';

            let input_pesquisa_texto = document.querySelector('.js--input-pesquisa-texto');
            input_pesquisa_texto.removeAttribute('disabled')

            if(select === 'T'){
                input_pesquisa_texto.setAttribute('readonly', 'readonly');
            }else{
                input_pesquisa_texto.removeAttribute('readonly');
            }

        }
    }

    checkPesquisaSelecionada();

    document.querySelector('.js--imprimir-lancamentos').addEventListener('click', function(e){
        e.preventDefault();
        let form = document.querySelector('.js--form-lancamento-pesquisa');

        if(!document.querySelector('.js--download-append')){
            elChild = document.createElement('input');
            elChild.setAttribute('value', true);
            elChild.setAttribute('name', 'download');
            elChild.setAttribute('type', 'hidden');
            elChild.setAttribute('class', 'js--download-append');
            form.appendChild(elChild);
        }
        form.submit();
        document.querySelector('.js--download-append').remove();
    });
})();
