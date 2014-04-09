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
<div id="liste_tickets">
    <h2>Tickets en cours</h2>
<?php
foreach ($bugs_en_cours as $bug) {
    if ($bug->getEngineer() != null){
        $engineer = $bug->getEngineer()->getName();
    }else{
        $engineer = "non affecté";
    }
    echo "<ul>";
    echo "<li><img src='./images/en_cours.png' width='30px' height='30px'/></li>";
    echo "<li>".$bug->getCreated()->format('d.m.Y')."</li>";
    echo "<li><info class='carac'> affecté à :</info> ".$engineer."</li>";
    echo "<li><info class='carac'> Produit(s) :</info> ";
    foreach ($bug->getProducts() as $product) {
        echo "- ".$product->getName()." ";
    }
    echo "</li>";
    echo "<li>".$bug->getDescription()."</li>";
    if ($bug->getCapture()!= "")
        echo "<li><a href='capture/".$bug->getCapture()."'>Capture d'écran</a>";
    echo "</ul>";
}
?>
</div>

<div id="liste_tickets">
    <h2>Tickets fermés</h2>
    <?php
    foreach ($bugs_fermes as $bug) {
        if ($bug->getEngineer() != null){
            $engineer = $bug->getEngineer()->getName();
        }else{
            $engineer = "non affecté";
        }
        echo "<ul>";
        echo "<li><img src='./images/ferme.png' width='30px' height='30px'/></li>";
        echo "<li>".$bug->getCreated()->format('d.m.Y')."</li>";
        echo "<li><info class='carac'> affecté à :</info> ".$engineer."</li>";
        echo "<li><info class='carac'> Produit(s)</info> : ";
        foreach ($bug->getProducts() as $product) {
            echo "- ".$product->getName()." ";
        }
        echo "</li>";
        echo "<li>".$bug->getDescription()."</li>";
        if ($bug->getCapture()!= "")
            echo "<li> <a href='capture/".$bug->getCapture()."'>Capture d'écran</a>";
        echo"<li><info class='carac'> Résumé :</info> ".$bug->getResume()."</li>";
        if($bug->getResolution()!= null)
        echo"<li><info class='carac'>Résolu le :</info> ".$bug->getResolution()->format('d.m.Y')."</li>";
        else"<li><info class='carac'>Pas de date</info></li>";
        echo "</ul>";
    }
    ?>
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