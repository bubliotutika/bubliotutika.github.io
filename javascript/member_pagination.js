document.addEventListener('DOMContentLoaded', function(){

    const nbrPerPage = document.getElementById('nbr');

    nbrPerPage.onchange = function()
    {
        document.location.assign(`http://localhost/samsung/php/PHP_my_cinema/php/page/member_result.php?page=3&name=%&surname=&nbr=${nbrPerPage.value}`);
    };
});