const inputFile = document.querySelector('#file');
const imageArea = document.querySelector('.image-area');

imageArea.addEventListener('click', clickUpload);

function clickUpload() {
    inputFile.click();
}