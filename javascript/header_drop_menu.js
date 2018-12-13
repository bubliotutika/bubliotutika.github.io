document.addEventListener('DOMContentLoaded', function(){

    const connexionBtn = document.getElementById('connexion-drop');
    const dropMenu = document.getElementById('drop-menu');
    dropMenu.style.display = 'none';
    
    connexionBtn.addEventListener('click', function()
    {
        if (dropMenu.style.display == 'none')
        {
            dropMenu.style.display = 'block';
            connexionBtn.style.borderBottomLeftRadius = 0;
            connexionBtn.style.borderBottomRightRadius = 0;
        }
        else
        {
            dropMenu.style.display = 'none';
            connexionBtn.style.borderBottomLeftRadius = '5px';
            connexionBtn.style.borderBottomRightRadius = '5px';
        }
    });
});