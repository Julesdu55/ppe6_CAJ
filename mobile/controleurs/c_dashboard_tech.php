<?php

if(!isset($_REQUEST['action']))
    $action = 'list';
else
    $action = $_REQUEST['action'];

switch($action){
    case 'list':{
        $the_bugs = getBugsForTechnicien($_SESSION['login']['id']);
        $bugs_en_cours = $the_bugs[0];
        $bugs_fermes =  $the_bugs[1];
        $users = getUsersByFunction();
        $cloture=false;
        include("vues/v_dashboard_techn.php");
        break;
    }

    case 'cloture':{
        $verif=false;

        include("vues/v_terminer.php");
        break;
    }


    case 'cloture_Bug':{
        $the_bugs = getBugsForTechnicien($_SESSION['login']['id']);
        $bugs_en_cours = $the_bugs[0];

        $true=0;
        foreach ($bugs_en_cours as $bugs){

            if ($bugs->getId()==$_GET['id']){

                $true=1;

            }
        }
        if ($true==1){
        $id = $_GET['id'];
        $libelle = $_POST['libelle'];
        if ($libelle==''){
            $verif=true;
            include("vues/v_terminer.php");

        }
        else{
            updateAction($id,$libelle);

            header('Location:index.php?uc=dash&cloture=1');
            break;
        }
        }
        else{
            echo "Vous n'etter pas autoriser";

        }

    }

}