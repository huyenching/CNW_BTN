<?php
session_start();

// Kiểm tra nếu dữ liệu `id` được gửi qua phương thức POST
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

// Lấy id sản phẩm từ tham số trong URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

    // Kiểm tra nếu sản phẩm tồn tại trong session
    if (isset($_SESSION['products'][$id])) {


    }
// Nếu id hợp lệ, lấy dữ liệu sản phẩm
    $product = null;
    if ($id !== null && isset($_SESSION['products'][$id])) {
        $product = $_SESSION['products'][$id];
    }
    else {
        @($product = null);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $product !== null) {
        unset($_SESSION['products'][$id]); // Xóa sản phẩm khỏi session
        header('Location: index.php'); // Chuyển hướng về trang danh sách
    exit;
}
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xóa sản phẩm</title>
</head>
<body>
<h2> Xóa sản phẩm</h2>
<?php if($product) : ?>
    <form action="delete.php?id=<?= $id ?>" method="post" style="display:inline">
        <label for="sanpham">Tên sản phẩm:</label>
        <input type="text" name="sanpham" value="<?=htmlspecialchars($product['sanpham'])?>" required>

        <label for="Gia">Giá:</label>
        <input type="number" name="Gia" value="<?=htmlspecialchars($product['Gia'])?>" required>

        <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</button>
    </form>
<?php else : ?>
    <p> Sản phẩm không tồn tại</p>
<?php endif; ?>
</body>
</html>
