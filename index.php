<?php
include 'header.php';

$limit = 16;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql = "SELECT products.name, products.product_id, `price`, `image`, products.category_id,
            categories.name as `category_name` FROM `products` INNER JOIN `categories`
            ON products.category_id = categories.category_id
            WHERE products.category_id = $category";
    $category_result = $conn->query("SELECT name FROM categories WHERE category_id = $category");
    if ($category_result === false) {
        die("Error: " . $conn->error);
    }
    $category_row = $category_result->fetch_assoc();
} elseif (isset($_GET['keyword'])) {
    $keyword = trim($_GET['keyword']);
    $sql = "SELECT product_id, name, price, image FROM products
            WHERE name LIKE '%$keyword%'";
} else {
    $sql = "SELECT product_id, name, price, image FROM products";
}
$sql .= " ORDER BY products.create_at DESC LIMIT $start, $limit";
$result = $conn->query($sql);

if ($result === false) {
    die("Error: " . $conn->error);
}
$total_sql = "SELECT COUNT(*) as total FROM `products`";

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $total_sql .= " WHERE category_id = $category";
} elseif (isset($_GET['keyword'])) {
    $keyword = trim($_GET['keyword']);
    $total_sql .= " WHERE name LIKE '%$keyword%'";
}

$total_result = $conn->query("SELECT COUNT(*) as total FROM `products`");
$total_row = $total_result->fetch_assoc();
$total_count = $total_row['total'];
$total_pages = ceil($total_row['total'] / $limit);
?>

<!-- title for newest -->
<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center text-danger">
                <?php
                if (isset($_GET['category'])) {
                    echo "Sản phẩm của " . $category_row['name'];
                } elseif (isset($_GET['keyword'])) {
                    echo "Kết quả tìm kiếm cho: " . $_GET['keyword'];
                } else {
                    echo "Sản phẩm mới nhất";
                }
                ?>
            </h2>
            <h4 class="text-center text-info">
                <?php echo "Tổng số sản phẩm: " . $total_count; ?>
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
                                <a href="product.php?id=<?php echo $row['product_id']; ?>" class="card-link"><?php echo $row['name']; ?></a>
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
        $url = '?';
        if (isset($_GET['category'])) {
            $url .= 'category=' . $_GET['category'] . '&';
        } elseif (isset($_GET['keyword'])) {
            $url .= 'keyword=' . $_GET['keyword'] . '&';
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<li class='page-item'><a class='page-link' href='" . $url . "page=" . $i . "'>" . $i . "</a></li>";
        }
        ?>
    </ul>
</div>

<?php
include 'footer.php';
?>