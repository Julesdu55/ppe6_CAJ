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
    <h2>Vos bug en attente de resolution</h2>
    <?php
    foreach ($bugs_en_cours as $bug) {
        if ($bug->getEngineer() != null){
            $engineer = $bug->getEngineer()->getName();
        }else{
            $engineer = "non affecté";
        }
        $datejour=date_create(date('y-m-d'));
        $datebug=date_create($bug->getResolution()->format('y-m-d'));
        $d = date_diff($datebug,$datejour);

       echo "<ul>";
        echo "<li>";
        if ($d->format('%a jours')<=0){

            echo "<img src='./images/error.png' width='30px' height='30px'/></li>";
        }
        else{
            echo "<img src='./images/en_cours.png' width='30px' height='30px'/></li>";
        }
        echo "<li>".$bug->getCreated()->format('d.m.Y')."</li>";

        echo "<li> Produit(s) : ";
        foreach ($bug->getProducts() as $product) {
            echo "- ".$product->getName()." ";
        }
        echo "</li>";

        //$date=abs($bug->getResolution()->format('d-m-y')-date('d-m-y'));


        echo "<li> A réaliser Avant  ".$d->format('%a jours')."</li>";
        echo "<li> <a href='http://127.0.0.1/ppe5_CAJ/index.php?uc=dash' onClick=ouvrirFenetre('".$bug->getid()."','description');> Description </a></li>";
        echo "    &nbsp;&nbsp;&nbsp;";
        echo "<li> <a href='http://127.0.0.1/ppe5_CAJ/index.php?uc=dash' onClick=ouvrirFenetre('".$bug->getid()."','cloture');> Terminer </a></li>";
        echo "</ul>";
    }
    ?>
    <script language="javascript">
        function ouvrirFenetre(id,action){


            window.open("http://127.0.0.1/ppe5_CAJ/index.php?uc=dash&action="+action+"&id="+id, "popup", "toolbar=0, location=0, directories=0, status=0, scrollbars=0, resizable=0, copyhistory=0, width=500, height=350,screenX=200,screenY=200");

        }
    </script>
</div>

<div id="liste_tickets">
    <h2>Tickets que vous avez fermés</h2>
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
        echo "<li> Produit(s) : ";
        foreach ($bug->getProducts() as $product) {
            echo "- ".$product->getName()." ";
        }
        echo "</li>";
        echo "<li>".$bug->getDescription()."</li>";
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