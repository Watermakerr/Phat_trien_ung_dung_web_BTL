<?php
require_once 'header.php';
$sql = "SELECT category_id, name from categories";
$result = mysqli_query($conn, $sql);

$error = [];
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    if ($name == "" || $category_id == "" || $price == "" || $description == "") {
        $error[] = "Thông tin đang bỏ trống";
    }
    // check if file image is valid, if not error = "Lỗi định dạng file ảnh"
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $file_name = $file['name'];
        if ($file['type'] == 'image/png' || $file['type'] == 'image/jpg' || $file['type'] == 'image/jpeg' || $file['type'] == 'image/webp') {
            $image = $file['name'];
        } else {
            $error[] = "Lỗi định dạng file ảnh";
        }
    }
    if (count($error) == 0) {
        $sql = "INSERT INTO `products`(`name`, `category_id`, `price`,`description`, `image`) VALUES ('$name','$category_id','$price','$description','$image')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Thêm sản phẩm thành công')</script>";
            echo "<script>window.location.href = 'show_product.php'</script>";
        }
    }
}
?>
<div class="row">
    <div class="col-6 mx-auto my-5">
        <?php if (count($error) > 0) : ?>
            <?php for ($i = 0; $i < count($error); $i++) : ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Error: </strong><?php echo $error[$i]; ?></p>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
        <form action="" method="post" class="form-group" enctype="multipart/form-data">
            <h1 class="text-center">Thêm sản phẩm</h1>
            <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <input type="text " name="name" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label for="category">Danh mục</label><br>
                <select name="category_id" id="category" class="form-select w-100">
                    <option selected value="">Chọn danh mục</option>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['category_id'] ?>"><?php echo $row['name'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="product">Giá</label>
                <input type="number" name="price" class="form-control" min="0">
            </div>
            <div class="form-group mt-3">
                <label for="description">Mô tả</label>
                <input type="text" name="description" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label for="image">Hình ảnh</label>
                <input type="file" id="image" name="image">
            </div>
            <input type="submit" name="submit" value="Add" class="btn btn-success">
        </form>
    </div>
</div>
<?php
require_once 'footer.php';
?>