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
    <ul id="menu">

        <?php
        if (estConnecter()) {
            echo '<p align="right"><img src="../images/deconnexion.png" width="20" height="20"><a  href="index.php?uc=deconnexion" data-ajax="false"  align="right"> Deconnexion</a></p>';
        } else {
            echo '<li><a href="index.php?uc=accueil"> Accueil </a></li>';
        }
        ?>
    </ul>
    <center><img src="../images/accueil.png" width="100" height="100"></center>
    <h1>
        <center>HelpDesk Maison des ligues
    </h1>
    </center>
    <center>Bienvenue sur l'application des gestions d'incidents</center>
    </br>

    <div id='erreur' title='Erreur'>
        <center><font size=5 color="#6495ed"><i><b>Vous n'avez pas rempli certains champs</b></i></center>
        </font></div>
    <div id='dialog_ok' title='Enregistrement'>
        <center><font size=5 color="#6495ed"><i><b>L'enregistrement a bien été pris en compte</b></i></center>
        </font></div>


</div>

<!--  Menu haut-->


<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        // Cache les div des popup
        $("[id^='erreur']").hide();
        $("[id^='dialog_ok']").hide();

        // Action du bouton affecter
        $("[id^='b_affect_']").click(function () {
            // Récuperer l'id du Bug de la ligne en question
            num = $(this).attr('id').substr(9);
            idTech = $('#liste_' + num + ' :selected').val();
            dateBug = $('#dateBug_' + num + '').val();
            nomTech = $('#liste_' + num + ' :selected').html();

            console.log(num);
            console.log(idTech);
            console.log(dateBug);

            if (idTech == '' || dateBug == '') {
                // Ouvre le popup dialog_tech si le technicien n'est pas sélectionné
                $("#erreur").show();
            } else {
                $("#erreur").hide();
                $("#dialog_ok").show();
                $.ajax({
                    type: "POST",
                    async: false,
                    url: "/PPE6_CAJ/mobile/util/donnees_ajax.php",
                    dataType: 'json',
                    data: "idBug=" + num + "&idTechnicien=" + idTech + "&dateBug=" + dateBug,
                    success: function (data) {
                        var paramDate = "#date_" + num;
                        var paramNomTech = "#tech_" + num;
                        $(paramDate).html(dateBug);
                        $(paramNomTech).html(nomTech);
                    }
                })
            }
        })
    })
</script>


