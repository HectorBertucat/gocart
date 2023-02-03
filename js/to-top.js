$('<div></div>')
    .attr('id', 'scrolltotop')
    .hide()
    .css({
        'z-index': '1000',
        'position': 'fixed',
        'bottom': '15px',
        'right': '2%',
        'cursor': 'pointer',
        'width': '45px',
        'height': '45px',
        'background': '#9797975b',
        'opacity': '1',
        'border-radius': '4px'

    })
    .appendTo('body')
    .click(function() {
        $('html,body').animate({
            scrollTop: 0
        }, 'slow');
    });
$('<div></div>')
    .css({
        'width': '15px',
        'height': '15px',
        'transform': 'rotate(-135deg)',
        'border': 'solid #ffffff',
        'border-width': '0 3px 3px 0',
        'padding': '3px',
        'margin-top': '20px',
        'margin-left': '15px'
    })
    .appendTo('#scrolltotop');
$(window).scroll(function() {
    if ($(window).scrollTop() < 500) {
        $('#scrolltotop').fadeOut();
    } else {
        $('#scrolltotop').fadeIn();
    }
});