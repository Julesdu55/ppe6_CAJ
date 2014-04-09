<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" >
    $(document).ready(function(){

        $("[id^='b_affect_']").click(function(){
            // Récuperer l'id du Bug de la ligne en question
            num = $(this).attr('id').substr(9);
            idTech = $('#liste_'+num+' :selected').val();
            dateBug = $('#dateBug_'+num+'').val();

            console.log(num);
            console.log(idTech);
            console.log(dateBug);

            $.ajax({
                type: "POST",
                async:false,
                url: "/PPE5_CAJ/util/donnees_ajax.php",
                dataType:'json',
                data: "idBug=" + num + "&idTechnicien=" + idTech + "&dateBug=" + dateBug,
            })
        })


    })
</script>

<head>
    <img src="MON_IMAGE" id="puce1" alt="puce" style="z-index: 0;" onmouseover="ouvreFiche('1')" onmouseout="fermeFiche('1')" onclick="fermeFiche('1')" />
    <div id="1">
        LE CONTENU DU CADE
    </div>
</head>

<div id="liste_tickets">
    <h2>Tickets en cours</h2>
    <?php
    foreach ($bugs_en_cours as $bug) {
        if ($bug->getEngineer() != null){
            $engineer = $bug->getEngineer()->getName();
        }else{
            $engineer = "non affecté";
        }
        // Récuperer l'id du bug
        $Idbug = $bug->getId();
        echo "<ul id=".$Idbug.">";
        echo "<li><img src='./images/en_cours.png' width='30px' height='30px'/></li>";
        echo "<li>".$bug->getCreated()->format('d.m.Y')."</li>";
        echo "<li> affecté à : ".$engineer."</li>";
        echo "<li> Produit(s) : ";
        foreach ($bug->getProducts() as $product) {
            echo "- ".$product->getName()." ";
        }
        echo "</li>";
        $dateResolution = $bug->getResolution();
        if(isset($dateResolution)){
            echo "<li> Date de résolution donnée: ".$dateResolution->format('d.m.Y')."</li>";
        }else{
            echo "<li> Date de résolution donnée: Pas de date</li>";
        }
        echo "<br />";;
        echo "<select name='liste' id='liste_".$Idbug."'>";
        echo "<option value=''>Choisissez un technicien</option>";
        foreach ($users as $user){
            echo "<option value='".$user->getId()."'>".$user->getName().' '.$user->getPrenom()."</option>";
        }
        echo "</select> ";
        echo "Date de résolution (jj/mm/YYYY)<input type=text name='dateBug' id='dateBug_".$Idbug."'>";
        echo "<input name='b_affect' id='b_affect_".$Idbug."' type='submit' value='Affecter'>";
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
        echo "<li> affecté à : ".$engineer."</li>";
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