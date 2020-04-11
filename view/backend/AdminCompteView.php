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
              <h1>COMPTE</h1>
            </div>
            <div class="info col-12">
              <table width="100%">
                <tr>
                  <td>User</td>
                  <td><?php echo $admininfo['nom']?></td>
                </tr>
                <tr>
                  <td>Mail</td>
                  <td> <?= $admininfo['mail'] ?></td>
                </tr>
                <tr>
                  <td>Contacte</td>
                  <td><?= $admininfo['contacte'] ?></td>
                </tr>
                <tr>
                  <td>Reference</td>
                  <td><?= $admininfo['reference']?></td>
                </tr>
              </table>
            </div>
            <div class="col-12">
              <div class="button-container row" style="text-align: center;">
                <div class="delete-button non col-8">
                  <a href="admin.php?id=<?= $_SESSION['adminid']?>&action=edit">edit</a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</body>
