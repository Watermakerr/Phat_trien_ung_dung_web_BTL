<?php
require 'header.php';
if ($_GET['action'] == 'delete') {
    if (isset($_POST['checkbox'])) {
        $ids = $_POST['checkbox'];
        if (!empty($ids)) {
            $ids = implode(',', array_map('intval', $ids)); // Sanitize the ids
            $sql = "DELETE FROM `products` WHERE product_id IN ($ids)";
            if ($conn->query($sql) !== TRUE) {
                echo "<script>alert('Không thể xóa sản phầm này')</script>";
            } else {
                echo "<script>alert('Xóa thành công')</script>";
            }
        }
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM `products` WHERE product_id = $id";
        if ($conn->query($sql) !== TRUE) {
            echo "<script>alert('Không thể xóa sản phầm này')</script>";
        } else {
            echo "<script>alert('Xóa thành công')</script>";
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
        <a href="index.php" class="btn btn-info float-right mr-1">Quay lại</a>
        <a href="../logout.php" class="btn btn-info float-right">Đăng xuất</a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-sm-12">
        <form action="show_product.php" id="search_form" method="get" class="d-flex flex-nowrap">
            <div class="form-group m-2">
                <input type="text" name="keyword" class="form-control" placeholder="Keyword">
            </div>
            <div class="form-group m-2">
                <select name="category" class="form-control">
                    <option value="">All Categories</option>
                    <?php
                    $categoryResult = $conn->query("SELECT category_id, name FROM categories");
                    while ($category = $categoryResult->fetch_assoc()) {
                        echo "<option value='" . $category['category_id'] . "'>" . $category['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </form>
        <div class="results">
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search_form').on('change', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'search_product.php',
                type: 'get',
                data: $('#search_form').serialize(),
                success: function(data) {
                    $('.results').html(data);
                }
            });
        });
        $('#search_form').trigger('change');
    });
</script>
<?php
require 'footer.php';
?>