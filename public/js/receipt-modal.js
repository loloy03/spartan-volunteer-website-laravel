const showModal = document.querySelectorAll('.btn-modal');

$(document).ready(function() {
    $(showModal).click(function() {
        imgPath = '/images/';
        imgFile = $(this).data('receipt-image');
        $('<img>').attr('src', imgPath + imgFile).appendTo('div.image-area');
    })
})
