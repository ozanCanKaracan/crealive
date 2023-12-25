let table;

function getUserTable(id, langID) {
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
            ],
            "language": {"url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json"}
        });
    }

}

function turkishCheckBox(id) {
    var checkedIDs = [];
    var notcheck = [];

    $(".turkishCheck:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $(".turkishCheck:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });

    $.ajax({
        type: "POST",
        url: "controller/roleController.php",
        data: {
            "id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "turkishCheckBox": 1,
        },
        success: function (response) {

        }
    });
}

function germanCheckBox(id) {
    var checkedIDs = [];
    var notcheck = [];

    $(".germanCheck:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $(".germanCheck:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });

    $.ajax({
        type: "POST",
        url: "controller/roleController.php",
        data: {
            "id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "germanCheckBox": 1,
        },
        success: function (response) {

        }
    });
}

function englishCheckBox(id) {
    var checkedIDs = [];
    var notcheck = [];

    $(".englishCheck:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $(".englishCheck:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });

    $.ajax({
        type: "POST",
        url: "controller/roleController.php",
        data: {
            "id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "englishCheckBox": 1,
        },
        success: function (response) {

        }
    });
}

function frenchCheckBox(id) {
    var checkedIDs = [];
    var notcheck = [];

    $(".frenchCheck:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $(".frenchCheck:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });

    $.ajax({
        type: "POST",
        url: "controller/roleController.php",
        data: {
            "id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "frenchCheckBox": 1,
        },
        success: function (response) {

        }
    });
}


