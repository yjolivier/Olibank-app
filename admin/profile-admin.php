<?php
session_start();
	require "../projet/model.php";
	//connexin a la base de donnée
	$bdd = dbConnect();

if (isset($_GET['id']) AND $_GET['id'] > 0) {

	//Convertir l'id en nombre
	$getid = intval($_GET['id']);
	$reqadmin = $bdd->prepare("SELECT * FROM administrateur WHERE id = ?");
	$reqadmin->execute(array($getid));
	$admininfo = $reqadmin->fetch();
?>
<?php require 'header.php'; ?>
	<body>
		<div class="container-fluid">
			<header class="row sticky-top">
					<div class="header-logo col-lg-4 col-sm-6 col-6">
						<h2>Espace Admin</h2>
					</div>
					<div class="header-menu col-lg-8 col-sm-6 col-6">
						<nav class="navbar navbar-expand-md navbar-white bg-transparent">
							<button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
								<span class="navbar-toggler-icon btn-menu">
									<i class="fas fa-align-justify"></i>
								</span>
							</button>
							<div class="collapse  navbar-collapse" id="collapse_target">
								<ul class="navbar-nav">
									<li class="nav-item">
										<a class="nav-link" href="#">ACCUEIL</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">compte</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="deconnexion.php">Deconnexion</a>
									</li>
								</ul>
							</div>
						</nav>
					</div>
			</header>
			<div class="slider row"></div>
			<section class="page-content row">
			<?php if(isset($_SESSION['adminid']) AND $admininfo['id'] == $_SESSION['adminid']):?>
				<div class="content-card-left col-lg-8">
					<div class="row">
						<div class="historique-title col-12">
							<h1>Liste des Clients</h1>
						</div>
						<div class="historique-card col-12">
								<table class="table col-12">
							<thead class="black white-text">
								<tr>
									<th scope="col">id</th>
									<th scope="col">Nom et Prenoms</th>
									<th scope="col">Date d'Inscription</th>
									<th scope="col">Edit</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$requser = $bdd->query("SELECT * FROM membres");
								while ($userinfo = $requser->fetch()):
							?>
								<tr>
									<th scope="row"><?= $userinfo['id'] ?></th>
									<td><?= $userinfo['nom']." ".$userinfo['prenoms'] ?></td>
									<td><?= $userinfo['date_inscription'] ?></td>
									<td>@mdo</td>
								</tr>
								<?php endwhile ?>
							</tbody>
						</table>
						</div>
					</div>
				</div>
				<div class="content-card-right col-lg-8">
					<div class="row">
						
					</div>
				</div>
				<?php endif; ?>
			</section>
			<footer class="row">
					<div class="col-12">
						<p>©Designed by OtoiSofware</p>
					</div>
			</footer>
		</div>
	</body>
	<?php require '../footer.php'; ?>
</html>
<?php
}
?>