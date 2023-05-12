const showModalButtons = document.querySelectorAll('.btn-modal');

$(document).ready(function() {
    $(showModalButtons).click(function() {
        imgUrl = $(this).data('volunteer_photo');
        $('#image img').attr('src', '/images/' + imgUrl);
    })
})

