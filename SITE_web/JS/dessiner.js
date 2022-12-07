function dessinerVolet(angleAModifier)
{
   var cvs = document.getElementById('myCanvas');
   var ctx = cvs.getContext('2d');
    dessinerRectangle(angleAModifier);
    // ctx.translate(-30, -10);

}

function dessinerToit(){
   var canvas = document.getElementById('myCanvas');
   ctx = canvas.getContext('2d');
   ctx.shadowOffsetX = 3;
   ctx.shadowOffsetY = 3;
   ctx.shadowBlur = 7;
   ctx.shadowColor = "grey";
   ctx.clearRect(0,0, 350, 230); //added offsets to clear tidbits

   //---------centrage schéma
   ctx.translate(30, 10);
   //--------- Ecriture Toit
   ctx.fillStyle = '#B40404';      // // Choix de la couleur
   ctx.font = '18px verdana';
   ctx.fillText('toit', 125, 170);
   //---------dessin toit
   ctx.beginPath();
   ctx.moveTo(50, 200);
   ctx.lineTo(140, 100);
   ctx.lineTo(230, 200);
   ctx.lineTo(210, 200);
   ctx.lineTo(140, 122);
   ctx.lineTo(70, 200);
   ctx.fill();
   // On enlève les ombres pour le reste
   ctx.shadowOffsetX = 0;
   ctx.shadowOffsetY = 0;
   ctx.shadowBlur = 0;
   ctx.shadowColor = "";
   //--------- Dessin panneau solaire
   ctx.fillStyle = '#6E6E6E';  // Choix de la couleur
   ctx.fillText('Panneau', -30, 180);
   ctx.beginPath();
   ctx.moveTo(130, 100);
   ctx.lineTo(137, 106);
   ctx.lineTo(70, 180);
   ctx.lineTo(63, 174);
   ctx.fill();


}
// Dessine le rectangle représeantant le volet avec la bonne inclinaison
function dessinerRectangle(angleAModifier){
    ctx.save();
    //save();
   //------ Ecriture Volet
	ctx.fillStyle = '#0AF';			// Choix de la couleur

	ctx.translate(130, 98);
   ctx.fillText('Volet Miroir', 15, 0);

   //------ Rotation Volet
	ctx.rotate((180+angleAModifier)*(Math.PI / 180)); // rotation
	ctx.fillRect(0,0, 100, 7);   // Dessine un rectangle avec les réglages par défaut

   ctx.restore();


}
