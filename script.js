var users = [];

function StartRegistration() {
	const w = 800;
	const h = 400;
	
	window.open("http://localhost/face recognition/registration.php","Registration",`width=${w},height=${h},titlebar=0,top=${(screen.height-h)/2},left=${(screen.width-w)/2}`)
}
