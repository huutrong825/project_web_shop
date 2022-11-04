// $(document).ready(function(){
//     $image_crop=$('#img_demo').croppie({
//         enanleExif: true,
//         viewport: {
//             width: 200,
//             heigth: 200,
//             type: 'square'
//         },
//         boundary: {
//             width: 300,
//             heigth: 300,
//         }
//     });

//     $('#avatar').on('change', function(){
//         var reader = new FileReader();
//         reader.onload =function (e) {
//             $image_crop.croppie('bind',{
//               url: e.target.result  
//             }).then(function(){
//                 console.log('');
//             });
//         }
//         reader.readAsDataURL(this.files[0]);
//         $('#UploadImg').modal('show');
//     });
// });