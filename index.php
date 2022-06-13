<!DOCTYPE html>
<html>
<body>
<h1>Affichage des publications</h1>

<script>
function loadDoc(authorname) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      printPublist(this,authorname);
    }
  };
  xhttp.open("GET", "test.xml?rand="+Math.random(), true);// le random n'est là que pour empecher la mise en cache du xml
  xhttp.send();
}

// fonction qui permet de récupérer les publications correspondant à l'auteur demandé, ou toutes les publications
function printPublist(xml,authorname) {
  var i;
  var xmlDoc = xml.responseXML;
  var liste_publis="<ul>";
  var x = xmlDoc.getElementsByTagName("article");

  // on parcourt l'ensemble des articles
  for (i = 0; i <x.length; i++) { 
    // et si l'auteur correspond (ou qu'on a demandé de tout afficher)
    if(authorname == "" || x[i].getElementsByTagName("author")[0].childNodes[0].nodeValue == authorname){
    // on ajoute l'article à la liste
    liste_publis += "<li>" +
    x[i].getElementsByTagName("author")[0].childNodes[0].nodeValue +
    ", " +
    x[i].getElementsByTagName("title")[0].childNodes[0].nodeValue +
    ", " +
    x[i].getElementsByTagName("journal")[0].childNodes[0].nodeValue +
    "</li>";
    }
  }
  liste_publis += "</ul>";
  // et on remplace le contenu de l'élément d'id publist par la liste que l'on vient de créer
  document.getElementById("publist").innerHTML = liste_publis;
}
</script>


<script>
// fonction qui permet d'afficher des propositions d'auteurs
function showHint(str) {
  var xhttp;
  if (str.length == 0) { 
    document.getElementById("nameHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
      document.getElementById("nameHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "gethint.php?q="+str, true);
  xhttp.send();   
}
</script>

<!-- compléter ici ! -->

<form method="post"  onSubmit="return submitcheck(this);" >
<label for="Choix">Choix : </label>
<input type="radio" name="toutes les publications" value="Cliquez" onClick="clic(this);"> toutes les publications
<input type="radio" name="les publications d'un auteur" value="Cliquez" onClick="CompteClic(this.form);"> les publications d'un auteur

<script type="text/javascript">

function creer()
{
var input = document.createElement("input");
 
input.type="text";
 
document.body.appendChild(input);
 
}

var nbclic=0  // Initialisation à 0 du nombre de clic
   function CompteClic(formulaire) { // Fonction appelée par le bouton
      nbclic++; // nbclic+1
      if (nbclic>1) { // Plus de 1 clic
         alert("Vous avez déjà cliqué ce bouton.\nLe formulaire est en cours de traitement... Patience");
      } else {        // 1 seul clic
         creer();
      }
   }

</script>

<input type="submit" name="Mon bouton" value="Cliquez" onClick="clic(this);">

<script>
 
<p>First name: <input type="text" id="txt1" onkeyup="showHint(this.value)"></p>
function showHint(str) {
  if (str.length == 0) { 
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("txtHint").innerHTML =
    this.responseText;
  }
  xhttp.open("GET", "gethint.php?q="+str);
  xhttp.send();   
}

<p>Suggestions: <span id="nameHint"></span></p>
</script>


</form>


<p id="publist">
</p>

</body>
</html>

