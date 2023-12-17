<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    include 'header.php';
    ?>
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <?php for ($i = 0; $i < 10; $i++) { ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card mx-auto" style="width: 12rem;">
                        <img class="card-img-top" src="asset/image/5ce1c93d3ca9b4a2425d369b59d05fee.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                <a href="product.php?id=1" class="card-link">Sản phẩm 1</a>
                            </h5>
                            <p class="card-text text-center">Giá: 100.000đ</p>
                            <div class="text-center">
                                <a href="" class="btn btn-primary">
                                    <i class="fas fa-cart-shopping"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>