<div date-role="content">
    <div data-role="collapsible-set" data-ajax="false" ta-theme="c" data-content-theme="a">

        <div id="liste_tickets">
            <div data-role="collapsible" data-collapsed="true">
                <h2>Tickets vous concernant</h2>

                <?php
                foreach ($bugs_resp as $bug) {
                    echo "<div data-role='collapsible' data-collapsed='true' id='concerne'>";
                    echo "<h2>Ticket n°".$bug->getId()."</h2>";
                    echo "<table>";
                    if ($bug->getEngineer() != null) {
                        $engineer = $bug->getEngineer()->getName();
                    } else {
                        $engineer = "non affecté";
                    }
                    $datejour = date_create(date('y-m-d'));
                    $datebug = date_create($bug->getResolution()->format('y-m-d'));
                    $d = date_diff($datebug, $datejour);
                    echo "<tr>";
                    echo "<td>";
                    if ($d->format('%a jours') <= 0) {
                        echo "<img src='../images/error.png' width='30px' height='30px'/></td></tr>";
                    } else {
                        echo "<img src='../images/en_cours.png' width='30px' height='30px'/></td></tr>";
                    }
                    echo "<tr><td>" . $bug->getCreated()->format('d.m.Y') . "</td></tr>";
                    echo "<tr><td> Produit(s) : ";
                    foreach ($bug->getProducts() as $product) {
                        echo "- " . $product->getName() . " ";
                    }
                    echo "</td></tr>";

                    echo "<tr><td> A réaliser Avant  " . $d->format('%a jours') . "</td></tr>";
                    echo "<tr><td> <a href='http://127.0.0.1/ppe5_CAJ/index.php?uc=dash' onClick=ouvrirFenetre('" . $bug->getid() . "','description');> Description </a></td></tr>";
                    echo "    &nbsp;&nbsp;&nbsp;";
                    echo "<tr><td> <a href='http://127.0.0.1/ppe5_CAJ/index.php?uc=dash' onClick=ouvrirFenetre('" . $bug->getid() . "','cloture');> Terminer </a></td></tr>";
                    echo "</tr>";
                    echo "</table>";
                    echo "</div>";
                }
                ?>


                <script language="javascript">
                    function ouvrirFenetre(id, action) {
                        window.open("http://127.0.0.1/ppe5_CAJ/index.php?uc=dash&action=" + action + "&id=" + id, "popup", "toolbar=0, location=0, directories=0, status=0, scrollbars=0, resizable=0, copyhistory=0, width=500, height=350,screenX=200,screenY=200");
                    }
                </script>
            </div>
        </div>


        <div id="liste_tickets">
            <div data-role="collapsible" data-collapsed="true">
                <h2>Tickets en cours</h2>
                <?php
                foreach ($bugs_en_cours as $bug) {
                    echo "<div data-role='collapsible' data-collapsed='true' id='en_cours'>";
                    echo "<h2>Ticket n°".$bug->getId()."</h2>";
                    echo "<table>";
                    if ($bug->getEngineer() != null) {
                        $engineer = $bug->getEngineer()->getName()." ".$bug->getEngineer()->getPrenom();
                    } else {
                        $engineer = "non affecté";
                    }

                    // Récuperer l'id du bug
                    $Idbug = $bug->getId();

                    echo "<tr id=" . $Idbug . "'>";
                    echo "<tr><td><img src='../images/en_cours.png' width='30px' height='30px'/>" . $bug->getCreated()->format('d.m.Y') . "</td></tr>";
                    echo "<tr><td> affecté à : <div id=tech_" . $Idbug . ">" . $engineer . "</td></tr>";
                    echo "<tr><td> Produit(s) : ";
                    foreach ($bug->getProducts() as $product) {
                        echo "- " . $product->getName() . " ";
                    }
                    echo "</td></tr>";
                    $dateResolution = $bug->getResolution();
                    echo "<tr><td> Date de résolution donnée : <div id=date_" . $Idbug . ">";
                    if (isset($dateResolution)) {
                        echo $dateResolution->format('d.m.Y');
                    } else {
                        echo "Pas de date";
                    }
                    echo "</div></td></tr>";

                    echo "<tr><td>";
                    $image = $bug->getCapture();
                    if (isset($image)) {
                        echo "<img src='../capture/" . $image . "' width='50' height='50'>";
                    } else {
                        echo "<img src='../capture/Pas de capture.jpg' width='50' height='50'>";
                    }
                    echo "</td></tr>";

                    echo "<tr><td>";
                    echo "<select name='liste' id='liste_" . $Idbug . "'>";
                    echo "<option value=''>Choisissez un technicien</option>";
                    foreach ($users as $user) {
                        echo "<option value='" . $user->getId() . "'>" . $user->getName() . ' ' . $user->getPrenom() . "</option>";
                    }
                    echo "</select> ";
                    echo "</td></tr>";
                    echo "<tr><td> Date de résolution (jj/mm/YYYY)<input type=text name='dateBug' id='dateBug_" . $Idbug . "'></td></tr>";
                    echo "<tr><td><input name='b_affect' id='b_affect_" . $Idbug . "' type='submit' value='Affecter'></td></tr>";
                    echo "</tr>";
                    echo "</table>";
                    echo "</div>";
                }
                ?>

            </div>
        </div>


        <div id="liste_tickets">
            <div data-role="collapsible" data-collapsed="true">
                <h2>Tickets fermés</h2>
                <?php

                foreach ($bugs_fermes as $bug) {
                    echo "<div data-role='collapsible' data-collapsed='true' id='termine'>";
                    echo "<h2>Ticket n°".$bug->getId()."</h2>";
                    echo "<table>";
                    if ($bug->getEngineer() != null) {
                        $engineer = $bug->getEngineer()->getName()." ".$bug->getEngineer()->getPrenom();
                    } else {
                        $engineer = "non affecté";

                    }
                    $Idbug = $bug->getId();

                    echo "<tr id=" . $Idbug . "'>";
                    echo "<tr><td><img src='../images/ferme.png' width='30px' height='30px'/></td></tr>";
                    echo "<tr><td>" . $bug->getCreated()->format('d.m.Y') . "</td></tr>";
                    echo "<tr><td> affecté à : " . $engineer . "</td></tr>";
                    echo "<tr><td> Produit(s) : ";
                    foreach ($bug->getProducts() as $product) {
                        echo "- " . $product->getName() . " ";
                    }
                    echo "</td></tr>";
                    echo "<tr><td>Description: " . $bug->getDescription() . "</td></tr>";
                    echo "</tr>";
                    echo "</table>";
                    echo "</div>";

                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>