	<body>
		<div class="container-fluid profile-container">
			<header>
				<input type="checkbox" id="check">
				<label for="check" class="checkbtn">
					<i class="fas fa-bars"></i>
				</label>
				<div class="logo">
					<img src="public/img/logo.png" alt="...">
				</div>
				<ul>
					<li><a href="admin.php?id=<?= $_SESSION['adminid']?>">ACCUEIL</a> </li>
					<li><a class="nav-link" href="admin.php?id=<?= $_SESSION['adminid']?>&action=compte">compte</a></li>
					<li><a class="nav-link" href="admin.php?action=deconnexion">Deconnexion</a></li>
				</ul>
    	</header>
			<div class="slider row d-flex justify-content-center">
				<h1>Liste des Clients</h1>
			</div>
			<section class="profile-page-container row d-flex justify-content-center">
			<?php if(isset($_SESSION['adminid']) AND $admininfo['id'] == $_SESSION['adminid']):?>
				<div class="profile-page-content col-lg-11">
					<div class="row">
						<div class="historique-card col-12">
							<table class="table-admin col-12">
								<thead>
									<tr class="sticky-top">
										<th scope="col" class="id">id</th>
										<th scope="col">Nom</th>
										<th scope="col" class="mail">email</th>
										<th scope="col" class="date">Date d'Inscription</th>
										<th scope="col">Solde</th>
										<th scope="col">Débit</th>
										<th scope="col">crédit</th>
										<th scope="col">Supr</th>
										<th scope="col">Confirme</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$bdd = dbConnect();
									if (isset($_GET['confirmer']) AND !empty($_GET['confirmer'])) {
											$confirmer = (int)$_GET['confirmer'];
											$bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
											$req = $bdd->prepare("UPDATE membres SET confirmer = 1 WHERE id = ?");
											$req->execute(array($confirmer));													
									}
									$requser = $bdd->query("SELECT id, nom, prenoms, mail,  DATE_FORMAT(date_inscription, '%d/%m/%Y') AS date_inscription, confirmer FROM membres ORDER BY id DESC");
 											
									while ($userinfo = $requser->fetch()):
										$userid = (int)$userinfo['id'];
										//recuperer tout les debits
										$debit = UserDebitInfo($userid);
										if (!empty($debit)) {
											foreach ($debit as $k => $value) {
												$DebitMont[] = $value['montant']; 
											}
										}
										if (isset($DebitMont)) {
											$DebMont = array_sum($DebitMont);
											$debit = [];
											$DebitMont = [];
										}

										//recuperer tout les credits
										$credit = UserCreditInfo($userid);
										if (!empty($credit)){
											foreach ($credit as $k => $value) {
												$CreditMont[] = $value['montant']; 
											}
										}
										if (isset($CreditMont)) {
											$CredMont = array_sum($CreditMont);
											$credit = [];
											$CreditMont = [];
										}
										$solde = $CredMont - $DebMont;
										?>
									<tr>
										<td scope="row" class="id"><?= $userid ?> </td>
										<td><?= $userinfo['nom']." ".$userinfo['prenoms'] ?></td>
										<td class="mail"><?= $userinfo['mail'] ?></td>
										<td class="date"><?= $userinfo['date_inscription'] ?></td>
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
										<td>
											<?php if ($userinfo['confirmer'] == 0) {?>
												<a  href="admin.php?id=<?= $_SESSION['adminid']?>&confirmer=<?= $userinfo['id']?>">confirmer</a>
											<?php 
											} else {
												echo 'actif';
											}		
											?>
										</td>
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