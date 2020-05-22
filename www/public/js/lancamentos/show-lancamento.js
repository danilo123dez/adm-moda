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

    function checkDate(){
        let data_venc = convertDate(document.querySelector('#data_vencimento_store').value)
        let data_compra = convertDate(document.querySelector('#data_compra_store').value);
        let success = false;
        if(data_compra > data_venc && data_compra != '' && data_venc != ''){
            let div = document.querySelector('.js--div-data-vencimento');
            if(!document.querySelector('.js--message-error')){
                console.log(1);
                document.querySelector('#data_vencimento_store').classList.add('is-invalid')
                let div_error = document.createElement('div');
                div_error.classList.add('invalid-feedback');
                div_error.classList.add('js--message-error');
                div_error.innerText = 'A data de vencimento não pode ser maior que data da compra';
                div.appendChild(div_error);
            }
        }else{
            if(document.querySelector('.js--message-error')){
                document.querySelector('.js--message-error').remove();
            }
            document.querySelector('#data_vencimento_store').classList.remove('is-invalid');
            success = true;
        }
        return success;
    }

    function convertDate(date)
    {
        return date.split('/').reverse().join('-');
    }
})()
