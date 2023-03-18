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
                let nbCarts = 0;

                // structure of div to add
                // <div id="cart_1" style="position:absolute;margin-left:" + cart['x'] + "%;margin-top:" + cart['y'] + "%">
                //    <div className="cart_dot"></div>
                // </div>
                if (data) {
                    $.each(data, function(index, cart) {
                        if (cart['state'] == 3 || cart['state'] == 4) {
                            let cart_class = "";
                            if (cart['state'] == 3) {
                                cart_class = "cart_dot_working";
                            } else {
                                cart_class = "cart_dot_assistance";
                            }
                            nbCarts++;

                            var div = document.createElement("div");
                            div.id = "cart_" + cart['id'];
                            div.style.position = "absolute";
                            div.style.marginLeft = cart['x'] + "%";
                            div.style.marginTop = cart['y'] + "%";

                            var divDot = document.createElement("div");
                            divDot.className = cart_class;

                            div.appendChild(divDot);

                            $("#cart_list").append(div);
                            $("#nb_carts").text(nbCarts);
                        }
                    });
                }
            }});
    }
}

// on page load, call updateCartList() function
updateCartList();

var autoRefreshCarts = window.setInterval(function(){
    // update all charts every 10 seconds
    updateCartList();
}, 10000);