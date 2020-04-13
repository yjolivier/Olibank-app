<?php require 'header.php'; ?>
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
					<li><a href="page.php?id=<?= $_SESSION['id']?>">ACCUEIL</a> </li>
					<li><a class="nav-link" href="page.php?id=<?= $_SESSION['id']?>&value=compte">compte</a></li>
					<li><a class="nav-link" href="page.php?id=<?= $_SESSION['id']?>&value=contacte">CONTACTE</a></li>
					<li><a class="nav-link" href="page.php?value=deconnexion">Deconnexion</a></li>
					<li><a href="#">Portfolio</a> </li>
				</ul>
    	</header>
			<?php if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']):?>
				<?php if($userinfo['confirmer'] == 1){ ?>
					<div class="slider row d-flex justify-content-center"> 
						<h1><?php echo $userinfo['nom'] . ' ' . $userinfo['prenoms']?></h1>
					</div>
					<section class="profile-page-container row d-flex justify-content-center">
						<div class="col-lg-11 profile-page-content">
							<div class="content-card-left col-lg-4">
								<div class="row">
									<div class="title col-12">
											<h2>
											<?php
												if (isset($CredMont) AND isset($DebMont)){
													if ($CredMont < $DebMont) {
														$solde = $DebMont - $CredMont;
														$_SESSION['mbrsolde'] = $solde;
														echo 'Solde crediteure ';
													}
													elseif($CredMont > $DebMont) {
														$solde = $CredMont - $DebMont;
														$_SESSION['mbrsolde'] = $solde;
														echo 'Solde Debiteure : ';
													}
													else {
														echo "Solde null !";
													}
												}
											?>
										</h2>
									</div>
									<div class="card-img col-12 d-flex justify-content-center">
										<h2 class="align-self-center">
											<?php 
												if (isset($_SESSION['mbrsolde'])){ 
													echo $_SESSION['mbrsolde'].' F';
												} 
											?>
										</h2>
									</div>
									
								</div>
							</div>
							<div class="content-card-right col-lg-8">
								<div class="row">
									<div class="historique-card col-12">
										<div class="row">
											<table id="debit-credit" class="col-md-6 col-12" border="1">
												<thead>
													<tr align="center">
														<th colspan="2">debit</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<th>date</th>
														<th>montant</th>
													</tr>
													<?php if(!empty($debit)){ foreach ($debit as $k => $value) {?>
													<tr>
														<td><?= $value['date'] ?></td>
														<td><?= $value['montant']?></td>
													</tr>
													<?php }} ?>
												</tbody>
											</table>
											<table id="debit-credit" class="col-md-6 col-12" border="1">
												<thead>
													<tr align="center">
														<th colspan="2">credit</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<th>date</th>
														<th>montant</th>
													</tr>
													<?php if(!empty($credit)){ foreach ($credit as $k => $value) {?>
													<tr>
														<td><?= $value['date'] ?></td>
														<td><?= $value['montant']?></td>
													</tr>
													<?php } }?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
					<?php } else { ?>
						<div>
							<h1>Desoler votre site n'est pas encore confirmer par l'agence<br> Cette operation prendra tout au plus 48h <br> Merci de patienter </h1>
						</div>
					<?php } ?>
			<?php endif; ?>
			<footer class="row">
					<div class="col-12">
						<p>©Designed by OtoiSofware</p>
					</div>
			</footer>
		</div>
	</body>
	<?php require 'footer.php'; ?>