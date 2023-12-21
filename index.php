<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    include 'header.php';
    ?>
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <?php
            $result = mysqli_query($conn, $sql);
            $limit = 16;
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $start = ($page - 1) * $limit;

            $sql = "SELECT * FROM `products` order by `create_at` DESC LIMIT $start, $limit";
            $result = $conn->query($sql);

            $total_result = $conn->query("SELECT COUNT(*) as total FROM `products`");
            $total_row = $total_result->fetch_assoc();
            $total_pages = ceil($total_row['total'] / $limit);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card mx-auto" style="width: 12rem;">
                            <img class="card-img-top" src="asset/image/<?php echo $row['image']?>" alt="Card image cap">
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
    <?php
    echo "<ul class='pagination justify-content-center'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<li class='page-item'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
    }
    ?>
</body>

</html>