<?php
	require 'header.php';
	checkCredentials(true, 'teacher');

	$conn = getDBconnection();
	$result = $conn->query("select * from students inner join users on students.user_id = users.user_id");
?>

<h2 class="ui blue top attached header">
	Student List
</h2>

<div class="ui attached segment">
	<?php
		if($result->num_rows > 0)
		{ ?>
			<table class="ui blue selectable striped table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Grade</th>
						<th class="collapsing"></th>
						<th class="collapsing"></th>
					</tr>
				</thead>

				<tbody>
					<?php
						while($row = $result->fetch_assoc())
						{ ?>
							<tr>
								<td><?php echo $row['whole_name']; ?></td>
								<td><?php echo $row['grade_level']; ?></td>
								<td><a class="ui mini yellow button" href="update-student-info.php?id=<?php echo $row['user_id'] ?>">Update Info</a></td>
								<td><a class="ui mini red button" href="delete.php?id=<?php echo $row['user_id'] ?>">Delete</a></td>
							</tr>
						<?php }
					?>
				</tbody>
			</table>
		<?php }

		else
		{ ?>
			<div class="ui warning message">
				No records found.
			</div>
		<?php }
	?>
</div>

<?php 
	$conn->close();
	require 'footer.php'
?>