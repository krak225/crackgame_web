$('document').ready(function(){
			
	const uuid = PubNub.generateUUID();
	
	const pubnub = new PubNub({
		publishKey: "pub-c-8279f6e9-58e8-4997-a925-a3d09f415784",
		subscribeKey: "sub-c-72100340-83fc-11e5-b539-0619f8945a4f",
		uuid: uuid
	});


	pubnub.subscribe({
	channels: ['pubnub_onboarding_channel'],
	withPresence: true
	});


	pubnub.addListener({

		message: function(event) {
			
			var u = event.message.content.u;
			var m = event.message.content.m;
			var d = event.message.content.d;
			var b = event.message.content.b;

			var m_formated = new Intl.NumberFormat().format(m);//alert(m + ' : ' + m_formated);

			$('#tbody').prepend('<tr class="new" style="font-weight:bold;"><td>'+u+'</td><td style="text-align:right;">'+ m_formated +'</td><td>'+d+'</td></tr>');
		  	
		  	var montant_bureau = parseInt($('#bureau_'+b).html().replace(/ /g, ""));

		  	var montant_total = parseInt($('#hidden_montant_total').val());//alert(montant_total);

		  	montant_bureau = montant_bureau - (- m);

		  	montant_total = montant_total - (- m);

			$('#bureau_'+b).html(new Intl.NumberFormat().format(montant_bureau));

			//$('#hidden_montant_total').val(new Intl.NumberFormat().format(montant_total));

			$('#hidden_montant_total').val(montant_total);

			$('#montant_total').html(new Intl.NumberFormat().format(montant_total));


			//Jouer le son
			//$('#audio').play();

			//play();
			//alert('Lecture en cours');

		}

	});

});