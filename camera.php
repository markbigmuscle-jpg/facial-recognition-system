<!DOCTYPE html>
<html lang="en">
  <head>
	<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Camera</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.11.9/p5.min.js"></script>
    <script src="https://unpkg.com/ml5@1/dist/ml5.min.js"></script>
  </head>
  <body>
	<div class="box" style="width:600px; margin:auto;">
		<form name="camera" method="post" id="cameraForm" action="regfinish.php">
			<div class="gridbox" style="width:100%;">
				<div class="box" id="canvas" style="grid-row: 1/span 2; margin:4px;">
					<main>
					</main>
				</div>
				<div class="box" style="grid-row: 2; margin:4px;">
					<h4 class="center">Instructions</h4>
					<ol>
						<li>Please show your shoulders to start face detection.</li>
						<li>When face is detected, click "Capture" at least 8 times (more is better accuracy)</li>
					</ol>
					<hr/>
					<p id="captures"></p>
					<p id="face"></p>
					
					<hr/>
					
					<button type="button" id="btn2">Capture</button>
					<button type="button" id="next">Next</button>
				</div>
				<div class="box" style="grid-row: 1; margin:4px;">
					<h4 class="center">Settings</h4>
					
					<label for="showCamera">Enable Camera</label>
					<input type="checkbox" id="showCamera">
					
					<br/>
					
					<label for="showKeypoints">Show Keypoints</label>
					<input type="checkbox" id="showKeypoints">
				</div>
				
				<input type="hidden" name="name" id="name" value="<?php echo $_POST["name"]; ?>">
				<input type="hidden" name="studentNumber" id="studentNumber" value="<?php echo $_POST["studentNumber"]; ?>">
				<input type="hidden" name="keypoints" id="keypoints" value>
				<script src="camera.js"></script>
			</div>
		</form>
	</div>
  </body>
</html>