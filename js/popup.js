function popup(overlay) {
console.log(overlay)
    var o = document.getElementById(overlay);

    o.style.display = 'block';

}

function closepopup(overlay) {

    var o = document.getElementById(overlay);

    o.style.display = 'none';

}