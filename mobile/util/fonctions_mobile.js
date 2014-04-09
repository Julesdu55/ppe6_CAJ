/**
 * Created with JetBrains PhpStorm.
 * User: Eric
 * Date: 21/02/14
 * Time: 18:08
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function(){
    $('#liste_tickets tr').bind('click', function(e) {
        // Prevents the default action to be triggered.
        e.preventDefault();
        // on va chercher avec un appel Ajax/Json les données sur le ticket choisi
        var identifiant = $(this).find("td").eq(1).html();

        $("#id_ticket").html(identifiant);

        $.ajax({
            type: "POST",
            url: "../util/c_requetes.php",
            dataType: "json",
            data: "action=infos_ticket&data="+identifiant,
            success: function(data){
                $("tr[name=une_ligne]").remove();
                $("#descri_ticket").html(data['description']);
                $("#solution_ticket").html(data['resume']);

                // on active le clic sur le lien invisible pour déclencher le dialog
                $('#lnkDialog').click();
                // Autre façon de changer la page à la volée
                //$.mobile.changePage('#ticket_dialog', { transition: 'pop', role: 'dialog' });
            }
        });
    });
});