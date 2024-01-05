function recommended() {
    $.ajax({
        type: 'POST',
        data: {
            'recommended': 1,
        },
        url: "controller/recommendedController.php",
        success: function (e) {

            $('#recommendedForU').empty();
            $('#recommendedForU').append(e);
        }
    });
}

recommended()
