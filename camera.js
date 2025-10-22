let canvas;
let faceMesh;
let video;
let faces = [];
let options = { maxFaces: 1, refineLandmarks: false, flipHorizontal: false };

let savedKeypoints = [];

let scale = 100;
let aspectRatio = 4/3;
let c = 0; // # of photos took

let mc = document.getElementById("canvas");
let vw = mc.getBoundingClientRect().width-8;

// buttons

document.getElementById("captures").innerHTML = `No. of captures: ${c}`;
document.getElementById("face").innerHTML = `Detecting face: ${faces.length > 0 ? "yes" : "no"}`;
document.getElementById("btn2").addEventListener("click",function() {
	//console.log(faces[0].keypoints);
	try {
		let box = faces[0].box

		savedKeypoints.push(faces[0].keypoints.map(function(kp) {
			const k = {...kp};
			k.x = (kp.x - box.xMin)/box.width;
			k.y = (kp.y - box.xMin)/box.width;
				
			return k;
		}));
		
		c += 1;
			
		document.getElementById("captures").innerHTML = `No. of captures: ${c}`;
	} catch (err) {
		alert("No face detected");
	}
});
document.getElementById("next").addEventListener("click",function() {
	//console.log(faces[0].keypoints);
	
	document.getElementById("keypoints").value = JSON.stringify(Array.from(savedKeypoints)); // serialize data to json string

	if (c < 8) {
		alert("Not enough captures");
		return;
	}
	
	document.getElementById("cameraForm").submit();
});

// main

function preload() {
	// Load the faceMesh model
	faceMesh = ml5.faceMesh(options);
}

function setup() {
	vw = mc.getBoundingClientRect().width-8;
	
	canvas = createCanvas(vw,vw/aspectRatio);

	// Create the webcam video and hide it
	video = createCapture(VIDEO);
	video.size(vw,vw/aspectRatio);
	video.center("horizontal");
	video.hide();

	// Start detecting faces from the webcam video
	faceMesh.detectStart(video, gotFaces);
}

function draw() {
	// Draw the webcam video
	 
	clear();
	
	vw = mc.getBoundingClientRect().width-8;
	resizeCanvas(vw,vw/aspectRatio);
	video.size(vw,vw/aspectRatio);

	if (document.getElementById("showCamera").checked) {
		image(video,0,0,vw,vw/aspectRatio);
	}

	document.getElementById("face").innerHTML = `Detecting face: ${faces.length > 0 ? "yes" : "no"}`;

	// Draw all the tracked face points

	if (document.getElementById("showKeypoints").checked) {
		for (let i = 0; i < faces.length; i++) {
			let face = faces[i];
			let box = face.box;

			for (let j = 0; j < face.keypoints.length; j++) {
				let keypoint = face.keypoints[j];
				fill(255, 0, 0);
				noStroke();
				circle((keypoint.x-box.xMin)*scale/box.width,(keypoint.y-box.yMin)*scale/box.width, 2);
			}
		}
	}
}

// Callback function for when faceMesh outputs data
function gotFaces(results) {
	// Save the output to the faces variable
	faces = results;
}