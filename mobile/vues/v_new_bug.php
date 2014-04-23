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
<a id='lnkDialog' href="#ticket_dialog" data-transition="flip" style='display:none;'></a>

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
        <form name="new_bug" onsubmit="return checkFormNewBug();" enctype="multipart/form-data" method="POST" action="index.php?uc=dash&action=nouveau">
            <fieldset>
                <legend>Signalement d'un nouveau bug</legend>
                <p>
                    <label for="objet">Objet : </label>
                    <input id="objet" type="text" name="objet" size="50" maxlength="50"> <div id="checkObjet"></div>
                </p>
                <p>
                    <label for="libelle">Description du problème : </label>
                    <textarea id="libelle" name="libelle" size="500" maxlength="500"></textarea> <div id="checkLibelle"></div>
                </p>
                <p>
                    <label for="apps">Application(s) concernées : </label>
                    <select multiple id="apps" name="apps[]">
                        <?php
                        foreach($the_products as $p){
                            echo '<option value="'.$p->getId().'">'.$p->getName().'</option>';
                        }
                        ?>
                    </select><div id="checkApps"></div>
                </p>
                <p>
                    <label for="file">Capture d'Ecran (optionnel)</label>
                    <input type="file" name="capture">
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                </p>
                <p>
                    <input type="submit" value="Valider" name="valider">
                    <a href="index.php?uc=dash" data-role="button" data-mini="true" data-inline="true" data-icon="arrow-l" data-iconpos="left" data-transition="slide" data-direction="reverse">Retour</a>
                </p>
            </fieldset>
        </form>
    </div>
</div>

</body>
</html>