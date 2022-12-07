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
        #main2 {
          text-align: left;
        	width:40%;
        	border:1px dashed #444;
        	margin:1em;
        	padding:1em;
        	background:#fff;
        }

        #main3 {
          text-align: left;
        	width:40%;
        	border:1px dashed #444;
        	padding:1em;
        	background:#fff;
        }
        #main3.form {
          text-align: justify;
        }

        #main2 ,#main3 {
          display: inline-block;
          vertical-align: middle;


        }
        tr {
          border: 1px solid #562e00;
        }

        input:checked + label {
          color: red;
          font-weight: bold;
        }

        option:checked {
          box-shadow: 0 0 0 3px lime;
          color: red;
          font-weight: bold;
        }

        input:out-of-range {
          color: red;
          font-weight: bolder;
        }
    </style>
  </head>
  <body>
    <!-- Header -->
    <header>
        <h1>Page Table</h1>
    </header>

    <!-- section -->
    <center>
      <section id="main">
          <p style="font-family: Verdana; font-weight: bold">Bienvenue BddUser<br></p>


          <?php
            $hid="Location: accueil_Bdd.php";
            // predefinir les table
            $tabvillesfrance = array("ville_id","ville_departement","ville_slug","ville_nom","ville_nom_simple","ville_nom_reel","ville_nom_soundex","ville_nom_metaphone","ville_code_postal","ville_commune","ville_code_commune","ville_arrondissement","ville_canton","ville_amdi","ville_population_2010","ville_population_1999","ville_population_2012","ville_densite_2010","ville_surface","ville_longitude_deg","ville_latitude_deg","ville_longitude_grd","ville_latitude_grd",
            "ville_longitude_dms","ville_latitude_dms","ville_zmin","ville_zmax");
            $tabteste = array("ID","Nom","Prenom");
            $tabjv = array("ID", "nom", "possesseur", "console", "prix", "nbre_joueurs_max", "commentaires");

            //
            $link = mysqli_connect("localhost", "BddUser", "BddUserPass2019", "JeuxVideo");
            date_default_timezone_set('Europe/Paris');
            $date=date("d:m:o");
            $heure=date("H:i");
            echo 'Le '.$date.' à '.$heure.'<br/><br/>';
            $wait = 1;



            // CODE AFFICHAGE TABLE (FONCTIONNEL)
            if($_POST["choix_table"]=="teste" || $_COOKIE["table"]=="teste"){
              setcookie("table", "", time() - 3600);
              setcookie("table", "teste");
              $result = mysqli_query($link, "SELECT * FROM teste");
              if($result->num_rows>0){
                echo "
                <table border='1'>
                <tr>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Prenom</th>
                </tr>";
                while($row = $result->fetch_assoc()) {
                  echo "
                  <tr>
                    <td>".$row['ID']."</td>
                    <td>".$row['Nom']."</td>
                    <td>".$row['Prenom']."</td>
                  </tr>";
                }
                echo "</table>";
              }
              else{
                echo "0 résultats";
              }
            }
            else if($_POST["choix_table"]=="jeux_video" || $_COOKIE["table"]=="jeux_video"){
              setcookie("table", "", time() - 3600);
              setcookie("table", "jeux_video");
              $result = mysqli_query($link, "SELECT * FROM jeux_video");

              if ($result->num_rows>0) {
                echo "
                <table border='1'>
                <tr>
                  <th>ID</th>
                  <th>nom</th>
                  <th>possesseur</th>
                  <th>console</th>
                  <th>prix</th>
                  <th>nbre_joueurs_max</th>
                  <th>commentaires</th>
                </tr>";
                while($row = $result->fetch_assoc()) {
                  echo "
                  <tr>
                    <td>".$row['ID']."</td>
                    <td>".$row['nom']."</td>
                    <td>".$row['possesseur']."</td>
                    <td>".$row['console']."</td>
                    <td>".$row['prix']."</td>
                    <td>".$row['nbre_joueurs_max']."</td>
                    <td>".$row['commentaires']."</td>
                  </tr>";
                }
                echo "</table>";
              }
              else {
                echo "0 résultats";
              }
            }
            else if($_POST["choix_table"]=="villes_france_free" || $_COOKIE["table"]=="villes_france_free"){
              if (isset($_POST["case_ligne1"])== TRUE && isset($_POST["case_ligne2"])== TRUE ) {
                if ($_POST["case_ligne1"]== "" && $_POST["case_ligne2"]== "" ) {
                  $min=1;
                  $max=20;
                }
                else {
                $min=$_POST["case_ligne1"];
                $max=$_POST["case_ligne2"];
                }
              }
              else {
                $min=1;
                $max=20;
              }

              setcookie("table", "", time() - 3600);
              setcookie("table", "villes_france_free");
              $result = mysqli_query($link, "SELECT * FROM villes_france_free");

              $nom_colonne1= "ville_id";

              if ($result->num_rows>0) {
                echo "
                <table border='1'>
                <tr>";
                // colonne
                $oo=0;
                while($oo<count($tabvillesfrance)){
                  if ($_POST["choixcolonne1"]== $tabvillesfrance[$oo] || $nom_colonne1==$tabvillesfrance[$oo] || $_POST["choixcolonne2"]== $tabvillesfrance[$oo] || $_POST["choixcolonne3"]== $tabvillesfrance[$oo]) {
                    echo "<th>".$tabvillesfrance[$oo]."</th>";
                  }
                   else if ($oo<4 && (($_POST["choixcolonne1"]== 'selection1' && $_POST["choixcolonne2"]== 'selection2' && $_POST["choixcolonne3"]== 'selection3')||(isset($_POST["choixcolonne1"])== FALSE && isset($_POST["choixcolonne2"])== FALSE && isset($_POST["choixcolonne3"])== FALSE ))) {
                    echo "<th>".$tabvillesfrance[$oo]."</th>";
                  }
                  else if ($oo<3 && ($_POST["choixcolonne1"]== 'selection1' || $_POST["choixcolonne2"]== 'selection2' || $_POST["choixcolonne3"]== 'selection3' )) {
                    if ($oo<3 &&(($_POST["choixcolonne1"]== 'selection1' && ($_POST["choixcolonne2"]== 'selection2' || $_POST["choixcolonne3"]== 'selection3')) || ($_POST["choixcolonne2"]== 'selection2' &&  $_POST["choixcolonne3"]== 'selection3'))) {
                      echo "<th>".$tabvillesfrance[$oo]."</th>";
                    }
                    else if ($oo<2 &&(($_POST["choixcolonne1"]== 'selection1' && $_POST["choixcolonne2"]!= 'selection2' && $_POST["choixcolonne3"]!= 'selection3') || ($_POST["choixcolonne1"]!= 'selection1' && $_POST["choixcolonne2"]== 'selection2' && $_POST["choixcolonne3"]!= 'selection3') || ($_POST["choixcolonne1"]!= 'selection1' && $_POST["choixcolonne2"]!= 'selection2' && $_POST["choixcolonne3"]== 'selection3'))) {
                      echo "<th>".$tabvillesfrance[$oo]."</th>";
                    }
                  }
                  $oo=$oo+1;
                }
                echo "</tr>";
                //ligne
                for($i=1; $i<=$max; $i++) {
                  $row = $result->fetch_assoc();
                  if ($min<=$i) {
                    echo "<tr>";
                    $o=0;
                    while($o<count($tabvillesfrance)){
                      if ($_POST["choixcolonne1"]== $tabvillesfrance[$o] || $nom_colonne1==$tabvillesfrance[$o] || $_POST["choixcolonne2"]== $tabvillesfrance[$o] || $_POST["choixcolonne3"]== $tabvillesfrance[$o]) {
                        echo "<td>".$row[$tabvillesfrance[$o]]."</td>";
                      }
                       else if ($o<4 && (($_POST["choixcolonne1"]== 'selection1' && $_POST["choixcolonne2"]== 'selection2' && $_POST["choixcolonne3"]== 'selection3')||(isset($_POST["choixcolonne1"])== FALSE && isset($_POST["choixcolonne2"])== FALSE && isset($_POST["choixcolonne3"])== FALSE ))) {
                        echo "<td>".$row[$tabvillesfrance[$o]]."</td>";
                      }
                      else if ($o<3 && ($_POST["choixcolonne1"]== 'selection1' || $_POST["choixcolonne2"]== 'selection2' || $_POST["choixcolonne3"]== 'selection3' )) {
                        if ($o<3 &&(($_POST["choixcolonne1"]== 'selection1' && ($_POST["choixcolonne2"]== 'selection2' || $_POST["choixcolonne3"]== 'selection3')) || ($_POST["choixcolonne2"]== 'selection2' &&  $_POST["choixcolonne3"]== 'selection3'))) {
                          echo "<td>".$row[$tabvillesfrance[$o]]."</td>";
                        }
                        else if ($o<2 &&(($_POST["choixcolonne1"]== 'selection1' && $_POST["choixcolonne2"]!= 'selection2' && $_POST["choixcolonne3"]!= 'selection3') || ($_POST["choixcolonne1"]!= 'selection1' && $_POST["choixcolonne2"]== 'selection2' && $_POST["choixcolonne3"]!= 'selection3') || ($_POST["choixcolonne1"]!= 'selection1' && $_POST["choixcolonne2"]!= 'selection2' && $_POST["choixcolonne3"]== 'selection3'))) {
                          echo "<td>".$row[$tabvillesfrance[$o]]."</td>";
                        }
                      }
                      $o=$o+1;
                    }
                    echo "</tr>";
                  }
                }
                echo "</table>";
              }
              else {
                echo "0 résultats";
              }
            }
            else{
              echo "Il n'y a pas de table !";
            }

            // CODE SUPPRESSION (FONCTIONNEL)
            if(isset($_POST["suppid"])==TRUE && $_COOKIE["table"]=="teste"){
              $result1 = mysqli_real_query($link, "DELETE FROM teste WHERE ".$tabteste[0]."=".$_POST["suppid"].";");
              sleep($wait);
              header($hid);
            }
            else if(isset($_POST["suppid"])==TRUE && $_COOKIE["table"]=="jeux_video"){
              $result1 = mysqli_real_query($link, "DELETE FROM jeux_video WHERE ".$tabjv[0]."=".$_POST["suppid"].";");
              sleep($wait);
              header($hid);
            }
            else if(isset($_POST["suppid"])==TRUE && $_COOKIE["table"]=="villes_france_free"){
              $result1 = mysqli_real_query($link, "DELETE FROM villes_france_free WHERE ".$tabvillesfrance[0]."=".$_POST["suppid"].";");
              sleep($wait);
              header($hid);
            }

            //CODE CREATION (EN COURS)
            if(isset($_POST["creaname_teste"])){
              $q=0;
              $sql="";
              foreach($_POST["creaname_teste"] as $creaname_teste){
                $sql=$sql.",'".$creaname_teste."'";
              }
              $valid_sql = substr($sql,1);
              $creainsert_teste = mysqli_query($link, "INSERT INTO teste VALUES ($valid_sql);");
              sleep($wait);
              header($hid);
            }else{}
            if(isset($_POST["creaname_jv"])){
              $q=0;
              $sql="";
              foreach($_POST["creaname_jv"] as $creaname_jv){
                $sql=$sql.",'".$creaname_jv."'";
              }
              $valid_sql = substr($sql,1);
              $creainsert_jv = mysqli_query($link, "INSERT INTO jeux_video VALUES ($valid_sql);");
              sleep($wait);
              header($hid);
            }else{}
            if(isset($_POST["creaname_villesfrance"])){
              $q=0;
              $sql="";
              foreach($_POST["creaname_villesfrance"] as $creaname_villesfrance){
                $sql=$sql.",'".$creaname_villesfrance."'";
              }
              $valid_sql = substr($sql,1);
              $creainsert_villesfrance = mysqli_query($link, "INSERT INTO villes_france_free VALUES ($valid_sql);");
              sleep($wait);
              header($hid);
            }else{}

            //CODE MODIFICATION (FONCTIONNEL)
            if(isset($_POST["modifname_teste"])){
              $q=0;
              $sql="";
              $modifid= $_POST["modifname_teste"][0];
              foreach($_POST["modifname_teste"] as $modifname_teste){
                $sql=$sql.", ".$tabteste[$q]."='".$modifname_teste."'";
                $q=$q+1;
              }
              $sql2 = substr($sql,1);
              $final_sql = "UPDATE teste SET ".$sql2." WHERE ".$tabteste[0]."=".$modifid.";";
              $modifupdate_teste = mysqli_query($link, $final_sql);
              sleep($wait);
              header($hid);
            }else{}
            if(isset($_POST["modifname_jv"])){
              $q=0;
              $sql="";
              $modifid= $_POST["modifname_jv"][0];
              foreach($_POST["modifname_jv"] as $modifname_jv){
                $sql=$sql.", ".$tabjv[$q]."='".$modifname_jv."'";
                $q=$q+1;
              }
              $sql2 = substr($sql,1);
              $final_sql = "UPDATE jeux_video SET ".$sql2." WHERE ".$tabjv[0]."=".$modifid.";";
              $modifupdate_jv = mysqli_query($link, $final_sql);
              sleep($wait);
              header($hid);
            }else{}
            if(isset($_POST["modifname_villesfrance"])){
              $q=0;
              $sql="";
              $modifid= $_POST["modifname_villesfrance"][0];
              foreach($_POST["modifname_villesfrance"] as $modifname_villesfrance){
                $sql=$sql.", ".$tabvillesfrance[$q]."='".$modifname_villesfrance."'";
                $q=$q+1;
              }
              $sql2 = substr($sql,1);
              $final_sql = "UPDATE villes_france_free SET ".$sql2." WHERE ".$tabvillesfrance[0]."=".$modifid.";";
              $modifupdate_jv = mysqli_query($link, $final_sql);
              sleep($wait);
              header($hid);
            }else{}

          ?>

      </section>
    </center>

    <!-- choix de l'interface -->
    <?php
    if($_POST["choix_table"]=="villes_france_free" || $_COOKIE["table"]=="villes_france_free"){
      echo "
      <center>
      <section id='main'>
        <p>Quelle ligne voulez-vous afficher ?</p>";?>
        <form method="post">
          <input type='number' name='case_ligne1' placeholder='1' min='0' />
          <input type='number' name='case_ligne2' placeholder='20' min='0' />
          <input type='submit' value='Afficher' formaction='page_table.php'/>
          </br>
          <p>Quelle colonne voulez-vous afficher ?</p>
          <?php
          echo "
          <select name='choixcolonne1' style='font-weight:bold'>";
            echo "<option value= selection1 >selection</option>";
            $f=0;
            while($f<count($tabvillesfrance)){
              echo "<option value='".$tabvillesfrance[$f]."'>".$tabvillesfrance[$f]."</option>";
              $f=$f+1;
            }
          echo "
          </select>
          <select name='choixcolonne2' style='font-weight:bold'>";
            echo "<option value= selection2 >selection</option>";
            $f=0;
            while($f<count($tabvillesfrance)){
              echo "<option value='".$tabvillesfrance[$f]."'>".$tabvillesfrance[$f]."</option>";
              $f=$f+1;
            }
          echo "
          </select>
          <select name='choixcolonne3' style='font-weight:bold'>";
            echo "<option value= selection3 >selection</option>";
            $f=0;
            while($f<count($tabvillesfrance)){
              echo "<option value='".$tabvillesfrance[$f]."'>".$tabvillesfrance[$f]."</option>";
              $f=$f+1;
            }
          echo "
          </select>";?>
        </form>
        <?php
        echo "
      </section>
      </center>";
      }
      ?>

    <!-- creation -->
    <center>
      <section id="main2">
        <h3>Création:</h3>
        <form method="post">
          <?php
            if($_POST["choix_table"]=="teste" || $_COOKIE["table"]=="teste"){
              $c1=0;
              while($c1<count($tabteste)){
                echo "<label>Indiquez '".$tabteste[$c1]."': </label>";
                echo "<input type='text' name='creaname_teste[$c1]'></input><br>";
                $c1=$c1+1;
              }
            }
            else if($_POST["choix_table"]=="jeux_video" || $_COOKIE["table"]=="jeux_video"){
              $c1=0;
              while($c1<count($tabjv)){
                echo "<label>Indiquez '".$tabjv[$c1]."': </label>";
                echo "<input type='text' name='creaname_jv[$c1]'></input><br>";
                $c1=$c1+1;
              }
            }
            else if($_POST["choix_table"]=="villes_france_free" || $_COOKIE["table"]=="villes_france_free"){
              $c1=0;
              while($c1<count($tabvillesfrance)){
                echo "<label>Indiquez '".$tabvillesfrance[$c1]."': </label>";
                echo "<input type='text' name='creaname_villesfrance[$c1]'></input><br>";
                $c1=$c1+1;
              }
            }
          ?>
          <input type="submit" value="Créer" formaction="page_table.php"></input>
        </form>
      </section>

      <!-- modifier -->
      <section id="main3">
        <h3>Modification:</h3>
        <form method="post">
          <?php
            if($_POST["choix_table"]=="teste" || $_COOKIE["table"]=="teste"){
              $c1=0;
              while($c1<count($tabteste)){
                echo "<label>Indiquez '".$tabteste[$c1]."': </label>";
                echo "<input type='text' name='modifname_teste[$c1]'></input><br>";
                $c1=$c1+1;
              }
            }
            else if($_POST["choix_table"]=="jeux_video" || $_COOKIE["table"]=="jeux_video"){
              $c1=0;
              while($c1<count($tabjv)){
                echo "<label>Indiquez '".$tabjv[$c1]."': </label>";
                echo "<input type='text' name='modifname_jv[$c1]'></input><br>";
                $c1=$c1+1;
              }
            }
            else if($_POST["choix_table"]=="villes_france_free" || $_COOKIE["table"]=="villes_france_free"){
              $c1=0;
              while($c1<count($tabvillesfrance)){
                echo "<label>Indiquez '".$tabvillesfrance[$c1]."': </label>";
                echo "<input type='text' name='modifname_villesfrance[$c1]'></input><br>";
                $c1=$c1+1;
              }
            }
          ?>
          <input type="submit" value="Créer" formaction="page_table.php"></input>
        </form>
      </section>
    </center>

    <!-- suppression -->
    <center>
      <section id="main">
        <h3>Suppression:</h3>
        <form method='post'>
          <label>Indiquez l'ID: </label>
          <input type='number' name='suppid' min='0'></input>
          <input type='submit' value='Supprimer' formaction='page_table.php'></input>
        </form>
      </section>
    </center>

     <!-- footer -->
     <footer id="mentions">
        <nav>
            <ul>
                <li><img src="../image/retour.png" height="20px"><a href="accueil.php" style="color:#fff;">Retour à la page d'accueil</a></li>
                <li><a href="accueil_Bdd.php" style="color:#fff;">•Retour à l'accueil de la base de donnée</a></li>
                <li><a href="page_carte.php" style="color:#fff;">•Aller a la page de la carte</a></li>
            </ul>
        </nav>
     </footer>

  </body>
</html>
