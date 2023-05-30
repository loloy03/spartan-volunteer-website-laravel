window.livewire.on('imageUploaded', () => {
    let inputField = document.getElementById('file')
    let imageFile = inputField.files[0]

    let reader = new FileReader();

    reader.onloadend = () => {
        window.livewire.emit('processImage', reader.result)
    }
    reader.readAsDataURL(imageFile);
})

const inputFile = document.querySelector('#file');
const imageArea = document.querySelector('.image-area');

imageArea.addEventListener('click', clickUpload);

function clickUpload() {
    inputFile.click();
}