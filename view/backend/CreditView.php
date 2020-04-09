<body>
    <div class="container delete-container d-flex justify-content-center">
      <div class="debit-content col-8">
        <h1>Crediter le compte de : <?php echo $userinfo['nom']." ".$userinfo['prenoms']." avec pour email : ".$userinfo['mail'] ?></h1>
        <h2> Noter dans le champ la somme a Crébiter </h2>
        <form id="debit-form" method="POST">
          <input class="champdesaisir debit-champ" type="number" name="montcredit" placeholder="montant a debiter"> <br>
          <input class="form-bouton debit-button" name="crediter" type="submit" value="Envoyer" />
        </form>
      </div>
    </div>
  </body>