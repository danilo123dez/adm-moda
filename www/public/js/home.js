(function(){
    $('.js--lancamentos-index-table').DataTable({
        scrollX: false,
          "info": false,
          "columns": [
              null,
              null,
              null,
              null,
              null,
              null,
              null
          ],
          searching: false,
          "bPaginate": false,
          "lengthChange": false,
          "language": {
              "zeroRecords": "Nenhum registro encontrado.",
              "sEmptyTable": "Nenhum registro encontrado.",
              "oAria": {
                  "sSortAscending": ": Ordenar colunas de forma ascendente",
                  "sSortDescending": ": Ordenar colunas de forma descendente"
              }
          }
      });
})();
