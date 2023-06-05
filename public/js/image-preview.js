const inputFile = document.querySelector('#file');
const imageArea = document.querySelector('.image-area');

imageArea.addEventListener('click', clickUpload);

function clickUpload() {
    inputFile.click();
}

inputFile.addEventListener('input', function () {
    const image = this.files[0];
    const reader = new FileReader();
    reader.onload = ()=> {
        const allImage = imageArea.querySelectorAll('img');
        allImage.forEach(item=> item.remove());
        const imgUrl = reader.result;
        const img = document.createElement('img');
        img.src = imgUrl;
        imageArea.appendChild(img);
    }
    reader.readAsDataURL(image);
});









