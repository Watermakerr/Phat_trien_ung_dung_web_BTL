<?php
require 'header.php';
$id = $_GET['id'];

$sql = "SELECT image FROM `products` WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$image = $row['image'];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $category = $_POST['category_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file = $_FILES['image'];
        $file_name = $file['name'];
        if ($file['type'] == 'image/png' || $file['type'] == 'image/jpg' || $file['type'] == 'image/jpeg' || $file['type'] == 'image/webp') {
            $image = $file['name'];
        } else {
            echo "<script>alert('Lỗi định dạng file ảnh')</script>";
            echo "<script>window.location.href = 'update_product.php?id=$id'</script>";
        }
    }

    $sql = "UPDATE `products` SET name=?, category_id=?, price=?, description=?, image=? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siissi", $name, $category, $price, $description, $image, $id);
    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thành công')</script>";
        echo "<script>window.location.href = 'show_product.php'</script>";
    } else {
        echo "<script>alert('Error updating record')</script>";
    }
    $conn->close();
}
?>
<?php
$sql_1 = "SELECT category_id, name FROM  categories";
$result_1 = mysqli_query($conn, $sql_1);

$id = $_GET['id'];
$sql = "SELECT * FROM `products` WHERE `product_id` = '$id'";
$result = $conn->query($sql);
if ($result->num_rows <= 0) {
    die("Record not found");
} else {
    $row = $result->fetch_assoc();
}
?>
<div class="row">
    <div class="col-6 mx-auto my-5">
        <form action="update_product.php?id=<?php echo $id ?>" method="post" class="form-group" enctype="multipart/form-data">
            <h1 class="text-center">Sửa sản phẩm</h1>
            <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>">
            </div>
            <div class="form-group mt-3">
                <label for="category">Danh mục</label><br>
                <select name="category_id" id="category_id" class="form-select w-100">
                    <?php
                    if (mysqli_num_rows($result_1) > 0) {
                        while ($row_1 = mysqli_fetch_assoc($result_1)) { ?>
                            <option value="<?php echo $row_1['category_id'] ?>"><?php echo $row_1['name'] ?></option>

                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="product">Giá</label>
                <input type="number" name="price" class="form-control" min="0" value="<?php echo $row['price'] ?>">
            </div>
            <div class="form-group mt-3">
                <label for="description">Mô tả</label>
                <input type="text" name="description" class="form-control" value="<?php echo $row['description'] ?>">
            </div>
            <div class="form-group mt-3">
                <label for="image">Hình ảnh</label>
                <input type="file" id="image" name="image"><br>
                <span>Ảnh cũ:</span>
                <img src="../asset/image/<?php echo $image; ?>" alt="Old image" style="width: 100px; height: auto;">
            </div>

            <input type="submit" name="submit" value="Update" class="btn btn-success">
        </form>
    </div>
</div>
<?php
require 'footer.php';
?>