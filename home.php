<!-- Corps de la page principale-->
<form action="gestionClient.php" method="post">
    <h1>Menu </h1>

    <div>
        <label for="idClient">Numéro de client :</label>
        <input type="number" id="idClient" name="idClient" required="required"/><br>
    </div>

    <fieldset>
        <legend>Choix:</legend>
        <label for="v">Visualisation :</label>
        <input type="radio" id="v" value="v" name="choix" required="required"><br>
        <label for="v">Modification :</label>
        <input type="radio" id="v" value="m" name="choix" required="required"><br>
        <label for="v">Création : </label>
        <input type="radio" id="v" value="c" name="choix" required="required"><br>
        <label for="v">Achat : </label>
        <input type="radio" id="v" value="a" name="choix" required="required"><br>
    </fieldset>
    <button type="submit">Envoyer</button>
</form>