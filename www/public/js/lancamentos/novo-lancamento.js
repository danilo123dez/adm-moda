(function(){

    $('#data_compra_store').datetimepicker({
        format: 'd/m/Y',
        timepicker: false,
        autoclose: true
    });

    $('#data_vencimento_store').datetimepicker({
        format: 'd/m/Y',
        timepicker: false,
        autoclose: true
    });
    
    $('#lojas-disponiveis').select2();

    $(".js--valor").maskMoney({
        prefix: "R$",
        decimal: ",",
        thousands: "."
    });
})()