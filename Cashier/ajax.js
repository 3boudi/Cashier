$(document).ready(function(){
    $('#search').keyup(function(){
        var input = $(this).val().trim();
        if(input !== '') {
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: {input: input},
                success: function(data){
                    $('#result').html(data).show();
                }
            });
        } else {
            $('#result').hide();
        }
    });

    let cart = [];

    $(document).on("click", ".add-to-cart", function(){
        let barcode = $(this).data("barcode");
        let name = $(this).data("name");
        let availableQuantity = $(this).data("quantity");
        let price = $(this).data("price");

        let existing = cart.find(item => item.barcode === barcode);
        if (existing) {
            if (existing.quantity < availableQuantity) {
                existing.quantity++;
            } else {
                alert("Cannot add more than available quantity!");
            }
        } else {
            cart.push({ barcode, name, quantity: 1, price });
        }

        updateCart();
    });

    $(document).on("click", ".delete-item", function(){
        let barcode = $(this).data("barcode");
        cart = cart.filter(item => item.barcode !== barcode);
        updateCart();
    });

    $(document).on("input", ".cart-quantity", function(){
        let barcode = $(this).data("barcode");
        let newQuantity = parseInt($(this).val());
        let item = cart.find(item => item.barcode === barcode);

        if (item) {
            if (newQuantity > item.availableQuantity) {
                alert("Quantity exceeds stock!");
                $(this).val(item.availableQuantity);
            } else if (newQuantity < 1) {
                $(this).val(1);
            } else {
                item.quantity = newQuantity;
            }
        }

        updateCart();
    });

    function updateCart(){
        let cartBody = $("#cart-body");
        cartBody.empty();
        if (cart.length === 0) {
            cartBody.append("<tr><td colspan='5' class='text-center'>Cart is empty</td></tr>");
        } else {
            cart.forEach(item => {
                cartBody.append(`
                    <tr>
                        <td>${item.name}</td>
                        <td><input type="number" class="form-control cart-quantity" data-barcode="${item.barcode}" value="${item.quantity}" min="1"></td>
                        <td>${item.price}</td>
                        <td>${(item.price * item.quantity).toFixed(2)}</td>
                        <td><button class="btn btn-danger delete-item" data-barcode="${item.barcode}">Delete</button></td>
                    </tr>
                `);
            });
        }
    }

    $("#buy").click(function(){
        if (cart.length === 0) {
            alert("Cart is empty!");
            return;
        }

        $.ajax({
            url: "buy.php",
            method: "POST",
            data: {cart: JSON.stringify(cart)},
            success: function(response){
                alert(response);
                cart = [];
                updateCart();
            }
        });
    });

});