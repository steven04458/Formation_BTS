<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <link href="../../image/LogoSN" rel="icon" type="image/png"/>
    <title>BTS SN</title>
  </head>
  <body>
    <?php
    if (isset($_GET['annee']) && ctype_digit($_GET['annee']))
    {
      $an= $_GET['annee'];
        echo $an.'<br/>';
    }
    else
    {
	     echo 'Il faut renseigner une annee !<br/>';
    }
    echo '<img src="../../image/retour.png" height="20px"><a href="../tp2.php">Retour aux tp2</a>';
     ?>
  </body>
</html>
