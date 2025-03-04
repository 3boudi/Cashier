<?php
include 'confige.php';

if (isset($_POST['input'])) {
    $input = trim($_POST['input']); // إزالة المسافات الزائدة
    try {
        $stmt = $db->prepare("SELECT * FROM products WHERE productname COLLATE utf8mb4_general_ci LIKE :input");
        $stmt->bindValue(':input', '%' . $input . '%', PDO::PARAM_STR);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
        exit;
    }
}

if (!empty($products)): ?>
    <table class="table table-bordered table-striped mt-4">
        <thead>
            <tr>
                <th>Barcode</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['Barcode']) ?></td>
                    <td><?= htmlspecialchars($row['productname']) ?></td>
                    <td><?= htmlspecialchars($row['Quantity']) ?></td>
                    <td><?= htmlspecialchars($row['Price']) ?></td>
                    <td><button class="btn btn-success add-to-cart" data-barcode="<?= $row['Barcode'] ?>" data-name="<?= htmlspecialchars($row['productname']) ?>" data-quantity="<?= $row['Quantity'] ?>" data-price="<?= $row['Price'] ?>">Add</button></td>
                </tr>    
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-warning mt-4" role="alert">
        No products found.
    </div>
<?php endif; ?>
