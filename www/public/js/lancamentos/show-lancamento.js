(function(){
    $('#data_compra_store').datepicker({
        format: 'dd/mm/yyyy',
        timepicker: false,
        autoclose: true
    }).on('changeDate', checkDate);

    $('#data_vencimento_store').datepicker({
        format: 'dd/mm/yyyy',
        timepicker: false,
        autoclose: true
    }).on('changeDate', checkDate);

    $('#lojas-disponiveis').select2();

    $(".js--valor").maskMoney({
        prefix: "R$",
        decimal: ",",
        thousands: "."
    });
})()
