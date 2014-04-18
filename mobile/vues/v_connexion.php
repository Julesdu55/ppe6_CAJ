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
            <h1>HelpDesk Maison des ligues</h1>
        </div>
        <!--  Menu haut-->
        <ul id="menu">

            <?php
                if(estConnecter()){
                    echo '<li><a href="index.php?uc=dash"> Mon tableau de bord </a></li>';
                if ($_SESSION['login']['fonction'] == "Club" ){
                    echo '<li><a href="index.php?uc=dash&action=nouveau"> Nouvel incident</a></li>';
                }
                    echo '<li><a href="index.php?uc=deconnexion">Se déconnecter</a></li>';
                }else{
                    echo '<li><a href="index.php?uc=accueil"> Accueil </a></li>';
                }
            ?>
        </ul>

        <div data-role="page">
            <div data-role="header">
                <center><font size=5>Help Desk Maison des ligues</font></center>
                <center><img src="../images/accueil.png" width="100" height="100"></center>
            </div>
            <div data-role="content">

                <center><h4>Authentification</h4></center>
                <center><p>Veuillez vous authentifier pour continuer votre navigation sur la plate forme</p></center>


                <form name="connexion" method="POST" action="index.php?uc=connexion" data-transition="flip" data-ajax="false">
                    <div data-role="fieldcontain" class="ui-hide-label">
                        <label for="pseudo">Pseudo</label>
                        <input id="pseudo" type="text" name="pseudo" size="30" maxlength="45" placeholder="Login">
                    </div>
                    <div data-role="fieldcontain" class="ui-hide-label">
                        <label for="mdp">Mot de passe</label>
                        <input id="mdp" type="password" name="mdp" size="30" maxlength="45" placeholder="Mot de passe">
                    </div>
                    <a href="#mon_dialog_info"><center><font size=1>Renseignements de connexion</font></center></a>
                        <input type="submit" value="Valider" name="valider">
                        <input type="reset" value="Annuler" name="annuler">
                </form>
            </div>
            <div data-role="footer" data-position="fixed">
                <h1>Maison des ligues ©</h1>
            </div>
        </div>

        <div data-role="dialog" id="mon_dialog_info">
            <div data-role="header">
                <h1>Informations</h1>
            </div>
            <div data-role="content">
                <p style="text-align: center;">Vous devez vous identifier avec le login et mot de passe reçus par courrier électronique.
                <br/>
                Merci.</p>
            </div>
        </div>
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