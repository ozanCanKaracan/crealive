ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

function addContent(){
    $.ajax({
        type:"POST",
        data:{
            "addContent":1,
            "text": CKEDITOR.instances['editor'].getData(),
        },
        url:"controller/contentController.php",
        success:function (e){

        }
    })
}