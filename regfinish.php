<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="box main-content" style="height:376px;">
			<h3 class="center">Registration Finished</h3>
			<p>You can now exit this window.</p>
			
			<?php
				// you can change these to whatever you are going to use
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "face_recognition"; 

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$s = $conn->prepare("INSERT INTO `users`(`Name`,`Keypoints`) VALUES (?,?)");
				
				// Check if preparation was successful
				if ($s === false) {
					die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
				}
				
				$s->bind_param("ss", $_POST["name"], $_POST["keypoints"]);

				if ($s->execute()) {
					echo "Registration successful";
				} else {
					echo "Registration failed: " . $s->error . " (Error Code: " . $s->errno . ")";
				}

				$s->close();
				$conn->close();
			?>
		</div>
	</body>
</html>