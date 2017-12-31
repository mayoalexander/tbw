<?php
function loginUser() {
	return true;
}


if ($_POST['action']=='login') {

	if (loginUser($_POST)) {
		console.log('New User Successfully Created.');
	}

}
