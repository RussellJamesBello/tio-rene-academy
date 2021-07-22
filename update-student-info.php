<?php
	require 'header.php';
	checkCredentials(true, 'teacher');

	function uploadFile($id)
	{
		if(file_exists("uploads/$id.png"))
			unlink("uploads/$id.png");

		move_uploaded_file($_FILES["report_card"]["tmp_name"], "uploads/$id.png");
	}

	$id = $_GET['id'];
	$conn = getDBconnection();
	$result = $conn->query("select * from students inner join users on students.user_id = users.user_id where students.user_id=$id");
	$row = $result->fetch_assoc();
	$conn->close();

	if(isset($_POST['id']) && isset($_POST['student_name']) && isset($_POST['username']) && isset($_POST['grade']))
	{
		$conn = getDBconnection();

		$id = $_POST['id'];
		$student_name = $_POST['student_name'];
		$username = $_POST['username'];
		$grade = $_POST['grade'];

		$filipino = $_POST['filipino'];
		$english = $_POST['english'];
		$math = $_POST['math'];
		$science = $_POST['science'];
		$araling_panlipunan = $_POST['araling_panlipunan'];
		$values_education = $_POST['values_education'];
		$epp = $_POST['epp'];
		$mapeh = $_POST['mapeh'];

		$conn->query("update users set username='$username', whole_name='$student_name' where user_id=$id");
		$conn->query("update students set grade_level='$grade', filipino='$filipino', english='$english', math='$math', science='$science', 
					araling_panlipunan='$araling_panlipunan', values_education='$values_education', epp='$epp', mapeh='$mapeh' where user_id='$id'");
		$conn->close();

		if($_FILES["report_card"]["tmp_name"])
			uploadFile($id);

		header("Location: update-student-info.php?id=$id");
	}
?>

<h2 class="ui blue top attached header">
	Update Student Info
</h2>

<div class="ui attached segment">
	<?php
		if(file_exists("uploads/$id.png"))
		{ ?>
			<div style="overflow: auto;">
				<a href="<?php echo "uploads/$id.png"; ?>" class="ui right floated small blue button" target="_blank">View Report Card</a>
			</div>
		<?php }
	?>

	<form class="ui form" method="POST" action="update-student-info.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $id; ?>">

		<div class="fields">
			<div class="three wide field"></div>

			<div class="five wide field">
				<label>Student Name:</label>
				<input type="text" name="student_name" required="" value="<?php echo $row['whole_name'] ?>">
			</div>

			<div class="five wide field">
				<label>Username:</label>
				<input type="text" name="username" required="" value="<?php echo $row['username'] ?>">
			</div>
		</div>

		<div class="fields">
			<div class="three wide field"></div>

			<div class="five wide field">
				<label>Password:</label>
				<input type="text" name="password" readonly="" value="<?php echo $row['password'] ?>">
			</div>

			<div class="five wide field">
				<label>Grade:</label>
				<input type="number" name="grade" required="" min="1" max="6" value="<?php echo $row['grade_level'] ?>">
			</div>
		</div>

		<div class="ui centered grid">
			<div class="ten wide column">
				<table class="ui blue selectable striped table" style="text-align: center;">
					<thead>
						<tr>
							<th>Subject</th>
							<th>Grade</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>Filipino</td>
							<td><input type="number" name="filipino" value="<?php echo $row['filipino']; ?>"></td>
						</tr>

						<tr>
							<td>English</td>
							<td><input type="number" name="english" value="<?php echo $row['english']; ?>"></td>
						</tr>

						<tr>
							<td>Math</td>
							<td><input type="number" name="math" value="<?php echo $row['math']; ?>"></td>
						</tr>

						<tr>
							<td>Science</td>
							<td><input type="number" name="science" value="<?php echo $row['science']; ?>"></td>
						</tr>

						<tr>
							<td>Araling Panlipunan</td>
							<td><input type="number" name="araling_panlipunan" value="<?php echo $row['araling_panlipunan']; ?>"></td>
						</tr>

						<tr>
							<td>Values Education</td>
							<td><input type="number" name="values_education" value="<?php echo $row['values_education']; ?>"></td>
						</tr>

						<tr>
							<td>Eduksayong Pangtahanan at Pangkabuhayan (EPP)</td>
							<td><input type="number" name="epp" value="<?php echo $row['epp']; ?>"></td>
						</tr>

						<tr>
							<td>MAPEH</td>
							<td><input type="number" name="mapeh" value="<?php echo $row['mapeh']; ?>"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<br>

		<div class="fields">
			<div class="three wide field"></div>

			<div class="ten wide field">
				<label>Upload Report Card Photo (accepts .png file only):</label>
				<input type="file" name="report_card" accept="image/png">
			</div>
		</div>

		<div class="fields">
			<div class="three wide field"></div>

			<div class="ten wide field">
				<button class="ui fluid blue inverted button" type="submit">Add Student</button>
			</div>
		</div>
	</form>
</div>

<?php 
	require 'footer.php'
?>