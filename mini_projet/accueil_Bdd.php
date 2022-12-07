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

        section {
          height:100px;
        }
    </style>
  </head>
  <body>
    <!-- Header -->
    <header>
        <h1>Accueil Bdd</h1>
    </header>

    <!-- section -->
    <center>
      <section id="main">
        <div style="float:left">
          <p style="font-family: Verdana; font-weight: bold">Bienvenue BddUser<br></p>
          <?php
            setcookie("table", "", time() - 3600);
            $link = mysqli_connect("localhost", "BddUser", "BddUserPass2019", "JeuxVideo");
            date_default_timezone_set('Europe/Paris');
            $date=date("d:m:o");
            $heure=date("H:i");
            echo 'le '.$date.' à '.$heure.'<br/><br/>';
            $result = mysqli_query($link, "show tables;");
          ?>
        </div>
        <div style="float:right; vertical-align:middle;">
          <p>Choix de la table:</p>
          <form method="post">
            <select name="choix_table">
              <?php
              while($table = mysqli_fetch_array($result)) {
                  echo("<option value=".$table[0].">".$table[0]."</option>");
              }
              ?>
            </select>
            <input type="submit" value="Sélectionner" formaction="page_table.php"/>
          </form>
        </div>
      </section>
    </center>

     <!-- footer -->
     <footer id="mentions">
        <nav>
            <ul>
                <li><img src="../image/retour.png" height="20px"><a href="accueil.php" style="color:#fff;">Retour à la page d'accueil </a></li>
            </ul>
        </nav>
     </footer>
  </body>
</html>
