<html>
<head>
	<meta http-equiv=“Pragma” content=”no-cache”>
	<meta http-equiv=“Expires” content=”-1″>
	<meta http-equiv=“CACHE-CONTROL” content=”NO-CACHE”>
	<title>Tio-Rene Academy Students Portal</title>
	<link rel="stylesheet" type="text/css" href="/semantic/semantic.min.css">

	<style>
		@font-face{
			font-family: StruckBase;
			src:  url('StruckBase.otf');
		}
	</style>
</head>

<body style="background-image: url('background.jpg'); background-repeat: round;">
	<?php
		session_start(); 

		function getDBconnection()
		{
			$conn = new mysqli('localhost', 'root', '', 'tioren_db');

			if($conn->connect_error)
  				die('Connection failed: ' . mysqli_connect_error());

  			return $conn;
		}

		function checkCredentials($is_authenticated, $user_type = null)
		{
			if($is_authenticated && $user_type == 'teacher')
			{
				if(!isset($_SESSION['id']))
					header('Location: login.php');

				elseif($_SESSION['type'] == 'student')
					header('Location: my-info.php');
			}

			else if($is_authenticated && $user_type == 'student')
			{
				if(!isset($_SESSION['id']))
					header('Location: login.php');

				elseif($_SESSION['type'] == 'teacher')
					header('Location: student-list.php');
			}

			else
			{
				if(isset($_SESSION['id']))
				{
					if($_SESSION['type'] == 'teacher')
						header('Location: student-list.php');
					else
						header('Location: my-info.php');
				}
			}
		}
	?>

	<div>
		<div class="ui blue inverted top fixed menu">
			<div class="header item">
				<i class="child icon"></i> 
				<span style="font-family: StruckBase; font-weight: normal; margin-top: 8px; font-size: 12.5pt;">
					<u>Tio-Rene Academy Students Portal</u>
				</span>
			</div>

			<?php
				if(isset($_SESSION['id']))
				{
					if($_SESSION['type'] == 'teacher')
					{ ?>
						<a class="item" href="add-student.php">Add Student</a>
						<a class="item" href="student-list.php">Students List</a>
						<a class="item" href="update-my-info.php">Update My Info</a>
					<?php }

					else
					{  ?>
						<a class="item" href="my-info.php">My Info</a>
						<a class="item" href="update-my-password.php">Update My Password</a>
					<?php } ?>

					<div class="right menu">
						<a class="item" href="logout.php">Logout</a>
					</div>
				<?php }
			?>
		</div>

		<div class="ui grid container">
			<div class="ui sixteen wide column raised segment" style="margin-top: 40px; margin-bottom: 50px;">