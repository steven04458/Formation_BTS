function date_heure(id)
{
        date = new Date;
        annee = date.getFullYear();
        moi = date.getMonth();
        mois = new Array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        j = date.getDate();
        jour = date.getDay();
        jours = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        resultat = 'Nous sommes le '+jours[jour]+' '+j+' '+mois[moi]+' '+annee+' il est '+h+'h '+m+'mn '+s+'s';
        document.getElementById(id).innerHTML = resultat;
        setTimeout('date_heure("'+id+'");','1000');
        return true;
}

function alertes()
{
        var titre=document.getElementById('titre').innerHTML;

        var images = document.images;
        var srcimage = [];
        for(var i = 0; i < images.length; i++) {
            srcimage.push(images[i].src);
        }

        var cssclasses = [];
        var sSheetList = document.styleSheets;
        for (var sSheet = 0; sSheet < sSheetList.length; sSheet++)
        {
            var ruleList = document.styleSheets[sSheet].cssRules;
            for (var rule = 0; rule < ruleList.length; rule ++)
            {
               cssclasses.push( ruleList[rule].selectorText );
            }
        }
        alert(srcimage);
        alert(titre);
        alert(cssclasses);
        return true;
}

function changements()
{
        document.images[0].align = "left";
        document.images[1].align = "right";
        let titre2 = document.querySelector("#titre");
        titre2.style.color = "red";
        return true;
}

function changetitre()
{
        document.getElementById("titre").innerHTML = "Bienvenue les enfants";
        return true;
}

function changecolor1()
{
  document.body.style.backgroundColor = 'green';
}

function changecolor2()
{
  document.body.style.backgroundColor = '#f4f4f4';
}

function getinit(){
        window.initx = window.scrollX + document.querySelector('#carre').getBoundingClientRect().left;
        window.inity = window.scrollY + document.querySelector('#carre').getBoundingClientRect().top;
}

function affichepos(){
        window.gx = window.scrollX + document.querySelector('#carre').getBoundingClientRect().left;
        window.gy = window.scrollY + document.querySelector('#carre').getBoundingClientRect().top;

        document.getElementById("pos").innerHTML = "X= " + window.gx + ", Y= " + window.gy;
        return true;
}

function bougecarre(){
        var posx = window.scrollX + document.querySelector('#carre').getBoundingClientRect().left;
        var posy = window.scrollY + document.querySelector('#carre').getBoundingClientRect().top;
        posx = posx + 20;
        posy = posy + 20;
        document.getElementById("carre").style.left = posx+'px';
        document.getElementById("carre").style.top = posy+'px';
        return true;
}

function initialcarre(){
        document.getElementById("carre").style.left = initx+'px';
        document.getElementById("carre").style.top = inity+'px';
        clearInterval(myTimer);
        return true;
}

function resetintervalle(){
        clearInterval(myTimer);
}

function intervalle(){
        window.myTimer = setInterval(bougecarre, document.getElementById("boite_intervalle").value);
}
