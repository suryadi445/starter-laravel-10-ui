import './bootstrap';

$(document).ready(function () {
    $('.select2').select2({
        theme: 'bootstrap-5',
        placeholder: 'Select an option',
    });

    $('.dropdown-menu-end').click(function () {
        $('.dropdown-menu.small').toggleClass('show')
        $('.dropdown-menu.small').css({
            'position': 'absolute',
            'inset': '0px 0px auto auto',
            'margin': '0px',
            'transform': 'translate3d(-10px, 52px, 0px)'
        });
    })
})
