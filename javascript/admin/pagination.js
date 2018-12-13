document.addEventListener('DOMContentLoaded', function(){

    const divMovie = document.getElementById('member-result');
    const movieChildren = divMovie.children;
    let startPage = 0;
    let endPage = 5;

    const displayMember = () =>
    {
        console.log(`s : ${startPage} | e : ${endPage}`);
        for (let i = 0; i < movieChildren.length; i++) 
        {
            if (startPage <= i && i <= endPage)
            {
                movieChildren[i].style.display = 'flex';
            }
            else
            {
                movieChildren[i].style.display = 'none';
            }
        }
    };

    const generatePageNbr = () =>
    {
        const pageNbr = Math.round(movieChildren.length / 6);
        const list = document.getElementById('page-list');
        for (let i = 1; i <= pageNbr; i++) 
        {
            list.insertAdjacentHTML('beforeend', `
                <li><a href="#">${i}</a></li>
            `);
        }
    };
 
    const createBtn = () =>
    { 
        divMovie.insertAdjacentHTML('afterend',`
            <div class="container">
                <div id="display-btn" class="row">
                    <button id="btn-back" class="btn">Page precedente</button>
                    <ul id="page-list">
                    </ul>
                    <button id="btn-next" class="btn">Page suivante</button>
                </div> 
            </div>
        `)

        generatePageNbr();
        const btnBack = document.getElementById('btn-back');
        const btnNext = document.getElementById('btn-next');
        btnBack.style.visibility = "hidden";

        btnNext.addEventListener('click', function()
        {
            if ((endPage + 6) >= movieChildren.length)
            {
                startPage += 6;
                endPage = movieChildren.length;
                btnNext.style.visibility = "hidden";
                btnBack.style.visibility = "visible";
            }
            else
            {
                startPage += 6;
                endPage += 6;
                btnBack.style.visibility = "visible";

            }
            displayMember();
        });

        btnBack.addEventListener('click', function()
        {
            if ((startPage - 6) <= 0)
            {
                startPage = 0;
                endPage = 5;
                btnBack.style.visibility = "hidden";
                btnNext.style.visibility = "visible";
            }
            else
            {
                startPage -= 6;
                endPage -= 6;
                btnNext.style.visibility = "visible";
            }
            displayMember();
        });
    };

    if (movieChildren.length > 6) 
    {
        startPage = 0;
        endPage = 5;
        createBtn();
    }

    displayMember();
});