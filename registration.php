<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="box" style="max-height:">
			<h3 class="center">Registration</h3>
			<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "face_recognition";
				$res = 0;

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$conn = new mysqli($servername, $username, $password, $dbname);
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
					
					$name = $_POST["name"];
					$stmt = $conn->prepare("SELECT * FROM `users` WHERE Name = ?");

					$stmt->bind_param("s", $name);
					
					$stmt->execute();
					
					$result = $stmt->get_result();
					
					// You should now check if any rows were returned:
					if ($result->num_rows > 0) {
						$res = 0;
					} else {
						$res = 1;
					}

					// Close the statement and connection
					$stmt->close();
					$conn->close();
				}
			?>
			<form name="registration" action="camera.php" method="post" id="regForm">
				<input type="text" name="name" id="name" placeholder="Name" autocomplete="off" required>
				<hr/>
				<button type="submit" formaction="registration.php" id="next">Next</button>
				<script>
					if (<?php echo $res; ?> == 1) { // If true then proceed to next step
						console.log("success");
						document.getElementById("name").value = "<?php echo $_POST["name"]; ?>";
						document.getElementById("regForm").submit();

						window.resizeTo(650,650);
						window.moveTo((screen.width-650)/2,(screen.height-650)/2);
					}
				</script>
			</form>
		</div>
	</body>
</html>