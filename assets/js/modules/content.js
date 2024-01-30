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
            dataType: 'json',
            success: function (response) {
                $('#question').empty();
                if (response.button1) {
                    $('#question').append('<button type="button" class="btn m-1" onclick="question(1)">Evet</button>');
                }
                if (response.button2) {
                    $('#question').append('<button type="button" class="btn m-1" onclick="question(2)">Hayır</button>');
                }
            }
        });
    } else {
        takeID(id)
        $.ajax({
            type: 'POST',
            data: {
                'question': 1,
                "id": id
            },
            url: "controller/contentController.php",
            dataType: 'json',
            success: function (response) {
                takeID(id)
                $('#question').empty();
                if (response.button1) {
                    $('#question').append('<button type="button" class="btn m-1" onclick="question(1)">Evet</button>');
                }
                if (response.button2) {
                    $('#question').append('<button type="button" class="btn m-1" onclick="question(2)">Hayır</button>');
                }
                if(response.message){
                    $('#question').append('<h3>Teşekkürler</h3>');
                }
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