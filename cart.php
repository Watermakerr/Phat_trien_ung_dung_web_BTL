<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    include 'header.php';
    ?>
    <div class="container " style="margin-top: 100px;">
        <p class="text-center">Giỏ hàng</p>
        <div class="table">
            <table class="table text-center my-auto">
                <tr class="bg-secondary text-light w-100" style="height: 30px;">
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><img src="asset/image/a31.jpg" alt="Hình ảnh" class="img-thumbnail img-order "></td>
                    <td>Sản phẩm 1</td>
                    <td>100.000đ</td>
                    <td>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1">
                    </td>
                    <td>100.000đ</td>
                </tr>
                <tr>
                    <th colspan="4">Tổng đơn hàng</th>
                    <th>1</th>
                    <th>100.000đ</th>
                </tr>

            </table>
        </div>
    </div>
</body>