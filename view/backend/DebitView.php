<body>
    <div class="container delete-container d-flex justify-content-center">
      <div class="debit-content col-8">
        <h1>Debiter le compte de : <?php echo $userinfo['nom']." ".$userinfo['prenoms']." avec pour email : ".$userinfo['mail'] ?></h1>
        <h2> Noter dans le champ la somme a debiter </h2>
        <form id="debit-form" method="POST">
          <input class="champdesaisir debit-champ" type="number" name="montdebit" placeholder="montant a debiter"> <br>
          <input class="form-bouton debit-button" name="debiter" type="submit" value="Envoyer" />
        </form>
      </div>
    </div>
  </body>