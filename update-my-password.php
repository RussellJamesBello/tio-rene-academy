<?php
	require 'header.php';
	checkCredentials(true, 'student');

	$id = $_SESSION['id'];

	if(isset($_POST['user_password']))
	{
		$password = $_POST['user_password'];

		$conn = getDBconnection();

		$conn->query("update users set password='$password' where user_id=$id");
		
		$conn->close();
		header('Location: update-my-password.php');
	}
?>

<h2 class="ui blue top attached header">
	Update My Password
</h2>

<div class="ui attached segment">
	<form class="ui form" method="POST" action="update-my-password.php">
		<div class="fields">
			<div class="five wide field"></div>

			<div class="six wide field">
				<label>New Password:</label>
				<input type="password" name="user_password" required="">
			</div>
		</div>

		<div class="fields">
			<div class="five wide field"></div>

			<div class="six wide field">
				<button class="ui fluid blue inverted button" type="submit">Update My Password</button>
			</div>
		</div>
	</form>
</div>

<?php require 'footer.php' ?>