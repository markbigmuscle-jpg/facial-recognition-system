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

				// Prepare statement using positional placeholders (?)
				$s = $conn->prepare("INSERT INTO `users`(`Name`,`Student Number`,`Keypoints`) VALUES (?,?,?)");
				
				// Check if preparation was successful
				if ($s === false) {
					die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
				}
				
				// FIX: Use bind_param() instead of bindParam() for mysqli
				// The first argument is a string specifying data types for the placeholders:
				// 's' = string, 's' = string, 's' = string (three strings)
				$s->bind_param("sss", $_POST["name"], $_POST["studentNumber"], $_POST["keypoints"]);
				
				// Execute the statement
				if ($s->execute()) {
					echo "New record created successfully";
				} else {
					// FIX: Use mysqli error properties for reporting
					echo "Error: " . $s->error . " (Error Code: " . $s->errno . ")";
				}

				// Close the statement and connection
				$s->close(); // It's good practice to close the statement
				$conn->close();
			?>
		</div>
	</body>
</html>