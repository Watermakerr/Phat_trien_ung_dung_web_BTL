<?php
require_once 'header.php';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $sql = "INSERT INTO `categories`(`name`) VALUES ('$name')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thêm thành công')</script>";
        echo "<script>window.location.href = 'show_category.php'</script>";
    } else {
        echo "<script>alert('Thêm thất bại')</script>";
    }
    $conn->close();
}
?>
<div class="row">
    <div class="col-6 mx-auto my-5">
        <form action="" method="post" class="form-group" enctype="multipart/form-data" id="productForm">
            <h1 class="text-center">Thêm danh mục</h1>
            <div class="form-group">
                <label for="">Tên danh mục</label>
                <input type="text" name="name" class="form-control" id="productName">
            </div>
            <input type="submit" name="submit" value="Add" class="btn btn-success">
        </form>
    </div>
</div>

<script>
document.getElementById('productForm').addEventListener('submit', function(e) {
    var name = document.getElementById('productName').value;

    if (name === '') {
        e.preventDefault();
        alert('Vui lòng nhập tên danh mục');
    }
});
</script>
<?php
require_once 'footer.php';
?>