<body>
    <div class="container delete-container d-flex justify-content-center">
      <div class="delete-content col-8 " style="text-align: left;">
        <h1><?php echo $userinfo['nom'].' '.$userinfo['prenoms'] ?></h1>
        <h2>
          E-mail : <?= $userinfo['mail'] ?> <br><br>
          Date inscription : <?= $userinfo['date_inscription'] ?> <br><br>
          Solde : <?= $_SESSION['mbrsolde'].' F'?>
        </h2>
        <div class="button-container" style="text-align: center;">
          <div class="delete-button oui">
            <a href="page.php?id=<?= $_SESSION['id']?>">retour</a>
          </div>
          <div class="delete-button non">
            <a href="page.php?id=<?= $_SESSION['id']?>&value=edit">edit</a>
          </div>
        </div>
      </div>
    </div>
</body>
</html>