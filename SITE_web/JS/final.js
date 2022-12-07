//------------------------------------------------------------------
//                Déclaration des modules
//------------------------------------------------------------------
var http = require('http');
var fs = require('fs');
var fs2=require('fs');
var serialport=require('serialport');
var requete = require('request');
var path = require('path');
var mysql = require('mysql');

var portArduino = "/dev/cu.usbmodemFD131";
//var portArduino= "/dev/cu.usbserial-AC0091Z0";

//----- Création du fichier qui produira le fichier "mesuresTotal.js"
eval(fs.readFileSync(__dirname + '/creerFichierData.js')+'');

let apiKey = 'ba515b75f6d15c5417068553e366f063'; //APIKEY météo
let unites='metric';                             // système de mesure "métrique" ou impérial...
// let city = 'La Roche-sur-Yon';                   // Ville
let city = 'La Roche-sur-Yon';                   // Ville
var nomVille='La Roche sur Yon';
var dirVent=0;
var vitVent=0;
var temperature=0;
var tempSonde1=0;
var tempSonde2=0;
var angleVolet=0;
var last_capteurs;
var id=0;
var horodatage;

//------------------------------------------------------------------
//
//                           BDD
//
//------------------------------------------------------------------
//------ Variables propres à MySQL ---------------------------------
let creationtableMesures = `create table if not exists tableMesures(
   id int primary key auto_increment,
   nomDeVille char(255) not null default "coucou",
   horodatage datetime,
   vitDuVent smallint(1) not null default 0,
   dirDuVent smallint(1) not null default 0,
   temperatureExt float not null default 0,
   tempDeSonde1 float not null default 0,
   tempDeSonde2 float not null default 0,
   angleDuVolet smallint(1) not null default 0
)`;
let connexionBaseMesures=`use mesures;`;
var connexionSQL = mysql.createConnection({
   host: "localhost",
   user: "root",
   password: "snir"
});
// ------------   Connexion au serveur MySQL -----------------------
connexionSQL.connect(function(err) {
   if (err) return console.error('Problème de connexion à la base de donnée : ' + err.message);
   else {
      console.log('connexion au serveur MySQL :                    ok');
      // ----------------- Connexion à la base de données "mesures"
      connexionSQL.query(connexionBaseMesures, function(err, results, fields) {
         if (err) console.log('Problème lors de la connexion à la base de données mesures : '+err.message);
         console.log('connexion à la base de donnée \"mesures\":        ok');
      });
      // ------------------ Création de la table "tableMesures" si elle n'existe pas
      connexionSQL.query(creationtableMesures, function(err, results, fields) {
         if (err) console.log('Problème lors de la création de la table tableMesures : '+err.message);
      });
   }
});
//------------------------------------------------------------------
//
//                           SERVEUR HTTP
//
//------------------------------------------------------------------
// Chargement du fichier index.html affiché au client
var server = http.createServer(function(req, res,err)
{
   // if (err) {
   //     throw(err)
   // }
   // else {
   if(req.method == "GET")
   {
      // ---------- On récupère le chemin et l'extention de la  requête
      var filetosend = path.basename(req.url)
      var extfiletosend = path.extname(req.url)

      console.log(filetosend+"."+extfiletosend);
      if(req.url == '/')
      {
         fs.readFile('index.html',function(err,data)
         {
            res.setHeader('Content-Type','text/html')
            res.write(data);
            res.end();
         })
      }

      if(extfiletosend == '.php')
      {
         fs.readFile(filetosend,function(err,data)
         {
            res.setHeader('Content-Type','text/php')
            res.write(data);
            res.end();
         })
      }

      if(extfiletosend == '.css')
      {
         fs.readFile(filetosend,function(err,data)
         {
            res.setHeader('Content-Type','text/css')
            res.write(data);
            res.end();
         })
      }
      if(extfiletosend == '.json')
      {
         fs.readFile(filetosend,function(err,data)
         {
            res.setHeader('Content-Type','text/plain')
            res.write(data);
            res.end();
         })
      }

      if(extfiletosend == '.js')
      {
         fs.readFile(filetosend,function(err,data)
         {
            res.setHeader('Content-Type','application/javascript')
            res.write(data);
            res.end();
         })
      }
      if(extfiletosend == '.txt')
      {
         fs.readFile(filetosend,function(err,data)
         {
            res.setHeader('Content-Type','text/plain')
            res.write(data);
            res.end();
         })
      }
      if(extfiletosend == '.ttf')
      {
         fs.readFile(filetosend,function(err,data)
         {
            res.setHeader('Content-Type','font/ttf')
            res.write(data);
            res.end();
         })
      }
      if(extfiletosend == '.gif')
      {
         fs.readFile(filetosend,function(err,data)
         {
            res.setHeader('Content-Type','image/gif')
            res.write(data);
            res.end();
         })
      }
      if(extfiletosend == '.jpg')
      {
         fs.readFile(filetosend,function(err,data)
         {
            res.setHeader('Content-Type','image/jpg')
            res.write(data);
            res.end();
         })
      }
      if(extfiletosend == '.png')
      {
         fs.readFile(filetosend,function(err,data)
         {
            res.setHeader('Content-Type','image/png')
            res.write(data);
            res.end();
         })
      }
   }

}).listen(8081); 				// écoute du port « 8081 »

