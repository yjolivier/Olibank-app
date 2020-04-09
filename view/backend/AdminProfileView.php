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
										<a class="nav-link" href="admin.php?action=deconnexion">Deconnexion</a>
									</li>
								</ul>
							</div>
						</nav>
					</div>
			</header>
			<div class="slider row"></div>
			<section class="page-content row">
			<?php if(isset($_SESSION['adminid']) AND $admininfo['id'] == $_SESSION['adminid']):?>
				<div class="content-card-left col-lg-10">
					<div class="row">
						<div class="historique-title col-12">
							<h1>Liste des Clients</h1>
						</div>
						<div class="historique-card col-12">
							<table class="table-admin col-12">
								<thead class="">
									<tr>
										<th scope="col">id</th>
										<th scope="col">Nom et Prenoms</th>
										<th scope="col">email</th>
										<th scope="col">Date d'Inscription</th>
										<th scope="col">Solde</th>
										<th scope="col">Débiter</th>
										<th scope="col">créditer</th>
										<th scope="col">Suprimer</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$bdd = dbConnect();
									$requser = $bdd->query("SELECT id, nom, prenoms, mail,  DATE_FORMAT(date_inscription, '%d/%m/%Y') AS date_inscription FROM membres");
 									
									while ($userinfo = $requser->fetch()):
										$userid = (int)$userinfo['id'];

										//recuperer tout les debits
										$debit = UserDebitInfo($userid);
										if (!empty($debit)) {
											foreach ($debit as $k => $value) {
												$DebitMont[] = $value['montant']; 
											}
										}
										$DebMont = array_sum($DebitMont);
										$debit = [];
										$DebitMont = [];

										//recuperer tout les credits
										$credit = UserCreditInfo($userid);
										if (!empty($credit)){
											foreach ($credit as $k => $value) {
												$CreditMont[] = $value['montant']; 
											}
										}
										$CredMont = array_sum($CreditMont);
										$credit = [];
										$CreditMont = [];
										$solde = $CredMont - $DebMont;
										?>
									<tr>
										<td scope="row"><?= $userid ?> </td>
										<td><?= $userinfo['nom']." ".$userinfo['prenoms'] ?></td>
										<td><?= $userinfo['mail'] ?></td>
										<td><?= $userinfo['date_inscription'] ?></td>
										<td>

										<?php 
												echo "$solde F";
												$CredMont = 0;
												$DebMont = 0;
												?>
										</td>
										<td align="center"><a href="admin.php?id=<?= $userinfo['id'] ?>&action=debit"><i class="fas fa-user-edit"></i></a></td>
										<td align="center"><a href="admin.php?id=<?= $userinfo['id'] ?>&action=credit"><i class="fas fa-user-edit"></i></a></td>
										<td align="center"><a href="admin.php?id=<?= $userinfo['id'] ?>&action=supprimer"><i class="fas fa-trash-alt"></i></a></td>
									</tr>
										<?php
											endwhile; 
											?>
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