<?php
  session_start();
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <link href="../image/LogoSN" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="fichier_css/accueil_Bdd.css" type="text/css">
    <title>BTS SN - PHP 3</title>
    <style>
        #number {
        width: 4em;
        }
        #main {
        	float:left;
        	width:30%;
        	border:1px dashed #444;
        	margin:1em;
        	padding:1em;
        	background:#fff;
        }
    </style>
  </head>
  <body>
    <!-- Header -->
    <header>
        <h1>Page pour la carte</h1>
    </header>

    <!-- section -->
    <center>
      <section id="main">
        <div style="float:left">
          <p style="font-family: Verdana; font-weight: bold">Bienvenue BddUser<br></p>
          <?php
            $link = mysqli_connect("localhost", "BddUser", "BddUserPass2019", "JeuxVideo");
            date_default_timezone_set('Europe/Paris');
            $date=date("d:m:o");
            $heure=date("H:i");
            echo 'le '.$date.' à '.$heure.'<br/><br/>';
          ?>
      </section>
    </center>

    <!-- footer -->
     <footer id="mentions">
        <nav>
            <ul>
              <li><img src="../image/retour.png" height="20px"><a href="accueil.php" style="color:#fff;">Retour à la page d'accueil</a></li>
              <li><a href="accueil_Bdd.php" style="color:#fff;">•Retour à l'accueil de la base de donnée</a></li>
              <li><a href="page_table.php" style="color:#fff;">•Retour a la page de la table</a></li>
            </ul>
        </nav>
     </footer>

  </body>
</html>
