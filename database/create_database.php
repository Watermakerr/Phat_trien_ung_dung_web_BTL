<?php
	require '../connect.php';
	$sql = "CREATE DATABASE IF NOT EXISTS WebProject";
	if(mysqli_query($conn,$sql)){
		echo "<br> Tạo thành công database";
	}else{
		echo "<br> có lỗi xảy ra".mysqli_error($conn);
	}
?>