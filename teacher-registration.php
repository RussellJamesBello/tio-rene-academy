<?php
	require 'header.php';
	checkCredentials(false);

	if(isset($_POST['username']) && isset($_POST['user_password']) && isset($_POST['teacher_name']))
	{
		$teacher_name = $_POST['teacher_name'];
		$username = $_POST['username'];
		$password = $_POST['user_password'];

		$conn = getDBconnection();
		$sql = "insert into users (username, password, user_type, whole_name) values ('$username', '$password', 'teacher', '$teacher_name')";
		
		if($conn->query($sql) == true)
		{
			$_SESSION['id'] = $conn->insert_id;
			$_SESSION['type'] = 'teacher';
			$_SESSION['whole_name'] = $teacher_name;
			$conn->close();

			header('Location: student-list.php');
		}

		else
		{
			$conn->close();
			header('Location: teacher-registration.php');
		}
	}
?>

<h2 class="ui blue top attached header">
	Teacher Account Registration
</h2>

<div class="ui attached segment">
	<form class="ui form" method="POST" action="teacher-registration.php">
		<div class="fields">
			<div class="five wide field"></div>

			<div class="six wide field">
				<label>Teacher Name:</label>
				<input type="text" name="teacher_name" required="">
			</div>
		</div>

		<div class="fields">
			<div class="five wide field"></div>

			<div class="six wide field">
				<label>Username:</label>
				<input type="text" name="username" required="">
			</div>
		</div>

		<div class="fields">
			<div class="five wide field"></div>

			<div class="six wide field">
				<label>Password:</label>
				<input type="password" name="user_password" required="">
			</div>
		</div>

		<div class="fields">
			<div class="five wide field"></div>

			<div class="six wide field">
				<button class="ui fluid blue inverted button" type="submit">Create My Account</button>
			</div>
		</div>
	</form>
</div>

<?php require 'footer.php' ?>