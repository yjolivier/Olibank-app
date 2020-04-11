<body>
  <div class="container-fluid page-container">
    <div class="row page-content">
      <div class="top-card col-lg-12">
        <div class="top-card-content row">
          <span class="back-button col-12"><a href="page.php?id=<?= $_SESSION['id']?>" class="">Retour</a></span>
        </div>
        <section class="info-section col-lg-12 d-flex justify-content-center">
          <div class="row info-section-content ">
            <div class="col-12">
              <h1 >COMPTE</h1>
            </div>
            <div class="info col-12">
              <table width="100%">
                <tr>
                  <td>User</td>
                  <td><?php echo $userinfo['nom'].' '.$userinfo['prenoms'] ?></td>
                </tr>
                <tr>
                  <td>Mail</td>
                  <td> <?= $userinfo['mail'] ?></td>
                </tr>
                <tr>
                  <td>Date Inscription</td>
                  <td><?= $userinfo['date_inscription'] ?></td>
                </tr>
                <tr>
                  <td>Solde</td>
                  <td><?= $_SESSION['mbrsolde'].' F'?></td>
                </tr>
              </table>
            </div>
            <div class="col-12">
              <div class="button-container row" style="text-align: center;">
                <div class="delete-button non col-8">
                  <a href="page.php?id=<?= $_SESSION['id']?>&value=edit">edit</a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</body>
