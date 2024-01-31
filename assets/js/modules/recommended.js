function recommended() {
    $.ajax({
        type: 'POST',
        data: {
            'recommended': 1,
        },
        url: "controller/recommendedController.php",
        success: function (e) {
            var recommendedData = JSON.parse(e);

            $('#recommendedForU').empty();

            for (var i = 0; i < recommendedData.length; i += 3) {
                var row = $('<div class="row">');

                for (var j = 0; j < 3 && i + j < recommendedData.length; j++) {
                    var content = recommendedData[i + j];

                    row.append(
                        '<div class="col-md-4">' +
                        '<div class="card shadow" style="width: 18rem;">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title">' + content.title + '</h5>' +
                        '<p>View Count: ' + content.viewCount + '</p>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );
                }

                $('#recommendedForU').append(row);
            }
        }
    });
}

recommended();
