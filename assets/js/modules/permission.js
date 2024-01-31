var table;

function languageCheckbox(roleID, type, parentID) {
    var checkedIDs = [];
    var notcheck = [];
    $("." + type + "CheckLanguage:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $("." + type + "CheckLanguage:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });
    $.ajax({
        type: "POST",
        url: "controller/permissionController.php",
        data: {
            "languageCheckbox": 1,
            "roleID": roleID,
            "type": type,
            "parentID": parentID,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
        },
        success: function (response) {

        }
    });
}

function permissionCheckbox(roleID, type) {
    var checkedIDs = [];
    var notcheck = [];
    $("." + type + "Check:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $("." + type + "Check:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });
    $.ajax({
        type: "POST",
        url: "controller/permissionController.php",
        data: {
            "permissionCheckbox": 1,
            "roleID": roleID,
            "type": type,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
        },
        success: function (response) {

        }
    });
}


function getPermissionTable(id, langID, pageID) {

    if (table) {
        table.destroy();
        table = false;
    }

    table = $('#permissionTable').DataTable({
        sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
        ajax: {
            url: 'controller/permissionController.php',
            type: 'POST',
            data: {
                "getPermissionTable": 1,
                "id": id,
                "pageID": pageID
            },
            dataSrc: function (json) {
                var data = json.data.map(function (item) {
                    return {
                        id: item.id,
                        pages: item.pages,
                        add:
                            (item.add.checkBox ? '<input type="checkbox" class="custom-control-input addCheck" id="addCheckBox" value="' + item.id + '" onclick="permissionCheckbox(' + item.add.roleID + ', \'add\')" ' + item.add.check + ' >' : '') +
                            (item.add.checkBoxContent ? '<input type="checkbox" class="custom-control-input addCheckLanguage" id="languageAddCheckBox" value="' + item.add.language + '" onClick="languageCheckbox(' + item.add.roleIDContent + ', \'add\',' + item.id + ')" ' + item.add.checkContent + ' >' : ''),

                        delete:
                            (item.delete.checkBox ? '<input type="checkbox" class="custom-control-input deleteCheck" id="deleteCheckBox" value="' + item.id + '" onclick="permissionCheckbox(' + item.delete.roleID + ', \'delete\')" ' + item.delete.check + ' >' : '') +
                            (item.delete.checkBoxContent ? '<input type="checkbox" class="custom-control-input deleteCheckLanguage" id="languageDeleteCheckBox" value="' + item.delete.language + '" onclick="languageCheckbox(' + item.delete.roleIDContent + ', \'delete\',' + item.id + ')" ' + item.delete.checkContent + ' >' : ''),

                        edit:
                            (item.edit.checkBox ? '<input type="checkbox" class="custom-control-input editCheck" id="editCheckBox" value="' + item.id + '" onclick="permissionCheckbox(' + item.edit.roleID + ', \'edit\')" ' + item.edit.check + ' >' : '') +
                            (item.edit.checkBoxContent ? '<input type="checkbox" class="custom-control-input editCheckLanguage" id="languageEditCheckBox" value="' + item.edit.language + '" onclick="languageCheckbox(' + item.edit.roleIDContent + ', \'edit\',' + item.id + ')" ' + item.edit.checkContent + ' >' : ''),

                        list:
                            (item.list.checkBox ? '<input type="checkbox" class="custom-control-input listCheck" id="listCheckBox" value="' + item.id + '" onclick="permissionCheckbox(' + item.list.roleID + ', \'list\')" ' + item.list.check + ' >' : '')+
                            (item.list.checkBoxContent ? '<input type="checkbox" class="custom-control-input listCheckLanguage" id="languageListCheckBox" value="' + item.list.language + '" onclick="languageCheckbox(' + item.list.roleIDContent + ', \'list\',' + item.id + ')" ' + item.list.checkContent + ' >' : ''),

                        view:
                            (item.view.checkBox ? '<input type="checkbox" class="custom-control-input viewCheck" id="listCheckBox" value="' + item.id + '" onclick="permissionCheckbox(' + item.view.roleID + ', \'view\')" ' + item.view.check + ' >' : '')+
                            (item.view.checkBoxContent ? '<input type="checkbox" class="custom-control-input viewCheckLanguage" id="languageViewCheckBox" value="' + item.view.language + '" onclick="languageCheckbox(' + item.view.roleIDContent + ', \'view\',' + item.id + ')" ' + item.view.checkContent + ' >':''),
                    };
                });
                return data;
            }
        },
        columns: [
            {data: 'id', visible: false},
            {data: 'pages'},
            {data: 'add'},
            {data: 'delete'},
            {data: 'edit'},
            {data: 'list'},
            {data: 'view'},
        ],
        "language": {"url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json"}
    });
    table.page.len(100).draw();

}




