<?php
include 'header.php';

$limit = 16;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT * FROM `products`";
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql .= " WHERE category_id = $category";
} elseif (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $sql .= " WHERE name LIKE '%$keyword%'";
}
$sql .= " ORDER BY `create_at` DESC LIMIT $start, $limit";
$result = $conn->query($sql);

$total_result = $conn->query("SELECT COUNT(*) as total FROM `products`");
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);
?>

<!-- title for newest -->
<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center text-danger">
            <?php
                if (isset($_GET['category'])) {
                    echo "Sản phẩm theo danh mục";
                } elseif (isset($_GET['keyword'])) {
                    echo "Kết quả tìm kiếm cho: " . $_GET['keyword'];
                } else {
                    echo "Sản phẩm mới nhất";
                }
                ?>
            </h2>
            <h4 class="text-center text-info">
                <?php echo "Tổng số sản phẩm: " . $result->num_rows; ?>
            </h4>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 40px;">
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card mx-auto" style="width: 12rem;">
                        <img class="card-img-top card mx-auto border-0" src="asset/image/<?php echo $row['image'] ?>" alt="Card image cap" style="width: 10rem; height: 10rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                <a href="product.php?id=<?php echo $row['product_id'] ?>" class="card-link"><?php echo $row['name'] ?></a>
                            </h5>
                            <p class="card-text text-center"><?php echo number_format($row['price'], 0, '', ',') ?> đ</p>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
</div>

<div class="container">
    <ul class='pagination justify-content-center'>
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<li class='page-item'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
        }
        ?>
    </ul>
</div>

<?php
include 'footer.php';
?>