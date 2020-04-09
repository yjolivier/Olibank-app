<?php
	require "controller/backend.php";

if (isset($_GET['action'])) {
	if ($_GET['action'] == 'debit') {
		debit();
	}
	elseif ($_GET['action'] == 'credit') {
		credit();
	}
	elseif ($_GET['action'] == 'supprimer') {
		supprimer();
	}
	elseif ($_GET['action'] == 'deconnexion') {
		deconnexion();
	}
}
else {
	profileAdmin();
}

