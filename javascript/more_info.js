function showMore(event , id)
{
    event = event || window.event;
    event.preventDefault();

    const eltDiv = document.getElementById(id);
    let styleDisplay = window.getComputedStyle(eltDiv, null).getPropertyValue('display');
    let stylePosition = window.getComputedStyle(eltDiv, null).getPropertyValue('position');
    
    if (styleDisplay == 'none' && stylePosition == 'absolute')
    {
        eltDiv.style.display = 'block';
        eltDiv.style.position = 'relative';
    }
    else
    {
       eltDiv.style.display = 'none';
       eltDiv.style.position = 'absolute';
    }
}
