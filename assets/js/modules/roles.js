var jQuery = $.noConflict();

let tableX;
function getRoleTable() {
    if (tableX) {
        tableX.destroy()
        tableX = false
    }

    tableX = $('#roleTable').DataTable({
        sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
        order: [0, "desc"],
        ajax: {
            url: 'controller/roleController.php',
            type: 'POST',
            data: {
                "getRoleTable": 1,
            }
        },
        columns: [
            { data: 'id', visible: false },
            { data: 'role_name' },
            { data: 'process' },
        ],
        "language": { "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json" }
    });

}
function addRole(){
    $.ajax({
        type:"POST",
        data:{
            "addRole":1,
            "roleName":$("#role").val(),
        },
        url:"controller/roleController.php",
        success:function (e){
            if(e.trim() === "bos"){
                Swal.fire({
                    title: 'Hata!',
                    text: 'Rol Ekleme Kısmını Boş Bırakmayınız!',
                    icon: 'error',
                    timer: 1500,
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6'
                })
            }else if(e.trim() === "hata"){
                Swal.fire({
                    title: 'Hata!',
                    text: 'Bu isimde rol bulunuyor!',
                    icon: 'error',
                    timer: 1500,
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6'
                })
            }
            else if(e.trim() === "ok"){
                Swal.fire({
                    title: 'Başarılı!',
                    text: 'Rol Eklendi!',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    getRoleTable();
                });
            }
        }
    })
}


getRoleTable();