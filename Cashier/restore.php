<?php
include 'confige.php';

if (isset($_POST['sale_id'])) {
    $sale_id = $_POST['sale_id'];

    // جلب بيانات المنتج المسترجع
    $stmt = $db->prepare("SELECT * FROM sales WHERE id = :sale_id");
    $stmt->bindParam(':sale_id', $sale_id, PDO::PARAM_INT);
    $stmt->execute();
    $sale = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($sale) {
        // استرجاع الكمية إلى المخزون
        $stmt2 = $db->prepare("UPDATE products SET Quantity = Quantity + :qty WHERE productname = :name");
        $stmt2->bindParam(':qty', $sale['quantity'], PDO::PARAM_INT);
        $stmt2->bindParam(':name', $sale['product_name'], PDO::PARAM_STR);
        $stmt2->execute();

        // حذف السلة من التاريخ بعد الاسترجاع
        $stmt3 = $db->prepare("DELETE FROM sales WHERE id = :sale_id");
        $stmt3->bindParam(':sale_id', $sale_id, PDO::PARAM_INT);
        $stmt3->execute();

        echo "Sale restored successfully!";
    } else {
        echo "Sale not found!";
    }
}
