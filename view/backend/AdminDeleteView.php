<body>
    <div class="container-fluid page-container">
      <div class="row page-content">
        <div class="top-card col-lg-12">
          <div class="top-card-content row">
            <span class="back-button col-12"><a href="admin.php?id=<?= $_SESSION['adminid']?>" class="">Retour</a></span>
          </div>
          <section class="info-section col-lg-12 d-flex justify-content-center">
            <div class="row info-section-content ">
              <div class="col-12">
                <h1 >Vous voulez Supprimer ce Utilisateur ?</h1>
              </div>
              <div class="info col-12">
                <table width="100%">
                  <tr>
                    <td>User</td>
                    <td><?= $userinfo['nom']." ".$userinfo['prenoms']?></td>
                  </tr>
                  <tr>
                    <td>Mail</td>
                    <td><?= $userinfo['mail'] ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-12">
                <div class="button-container">
                  <div class="delete-button oui">
                    <a href="admin.php?id=<?= $getid?>&action=supprimer&value=<?= $oui ?>">Oui</a>
                  </div>
                  <div class="delete-button non">
                    <a href="admin.php?id=<?= $_SESSION['adminid']?>">non</a>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </body>