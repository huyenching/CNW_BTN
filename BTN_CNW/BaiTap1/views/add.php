<?php
session_start(); // Khởi tạo session ngay lập tức

// Kiểm tra nếu form đã được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy giá trị từ form
    $sanpham = $_POST['sanpham'];  // Tên sản phẩm
    $gia = $_POST['Gia'];          // Giá sản phẩm

    // Kiểm tra nếu session chưa có mảng products thì khởi tạo
    if (!isset($_SESSION['products'])) {
        $_SESSION['products'] = array();
    }

    // Thêm sản phẩm vào mảng trong session
    $_SESSION['products'][] = array('sanpham' => $sanpham, 'Gia' => $gia);
    header("Location: index.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons/font/bootstrap-icons.min.css">
    <title>Document</title>

</head>
<?php
require "Header.php";
?>
<body>




        <div class="form-container">
            <div class="header">
                <h1>Add Sản phẩm</h1>
            </div>
            <form action="add.php" method="post">
                <label for="sanpham">Tên sản phẩm:</label>
                <input type="text" name="sanpham" placeholder="Nhập tên sản phẩm">

                <label for="Gia">Giá:</label>
                <input type="number" name="Gia" placeholder="Nhập giá sản phẩm">

                <button type="submit">Thêm sản phẩm</button>
            </form>
        </div>
        


</body>

</html>