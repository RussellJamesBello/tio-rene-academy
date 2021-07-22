<?php
	require 'header.php';
	checkCredentials(true, 'teacher');

	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$conn = getDBconnection();
		$result = $conn->query("delete from users where user_id=$id");
		$conn->close();
	}

	header('Location: student-list.php');
?>