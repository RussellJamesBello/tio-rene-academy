<?php
	require 'header.php';
	checkCredentials(false);

	if(isset($_POST['username']) && isset($_POST['user_password']) && isset($_POST['type']))
	{
		$username = $_POST['username'];
		$password = $_POST['user_password'];
		$type = $_POST['type'];

		$conn = getDBconnection();
		$result = $conn->query("select * from users where username='$username' and password='$password' and user_type='$type'");

		if($result->num_rows > 0)
		{
			$result = $result->fetch_assoc();

			$_SESSION['id'] = $result['user_id'];
			$_SESSION['type'] = $result['user_type'];
			$_SESSION['whole_name'] = $result['whole_name'];

			$conn->close();

			if($_SESSION['type'] == 'teacher')
				header('Location: student-list.php');
			else
				header('Location: my-info.php');
		}

		else
		{
			$conn->close();
			header('Location: login.php');
		}
	}
?>

<h2 class="ui blue top attached header">
	Login
</h2>

<div class="ui attached segment">
	<form class="ui form" method="POST" action="login.php">
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
				<label>Login Type:</label>
				<select name="type" required="">
					<option value=""></option>
					<option value="teacher">Teacher</option>
					<option value="student">Student</option>
				</select>
			</div>
		</div>

		<div class="fields">
			<div class="five wide field"></div>

			<div class="six wide field">
				<button class="ui fluid blue inverted button" type="submit">Login</button>
			</div>
		</div>
	</form>
</div>

<?php require 'footer.php' ?>