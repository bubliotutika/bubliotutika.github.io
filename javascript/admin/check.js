document.addEventListener('DOMContentLoaded', function() {

    const submitBtn = document.getElementById('submit-btn');
    const nameField = document.getElementById('text-name');
    const surnameField = document.getElementById('text-surname');

    submitBtn.addEventListener('click', function(e) {

        e = e || window.event;
        
        if (nameField.value.length < 1 && surnameField.value.length < 1)
        {
            e.preventDefault();
            alert(`Merci d'indiquer au moins un nom ou un prenom`);
        }
    });
});