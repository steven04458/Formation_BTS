<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <link href="../../image/LogoSN" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="../../fichier_css/Web_D_tp3.css" type="text/css">
    <title>BTS SN</title>
    <style>
      table,td {
          border: 1px solid #333;
      }

      thead,tfoot,#fond {
          background-color: #333;
          color: #fff;
      }
    </style>
  </head>
  <body>
    <!-- Header -->
    <header>
        <h1>Page de Traitement</h1>
    </header>

    <!-- section -->
    <section id="main">
      <?php
      //verifie  le nom
      if (isset($_POST['name']) && ctype_alpha($_POST['name']))
      {
          $nom= $_POST['name'];
          echo 'Bonjour '.$nom.'<br/>';
      }
      else
      {
         echo "T'a pas mis tont nom !<br/>";
      }
      ?>
    </section>


    <?php
    //verifie l'adresse IP
    if (isset($_POST['adresse1']) && isset($_POST['adresse2']) && isset($_POST['adresse3']) && isset($_POST['adresse4']))
    {
      if (ctype_digit($_POST['adresse1']) && ctype_digit($_POST['adresse2']) && ctype_digit($_POST['adresse3']) && ctype_digit($_POST['adresse4']))
      {

        $IP= $_POST['adresse1'].'.'.$_POST['adresse2'].'.'.$_POST['adresse3'].'.'.$_POST['adresse4'];
        $IPbin1=str_pad(decbin($_POST['adresse1']), 8, "0", STR_PAD_LEFT);
        $IPbin2=str_pad(decbin($_POST['adresse2']), 8, "0", STR_PAD_LEFT);
        $IPbin3=str_pad(decbin($_POST['adresse3']), 8, "0", STR_PAD_LEFT);
        $IPbin4=str_pad(decbin($_POST['adresse4']), 8, "0", STR_PAD_LEFT);
        $IPbinaire= $IPbin1.'.'.$IPbin2.'.'.$IPbin3.'.'.$IPbin4;
        $b=1;

        //classe d'adresse
        if ($_POST['adresse1']>=0 && $_POST['adresse1']<127)
        {
          $classe="classe A";
        }elseif ($_POST['adresse1']>=128 && $_POST['adresse1']<192)
        {
          $classe="classe B";
        }elseif ($_POST['adresse1']>=192 && $_POST['adresse1']<224)
        {
          $classe="classe C";
        }elseif ($_POST['adresse1']>=224 && $_POST['adresse1']<240)
        {
          $classe="classe D";
        }elseif ($_POST['adresse1']>=240 && $_POST['adresse1']<256)
        {
          $classe="classe E";
        }else {
          $classe= "Mauvais !";
        }
      }
      else
      {
  	     $IP= "Mauvais adresse IP !";
         $IPbinaire= "Mauvais adresse IP !";
         $b=0;
         $classe= "Mauvais !";
      }
    }
    else
    {
	     $IP= "Mauvais adresse IP !";
       $IPbinaire= "Mauvais adresse IP !";
       $b=0;
       $classe= "Mauvais !";
    }

    //verifie le masque de sous reseau
    if (isset($_POST['masque1']) && isset($_POST['masque2']) && isset($_POST['masque3']) && isset($_POST['masque4']))
    {
      if (ctype_digit($_POST['masque1']) && ctype_digit($_POST['masque2']) && ctype_digit($_POST['masque3']) && ctype_digit($_POST['masque4']))
      {

        $masq= $_POST['masque1'].'.'.$_POST['masque2'].'.'.$_POST['masque3'].'.'.$_POST['masque4'];
        $masqbin1=str_pad(decbin($_POST['masque1']), 8, "0", STR_PAD_LEFT);
        $masqbin2=str_pad(decbin($_POST['masque2']), 8, "0", STR_PAD_LEFT);
        $masqbin3=str_pad(decbin($_POST['masque3']), 8, "0", STR_PAD_LEFT);
        $masqbin4=str_pad(decbin($_POST['masque4']), 8, "0", STR_PAD_LEFT);
        $masqBinaire= $masqbin1.'.'.$masqbin2.'.'.$masqbin3.'.'.$masqbin4;
        $a=1;
      }
      else
      {
  	     $masq= "Mauvais masque de sous reseau !";
         $masqBinaire= "Mauvais masque de sous reseau !";
         $a=0;
      }
    }
    else
    {
	     $masq= "Mauvais masque de sous reseau !";
       $masqBinaire= "Mauvais masque de sous reseau !";
       $a=0;
    }
    //adresse reseau
    if ($a==1 && $b==1) {
      $invmasq=long2ip( ~ip2long($masq));
      $adreseau=long2ip( ip2long($IP) & ip2long($masq));
      $bcast=long2ip( ip2long($IP) | ip2long($invmasq));
      //premier adresse reseau
      $fplus1= substr($adreseau,-1);
      $fplus2=$fplus1+1;
      $premadresau= substr($adreseau,0,-1).$fplus2;

      //dernier adresse reseau
      $fmoin1= substr($bcast,-1);
      $fmoin2=$fmoin1-1;
      $dernadreseau= substr($bcast,0,-1).$fmoin2;

      //adresse en binaire
      $adreseau2=explode(".",$adreseau);
      $adre1=str_pad(decbin($adreseau2[0]), 8, "0", STR_PAD_LEFT);
      $adre2=str_pad(decbin($adreseau2[1]), 8, "0", STR_PAD_LEFT);
      $adre3=str_pad(decbin($adreseau2[2]), 8, "0", STR_PAD_LEFT);
      $adre4=str_pad(decbin($adreseau2[3]), 8, "0", STR_PAD_LEFT);
      $adreseauBinaire= $adre1.".".$adre2.".".$adre3.".".$adre4;

      $premadresau2=explode(".",$premadresau);
      $preadre1=str_pad(decbin($premadresau2[0]), 8, "0", STR_PAD_LEFT);
      $preadre2=str_pad(decbin($premadresau2[1]), 8, "0", STR_PAD_LEFT);
      $preadre3=str_pad(decbin($premadresau2[2]), 8, "0", STR_PAD_LEFT);
      $preadre4=str_pad(decbin($premadresau2[3]), 8, "0", STR_PAD_LEFT);
      $premadresauBinaire= $preadre1.".".$preadre2.".".$preadre3.".".$preadre4;

      $dernadreseau2=explode(".",$dernadreseau);
      $deradre1=str_pad(decbin($dernadreseau2[0]), 8, "0", STR_PAD_LEFT);
      $deradre2=str_pad(decbin($dernadreseau2[1]), 8, "0", STR_PAD_LEFT);
      $deradre3=str_pad(decbin($dernadreseau2[2]), 8, "0", STR_PAD_LEFT);
      $deradre4=str_pad(decbin($dernadreseau2[3]), 8, "0", STR_PAD_LEFT);
      $dernadreseauBinaire=$deradre1.".".$deradre2.".".$deradre3.".".$deradre4;

    }
    else {
      $adreseau= "Mauvais !";
      $premadresau= "Mauvais !";
      $dernadreseau= "Mauvais !";
      $adreseauBinaire= "Mauvais !";
      $premadresauBinaire= "Mauvais !";
      $dernadreseauBinaire= "Mauvais !";

    }

     ?>
     <!-- tableau de l'adresse IP -->
     <table>
        <thead>
            <tr>
                <th colspan="3">Adresse IPv4:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>adresse IP:</td>
                <td><?php echo $IP ?></td>
                <td><?php echo $IPbinaire ?></td>
            </tr>
            <tr>
                <td>masque de sous reseau:</td>
                <td><?php echo $masq ?></td>
                <td><?php echo $masqBinaire ?></td>
            </tr>
            <tr>
                <td>Adresse reseau:</td>
                <td><?php echo $adreseau ?></td>
                <td><?php echo $adreseauBinaire ?></td>
            </tr>
            <tr>
                <td>Premier adresse reseau:</td>
                <td><?php echo $premadresau ?></td>
                <td><?php echo $premadresauBinaire ?></td>
            </tr>
            <tr>
                <td>derniere adresse reseau:</td>
                <td><?php echo $dernadreseau ?></td>
                <td><?php echo $dernadreseauBinaire ?></td>
            </tr>
            <tr>
                <td>Classe d'adresse:</td>
                <td><?php echo $classe ?></td>
                <td id="fond"></td>
            </tr>
        </tbody>
      </table>
      <!-- footer -->
    <footer id="mentions">
      <p><img src="../../image/retour.png" height="20px"><a href="../tp3.php" style="color:#fff;">Retour  aux tp3</a></p>
    </footer>
  </body>
</html>
