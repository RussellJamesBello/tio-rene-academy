<?php
	require 'header.php';
	checkCredentials(true, 'teacher');

	if(isset($_POST['username']) && isset($_POST['grade']) && isset($_POST['student_name']))
	{
		$student_name = $_POST['student_name'];
		$username = $_POST['username'];
		$grade = $_POST['grade'];
		$password = rand(1000, 99999);

		$conn = getDBconnection();
		$sql_users = "insert into users (username, password, user_type, whole_name) values ('$username', '$password', 'student', '$student_name')";
		$conn->query($sql_users);
		$sql_students = "insert into students(user_id, grade_level) values ('{$conn->insert_id}', '$grade')";
		$conn->query($sql_students);
		$conn->close();

		header('Location: student-list.php');
	}
?>

<h2 class="ui blue top attached header">
	Add Student
</h2>

<div class="ui attached segment">
	<form class="ui form" method="POST" action="add-student.php">
		<div class="fields">
			<div class="five wide field"></div>

			<div class="six wide field">
				<label>Student Name:</label>
				<input type="text" name="student_name" required="">
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
				<label>Grade:</label>
				<input type="number" name="grade" required="" min="1" max="6">
			</div>
		</div>

		<div class="fields">
			<div class="five wide field"></div>

			<div class="six wide field">
				<button class="ui fluid blue inverted button" type="submit">Add Student</button>
			</div>
		</div>
	</form>
</div>

<?php require 'footer.php' ?>