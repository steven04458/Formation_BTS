<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <link href="../image/LogoSN" rel="icon" type="image/png"/>
    <title>BTS SN - PHP 1</title>
  </head>
  <body>
    <img src="../image/LogoSN" widht"200px" height="100px" align=right>
    <?php
    date_default_timezone_set('Europe/Paris');
    $date=date("d:m:o");
    $heure=date("H:i");
    $chemin_absolue=realpath('index.php');

    $age= 19;
    $nom= "Magaud";
    $class= "BTS SNIR";

    $nombre_1= 180;
    $nombre_2= 260;
    $operation= '*';

    $bissextile= date("L");

    function presentation($age,$nom,$class)
    {
      echo 'Mr.'.$nom.' a '.$age.' ans et est en classe de '.$class.'<br/><br/>';
    }

    function calcul($nombre_1,$nombre_2,$operation)
    {
      if ($operation=='*') {
        $resulta=$nombre_1*$nombre_2;
        echo $nombre_1.' '.$operation.' '.$nombre_2.' = '.$resulta.'<br/><br/>';

      } elseif ($operation=='+') {
        $resulta=$nombre_1+$nombre_2;
        echo $nombre_1.' '.$operation.' '.$nombre_2.' = '.$resulta.'<br/><br/>';

      } elseif ($operation=='-') {
        $resulta=$nombre_1-$nombre_2;
        echo $nombre_1.' '.$operation.' '.$nombre_2.' = '.$resulta.'<br/><br/>';
    		// Année NON bissextile
    		// vous remplacez le retour par ce que vou voulez
      }elseif ($operation=='/') {
        $resulta=$nombre_1/$nombre_2;
        echo $nombre_1.' '.$operation.' '.$nombre_2.' = '.$resulta.'<br/><br/>';

      }else{
        echo "mauvai operateur<br/>";
      }
    }

    function est_bissextile($bissextile)
    {
      if ($bissextile==1) {
        echo "Notre année est bissextile.<br/><br/>";

      } else {
        echo "Notre année n'est pas bissextile.<br/><br/>";
      }

    }

    function calcul_bissextile($annee) {
	     if( (is_int($annee/4) && !is_int($annee/100)) || is_int($annee/400)) {
		      echo "oui <br/><br/>";

	     }else {
    		echo "non <br/><br/>";
    	}
    }

    echo "it works! <br/><br/>";
    echo "Le chemin absolue du fichier index.php est :";
    echo "<b>$chemin_absolue</b><br/>";
    echo '<br/>';
    echo 'Nous sommes le '.$date.' et il est '.$heure.'<br/><br/>';
    presentation($age,$nom,$class);
    calcul($nombre_1,$nombre_2,$operation);
    est_bissextile($bissextile);
    echo "L\'année choisi est-elle bissextile: ";
    echo calcul_bissextile(2017);

     ?>
     <p><img src="../image/retour.png" height="20px"><a href="../index.php">Retoure  a la page d'accueil</a></p>
  </body>
</html>
