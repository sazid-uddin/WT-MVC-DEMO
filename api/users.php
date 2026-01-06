<?php
// GET localhost/mvc/api/users

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	require_once "models/User.php";
	$userModel = new User();

	$all_users = $userModel->getAll();
	echo json_encode($all_users);
}
?>