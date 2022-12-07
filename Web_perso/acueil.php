<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <link href="../image/LogoSN" rel="icon" type="image/png"/>
    <script type="text/javascript" src="perso.js"></script>

    <!-- Feuille de styles génériques -->
    <link rel="stylesheet" href="../fichier_css/index.css" type="text/css">
    <title>BTS SN</title>

    <style>
      #corps {
        width:980px;
        margin: 0 auto 0 auto;
      }

      #corps>#info {
				padding:1em;
				border:1px dashed #444;
				margin-top:1em;
			}

    </style>
  </head>
  <body>
    <center>
      <h1>Page perso </h1>

    </center>

    <div id="corps">

      <div id="info">
        <span id="date_heure"></span>

        <script type="text/javascript">
        window.onload = date_heure('date_heure');
      //  window.onload = getinit();
        </script>
			</div>

      <section id="main">
          <p><b>MAGAUD S.</b><br/></p>
          <p id="demo">JE TOUUUUUUUUUUUUUUUURNE</p>
          <script type="text/javascript">
          </script>
      </section>

      <section id="main2">
        <form>
          <input type="text" id="lol">
          <input type="button" onclick="volet_ouvrir(document.getElementById('lol').value)">
          <input type="range" min="-180" max="180" value="90" id="sliderRange">
        </form>
      </section>

<!--   <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> -->
<script type="text/javascript">
  var x = document.getElementById("demo");
  x.style = "background-color : blue";
  function volet_ouvrir(ang){
    x.style.transform = "rotate("+ang+"deg)";
  }
  var rangeslider = document.getElementById("sliderRange");
  rangeslider.oninput = function() {
    volet_ouvrir(this.value);
  }
  var el = document.getElementById("demo");
var st = window.getComputedStyle(el, null);
var tr = st.getPropertyValue("transform");

// With rotate(30deg)...
// matrix(0.866025, 0.5, -0.5, 0.866025, 0px, 0px)
console.log('Matrix: ' + tr);

// rotation matrix - http://en.wikipedia.org/wiki/Rotation_matrix

var values = tr.split('(')[1].split(')')[0].split(',');
var a = values[0];
var b = values[1];
var c = values[2];
var d = values[3];

var scale = Math.sqrt(a*a + b*b);

console.log('Scale: ' + scale);

// arc sin, convert from radians to degrees, round
var sin = b/scale;
// next line works for 30deg but not 130deg (returns 50);
// var angle = Math.round(Math.asin(sin) * (180/Math.PI));
var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));

console.log('Rotate: ' + angle + 'deg');
</script>

    </div>
    <!-- footer -->
    <footer id="mentions">
       <nav>
           <ul>
               <li><img src="../image/retour.png" height="20px"><a href="../index.php" style="color:#fff;">Retour à la page d'accueil </a><p id="heure" style="color: white"></p></li>
           </ul>
           <span id="date_heure"></span>
           <script type="text/javascript">window.onload = date_heure('heure');</script>
       </nav>

    </footer>
  </body>
</html>
