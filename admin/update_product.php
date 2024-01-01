<!DOCTYPE html>
<html lang="en">
<body>
    <?php
    require 'header.php';
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
        <form action="" method="post" class="form-group" enctype="multipart/form-data">
            <h1 class="text-center">Sửa sản phẩm</h1>
            <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']?>">
            </div>
            <div class="form-group mt-3">
                <label for="category">Danh mục</label><br>
                <select name="category_id" id="category_id" class="form-select w-100">
                    
                    <?php
                    if (mysqli_num_rows($result_1) > 0) {
                        while ($row_1 = mysqli_fetch_assoc($result_1)) { ?>
                            <option selected value="<?php echo $row['category_id'] ?>"><?php echo $row_1['name'] ?></option>

                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="product">Giá</label>
                <input type="number" name="price" class="form-control" min="0" value="<?php echo $row['price']?>">
            </div>
            <div class="form-group mt-3">
                <label for="description">Mô tả</label>
                <input type="text" name="description" class="form-control" value="<?php echo $row['description']?>">
            </div>
            
            <input type="submit" name="submit" value="Update" class="btn btn-success">
        </form>
        </div>
        <?php
        if (isset($_POST['submit'])) {
            $id = $_GET['id'];
            $name = $_POST['name'];
            $category = $_POST['category_id'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $sql = "UPDATE `products` SET 'name'=$name, 'category_id'=$category,  'price'=$price, 'description'=$description WHERE `product_id` = '$id'";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Record updated successfully')</script>";
                echo "<script>window.location.href = 'show_product.php'</script>";
            } else {
                echo "<script>alert('Error updating record')</script>";
            }
            $conn->close();
        }
        ?>
</body>
</html>