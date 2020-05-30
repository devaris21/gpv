$(function(){


	$("#formAcompte").submit(function(event) {
		var url = "../../webapp/gestion/modules/production/commercial/ajax.php";
		alerty.confirm("Voulez-vous vraiment créditer ce montant sur ce compte ?", {
			title: "Créditer l'acompte",
			cancelLabel : "Non",
			okLabel : "OUI, créditer",
		}, function(){
			alerty.prompt("Entrer votre mot de passe pour confirmer l'opération !", {
				title: 'Récupération du mot de passe !',
				inputType : "password",
				cancelLabel : "Annuler",
				okLabel : "Valider"
			}, function(password){
				var formdata = new FormData($("#formAcompte")[0]);
				formdata.append('password', password);
				formdata.append('action', "acompte");
				Loader.start();
				$.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
					if (data.status) {
						window.open(data.url, "_blank");
						window.location.reload();
					}else{
						Alerter.error('Erreur !', data.message);
					}
				}, 'json')
			})
		})
		return false;
	});


	$("form#filtrer").submit(function(event) {
		var url = "../../webapp/gestion/modules/production/commercial/ajax.php";
		var formdata = new FormData($(this)[0]);
		formdata.append('action', "filtrer");
		Loader.start();
		$.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
			$(".tableau").html(data)
			Loader.stop();
		}, 'html')
		return false;
	});




	$('.input-group.date').datepicker({
		autoclose: true,
		format: "dd MM yyyy",
		language: "fr"
	});

})