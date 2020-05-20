(function(){
    document.querySelector('.js--confirm-pass').addEventListener('keyup', function(){
        checkPass();
    });

    if(document.querySelector('.js--form-recover-pass')){
        document.querySelector('.js--form-recover-pass').addEventListener('submit', function(e){
            e.preventDefault();
            if(checkPass()){
                this.submit();
            }
        });
    }

    if(document.querySelector('.js--form-store-admin')){
        document.querySelector('.js--form-store-admin').addEventListener('submit', function(e){
            e.preventDefault();
            if(checkPass()){
                this.submit();
            }
        });
    }

    function checkPass(){
        let pass = document.querySelector('.js--password');
        let confirm_pass = document.querySelector('.js--confirm-pass');
        let success = false;
        if(pass.value !== confirm_pass.value){
            confirm_pass.classList.add('is-invalid');
            let div = document.querySelector('.js--div-confirm-pass');
            if(!document.querySelector('.js--message-error')){
                let div_error = document.createElement('div');
                div_error.classList.add('invalid-feedback');
                div_error.classList.add('js--message-error');
                div_error.innerText = 'As senhas não estão iguais';
                div.appendChild(div_error);
            }
        }else{
            if(document.querySelector('.js--message-error')){
                document.querySelector('.js--message-error').remove();
            }
            confirm_pass.classList.remove('is-invalid');
            success = true;
        }
        return success
    }
})()
