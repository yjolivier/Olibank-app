<body>
  <div class="container-fluid page-container">
    <div class="row page-content">
      <div class="top-card col-lg-12">
        <div class="top-card-content row">
          <span class="back-button col-12"><a href="page.php?id=<?= $_SESSION['id'] ?>">Retour</a></span>
        </div>
        <section class="info-section col-lg-12 d-flex justify-content-center">
          <div class="row info-section-content ">
            <div class="col-12">
              <h1>Contacte Service</h1>
            </div>
            <div class="info col-12">
              <table width="100%">
                <tr>
                  <td>User</td>
                  <td><?= $req['nom']?></td>
                </tr>
                <tr>
                  <td>Mail</td>
                  <td><?= $req['mail']?></td>
                </tr>
                <tr>
                  <td>Contacte</td>
                  <td><?= $req['contacte']?></td>
                </tr>
              </table>
            </div>
          </div>
        </section>
      </div>
      <div class="bottom-card col-lg-12">
      </div>
    </div>
  </div>
</body>