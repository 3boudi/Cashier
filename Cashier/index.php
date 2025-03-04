<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>CASHIER SYSTEM</title>
</head>
<body>
    <div class="container">
        <div class="mt-5 mb-4" style="text-align: left; margin-left: 20px;">
            <h2>CASHIER SYSTEM</h2>
        </div>

        <input type="text" class="form-control" placeholder="Search for products" style="width: 50%; margin-left: 20px;" id="search">
        <br>
        <div id="result"></div>

        <h3 class="mt-5">🛒 Shopping Cart</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="cart-body">
                <tr><td colspan="5" class="text-center">Cart is empty</td></tr>
            </tbody>
        </table>
        <button class="btn btn-primary" id="buy">Buy</button>
        <a href="historique.php" class="btn btn-secondary mt-3">📜 Sales History</a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="ajax.js"></script>
</body>
</html>
