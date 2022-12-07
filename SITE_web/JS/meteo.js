//-------------------METEO------------------- OK

function START_METEO(lon, lat){
  var obj, dbParam, xmlhttp, myObj, x, txt = "";
  obj = {};
  dbParam = JSON.stringify(obj);
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myObj = JSON.parse(this.responseText);
      nom = myObj.name;
      temp = myObj.main.temp;
      temp = Number(Math.round(temp));
      document.getElementById("Temperature").innerHTML = temp+"°C";
      document.getElementById("VitesseVent").innerHTML = myObj.wind.speed + " m/s";
      document.getElementById("DirectionVent").innerHTML = myObj.wind.deg + "°";
      CALCUL_AZIMUT(myObj.coord.lon, myObj.coord.lat);
      var dirvent= myObj.wind.deg;
      if (dirvent >= 315 && dirvent < 45 || dirvent >=0 && dirvent < 45 || dirvent >= 315 && dirvent <= 360){
        document.getElementById("DirectionVent").innerHTML += " - Nord";
      }
      else if (dirvent >= 46 && dirvent < 135) {
        document.getElementById("DirectionVent").innerHTML += " - Est";
      }
      else if (dirvent >= 136 && dirvent < 225) {
        document.getElementById("DirectionVent").innerHTML += " - Sud";
      }
      else if (dirvent >= 226 && dirvent < 315) {
        document.getElementById("DirectionVent").innerHTML += " - Ouest";
      }
      document.getElementById("ville_affiche").innerHTML = nom;
    }
  };
  var checkBox = document.getElementById("myCheck");
  if (checkBox.checked == true){ //MANUEL
    xmlhttp.open("POST", "//api.openweathermap.org/data/2.5/weather?q="+ document.getElementById("boiteville").value +",fr&units=metric&lang=fr&APPID=41491d3bd03228e090f4500b66c6c037", true);
    xmlhttp.send("x=" + dbParam);
  } else { //AUTO
    xmlhttp.open("POST", "//api.openweathermap.org/data/2.5/weather?lat="+lat+"&lon="+lon+"&units=metric&lang=fr&APPID=41491d3bd03228e090f4500b66c6c037", true);
    xmlhttp.send("x=" + dbParam);
  }
}

//-------------------AZIMUT------------------- OK

function CALCUL_AZIMUT(lon, lat){
  console.log("lon : ", lon);
  console.log("lat : ", lat);
  var lat2=4.000000;
  var lon2=5.084444;
  var dlat=lat2-lat;
  var dlon=lon2-lon;
  azimut=Math.atan2((Math.sin(dlon)*Math.cos(lat2)),(Math.cos(lat)*Math.sin(lat2)-Math.sin(lat)*Math.cos(lat2)*Math.cos(dlon)));
  azimut=Math.round(azimut*(180/Math.PI)*100)/100;
  if(azimut<0){
    azimut=360+azimut;
  }
  console.log("Azimut:",azimut);
  document.getElementById("Azimut").innerHTML = azimut+"°";
}
