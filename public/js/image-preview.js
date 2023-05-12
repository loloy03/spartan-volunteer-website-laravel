const selectImage = document.querySelector('.image-area');
const inputFile = document.querySelector('#file');
const imageArea = document.querySelector('.image-area');
const uploadInfo = document.querySelector('.upload-info')
const removeImgArea = document.querySelector('.remove-img');
const removeImgBtn = document.querySelector('#removeImg');

function clickUpload() {
    inputFile.click();
}
//imageArea.addEventListener('click', clickUpload);

// EventListener to get image input and display over a div
inputFile.addEventListener('input', function () {
    const image = this.files[0];
    console.log(image);
    const reader = new FileReader();
    reader.onload = ()=> {
        const allImage = imageArea.querySelectorAll('img');
        allImage.forEach(item=> item.remove());
        const imgUrl = reader.result;
        const img = document.createElement('img');
        img.src = imgUrl;
        imageArea.appendChild(img);
        imageArea.classList.add('active');

        sessionStorage.setItem('imageData', imgUrl);
    }
    reader.readAsDataURL(image);
});

// Persist image 
if (sessionStorage.getItem('imageData')) {
    const imgUrl = sessionStorage.getItem('imageData');
    const img = document.createElement('img');
    img.src = imgUrl;
    imageArea.appendChild(img);
    imageArea.classList.add('active');
} 

document.addEventListener('DOMContentLoaded', function() {
    if(inputFile.files.length > 0) {
        showRemoveBtn();
    }else {
        showUploadInfo();
    }
})

// Show remove button after img is uploaded
inputFile.addEventListener('change', showRemoveBtn);

// Removes img
removeImgBtn.addEventListener('click', function() {
    removeImage();
    showUploadInfo();
});


// Shows upload info and hides remove button
function showUploadInfo() {
    uploadInfo.removeAttribute('hidden');
    addHiddenAtt();

    imageArea.removeEventListener('mouseover', removeHiddenAtt);
    imageArea.removeEventListener('mouseout', addHiddenAtt);

    imageArea.addEventListener('click', clickUpload);
}

function removeHiddenAtt() {
    removeImgArea.removeAttribute('hidden');
}

function addHiddenAtt() {
    removeImgArea.setAttribute('hidden', true);
}

// Shows remove button, hides upload info
function showRemoveBtn() {
    uploadInfo.setAttribute('hidden', true);

    imageArea.addEventListener('mouseover', removeHiddenAtt);

    imageArea.addEventListener('mouseout', addHiddenAtt);

    imageArea.removeEventListener('click', clickUpload);
};

// Function to remove image
function removeImage() {
    inputFile.value='';
    sessionStorage.removeItem('imageData');

    const img = document.querySelector('.image-area img');
    img.remove();
};







