document.addEventListener('DOMContentLoaded', function() {

    const submitBtn = document.getElementById('submit-btn');
    const titleField = document.getElementById('title');
    const categorieField = document.getElementById('categorie');
    const distribField = document.getElementById('distributeur');

    const dateBtn = document.getElementById('date-btn');
    const dateInput = document.getElementById('date');

    submitBtn.addEventListener('click', function(e) {

        e = e || window.event;
        
        if (titleField.value.length < 1 && categorieField.value == '-1' && distribField.value == '-1')
        {
            e.preventDefault();
            alert(`Merci d'indiquer au moins une information pour lancer la recherche`);
        }
    });

    dateBtn.addEventListener('click', function(e) {
        e = e || window.event;
        
        if (dateInput.value.length < 1)
        {
            e.preventDefault();
            alert(`Merci d'indiquer la date de projection souhaiter`);
        }
    });
});