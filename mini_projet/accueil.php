<?php
  session_start();
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <link href="../image/LogoSN" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="fichier_css/accueil.css" type="text/css">
    <title>BTS SN - PHP 3</title>
    <style>
        #number {
        width: 4em;
        }
    </style>
  </head>
  <body>
    <!-- Header -->
    <header>
        <h1>Accueil</h1>
    </header>


    <!-- formulaire 1 (sur le nom) -->
    <center>
     <form method="post">
       <fieldset style="width:300px">
         <legend>Identifiants :</legend>
         <input type="text" name="utili" placeholder="Utilisateur"/><br/>
         <input type="password" name="mdp" placeholder="Mot de passe"/><br/><br/>
         <input type="submit" value="Connexion" formaction="accueil.php"/>
       </fieldset>
     </form>
    </center>

    <?php
      $utili=$_POST["utili"];
      $mdp=$_POST["mdp"];
      if(isset($utili)&&isset($mdp)){
        $link=mysqli_connect("localhost",$utili,$mdp,"JeuxVideo");
        if (!$link){
            echo "
            <center>
              <section  id='main'>
                <p> Erreur : Impossible de se connecter à MySQL. </p>
                <p>Erreur de débogage : " . mysqli_connect_error() . "<P>
            </section>
            </center>";
        }
        else{
            echo "Connexion réussie...";
            sleep(1);
            header("Location: accueil_Bdd.php");
            exit;

        }
      }

    ?>


    <!-- footer -->
     <footer id="mentions">
        <nav>
            <ul>
                <li><img src="../image/retour.png" height="20px"><a href="../index.php" style="color:#fff;">Retour à la page d'accueil </a></li>
                <li><form method="post" style="float:right;"> <input type="submit" value="Déconnexion" formaction="<?php
                setcookie("table", "", time() - 3600);
                session_unset();
                session_destroy();
                ?>"/> </form></li>
            </ul>
        </nav>
     </footer>

  </body>
</html>
