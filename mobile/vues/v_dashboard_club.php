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
<?php echo '<form name="incident" method="POST" action="index.php?uc=dash&action=nouveau"> <input type="submit" data-icon="alert" value="Nouvel incident"> </form>'; ?>
<div id="liste_tickets">
    <p>
    <div data-role="collapsible" data-collapsed="true" data-inset="true">

    <h2>Tickets en cours</h2>
        <table data-role="table" id="table-custom-1" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="Columns to display..." data-column-popup-theme="a">
            <thead>
                <tr>
                    <th></th>
                    <th data-priority="9">Date</th>
                    <th data-priority="10">Affecté à</th>
                    <th data-priority="11">Produit</th>
                    <th data-priority="12">Produits concernés</th>
                    <th data-priority="13">Capture d'écran</th>
                </tr>
            </thead>

            <?php
foreach ($bugs_en_cours as $bug) {
    if ($bug->getEngineer() != null){
        $engineer = $bug->getEngineer()->getName();
    }else{
        $engineer = "non affecté";
    }
    echo "<tr>";
    echo "<td><img src='../images/en_cours.png' width='30px' height='30px'/></td>";
    echo "<td class='colonnedate'>".$bug->getCreated()->format('d.m.Y')."</td>";
    echo "<td class='colonnetech'>".$engineer."</td>";
    echo "<td class='colonneprod'>";
    foreach ($bug->getProducts() as $product) {
        echo $product->getName()." ";
    }
    echo "</td>";
    echo "<td>".$bug->getDescription()."</td>";
    if ($bug->getCapture()!= "")
        echo "<td><a href='../capture/".$bug->getCapture()."'>Capture d'écran</a></td>";
    else
        echo"<td>Pas de capture</td>";
    echo "</tr>";
}
?>
</table>
</p>
</div>

<div data-role="collapsible">
    <h3>Tickets cloturés</h3>
    <p>
    <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="Columns to display..." data-column-popup-theme="a">
        <thead>
        <tr>
            <th></th>
            <th>Date</th>
            <th data-priority="3">Affecté à</th>
            <th data-priority="4">Produit</th>
            <th data-priority="5">Produits concernés</th>
            <th data-priority="6">Capture d'écran</th>
            <th data-priority="7">Résumé</th>
            <th data-priority="8">Résolu le</th>
        </tr>
        </thead>    <?php
    foreach ($bugs_fermes as $bug) {
        if ($bug->getEngineer() != null){
            $engineer = $bug->getEngineer()->getName();
        }else{
            $engineer = "non affecté";
        }
        echo "<tr>";
        echo "<td><img src='../images/ferme.png' width='30px' height='30px'/></td>";
        echo "<td>".$bug->getCreated()->format('d.m.Y')."</td>";
        echo "<td><info class='carac'></info> ".$engineer."</td>";
        echo "<td><info class='carac'></info> ";
        foreach ($bug->getProducts() as $product) {
            echo $product->getName()." ";
        }
        echo "</td>";
        echo "<td>".$bug->getDescription()."</td>";
        if ($bug->getCapture()!= "")
            echo "<td> <a href='../capture/".$bug->getCapture()."'>Capture d'écran</a>";
        else
            echo"<td>Pas de capture</td>";
        echo"<td><info class='carac'></info> ".$bug->getResume()."</td>";
        if($bug->getResolution()!= null)
        echo"<td><info class='carac'></info> ".$bug->getResolution()->format('d.m.Y')."</td>";
        else"<td><info class='carac'>Pas de date</info></td>";
        echo "</tr>";
    }
    ?>
</table>
</div>
</div>
</div>
</div>

</body>
</html>