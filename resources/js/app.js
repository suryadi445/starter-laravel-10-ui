import './bootstrap';

$(document).ready(function () {
    // select2
    $('.select2').select2({
        theme: 'bootstrap-5',
        placeholder: 'Select an option',
    });

    // dropdown in avatar for show logout etc
    $('.dropdown-menu-end').click(function () {
        $('.dropdown-menu.small').toggleClass('show')
        $('.dropdown-menu.small').css({
            'position': 'absolute',
            'inset': '0px 0px auto auto',
            'margin': '0px',
            'transform': 'translate3d(-10px, 52px, 0px)'
        });
    })

    // give a star to required fields
    $('input[required], select[required], textarea[required]').each(function () {
        var inputId = $(this).attr('id');
        var label = $('label[for="' + inputId + '"]');

        label.append('<i class="text-danger">*</i>');
    });

    // date picker
    $('.date').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
    }).on('changeDate', function (e) {
        console.log(e.target.value);
    });
})
