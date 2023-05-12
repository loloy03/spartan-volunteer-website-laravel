const checkBox = document.querySelector('input[type=checkbox]');
const tableRow = document.querySelector('.table-row');

tableRow.addEventListener('click', function() {
    checkBox.click();
});

$(document).ready(function () {
    tableRow.addEventListener('click', function() {
        checkBox.click();
    });
});