//------------------------------------------------------------------
//
//                           API METEO
//
// Fonction appelée à chaque récéption de data de l'arduino (à peaufiner...)
//------------------------------------------------------------------
function meteo(){
   //-------------------- préparation de l'url...  --------------------
   let url = `http://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=${unites}`;
   //-------------------- appel de la requête -------------------------
   requete(url, function (err, response, body) {//appel de l'API
   if(err){
      console.log('error:', err);
   } else {
      let meteo = JSON.parse(body)
      //---- sauvegarde des trois données météo dans 3 variables
      nomVille=meteo.name;
      dirVent=meteo.wind.deg;
      vitVent=meteo.wind.speed;
      temperature=meteo.main.temp;
      //----- debug
      // let message = `Actuellement à ${nomVille}, il fait ${meteo.main.temp} degrés, le vent souffle à ${meteo.wind.speed}km/h et a une direction de ${meteo.wind.deg}°`;
      // console.log(message);               //message avec les datas extraites
      //--- fin debug
   }
});
}
//------------------------------------------------------------------
//
//                           ARDUINO NANO
//
// Dès réception d'une data, celle-ci est découpée et mémorisée dans 3
// variables "tempSonde1","tempSonde2" et "angleVolet".
//------------------------------------------------------------------
var Readline = serialport.parsers.Readline
// Sélection du port série
var SP1=new serialport(portArduino,{
   //baudrate
   baudRate:9600
});
//-------événement sur l'ouverture du port SP1 ------------------
SP1.on('open', function () {
   console.log('connexion au port série :                       ok')
})
//-------événement sur l'ouverture du port SP1 ------------------
SP1.on('close', function () {
   console.log('fermeture du port série :                       ok')
     connexionSQL.end(function(err){
       if (err) return console.log(err.message);
         console.log('deconnexion au serveur MySQL :                    ok');
   });
})
//-------  création du parser "retour ligne"   ------------------
var parser = new Readline()
// ------------------On crée le flux SP1--->parser---------------
SP1.pipe(parser)
//----- événement sur une reception de données sur le parser ----
parser.on('data', function (data)
{
   id++;
   // ---------- Appel de l'API météo
   meteo();
   // ---------- Récupération des données issues de l'AN
   tempSonde1 = data.substr(0,4);
   tempSonde2 = data.substr(6,4);
   angleVolet = data.substr(12,4);
   // --------  Construction de la requête MySQL pour l'insertion de la dernière mesure...
   let insertionMesure=`INSERT INTO tableMesures (nomDeVille,horodatage,vitDuVent, dirDuVent, temperatureExt, tempDeSonde1, tempDeSonde2, angleDuVolet)
   VALUES`+`('`+nomVille+`',now(),`+vitVent+`,`+dirVent+`,`+temperature+`,`+tempSonde1+`,`+tempSonde2+`,`+angleVolet+`);`;
   // -------- Requête MySQL pour l'insertion de la dernière mesure dans la BDD
   connexionSQL.query(insertionMesure, function(err, results, fields) {
      if (err) console.log('Problème lors de l\'insertion d\'une mesure dans la table tableMesures : '+err.message);
   });
// ----- on selectionne la dernière entrée (ORDER BY id DESC LIMIT 1) et on fabrique le fichier mesuresTotal.js
   connexionSQL.query("SELECT * FROM tableMesures ORDER BY id DESC LIMIT 1", function (err, result, fields) {
      if (err) console.log('Problème d\'extraction des données de la table \"tableMesures\" :'+err.message);
          //console.log(result[0].id);
          initialiserMesuresTotal(result[0].id, result[0].nomDeVille, result[0].vitDuVent, result[0].dirDuVent, result[0].temperatureExt, result[0].tempDeSonde1, result[0].tempDeSonde2, result[0].angleDuVolet);
        });



});
