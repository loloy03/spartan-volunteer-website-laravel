const showModal = document.querySelectorAll('.btn-modal');

$(document).ready(function() {
    $(showModal).click(function() {
        imgPath = '/images/';
        imgFile = $(this).data('volunteer-image');
        $('div.image-area img').attr('src', imgPath + imgFile);
    })
})

