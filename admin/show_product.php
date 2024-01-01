<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    require 'header.php';
    if ($_GET['action'] == 'delete'){
        if (isset($_POST['checkbox'])) {
            $ids = $_POST['checkbox'];
            if (!empty($ids)) {
                $ids = implode(',', array_map('intval', $ids)); // Sanitize the ids
                $sql = "DELETE FROM `products` WHERE product_id IN ($ids)";
                if ($conn->query($sql) !== TRUE) {
                    echo "<script>alert('Không thể xóa sản phầm này')</script>";  
                }
                else{
                    header("Location: show_product.php");
                }
            }
        }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM `products` WHERE product_id = $id";
            if ($conn->query($sql) !== TRUE) {
                echo "<script>alert('Không thể xóa sản phầm này')</script>";  
            }
        }
    }
    ?>
    <div class="row bg-dark mr-0 py-1">
        <div class="col-sm-6">
            <h1 class="text-center text-white float-left ml-3 ">Show product</h1>
        </div>
        <div class="col-sm-6 my-auto">
            <a href="create_product.php" class="btn btn-info float-right mr-1">
                <i class="fas fa-plus"></i> Thêm sản phẩm mới
            </a>
            <a href="index.php" class="btn btn-info float-right mr-1">Trang chủ</a>
            <a href="../logout.php" class="btn btn-info float-right">Đăng xuất</a>
        </div>
    </div>
    <?php
    $limit = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $sql = "SELECT `product_id`,products.name, `image`, `price`,
            `description`, categories.name as `catName`  FROM `products`
            INNER JOIN categories on categories.category_id = products.category_id
            order by products.create_at DESC LIMIT $start, $limit";
    $result = $conn->query($sql);

    $total_result = $conn->query("SELECT COUNT(*) as total FROM `products`");
    $total_row = $total_result->fetch_assoc();
    $total_pages = ceil($total_row['total'] / $limit);

    if ($result->num_rows > 0) { ?>
        <form action="?action=delete" method="post">
            <table class='table table-bordered table-striped text-center'>
                <thead class='thead-dark'>
                    <tr>
                        <th></th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Danh mục</th>
                        <th>Giá thành</th>
                        <th>Mô tả</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = ($page - 1) * $limit + 1;
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                        <td><input type="checkbox" name="checkbox[]" value="<?php echo $row['product_id']; ?>"></td>                            <td><?php echo $row['name'] ?></td>
                            <td>
                                <img class="card-img-top" style="width: 5rem;" src="../asset/image/<?php echo $row['image'] ?>" alt="Card image cap">
                            </td>
                            <td><?php echo $row['catName'] ?></td>
                            <td><?php echo $row['price'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><a href='update_product.php?id= <?php echo $row['product_id'] ?> '><i class='fas fa-edit'></i></a>
                                <a href='?action=delete&id=<?php echo $row['product_id'] ?>' class='ml-1' onclick='return confirmDelete()'><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    <?php
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
            <input type="submit" name="delete" value="Delete Selected" onclick="return confirmDelete()">
        </form>
    <?php
    } else {
        echo "0 results";
    }
    echo "<ul class='pagination justify-content-center'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<li class='page-item'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
    }
    ?>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this product?");
        }
    </script>
</body>

</html>