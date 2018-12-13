document.addEventListener('DOMContentLoaded', function(){

    const submitBtn = document.getElementById('date-btn');
    const emailInput = document.getElementById('email1');
    const emailInputComfirm = document.getElementById('confirm-email');
    const pwdInput = document.getElementById('pwd');
    const pwdInputConfirm = document.getElementById('confirm-pwd'); 

    const style = window.getComputedStyle(emailInput);

    submitBtn.addEventListener('click', function(e) {
        e = e || window.event;
        console.log(emailInput.value);
        console.log(emailInputComfirm.value);
        if (emailInput.value !== emailInputComfirm.value)
        {
            alert('Les adresses email ne corresponde pas');
            e.preventDefault();
        }
        if (pwdInput.value !== pwdInputConfirm.value)
        {
            alert('Les mots de passe ne corresponde pas');
            e.preventDefault();
        }
    });
});