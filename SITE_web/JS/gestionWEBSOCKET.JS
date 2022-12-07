function gererWS()
{
   var iden;
   var socket = io.connect('http://localhost:8080');
   socket.on('message', function(message) {
      document.getElementById('presentationVille').innerHTML="Actuellement à "+message.nomDeLaVille ;
      document.getElementById('TemperatureSonde1').innerHTML=message.TemperatureDeSonde1+"°C";
      document.getElementById('TemperatureSonde2').innerHTML=message.TemperatureDeSonde2+"°C";
      document.getElementById('Temperature').innerHTML=message.TemperatureExt+"°C";
      document.getElementById('VitesseVent').innerHTML=message.VitesseVent+"m/s";
      document.getElementById('DirectionVent').innerHTML=message.DirectionVent+"°";
      document.getElementById('positionVolet').innerHTML=message.AngleDuVolet+"°";

      dessinerToit();
      dessinerVolet(message.AngleDuVolet);
      ctx.translate(-30, -10);

   });
}
