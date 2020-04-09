<?php
require 'controller/frontend.php';
if (isset($_GET['action'])) {
	if ($_GET['action'] == 'inscription') {
		inscription();
	}
	elseif ($_GET['action'] == 'admin') {
		admin();
	}
}
else{
	connexion();
}
