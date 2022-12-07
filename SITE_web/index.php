<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cube SA</title>
		<link href="css/style.css" rel="stylesheet" >
		<link rel="icon" type="image/jpg" href="./images/logoCubeSA.jpg" />
		<script language="javascript" src="./js/horloge.js" ></script>
		<script language="javascript" src="./js/gestionWEBSOCKET.js"></script>
		<script language="javascript" src="./js/dessiner.js"></script>
		<script type="text/javascript" src="JS/meteo.js"></script>
		<script type="text/javascript" src="JS/ani_volet.js"></script>
		<script src="/socket.io/socket.io.js"></script>
	</head>
	<!-- <body onload="gererWS();mettreAJourData();Clock()" > -->

	<body onload="get_base()">
		<header>
			<img src="./images/logoCubeSA.jpg" alt=logoCubeSA width=50px height=50px align="left">
			Supervision chauffe eau solaire thermique
		</header>
		<!--Partie Navigation-->
		<nav>
			<label id="presentationVille">Prévisions météorologiques pour</label>
			<label id="ville_affiche"></label>
		</nav>
		<!--Fin de la partie navigation-->

			<!--AFFICHAGE TEMPÉRATURE-->
		<aside id="TEMP"><div class="separation">	<a>Températures</a></div>
			<img src="./images/celsius.png" alt=celsius width=50px height=50px align="left" >
			</br>
			</br>
			<p id="nomMesure" position= "absolute" >Sonde 1: échangeur</p>
			<p id="TemperatureSonde1" class="etiquette"></p>
			</br>
			</br>
			<p id="nomMesure">Sonde 2 : ballon</p>
			<p id="TemperatureSonde2" class="etiquette"></p>
			</br>
			</br>
			<p id="nomMesure">Extérieure :</p>
			<p id="Temperature" class="etiquette"></p>
		</aside>
		<!--AFFICHAGE INFORMATIONS VENT-->
		<aside id="VENT">	<div class="separation"><a>Vent</a></div>
			<img src="./images/eolienne.gif " alt=éolienne width=50px height=50px align="left"  >	</br>
			<img src="./images/eolienne.gif " alt=éolienne width=30px height=30px align="left"  >
			</br>
			<p id="nomMesure">Vitesse :</p>
			<p id="VitesseVent" class="etiquette"></p></br>
			</br>
			</br>
			<p id="nomMesure">Direction :</p>
			<p id="DirectionVent" class="etiquette"></p>
			</br>
			</br>
			<p id="nomMesure">Azimut :</p>
			<p id="Azimut" class="etiquette"></p>
		</aside>
		<!--AFFICHAGE INFORMATION VOLET-->
		<aside id="schemaVolet"> <div class="separation"><a>Volet</a></div>
			</br>
			<!-- Switch Auomatique/Manuel -->
			<div class="automanu">
				<p id="auto">Automatique</p>
				<label class="switch">
				  <input type="checkbox" id="myCheck" onclick="afficheangle()">
				  <span class="slider round"></span>
				</label>
				<p id="manu">Manuel</p>
				<form id="rechercheville" style="display:none">
					<br>
					<input type="text" id="boiteville" placeholder="Code postal ou nom de ville">
					<input type="button" value="Envoyer" onclick="START_METEO()">
				</form>
			</div>

      <!-- Angle -->
			<p id="nomMesure">angle :</p>
			<p id="positionVolet" class="etiquette"></p>
			<div class="rangeslider">
			</br></br>
			<input list="marks" type="range" min="0" max="180" value="90" id="sliderRange" style="display:none">
			<datalist id="marks">
				<option value="0"></option>
				<option value="10"></option>
				<option value="20"></option>
				<option value="30"></option>
				<option value="40"></option>
				<option value="50"></option>
				<option value="60"></option>
				<option value="70"></option>
				<option value="80"></option>
				<option value="90"></option>
				<option value="100"></option>
				<option value="110"></option>
				<option value="120"></option>
				<option value="130"></option>
				<option value="140"></option>
				<option value="150"></option>
				<option value="160"></option>
				<option value="170"></option>
				<option value="180"></option>
			</datalist>
			</div>
			<script>
			</script>
			</br></br>
		<div>
			<!-- Insertion du canvas pour le dessin du toit -->
			<canvas id="myCanvas" width="350"	height="230";></canvas>
			</br></br></br>
		</div>

		</aside>
	<!--Fin de la partie aside-->

	<!--Pied de page-->
		<footer>
			<div>
        Lycée de Lattre de Tassigny 2019
        <p id="insererHorloge" ></p>
			</div>

      <img src="../image/retour.png" height="20px"><a href="../index.php">Retour à la page d'accueil </a>


		</footer>
	<!--Fin de pied de page-->
		<script>
			var rangeslider = document.getElementById("sliderRange");
			var output = document.getElementById("positionVolet");
			output.innerHTML = rangeslider.value + "°";
			rangeslider.oninput = function() {
				output.innerHTML = this.value + "°";
			}

			document.getElementById("rechercheville").onkeypress = function(e) {
				var key = e.charCode || e.keyCode || 0;
				if (key == 13) {
					e.preventDefault();
				}
			}

			if (navigator.geolocation) {
			  navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
			} else {
			  x.innerHTML = "La géolocalisation n'est pas prise en charge par ce navigateur.";
			}


			function successFunction(position) {
			    var lat = position.coords.latitude;
			    var lng = position.coords.longitude;
					START_METEO(lng,lat);
			}

			function errorFunction(){
			    if(confirm("La localisation à rencontré une erreur, voulez vous accéder à la page de manière sécurisée (https://)?")){
						window.location.href = "https://80.14.250.176:2004/SITE/index.php"
					}
			}

			function afficheangle() {
				var checkBox = document.getElementById("myCheck");
				var text = document.getElementById("sliderRange");
				var rechercheville = document.getElementById("rechercheville");
				if (checkBox.checked == true){
					text.style.display = "inline-block";
					rechercheville.style.display = "block";
				} else {
					 text.style.display = "none";
					 rechercheville.style.display = "none";
				}
			}
			gererWS();
			Clock();
		</script>
		<p></p>
	</body>
</html>
