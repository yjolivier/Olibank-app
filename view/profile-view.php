<?php require 'header.php'; ?>
<body>
		<div class="container-fluid">
			<header class="row sticky-top">
					<div class="header-logo col-lg-4 col-sm-6 col-6">
						<h2>Espace Client</h2>
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
										<a class="nav-link" href="page.php?id=<?= $_SESSION['id']?>">ACCUEIL</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="page.php?id=<?= $_SESSION['id']?>&value=compte">compte</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="page.php?id=<?= $_SESSION['id']?>&value=contacte">CONTACTE</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="page.php?value=deconnexion">Deconnexion</a>
									</li>
								</ul>
							</div>
						</nav>
					</div>
			</header>
			<div class="slider row"></div>
			<section class="page-content row">
			<?php if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']):?>
				<div class="content-card-left col-lg-6">
					<div class="row">
						<div class="card-img col-12">
							<img src="public/img/slide.jpg" alt="..." >
						</div>
						<div class="title col-12">
							<h2><?php echo $userinfo['nom'] . ' ' . $userinfo['prenoms']?></h2>
							<div class="solde-content">
								<h2>
								<?php
									if (isset($CredMont) AND isset($DebMont)){
										if ($CredMont < $DebMont) {
											$solde = $DebMont - $CredMont;
											$_SESSION['mbrsolde'] = $solde;
											echo 'Solde crediteure : '.$solde;
										}
										else {
											$solde = $CredMont - $DebMont;
											$_SESSION['mbrsolde'] = $solde;
											echo 'Solde Debiteure : '.$solde.' F';
										}
									}
								?>
								</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="content-card-right col-lg-6">
					<div class="row">
						<div class="historique-title col-12">
							<h1>HISTORIQUE</h1>
						</div>
						<div class="historique-card col-12">
							<div class="row">
								<table id="debit-credit" class="col-6" border="1">
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
								<table id="debit-credit" class="col-6" border="1">
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
				<?php endif; ?>
			</section>
			<footer class="row">
					<div class="col-12">
						<p>©Designed by OtoiSofware</p>
					</div>
			</footer>
		</div>
	</body>
	<?php require 'footer.php'; ?>