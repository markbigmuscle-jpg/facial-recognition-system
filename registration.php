<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="box main-content" style="height:376px; width:50%;">
			<h3 class="center">Registration</h3>
			<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "face_recognition";
				$res = 0;

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					// 1. Establish connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
					
					// Get the name from the POST data
					$name = $_POST["name"];
					
					// 2. Prepare the statement with a placeholder (?)
					$stmt = $conn->prepare("SELECT * FROM `users` WHERE Name = ?");
					
					// 3. Bind the user input to the placeholder. 's' means the variable is a string.
					$stmt->bind_param("s", $name);
					
					// 4. Execute the statement
					$stmt->execute();
					
					// 5. Get the result
					$result = $stmt->get_result();
					
					// You should now check if any rows were returned:
					if ($result->num_rows > 0) {
						$res = 0;
					} else {
						$res = 1;
					}

					// 6. Close the statement and connection
					$stmt->close();
					$conn->close();
				}
			?>
			<form name="registration" action="camera.php" method="post" id="regForm">
				<input type="text" name="name" id="name" placeholder="Name" autocomplete="off" required>
				<input type="text" name="studentNumber" id="studentNumber" placeholder="Student Number" autocomplete="off" required>
				<hr/>
				<button type="submit" formaction="registration.php" id="next">Next</button>
				<script>
					if (<?php echo $res; ?> == 1) {
						console.log("success");
						document.getElementById("name").value = "<?php echo $_POST["name"]; ?>";
						document.getElementById("studentNumber").value = "<?php echo $_POST["studentNumber"]; ?>";
						document.getElementById("regForm").submit();
					}
				</script>
			</form>
		</div>
	</body>
</html>