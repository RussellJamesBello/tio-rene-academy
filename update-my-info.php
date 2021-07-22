<?php
	require 'header.php';
	checkCredentials(true, 'teacher');

	$id = $_SESSION['id'];
	$conn = getDBconnection();
	$result = $conn->query("select * from users where user_id=$id");
	$row = $result->fetch_assoc();
	$conn->close();

	if(isset($_POST['username']) && isset($_POST['teacher_name']))
	{
		$teacher_name = $_POST['teacher_name'];
		$username = $_POST['username'];
		$password = $_POST['user_password'];

		$conn = getDBconnection();

		if($password == '')
			$conn->query("update users set username='$username', whole_name='$teacher_name' where user_id=$id");
		else
			$conn->query("update users set username='$username', whole_name='$teacher_name', password='$password' where user_id=$id");

		$_SESSION['whole_name'] = $teacher_name;
		
		$conn->close();
		header('Location: update-my-info.php');
	}
?>

<h2 class="ui blue top attached header">
	Update My Info
</h2>

<div class="ui attached segment">
	<form class="ui form" method="POST" action="update-my-info.php">
		<div class="fields">
			<div class="five wide field"></div>

			<div class="six wide field">
				<label>Teacher Name:</label>
				<input type="text" name="teacher_name" value="<?php echo $row['whole_name'] ?>" required="">
			</div>
		</div>

		<div class="fields">
			<div class="five wide field"></div>

			<div class="six wide field">
				<label>Username:</label>
				<input type="text" name="username" value="<?php echo $row['username'] ?>" required="">
			</div>
		</div>

		<div class="fields">
			<div class="five wide field"></div>

			<div class="six wide field">
				<label>New Password:</label>
				<input type="password" name="user_password">
			</div>
		</div>

		<div class="fields">
			<div class="five wide field"></div>

			<div class="six wide field">
				<button class="ui fluid blue inverted button" type="submit">Update My Info</button>
			</div>
		</div>
	</form>
</div>

<?php require 'footer.php' ?>