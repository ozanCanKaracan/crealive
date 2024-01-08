let table;

function getUserTable(id, langID,columns) {
    console.log(...columns)
    if (langID == 2) {

        if (table) {
            table.destroy()
            table = false
        }

        table = $('#userlistRoleTable').DataTable({
            sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
            order: [0, "desc"],
            ajax: {
                url: 'controller/roleController.php',
                type: 'POST',
                data: {
                    "id": id,
                    "getUserTable": 1,
                }
            },
            columns: [
                {data: 'id', visible: false},
                {data: 'name'},
                ...columns
            ],
        });
    } else {

        if (table) {
            table.destroy()
            table = false
        }

        table = $('#userlistRoleTable').DataTable({
            sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
            order: [0, "desc"],
            ajax: {
                url: 'controller/roleController.php',
                type: 'POST',
                data: {
                    "id": id,
                    "getUserTable": 1,
                }
            },
            columns: [
                {data: 'id', visible: false},
                {data: 'name'},
                ...columns

            ],
            "language": {"url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json"}
        });
    }

}

function langCheckBox(id, langName,userID) {
    console.log(userID)
    var checkedIDs = [];
    var notcheck = [];

    $("." + langName + "Check:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);

    });

    $("." + langName + "Check:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });
    console.log(notcheck , checkedIDs)
    $.ajax({
        type: "POST",
        url: "controller/roleController.php",
        data: {
            "id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "langCheckBox": 1,
            "langName": langName,
            "userID":userID
        },
        success: function (e) {
        }
    });
}
