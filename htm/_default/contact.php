<?php
	include_once(dirname(dirname(dirname(__FILE__)))."/app/class.sing.php");
	include_once(dirname(dirname(dirname(__FILE__)))."/app/functions.php");
	$contact = new Sing('contact');
	$config = new Sing('cfg');
?>
<article>

	<div>

<?php /*	<p style="text-align:center;"><?php echo $contact->get('adresse'); ?><br />
	<?php if($contact->get('tel')) echo "Tél: ".$contact->get('tel'); ?><?php if($contact->get('fax')) echo " - Fax: ".$contact->get('fax'); ?></p>
	<?php echo encodeHTML($contact->get('horaires')); */

	?>

	<fieldset>
		<form name="formulaire-contact" class="up" action="#" method="POST">
				<?php
					if ($contact->get('nom')!='Desactivé') echo '<span class="nom-formulaire"><input type="text" name="nom-formulaire"   id="nom-formulaire" placeholder="Votre Nom'.(($contact->get('nom')=='Obligatoire')?'*':'').'" /></span>';
					if ($contact->get('prenom')!='Desactivé') echo '<span class="prenom-formulaire"><input type="text" name="prenom-formulaire"   id="prenom-formulaire" placeholder="Votre Prénom'.(($contact->get('prenom')=='Obligatoire')?'*':'').'" /></span>';
					if ($contact->get('societe')!='Desactivé') echo '<span class="societe-formulaire"><input type="text" name="societe-formulaire"   id="societe-formulaire" placeholder="Votre Société'.(($contact->get('societe')=='Obligatoire')?'*':'').'" /></span>';
					if ($contact->get('mail')!='Desactivé') echo '<span class="mail-formulaire"><input type="text" name="mail-formulaire"   id="mail-formulaire" placeholder="Votre E-Mail'.(($contact->get('mail')=='Obligatoire')?'*':'').'" /></span>';
					if ($contact->get('telephone')!='Desactivé') echo '<span class="tel-formulaire"><input type="text" name="tel-formulaire"   id="tel-formulaire" placeholder="Votre Téléphone'.(($contact->get('telephone')=='Obligatoire')?'*':'').'" /></span>';
				?>
				<span class="message-formulaire">
				<textarea name="message" id="message-formulaire" rows="4" placeholder="Votre Message"><?php if(isset($_GET['msg'])) echo $_GET['msg']; ?></textarea>
				</span>
				<p class="envoi"><span id="envoi"><button  name="envoi" id="envoi-formulaire"/> Envoyer </span></p>
		</form>
	</fieldset>
	</div>
</article>


<script type="text/javascript">

	function isValidEmailAddress(emailAddress) {
		var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
		return pattern.test(emailAddress);
	}

	/** Jquery Empêcher le remplissage des champs chiffres par autre chose que des chiffres (html5 input tel) **/
	jQuery("form.up input, form.up textarea ").each(function() {
		$(this).keyup(function() {
			if(this.value!='' && typeof this.value != 'undefined')
				$(this).addClass('filled');
			else
				$(this).removeClass('filled');
		})

	});


	$('textarea').keypress(function(e) {
    var tval = $('textarea').val(),
        tlength = tval.length,
        set = 201,
        remain = parseInt(set - tlength);
    if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        $('textarea').val((tval).substring(0, tlength - 1))
	    }
	});

	jQuery("input[name=tel-formulaire]").keyup(function(event) {
		this.value = this.value.replace(/[^0-9\.+]/g,'');
	});

	/** Contrôle du formulaire avant envoi */
	$("#envoi-formulaire").click(function(event) {
		event.preventDefault();
		var count = 0;

		<?php
				if ($contact->get('nom')!='Desactivé') echo 'var nom = $("input#nom-formulaire").val();'."\n";
				if ($contact->get('prenom')!='Desactivé') echo 'var prenom = $("input#prenom-formulaire").val();'."\n";
				if ($contact->get('societe')!='Desactivé') echo 'var societe = $("input#societe-formulaire").val();'."\n";
				if ($contact->get('mail')!='Desactivé') echo 'var mail = $("input#mail-formulaire").val();'."\n";
				if ($contact->get('telephone')!='Desactivé') echo 'var telephone = $("input#telephone-formulaire").val();'."\n";

			if ($contact->get('nom')=='Obligatoire') echo ' $("input#nom-formulaire").removeClass("erreur"); '."\n".' if (nom.length < 2) { $("input#nom-formulaire").addClass("erreur"); count++; }'."\n";
			if ($contact->get('prenom')=='Obligatoire') echo ' $("input#prenom-formulaire").removeClass("erreur");'."\n".' if (prenom.length < 2) { $("input#prenom-formulaire").addClass("erreur"); count++; }'."\n";
			if ($contact->get('societe')=='Obligatoire') echo ' $("input#societe-formulaire").removeClass("erreur");'."\n".' if (societe.length < 2) { $("input#societe-formulaire").addClass("erreur"); count++; }'."\n";
			if ($contact->get('mail')=='Obligatoire') echo ' $("input#mail-formulaire").removeClass("erreur");'."\n".' if (!isValidEmailAddress(mail)) { $("input#mail-formulaire").addClass("erreur"); count++; }'."\n";
			if ($contact->get('telephone')=='Obligatoire') echo ' $("input#telephone-formulaire").removeClass("erreur");'."\n".' if (telephone.length < 2) { $("input#telephone-formulaire").addClass("erreur"); count++; }'."\n";
		?>
		var message = $("textarea#message-formulaire").val();
		$("textarea#message-formulaire").removeClass("erreur");
	 	if (message.length < 2) { $("textarea#message-formulaire").addClass("erreur"); count++; }
		if (count>1) return false;

		var reqPOST = 'message=' + encodeURIComponent(message)
		<?php
				if ($contact->get('nom')!='Desactivé') echo "+ '&nom='+ encodeURIComponent(nom)";
				if ($contact->get('prenom')!='Desactivé') echo "+ '&prenom='+ encodeURIComponent(prenom)";
				if ($contact->get('societe')!='Desactivé') echo "+ '&societe='+ encodeURIComponent(societe)";
				if ($contact->get('mail')!='Desactivé') echo "+ '&mail='+ encodeURIComponent(mail)";
				if ($contact->get('telephone')!='Desactivé') echo "+ '&telephone='+ encodeURIComponent(telephone)";
		?>;

		console.log(reqPOST)
		$.ajax({
			type: "POST",
			url: "./app/mailer.php",
			data: reqPOST,
			error: function(msg) {
				console.log(msg);
				$.ajax({
					type: "POST",
					url: "../app/mailer.php",
					data: reqPOST,
					error: function(msg) {
						console.log(msg);

					},
					success: function(msg) {
						console.log(msg);
						$('span#envoi').html("<div id='formulaire-succes' class='succes'></div>");
						$('#formulaire-succes').html("Votre message a bien été envoyé.")
							.append("<p></p>")
							.hide()
							.fadeIn(1500, function() {
							});
						$('input').each(function(){$(this).attr('disabled', true);});
						$('textarea').each(function(){$(this).attr('disabled', true);});
					}
				});
			},
			success: function(msg) {
						console.log(msg);
				$('span#envoi').html("<div id='formulaire-succes' class='succes'></div>");
				$('#formulaire-succes').html("Votre message a bien été envoyé.")
					.append("<p></p>")
					.hide()
					.fadeIn(1500, function() {
					});
				$('input').each(function(){$(this).attr('disabled', true);});
				$('textarea').each(function(){$(this).attr('disabled', true);});

			}
		});
		return false;

	});
</script>
