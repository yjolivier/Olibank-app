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
	elseif ($_GET['action'] == 'compte') {
		compte();
	}
	elseif ($_GET['action'] == 'edit') {
		EditAdmin();
	}
}
else {
	profileAdmin();
}

