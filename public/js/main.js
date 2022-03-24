function openClose(id) {
    let elements = document.getElementsByClassName('can_closed_'+id);
    let plus = document.getElementsByClassName('plus_'+id);
    let minus = document.getElementsByClassName('minus_'+id);

    for (let i = 0; i < elements.length; ++i) {
        swichDisplay(elements[i]);
    }

    for (let i = 0; i < plus.length; ++i) {
        swichDisplay(plus[i]);
    }

    for (let i = 0; i < minus.length; ++i) {
        swichDisplay(minus[i]);
    }
}

function updateDescription(text) {
    let el = document.getElementsByClassName('description-wrap');
    if (typeof el[0].innerText !== 'undefined') {
        el[0].innerText = text;
    } else {
        el[0].textContent = text;
    }
}
function swichDisplay(obj) {
    if(obj.style.display === 'none'){
        obj.style.display = '';
    }else{
        obj.style.display = 'none';
    }
}