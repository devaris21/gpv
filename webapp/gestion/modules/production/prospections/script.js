$(function(){


    $("tr.fini").hide()

    $("input[type=checkbox].onoffswitch-checkbox").change(function(event) {
        if($(this).is(":checked")){
            Loader.start()
            setTimeout(function(){
                Loader.stop()
                $("tr.fini").fadeIn(400)
                $(".aucun").hide()
            }, 500);
        }else{
            $("tr.fini").fadeOut(400)
            $(".aucun").show()
        }
    });

    $("#top-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("table.table-prospection tr:not(.no)").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    
    annulerProspection = function(id){
        alerty.confirm("Voulez-vous vraiment annuler cette prospection ?", {
            title: "Annuler la prospection",
            cancelLabel : "Non",
            okLabel : "OUI, annuler",
        }, function(){
            var url = "../../webapp/gestion/modules/production/prospections/ajax.php";
            alerty.prompt("Entrer votre mot de passe pour confirmer l'opération !", {
                title: 'Récupération du mot de passe !',
                inputType : "password",
                cancelLabel : "Annuler",
                okLabel : "Valider"
            }, function(password){
                Loader.start();
                $.post(url, {action:"annulerProspection", id:id, password:password}, (data)=>{
                    if (data.status) {
                        window.location.reload()
                    }else{
                        Alerter.error('Erreur !', data.message);
                    }
                },"json");
            })
        })
    }


    terminer = function(id){
        alerty.confirm("Cette prospection est-elle vraiment terminée ?", {
            title: "Prospection terminée",
            cancelLabel : "Non",
            okLabel : "OUI, terminer",
        }, function(){
            session("prospection_id", id);
            modal("#modal-prospection"+id);
        })
    }



    $(".formValiderProspection").submit(function(event) {
        Loader.start();
        var url = "../../webapp/gestion/modules/production/prospections/ajax.php";
        var formdata = new FormData($(this)[0]);
        var tableau = new Array();
        $(this).find("table tr").each(function(index, el) {
            var id = $(this).attr('data-id');
            var val = $(this).find('input.vendu').val();
            var item = id+"-"+val;
            tableau.push(item);
        });
        formdata.append('tableau', tableau);

        var tableau = new Array();
        $(this).find("table tr").each(function(index, el) {
            var id = $(this).attr('data-id');
            var val = $(this).find('input.perdu').val();
            var item = id+"-"+val;
            tableau.push(item);
        });
        formdata.append('tableau1', tableau);

        formdata.append('action', "validerProspection");
        $.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
            if (data.status) {
                window.location.reload()
            }else{
                Alerter.error('Erreur !', data.message);
            }
        }, 'json');
        return false;
    });


    
})