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

            <h4>Bienvenue sur votre console de gestion</h4>
 <?php if (isset ($_GET['cloture'])){

     echo 'Cloturation affectuer';
 }
 ?>
    <div data-role="collapsible-set" data-theme="c" data-content-theme="a">
        <div id="liste_tickets">
            <div data-role="collapsible" data-collapsed="true">
                <h3>Tickets en cours</h3>
                <p>
                <table><tr><th></th><th>Numéro</th><th>Date</th><th>Technicien</th><th>Produits concernés</th></tr>
                    <?php
                    foreach ($bugs_en_cours as $bug) {
                        if ($bug->getEngineer() != null){
                            $engineer = $bug->getEngineer()->getName();
                        }else{
                            $engineer = "non affecté";
                        }
                        echo "<tr>";
                        echo "<td><img src='../images/en_cours.png' width='30px' height='30px'/></td>";
                        echo "<td class='colonneid'>".$bug->getId()."</td>";
                        echo "<td class='colonnedate'>".$bug->getCreated()->format('d.m.Y')."</td>";
                        echo "<td class='colonnetech'>".$engineer."</td>";
                        echo "<td class='colonneprod'>";
                        foreach ($bug->getProducts() as $product) {
                            echo "- ".$product->getName()." ";
                        }
                        echo "</td>";

                        echo "</tr>";
                    }
                    ?>


                </table>
                </p>
            </div>

            <div data-role="collapsible">
                <h3>Tickets cloturés</h3>
                <p>
                <table><tr><th></th><th>Numéro</th><th>Date</th><th>Technicien</th><th>Produits concernés</th></tr>
                    <?php
                    foreach ($bugs_fermes as $bug) {
                        if ($bug->getEngineer() != null){
                            $engineer = $bug->getEngineer()->getName();
                        }else{
                            $engineer = "non affecté";
                        }

                        echo "<tr>";
                        echo "<td><img src='../images/ferme.png' width='30px' height='30px'/></td>";
                        echo "<td class='colonneid'>".$bug->getId()."</td>";
                        echo "<td class='colonnedate'>".$bug->getCreated()->format('d.m.Y')."</td>";
                        echo "<td class='colonnetech'>".$engineer."</td>";
                        echo "<td class='colonneprod'>";
                        foreach ($bug->getProducts() as $product) {
                            echo "- ".$product->getName()." ";
                        }
                        echo "</td>";
                        //echo "<td>".$bug->getDescription()."</td>";
                        echo "</tr>";
                    }
                    ?>

                </table>
                </p>
            </div>
        </div>
    </div>
    <div data-role="footer" data-position="fixed">
        <h4>Pied de page</h4>
    </div>
</div>
</div>



    <div data-role="dialog" id="ticket_dialog">
        <div data-role="header">
            <h1>Detail du ticket <div id="id_ticket"></div></h1>
        </div>
        <div data-role="content">
            <div id="descri_ticket"></div>
            <hr/>
            <div id="solution_ticket"></div>
        </div>
        <hr/>
        <div id="capture_ticket"></div>
        <hr/>
        <div id="cloture_ticket"></div>
    </div>


</body>
</html>
