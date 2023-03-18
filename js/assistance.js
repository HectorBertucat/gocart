function updateCartList() {
    // if div with id "cart_list" exists
    if ($("#cart_list").length) {
        var url = "index.php?controller=tablet_screen&carts=list";
        $.ajax({
            url: url,
            type: "GET",
            async: false,
            dataType: "json",
            success: function(data) {
                $("#cart_list").empty();
                if (data) {
                    $.each(data, function(index, cart) {
                        var div = $("<div/>", {
                            "class": "tab_bubble clickable"
                        });
                        var h5 = $("<h5/>", {
                            text: "Chariot n°" + cart['number']
                        });
                        div.append(h5);

                        // empty the div with id "cart_list"
                        $("#cart_list").append(div);
                    });
                }
            }});
    }
}

var autoRefreshCarts = window.setInterval(function(){
    // update all charts every 10 seconds
    updateCartList();
}, 10000);