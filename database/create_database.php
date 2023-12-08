<?php
	$server = "localhost";//127.0.0.1; IP
	$username = "root";
	$password = "root";
	$conn = mysqli_connect($server, $username, $password); //,$dbname
	if(!$conn){
		die("Kết nối không thành công: ".mysqli_connect_error());
	}
	echo "Kết nối thành công";
	$sql = "CREATE DATABASE IF NOT EXISTS WebProject";
	if(mysqli_query($conn,$sql)){
		echo "<br> Tạo thành công database";
	}else{
		echo "<br> có lỗi xảy ra".mysqli_error($conn);
	}
?>