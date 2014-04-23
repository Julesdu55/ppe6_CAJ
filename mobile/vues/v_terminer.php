<html>
<head>
    <title>jQuery Mobile</title>
    <meta charset="utf-8">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./lib/jquery.mobile-1.4.2.min.css">
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="./lib/jquery.mobile-1.4.2.min.js"></script>
    <script src="./util/fonctions_mobile.js"></script>
</head>
<!doctype html>


<body>


<div data-role="page">
    <div id="bandeau">
        <ul id="menu">

            <?php
            if(estConnecter()){
                echo '<p align="right"><img src="../images/deconnexion.png" width="20" height="20"><a  href="index.php?uc=deconnexion" data-ajax="false"  align="right"> Deconnexion</a></p>';
            }else{
                echo '<li><a href="index.php?uc=accueil"> Accueil </a></li>';
            }
            ?>
        </ul>
        <center><img src="../images/accueil.png" width="100" height="100"></center>
        <h1><center>HelpDesk Maison des ligues</h1></center>
        <center>Bienvenue sur l'application des gestions d'incidents</center>
        </br>


    </div>
    <div date-role="content">

        <h4>Bienvenue sur votre console de gestion</h4>
      <?php

        if ($verif==true){

            echo "Veuillier remplire une description";
        }

      ?>
        <form name="cloture_bug" enctype="multipart/form-data" method="POST" action="index.php?uc=dash&action=cloture_Bug&id=<?php echo $_GET['id'] ?>"
   >
    <fieldset>
    <legend>Cloturer le bug</legend>
    <p>
        <label for="libelle">Des  : </label>
        <textarea id="libelle" name="libelle" size="500" maxlength="500"></textarea> <div id="checkLibelle"></div>
    </p>

        <input type="submit"  value="Valider" name="valider">
        <input type="reset" value="Annuler" name="annuler">
    </p>
    </fieldset>
</form>
        <div data-role="footer" data-position="fixed">
            <h4>Pied de page</h4>
        </div>
</div>
    </div>

</body>
</html>