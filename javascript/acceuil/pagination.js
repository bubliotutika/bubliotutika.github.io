document.addEventListener('DOMContentLoaded', function(){

    const divMovie = document.getElementById('movie');
    const movieChildren = divMovie.children;
    let filmDisplay = movieChildren.length;
    console.log(movieChildren.length);

    const displayFilm = () =>
    {
        for (let i = 0; i < movieChildren.length; i++) 
        {
            if (filmDisplay > i)
            {
                movieChildren[i].style.display = 'flex';
            }
            else
            {
                movieChildren[i].style.display = 'none';
            }
        }
    };
 
    const createBtn = () =>
    {
        divMovie.insertAdjacentHTML('afterend',`
            <div class="container">
                <div id="display-btn" class="row">
                    <button id="btn-more" class="btn">Afficher plus</button>
                    <button id="btn-less" class="btn">Afficher moins</button>
                </div> 
            </div>
        `)

        const btnMore = document.getElementById('btn-more');
        const btnLess = document.getElementById('btn-less');
        btnLess.style.visibility = "hidden";

        btnMore.addEventListener('click', function()
        {
            if ((filmDisplay + 10) >= movieChildren.length)
            {
                filmDisplay = movieChildren.length;
                btnMore.style.visibility = "hidden";
            }
            else
            {

                filmDisplay += 10;
                btnLess.style.visibility = "visible";

            }
            displayFilm();
        });

        btnLess.addEventListener('click', function()
        {
            if ((filmDisplay - 10) <= 10)
            {
                filmDisplay = 10;
                btnLess.style.visibility = "hidden";
            }
            else
            {
                filmDisplay -= 10;
                btnMore.style.visibility = "visible";
            }
            displayFilm();
        });
    };

    if (movieChildren.length > 10) 
    {
        filmDisplay = 10;
        createBtn();
    }

    displayFilm();
});