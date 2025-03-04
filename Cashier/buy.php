<?php
include 'confige.php';

if (isset($_POST['cart'])) {
    $cart = json_decode($_POST['cart'], true);
    
    foreach ($cart as $item) {
        // تحديث الكمية في قاعدة البيانات
        $stmt = $db->prepare("UPDATE products SET Quantity = Quantity - :qty WHERE Barcode = :barcode AND Quantity >= :qty");
        $stmt->bindParam(':qty', $item['quantity'], PDO::PARAM_INT);
        $stmt->bindParam(':barcode', $item['barcode'], PDO::PARAM_STR);
        $stmt->execute();

        // تخزين عملية البيع
        $stmt2 = $db->prepare("INSERT INTO sales (product_name, quantity, total_price, sale_date) VALUES (:name, :qty, :total, NOW())");
        $stmt2->bindParam(':name', $item['name'], PDO::PARAM_STR);
        $stmt2->bindParam(':qty', $item['quantity'], PDO::PARAM_INT);
        $total = $item['price'] * $item['quantity'];
        $stmt2->bindParam(':total', $total, PDO::PARAM_STR);
        $stmt2->execute();
    }

    echo "Purchase successful!";
}
