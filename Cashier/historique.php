<?php
include 'confige.php';

// جلب جميع السلات السابقة
$stmt = $db->query("SELECT * FROM sales ORDER BY sale_date DESC");
$sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">📜 Sales History</h2>
        <a href="/cashier" class="btn btn-primary mb-3">🏠 Back to Cashier</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sale ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Sale Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale): ?>
                    <tr>
                        <td><?= $sale['id'] ?></td>
                        <td><?= htmlspecialchars($sale['product_name']) ?></td>
                        <td><?= $sale['quantity'] ?></td>
                        <td><?= number_format($sale['total_price'], 2) ?></td>
                        <td><?= $sale['sale_date'] ?></td>
                        <td>
                            <button class="btn btn-warning restore-sale" data-sale-id="<?= $sale['id'] ?>">🔄 Restore</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).on("click", ".restore-sale", function(){
            let saleId = $(this).data("sale-id");
            if (confirm("Are you sure you want to restore this sale?")) {
                $.ajax({
                    url: "restore.php",
                    method: "POST",
                    data: { sale_id: saleId },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    }
                });
            }
        });
    </script>
</body>
</html>
