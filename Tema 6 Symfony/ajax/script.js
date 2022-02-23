
function getData(var) {

    $.ajax({
        type: "GET",
        url: "/ruta",
        data: { dato: var },

        // ------v-------use it as the callback function
        success: function(data) {
            alert(data);
        },
        error: function(request, error) {
            alert(errorJS);
            // console.log(request, error);
        }
    });
}
