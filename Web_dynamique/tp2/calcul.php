<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <link href="../../image/LogoSN" rel="icon" type="image/png"/>
    <title>BTS SN</title>
  </head>
  <body>
    <?php
    if (isset($_GET['valeur1']) && isset($_GET['valeur2']) && isset($_GET['opération']) && ctype_digit($_GET['valeur1']) && ctype_digit($_GET['valeur2']))
    {
      $valeur1= $_GET['valeur1'];
      $valeur2= $_GET['valeur2'];
      $opération=$_GET['opération'];
      echo 'La valeur 1: '.$valeur1.'<br/>';
      echo 'La valeur 2: '.$valeur2.'<br/>';
      echo "L'opérateur: ".$opération.'<br/><br/>';
      $calcul=$opération;
      echo 'Le calcul:<br/>';
    }
    else
    {
	     echo "Il faut renseigner les deux valeur et l'operateur !<br/>";
    }
    //
    switch ($calcul) {
      case '*':
        $result =$valeur1*$valeur2;
        echo $valeur1.' '.$opération.' '.$valeur2.' = '.$result.'<br/><br/>';
        break;

      case '-':
        $result =$valeur1*$valeur2;
        echo $valeur1.' '.$opération.' '.$valeur2.' = '.$result.'<br/><br/>';
        break;

      case '/':
        $result =$valeur1*$valeur2;
        echo $valeur1.' '.$opération.' '.$valeur2.' = '.$result.'<br/><br/>';
        break;

      case '+':
        $result =$valeur1*$valeur2;
        echo $valeur1.' '.$opération.' '.$valeur2.' = '.$result.'<br/><br/>';
        break;

      default:
        echo "Tu n'a pas mis un operateur<br/>";
        break;
    }
    //sortie
    echo '<img src="../../image/retour.png" height="20px"><a href="../tp2.php">Retour  aux tp2</a>';
    ?>
  </body>
</html>
