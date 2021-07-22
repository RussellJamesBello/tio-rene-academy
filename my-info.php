<?php
	require 'header.php';
	checkCredentials(true, 'student');

	$id = $_SESSION['id'];
	$conn = getDBconnection();
	$result = $conn->query("select * from students inner join users on students.user_id = users.user_id where students.user_id=$id");
	$row = $result->fetch_assoc();
	$conn->close();
?>

<h2 class="ui blue top attached header">
	My Grades Info
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

	<form class="ui form">
		<div class="fields">
			<div class="three wide field"></div>

			<div class="five wide field">
				<label>Student Name:</label>
				<input type="text" name="student_name" readonly="" value="<?php echo $row['whole_name'] ?>">
			</div>

			<div class="five wide field">
				<label>Username:</label>
				<input type="text" name="username" readonly="" value="<?php echo $row['username'] ?>">
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
				<input type="number" name="grade" readonly="" min="1" max="6" value="<?php echo $row['grade_level'] ?>">
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
							<td><input type="number" name="filipino" readonly="" value="<?php echo $row['filipino']; ?>"></td>
						</tr>

						<tr>
							<td>English</td>
							<td><input type="number" name="english" readonly="" value="<?php echo $row['english']; ?>"></td>
						</tr>

						<tr>
							<td>Math</td>
							<td><input type="number" name="math" readonly="" value="<?php echo $row['math']; ?>"></td>
						</tr>

						<tr>
							<td>Science</td>
							<td><input type="number" name="science" readonly="" value="<?php echo $row['science']; ?>"></td>
						</tr>

						<tr>
							<td>Araling Panlipunan</td>
							<td><input type="number" name="araling_panlipunan" readonly="" value="<?php echo $row['araling_panlipunan']; ?>"></td>
						</tr>

						<tr>
							<td>Values Education</td>
							<td><input type="number" name="values_education" readonly="" value="<?php echo $row['values_education']; ?>"></td>
						</tr>

						<tr>
							<td>Eduksayong Pangtahanan at Pangkabuhayan (EPP)</td>
							<td><input type="number" name="epp" readonly="" value="<?php echo $row['epp']; ?>"></td>
						</tr>

						<tr>
							<td>MAPEH</td>
							<td><input type="number" name="mapeh" readonly="" value="<?php echo $row['mapeh']; ?>"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</form>
</div>

<?php 
	require 'footer.php'
?>