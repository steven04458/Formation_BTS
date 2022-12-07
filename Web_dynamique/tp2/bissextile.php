<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <link href="../../image/LogoSN" rel="icon" type="image/png"/>
    <title>BTS SN</title>
  </head>
  <body>
    <?php
    //fonction
    function est_bissextile($an_bis) {
	     if( (is_int($an_bis/4) && !is_int($an_bis/100)) || is_int($an_bis/400)) {
		      echo $an_bis.' <br/>';

	     }
    }
    //debut
    if (isset($_GET['annee_bissextile']) && ctype_digit($_GET['annee_bissextile']))
    {
      $an_bis= (int)$_GET['annee_bissextile'];
      if (($an_bis>=0) && ($an_bis<=3000))
      {
        $a=0;
        while ($a <= $an_bis)
        {
          est_bissextile($a);
          $a=$a+1;
        }
      }
      else {
        echo "Ta valeur est soit trop bas ou soit trop haute.<br/>";
      }
    }
    else
    {
	     echo 'Il faut renseigner une annee !<br/>';
    }
    //sortie
    echo '<img src="../../image/retour.png" height="20px"><a href="../tp2.php">Retour  aux tp2</a>';
     ?>
  </body>
</html>
