<!doctype html>
<html>
<head>
    <title>jQuery Mobile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./lib/jquery.mobile-1.4.2.min.css">
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="./lib/jquery.mobile-1.4.2.min.js"></script>
    <script src="./util/fonctions_mobile.js"></script>
</head>
<body>
<div id="bandeau">
    <!-- Images En-t�te -->
    <h1>HelpDesk Maison des ligues</h1>
</div>
<!--  Menu haut-->
<ul id="menu">


    <?php
    if(estConnecter()){
        echo '<li><a href="index.php?uc=dash"> Mon tableau de bord </a></li>';
        //echo '<li><a href="index.php?uc=liste_tickets"> Incidents déclarés </a></li>';
        if ($_SESSION['login']['fonction'] == "Club" ){

            echo '<li><a href="index.php?uc=dash&action=nouveau"> Nouvel incident</a></li>';
        }
        echo '<li><a href="index.php?uc=deconnexion">Se déconnecter</a></li>';
    }else{
        echo '<li><a href="index.php?uc=accueil"> Accueil </a></li>';
    }
    ?>
</ul>
<form name="new_bug" onsubmit="return checkFormNewBug();" enctype="multipart/form-data" method="POST" action="index.php?uc=dash&action=nouveau">
    <fieldset>
    <legend>Signalement d'un nouveau bug</legend>
        <div data-role="fieldcontain" class="ui-hide-label">
            <label for="objet">Objet : </label>
            <input id="objet" type="text" name="objet" size="50" maxlength="50" placeholder="Objet"> <div id="checkObjet"></div>
        </div>
        <div data-role="fieldcontain" class="ui-hide-label">
            <label for="libelle">Description du problème : </label>
            <textarea id="libelle" name="libelle" size="500" maxlength="500" placeholder="Description du problème"></textarea> <div id="checkLibelle"></div>
        </div>
        <label for="apps">Application(s) concernées : </label>
        <div class="ui-field-contain" >
        <select multiple id="apps" name="apps[]" >
            <?php
            foreach($the_products as $p){
                echo '<option value="'.$p->getId().'">'.$p->getName().'</option>';
            }
            ?>
        </select><div id="checkApps"></div>
            </div>

        <label for="file">Capture d'Ecran (optionnel)</label>
        <input type="file" name="capture">
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    </p>
    <p>
        <input type="submit" value="Valider" name="valider">
        <input type="reset" value="Annuler" name="annuler">
    </p>
    </fieldset>
</form>
<div class="erreur">
    <ul>
        <?php
        foreach($msgErreurs as $erreur)
        {
            ?>
            <li><?php echo $erreur ?></li>
        <?php
        }
        ?>
    </ul>
</div>

</body>
</html>