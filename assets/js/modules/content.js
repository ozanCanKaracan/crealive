
function question(id, number) {
    console.log(id);
    if (number == 1) {
        $.ajax({
            type: 'POST',
            data: {
                'question': 1,
                'number': number,
                "id":id,
            },
            url: "controller/contentController.php",
            success: function (e) {
                $('#question').empty();
                $('#question').append(e);
            }
        });
    } else {
        $.ajax({
            type: 'POST',
            data: {
                'question': 1
            },
            url: "controller/contentController.php",
            success: function (e) {
                $('#question').empty();
                $('#question').append(e);
            }
        });
    }

}

