<?php
require 'header.php';
if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $message = $_POST['message'];
    $sql = "UPDATE `feedbacks` SET `message`='$message' WHERE `feedback_id` = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cập nhật thành công')</script>";
        echo "<script>window.location.href = 'show_feedback.php'</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra')</script>";
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `feedbacks` WHERE `feedback_id` = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows <= 0) {
        die("Record not found");
    } else {
        $row = $result->fetch_assoc();
    }
}
?>
<div class="row">
    <div class="col-6 mx-auto my-5">
        <form action="" method="post" class="form-group">
            <h1 class="text-center">Update feedback</h1>
            <div class="form-group">
                <label for="">Message:</label>
                <input type="text " name="message" class="form-control" value="<?php echo $row['message']; ?> ">
            </div>
            <input type="submit" name="submit" value="update" class="btn btn-success">
        </form>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        $id = $_GET['id'];
        $message = $_POST['message'];
        $sql = "UPDATE `feedbacks` SET `message`='$message' WHERE `feedback_id` = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Cập nhật thành công')</script>";
            echo "<script>window.location.href = 'show_feedback.php'</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra')</script>";
        }
    }
    ?>
</div>
<script>
    document.querySelector("form").addEventListener("submit", function(e) {
        var message = document.querySelector("input[name='message']").value;

        if (message === "") {
            e.preventDefault();
            alert("Chưa nhập message");
        }
    });
</script>
<?php
require 'footer.php';
?>