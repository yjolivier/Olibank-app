<body>
  <div class="container-fluid page-container">
    <div class="row page-content">
      <div class="top-card col-lg-12">
        <div class="top-card-content row">
          <span class="back-button col-12"><a href="admin.php?id=<?= $_SESSION['adminid']?>">Retour</a></span>
        </div>
        <section class="info-section col-lg-12 d-flex justify-content-center">
          <div class="row info-section-content ">
            <div class="col-12">
              <h1 >Debiter le compte de</h1>
            </div>
            <div class="info col-12">
              <table width="100%">
                <tr>
                  <td>User</td>
                  <td><?= $userinfo['nom']." ".$userinfo['prenoms'] ?></td>
                </tr>
                <tr>
                  <td>Mail</td>
                  <td><?=$userinfo['mail'] ?></td>
                </tr>
                <tr>
                  <td>Date Inscription</td>
                  <td><?=$userinfo['date_inscription'] ?></td>
                </tr>
                <tr>
                  <td>Id</td>
                  <td><?=$userinfo['id'] ?></td>
                </tr>
              </table>
            </div>
            <div class="col-12">
              <form class="page-form" method="POST">
                <input class="pagechamp" type="number" name="montdebit" placeholder="montant a debiter"><br>
                <input class="button" id="pagesubmit" type="submit" name="debiter" value="Envoyer">
              </form>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</body>
