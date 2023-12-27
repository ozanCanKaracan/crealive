function question(number) {
    if (number) {
        $.ajax({
            type: 'POST',
            data: {
                'question': 1,
                'number': number,
                "id": id,
            },
            url: "controller/contentController.php",
            success: function (e) {

                $('#question').empty();
                $('#question').append(e);
            }
        });
    } else {
        takeID(id)
        $.ajax({
            type: 'POST',
            data: {
                'question': 1,
                "id" : id
            },
            url: "controller/contentController.php",
            success: function (e) {
                takeID(id)
                $('#question').empty();
                $('#question').append(e);
            }
        });
    }
}

function takeID(id) {
    $.ajax({
        type: 'POST',
        data: {
            'question': 1,
            "id": id,
        },
        url: "controller/contentController.php",

    });
}