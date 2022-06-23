// let canvas = $("#canvas"),
//     context = canvas.get(0).getContext("2d"),
//     $result = $('#result');
//
// $('#fileInput').on('change', function cropFoto () {
//
//     if (this.files && this.files[0]) {
//         if (this.files[0].type.match(/^image\//)) {
//
//             console.log(this.files)
//
//             $('#fileInput').hide();
//             $('#crop_btns').append(
//                 '<input type="button" id="andereFoto" value="Andere Foto">' +
//                 '<input type="button" id="btnCrop" value="Bijsnijden"/>' +
//                 '<input type="button" id="btnRestore" value="Origineel"/>'
//             );
//
//             var reader = new FileReader();
//             reader.onload = function (evt) {
//                 var reader = new FileReader();
//                 img.onload = function () {
//                     context.canvas.height = img.height;
//                     context.canvas.width = img.width;
//                     context.drawImage(img, 0, 0);
//                     var cropper = canvas.cropper({
//                         zoomable: true,
//                         aspectRatio: 1 / 1,
//                         dragMode: 'move',
//                         cropBoxMovable: false,
//                         cropBoxResizable: false,
//                         minCropBoxWidth: img.height,
//                         minCropBoxHeight: img.height,
//                     });
//                     $('#btnCrop').click(function () {
//                         // Get a string base 64 data urlss
//
//                         let croppedImageDataURL = canvas.cropper('getCroppedCanvas').toDataURL("image/png");
//
//                         $result.html($(
//                             '<img src="' + croppedImageDataURL + '">' +
//                             '<input type="hidden" name="profiel_img" value="' + croppedImageDataURL + '">' +
//                             ''));
//
//                         $('#btnCrop').remove();
//                         $('#btnRestore').remove();
//                     });
//                     $('#btnRestore').click(function () {
//                         document.getElementById('fileInput').value = null;
//                         canvas.cropper('clear');
//                     });
//
//                     $('#andereFoto').click(function() {
//
//                         $result.html($(
//                             '<canvas id="canvas">Your browser does not support the HTML5 canvas element.</canvas>'
//                             ));
//                         document.getElementById('fileInput').value= null;
//                         $('#fileInput').show();
//
//                         $('#andereFoto').remove();
//                         $('#btnCrop').remove();
//                         $('#btnRestore').remove();
//                     })
//                 };
//                 img.src = evt.target.result;
//             };
//             reader.readAsDataURL(this.files[0]);
//         } else {
//             alert("Invalid file type! Please select an image file.");
//         }
//     } else {
//         alert('No file(s) selected.');
//     }
// });

// vars



$('.hide').hide();

let result = document.querySelector('.result'),
    img_result = document.querySelector('.img-result'),
    save = document.querySelector('.save'),
    cropped = document.querySelector('.cropped'),
    upload = document.querySelector('#file-input'),
    cropper = '';

// on change show image with crop options
upload.addEventListener('change', (e) => {

    $(img_result).show();
    cropped.src = '';
    if (e.target.files.length) {
        // start file reader
        const reader = new FileReader();
        reader.onload = (e)=> {
            if(e.target.result){
                // create new image
                let img = document.createElement('img');
                img.id = 'image';
                img.src = e.target.result
                // clean result before
                result.innerHTML = '';
                // append new image
                result.appendChild(img);
                // show save btn and options
                save.classList.remove('hide');
                // init cropper
                cropper = new Cropper(img, {
                    zoomable: true,
                    aspectRatio: 1 / 1,
                    dragMode: 'move',
                    cropBoxMovable: false,
                    cropBoxResizable: false,
                    minCropBoxWidth: 450,
                    minCropBoxHeight: 450,
                });
            }
        };
        reader.readAsDataURL(e.target.files[0]);
    }
    $('.hide').show();
});

$('.crop_btn').click(function () {
    document.getElementById("save_btn").disabled = false;
})

// save on click
save.addEventListener('click',(e)=>{
    e.preventDefault();
    // get result to data uri
    let imgSrc = cropper.getCroppedCanvas({
        width: 1186// input value
    }).toDataURL();
    // remove hide class of img
    cropped.classList.remove('hide');
    img_result.classList.remove('hide');
    // show image cropped
    cropped.src = imgSrc;
    $(img_result).hide();

    $('.imgURL').html('<input type="hidden" id="profiel_img" name="profiel_img" value="' + imgSrc + '">')
    console.log(imgSrc);
});