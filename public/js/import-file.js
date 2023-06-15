const inputFile = document.querySelector('#import-excel');
const importBtn = document.querySelector('.import-btn');

importBtn.addEventListener('click', clickUpload);

function clickUpload() {
    inputFile.click();
}