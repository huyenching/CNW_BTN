

<?php
session_start(); // Khởi tạo session

// Kiểm tra nếu session chứa sản phẩm
if (isset($_SESSION['products'])) {
    $products = $_SESSION['products']; // Lấy dữ liệu sản phẩm từ session
} else {
    $products = array(); // Nếu chưa có sản phẩm nào
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<body>


<div class="mt-4 px-4 bg-info p-2 d-flex justify-content-between align-items-center">
    <h2>
        Danh Sách <span class="fw-semibold">Sản phẩm</span>
    </h2>
</div>

<table class="table container table-striped mt-3">
    <div>
        <a href="add.php" target="_blank">
            <button  class="btn" , style="background-color: #a6b5cc">Thêm sản phẩm</button>
        </a>
         </div>
    <tr>
        <th> Name</th>
        <th>Price</th>
        <th>Xóa</th>
        <th>Sửa</th>
    </tr>
    <tbody id="productTable">
    <?php if (empty($_SESSION['products'])) : ?>
        <tr>
            <td colspan="4">Không có sản phẩm nào.</td>
        </tr>
    <?php else : ?>
        <?php foreach ($_SESSION['products'] as $index => $product) : ?>
            <tr>
                <td><?= htmlspecialchars($product['sanpham']); ?></td>
                <td><?= htmlspecialchars($product['Gia']); ?> VND</td>
                <td>
                    <a href="delete.php?id=<?= $index ?>" >
                    <button class="btn"><i class="bi bi-trash-fill"></i></button>
                    </a>
                </td>
                <td>
                    <a href="edit.php?id=<?= $index ?>" >
                        <button class="btn"><i class="bi bi-pencil-fill"></i></button>
                    </a>
                </td>

            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>


</table>

</body>
</html>
