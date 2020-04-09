<?php
	require "controller/frontend.php";

if (isset($_GET['value'])) {
	if ($_GET['value'] == 'compte') {
		compte();
	}
	elseif ($_GET['value'] == 'contacte') {
		contacte();
	}
	elseif ($_GET['value'] == 'deconnexion') {
		deconnexion();
	}
	elseif ($_GET['value'] == 'edit') {
		edituser();
	}
}
else {
	profile();
}
?>
