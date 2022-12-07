<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <link href="../image/LogoSN" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="../fichier_css/Web_D_tp3.css" type="text/css">
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
        <img src="../image/LogoSN" widht"200px" height="100px" align=right>
        <h1>TP5:PHP-3 les formulaires</h1>
    </header>

    <!-- section -->
    <section id="main">
        <p><b>MAGAUD S.</b><br/></p>
        <?php
        date_default_timezone_set('Europe/Paris');
        $date=date("d:m:o");
        $heure=date("H:i");

        echo 'le '.$date.' à '.$heure.'<br/><br/>';
        ?>
    </section>

    <!-- formulaire 1 (sur le nom) -->
     <form method="post">
       <fieldset>
         <legend>information:</legend>
         <p>Votre nom:</p>
         <input type="text" name="name" placeholder="nom"/><br/><br/>
         <input type="submit" value="envoit" formaction="Web_D_tp3/traitement.php"/>
       </fieldset>
     </form>

     <br/>
     <!-- formulaire 2 (sur l'adresse IP) -->
     <form method="post">
       <fieldset>
         <legend>adresse IP:</legend>
         <p>Indiquer votre adresse IP:</p>
         <input id="number" type="number" name="adresse1" max="255" min="0" placeholder="192"/>
         <input id="number" type="number" name="adresse2" max="255" min="0" placeholder="168"/>
         <input id="number" type="number" name="adresse3" max="255" min="0" placeholder="10"/>
         <input id="number" type="number" name="adresse4" max="255" min="0" placeholder="20"/><br/><br/>
         <p>Indiquer votre masque de sous réseau:</p>
         <input id="number" type="number" name="masque1" max="255" min="0" placeholder="255"/>
         <input id="number" type="number" name="masque2" max="255" min="0" placeholder="255"/>
         <input id="number" type="number" name="masque3" max="255" min="0" placeholder="255"/>
         <input id="number" type="number" name="masque4" max="255" min="0" placeholder="0"/><br/><br/>
         <input type="submit" value="envoi" formaction="Web_D_tp3/traitement.php"/>
         <input type="reset" value="annuler">
       </fieldset>
     </form>


     <!-- footer -->
     <footer id="mentions">
        <nav>
            <ul>
                <li><img src="../image/retour.png" height="20px"><a href="../index.php" style="color:#fff;">Retour à la page d'accueil </a></li>
                <li><a href="tp3/traitement.php" style="color:#fff;">•Aller à la page de traitement </a></li>
            </ul>

        </nav>

     </footer>


  </body>
</html>
