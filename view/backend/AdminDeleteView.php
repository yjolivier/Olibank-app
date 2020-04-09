<body>
    <div class="container delete-container d-flex justify-content-center">
      <div class="delete-content col-8">
        <h1>Vous voulez Supprimer ce Utilisateur ?</h1>
        <h2>
          <?php echo $userinfo['nom']." ".$userinfo['prenoms']." avec pour email : ".$userinfo['mail'] ?>
          <br>
          Si vous confirmez les données supprimées ne pourrons plus être récupérées 
        </h2>
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
</body>