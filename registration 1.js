function SubmitForm(f) {
	let fd = new FormData(document.getElementById("registration"));
	console.log(document.getElementById("registration"),fd);
	alert(fd);
}