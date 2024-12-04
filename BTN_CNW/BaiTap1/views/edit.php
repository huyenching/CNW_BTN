<?php
session_start();

// Kiểm tra nếu sản phẩm đã có trong session
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

// Lấy id sản phẩm từ tham số trong URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Nếu id hợp lệ, lấy dữ liệu sản phẩm
$product = null;
if ($id !== null && isset($_SESSION['products'][$id])) {
    $product = $_SESSION['products'][$id];
}
else {
    @($product = null);
}

// Nếu form được submit, cập nhật sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $sanpham = $_POST['sanpham'];
    $gia = $_POST['Gia'];

    // Cập nhật sản phẩm trong mảng
    $_SESSION['products'][$id] = array('sanpham' => $sanpham, 'Gia' => $gia);

    // Chuyển hướng về trang danh sách sản phẩm
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update sản phẩm</title>
</head>
<body>
    <h2> Sửa sản phẩm</h2>
    <?php if($product) : ?>
        <form action="edit.php?id=<?= $id ?>" method="post">
        <label for="sanpham">Tên sản phẩm:</label>
        <input type="text" name="sanpham" value="<?=htmlspecialchars($product['sanpham'])?>" required>

        <label for="Gia">Giá:</label>
        <input type="number" name="Gia" value="<?=htmlspecialchars($product['Gia'])?>" required>

        <button type="submit">Cập nhật</button>
    </form>
    <?php else : ?>
            <p> Sản phẩm không tồn tại</p>
    <?php endif; ?>
</body>
</html>
