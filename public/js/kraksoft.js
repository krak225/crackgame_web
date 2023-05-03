+function ($) { "use strict";

  $(function(){

		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		
		var base_url = $("#eco_base_url").val();
		// var base_url = 'http://192.168.43.139/crackgame/public/';
		
		var lang = $("#lang").val();
		
		$('.datatable:not(".someClass")').each(function() {
			
			var oTable = $(this).dataTable({
			"bProcessing": false,
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"sPaginationType": "full_numbers",
			"language": {
				"url": base_url + "js/datatables/lang/French.json"
			},
			"lengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]]
			});
		});
	  
	  
		//
		var cpt_selection = $('.checkbox_selection_question:checked').length;//alert('cpt_selection:'+cpt_selection);
		$('.checkbox_selection_question').click(function(){
			
			
			if(document.getElementById('chk_'+$(this).attr('data-id')).checked == true){
				cpt_selection ++;
			}else{
				if(cpt_selection > 0) cpt_selection --;
			}

			//alert('cpt_selection:'+cpt_selection);
			
			if(cpt_selection == 7){
				SaveSelectionQuestion('Vous avez atteint les 7 questions. ');
			}
			
				
		});
	    
		//
		var cpt_selection_chap = $('.checkbox_selection_question_chap:checked').length;//alert('cpt_selection_chap:'+cpt_selection_chap);
		$('.checkbox_selection_question_chap').click(function(){
			
			

			if(document.getElementById('chk_'+$(this).attr('data-id')).checked == true){
				cpt_selection_chap ++;
			}else{
				if(cpt_selection_chap > 0) cpt_selection_chap --;
			}

			//alert('cpt_selection_chap:'+cpt_selection_chap);
			
			if(cpt_selection_chap == 5){
				SaveSelectionQuestionChap('Vous avez atteint les 5 questions. ');
			}
			
				
		});
	    
		//
		$('.pour_qui').click(function(){
			if($(this).val() == 'ami'){
				$('#box_pseudo_ami').fadeIn();
				$('#pseudo_ami').attr('required',true);
			}else{
				$('#box_pseudo_ami').fadeOut();
				$('#pseudo_ami').removeAttr('required');
			}
		});
	    
		//
		$('#quantite_jocker_question').change(function(){
			
			var quantite = $(this).val();

			$.ajax({
				headers:{'X-CSRF-TOKEN': csrf_token},
				type:'get',
				dataType: 'json',
				url: base_url + 'montant_jocker/'+quantite,
				success: function(montant){
					$('#montant_jocker_question').val(montant);
				},
				error:function(){

				}
			});

		});
	    
		//
		$('#quantite_souscription').change(function(){
			
			var quantite = $(this).val();

			$.ajax({
				headers:{'X-CSRF-TOKEN': csrf_token},
				type:'get',
				dataType: 'json',
				url: base_url + 'montant_souscription/'+quantite,
				success: function(montant){
					$('#montant_souscription').val(montant);
				},
				error:function(){

				}
			});

			
			
		});
	    
		//
		var categorie_id = $('#categorie_id').val();
		var boxScore = $('#myScore');
		ShowScore();
		// ShowQuestion(categorie_id);
		
		var gameOver = false;
		var cpt_faute = 0;
		var timer = '';
		var onPause = true;
		
		function StartChrono(categorie_id){
			
			var cpt = 25;
			
			clearInterval(timer);
			
			timer = setInterval(function(){
				
				$('#chrono').html(cpt);
					
				if(cpt > 0){
					
					cpt = cpt  - 1;
				
				}else{
					
					cpt = 25;
					// alert(cpt);
					clearInterval(timer);
					// ContinuerTest(categorie_id);
					$('#no_answer').click();
					$('#btnConfirmerReponse').click();
					
				}
				
				
			},1000);
			
			
		}
		
		
		//
		// $('.listePropositions li')
		$('#btnA').click(function(){
			document.getElementById('checkA').checked = true;
		});
		$('#btnB').click(function(){
			document.getElementById('checkB').checked = true;
		});
		$('#btnC').click(function(){
			document.getElementById('checkC').checked = true;
		});
		
		
		$('#StartView').show();
		//Changement de circonscription
		$('#btnStartGame').click(function(){

			
			if($(this).hasClass('pause')){
				
				onPause = false;
							
				$('#StartView').hide();
				$('#PauseView').hide();
				$('#GameView').fadeIn();
			
				$(this).removeClass('pause');
				
				$(this).addClass('play');
				
				$(this).html('<i class="fa fa-pause"></i> Pause');
			
				var categorie_id 		= $('#categorie_id').val();
				var type_jeu	 		= $('#type_jeu').val();
				var objectif_financier	= $(this).attr('data-objectif_financier');
				
				// ShowQuestion(categorie_id);//enregistrer le test d'abord
				
				//enregistrer le test
				SaveTestConnaissance(categorie_id,type_jeu,objectif_financier);
				
				
			}else{
				
				gameOver = false;
			
				onPause = true;
				
				$('#StartView').hide();
				$('#GameView').hide();
				$('#PauseView').fadeIn();
				
				$(this).html('<i class="fa fa-play"></i> Démarer le jeu');
				
				$(this).removeClass('play');
				
				$(this).addClass('pause');
				
				clearInterval(timer);
				// alert();
				
				
			}
			
		});
		
		//Changement de circonscription
		$('#btnConfirmerReponse').click(function(){
			
			clearInterval(timer);
			
			var categorie_id = $('#categorie_id').val();
			var buttonClicked = $('.reponse:checked').parent().parent();
			
			var entrainement_id = $('#entrainement_id').val();
			
			var question_id = $('#question_id').val();
			
			var reponse = $('.reponse:checked').val();
			
			
			$('.reponse:checked').removeAttr('checked');
			
			var data = {'entrainement_id': entrainement_id,'question_id': question_id, 'reponse':reponse};
			
			$.ajax({
				headers:{'X-CSRF-TOKEN': csrf_token},
				type:'post',
				data: data,
				dataType: 'json',
				url: base_url + 'repondre',
				success: function(e){
					
					$('#score').html(e.score);
					
					//
					if(e.statut == 1){
						
						// notifySuccess("Bravo! c'est la bonne réponse");
						buttonClicked.addClass('btn-bonne_reponse');
						boxScore.addClass('newScore');
						
						AnimateScoreView();
						
					}else{
						
						// notifyWarning("Mauvaise réponse");
						buttonClicked.addClass('btn-mauvaise_reponse');
						// alert(buttonClicked.attr('class'));
						
						
						cpt_faute++;
						
						if(cpt_faute == 1){
							
							$('#vie1').addClass('elimine');
						
						}else if(cpt_faute == 2){
							
							$('#vie2').addClass('elimine');
							
						}else{
							
							$('#vie3').addClass('elimine');
							
							clearInterval(timer);
							
							gameOver = true;
							
						}
						
					}
					
					if(e.reponse == 'A'){
						$('#btnA').addClass('btn-bonne_reponse');
					}else if(e.reponse == 'B'){
						$('#btnB').addClass('btn-bonne_reponse');
					}else{
						$('#btnC').addClass('btn-bonne_reponse');
					}
					
					setTimeout(function(){
						
						$('.btn-proposition').removeClass('btn-bonne_reponse');
						$('.btn-proposition').removeClass('btn-warning');
						$('.btn-proposition').removeClass('btn-mauvaise_reponse');
						
						boxScore.removeClass('newScore');
						
						if(e.statut_fin_quiz == 0){
							ShowQuestion(categorie_id);
						}else{
							clearInterval(timer);
							
							gameOver = true;
						}
						
					},5000);
					
				},
				error: function(){
					notifyError("Erreur lors de du traitement");
				},
				beforeSend:function(){
					$('#btnConfirmerReponse').attr('disabled','true');
				}
			});
			
			
			
		});
		
		
		//
		function ShowQuestion(categorie_id){
			
			if(gameOver){
				// alert();
				GameOverAlert();
				
			}else{
			
				if(!onPause){
					
					$('#chrono').html('');
					
					$('.reponse:checked').removeAttr('checked');
					
					$.ajax({
						headers:{'X-CSRF-TOKEN': csrf_token},
						type:'get',
						dataType:'json',
						url: base_url + 'question/'+categorie_id,
						success: function(e){
							
							//alert(e.cptQuestion 0);

							if(e.cptQuestion > 0){
							
								AnimateQuestionView();
								
								$('#cptQuestion').text(e.cptQuestion);
								
								$('#question_id').val(e.id);
							
								$('#question').text(e.question);
								$('#propositionA').text(e.propositionA);
								$('#propositionB').text(e.propositionB);
								$('#propositionC').text(e.propositionC);
								
								$('#btnConfirmerReponse').removeAttr('disabled');
								
								

								
								//
								// StartChrono(categorie_id);//déplacé apres les anims

							}else{
								notifyWarning("Plus de question disponible dans cette catégorie .");
							}
									
						},
						error: function(){
							// notifyError("Erreur lors de du chargement");
						}
					});
					
				}else{
					
					$('#GameView').fadeOut();
					// notifyWarning('Veuillez cliquez sur play, pour continuer le jeu');
				}
				
			}
			
		}
		
		function ShowScore(){
			
			$.ajax({
				headers:{'X-CSRF-TOKEN': csrf_token},
				type:'get',
				// dataType:'json',
				url: base_url + 'score',
				success: function(score){
					
					// $('#score').html(score);
					AnimateScoreView(score);
					
				},
				error: function(){
					// notifyError("Erreur lors de du chargement");
				}
			});
			
		}
		
		function AnimateScoreView(score){
			/*
			var old_score = $('#score').html();
			var i = old_score;
			// alert(old_score);
			while(i <= score){
				// alert(i);
				setTimeout(function(){
					// $('#score').html(old_score + i);
				},4000);
				
				i ++;
				
			}
			
			*/
			
		}
		
		
		function SaveTestConnaissance(categorie_id, type_jeu, objectif_financier){
						
			var data = {'categorie_id': categorie_id, type_jeu:type_jeu, objectif_financier:objectif_financier};
			
			$.ajax({
				headers:{'X-CSRF-TOKEN': csrf_token},
				type:'post',
				data: data,
				dataType: 'json',
				url: base_url + 'savetest',
				beforeSend: function(){
					$('#LoadingView').fadeIn();
					$('#GameView').hide();
				},
				success: function(e){
					
					$('#LoadingView').hide();
					$('#GameView').fadeIn();
					
					if(e.statut == 1){
						
						// notifySuccess("Jeu enregistré avec succès!");
						
						$('#entrainement_id').val(e.entrainement_id);
						
						ShowQuestion(categorie_id);
						
					}else{
						location.href = "";
					}
				},
				error:function(){
					
				}
			});
			
		}
		
		
		//NOTY
		function notifyError(text){
			notification(text,'error');
		}
		function notifyWarning(text){
			notification(text,'warning');
		}
		function notifySuccess(text){
			notification(text,'success');
		}
		
		function notification(text,type,callback){
			
			noty({
				dismissQueue: false,
				force: true,
				layout:'center',
				modal: true,
				theme: 'defaultTheme',
				text:text,
				type: type,
				buttons: [{addClass: 'btn btn-information ', text: 'OK', onClick: function($noty) {
				   $noty.close();
				  
				   }}]
			});
		}

		function ContinuerTest(categorie_id){
			
			noty({
				dismissQueue: false,
				force: true,
				layout:'center',
				modal: true,
				theme: 'defaultTheme',
				text:'Temps de réponse terminé!',
				type: type,
				buttons: [{addClass: 'btn btn-information ', text: 'Question suivante', onClick: function($noty) {
						$noty.close();
				   
						ShowQuestion(categorie_id);
						
				   }},
				   {addClass: 'btn btn-warning ', text: 'Abandonner', onClick: function($noty) {
						$noty.close();
				  
				   }}]
			});
		}
		
		
		function GameOverAlert(){
			
			noty({
				dismissQueue: false,
				force: true,
				layout:'center',
				modal: true,
				theme: 'defaultTheme',
				text: 'FIN DE LA PARTIE! voulez-vous refaire un autre test?',
				type: 'information',
				buttons: [{addClass: 'btn btn-primary', text: 'Nouvelle partie', onClick: function($noty) {
						$noty.close();
						
						location.href = "";
					
				   }},
				   {addClass: 'btn btn-warning ', text: 'Arrêter le test', onClick: function($noty) {
						$noty.close();
						
						location.href = base_url + 'categorie_test';
						
				   }},]
			});
			
		}

		function SaveSelectionQuestion(){
			
			var liste_selection = '';
			
			$('.checkbox_selection_question:checked').each(function(){
				liste_selection=liste_selection+$(this).attr('data-id')+',';
			});
			
			noty({
				dismissQueue: false,
				force: true,
				layout:'center',
				modal: true,
				theme: 'defaultTheme',
				text: 'Vous avez atteint les 7 questions sélectionnées. ',
				type: 'information',
				buttons: [{addClass: 'btn btn-primary', text: 'Enregistrer', onClick: function($noty) {
						$noty.close();
						
						//
						$.ajax({
							headers:{'X-CSRF-TOKEN': csrf_token},
							type:'post',
							data:{liste_selection:liste_selection},
							dataType: 'json',
							url: base_url + 'save_selection_question',
							success: function(e){
								
								if(e.statut == 1){
									
									notifySuccess("Enregistrement effectué avec succès");
									
									$('.checkbox_selection_question').removeAttr('checked');
									
									cpt_selection = 0;
									//location.href = "";
									
								}else{
									
									notifyWarning("Erreur lors de l'enregistrement");
									
								}
							},
							error:function(){
								
							}
						});
						
				   }},
				   {addClass: 'btn btn-warning ', text: 'Annuler', onClick: function($noty) {
						$noty.close();
						
						$('.checkbox_selection_question').removeAttr('checked');
						location.href = '';
						
				   }},]
			});
			
		}

		
		function SaveSelectionQuestionChap(){
			
			var liste_selection_chap = '';
			
			$('.checkbox_selection_question_chap:checked').each(function(){
				liste_selection_chap=liste_selection_chap+$(this).attr('data-id')+',';
			});
			
			noty({
				dismissQueue: false,
				force: true,
				layout:'center',
				modal: true,
				theme: 'defaultTheme',
				text: 'Vous avez atteint les 5 questions du chap. ',
				type: 'information',
				buttons: [{addClass: 'btn btn-primary', text: 'Enregistrer', onClick: function($noty) {
						$noty.close();
						
						//
						$.ajax({
							headers:{'X-CSRF-TOKEN': csrf_token},
							type:'post',
							data:{liste_selection_chap:liste_selection_chap},
							dataType: 'json',
							url: base_url + 'save_selection_question_chap',
							success: function(e){
								
								if(e.statut == 1){
									
									notifySuccess("Enregistrement effectué avec succès");
									
									$('.checkbox_selection_question_chap').removeAttr('checked');
									
									cpt_selection_chap = 0;
									//location.href = "";
									
								}else{
									
									notifyWarning("Erreur lors de l'enregistrement");
									
								}
							},
							error:function(){
								
							}
						});
						
				   }},
				   {addClass: 'btn btn-warning ', text: 'Annuler', onClick: function($noty) {
						$noty.close();
						
						$('.checkbox_selection_question_chap').removeAttr('checked');
						location.href = '';

				   }},]
			});
			
		}

		
		//CONVERSION DE POINTS
		$('#point_a_convertir').keyup(function(){
			var point_actuel = $('#point_actuel').val();
			var point_a_convertir = $('#point_a_convertir').val();
			
			point_actuel = parseInt(point_actuel);
			point_a_convertir = parseInt(point_a_convertir);
			
			if(point_a_convertir > point_actuel){
				// alert(point_actuel.parseInt());
				$('#point_a_convertir').val(point_actuel);
			}
			
			AutoConversion();
			
		});
		
		
		$('#point_a_convertir').change(function(){
			var point_actuel = $('#point_actuel').val();
			var point_a_convertir = $('#point_a_convertir').val();
			
			point_actuel = parseInt(point_actuel);
			point_a_convertir = parseInt(point_a_convertir);
			
			if(point_a_convertir > point_actuel){
				// alert(point_actuel.parseInt());
				$('#point_a_convertir').val(point_actuel);
			}
			
			AutoConversion();
			
		});
		
		
		function AutoConversion(){
			
			$.ajax({
				headers:{'X-CSRF-TOKEN': csrf_token},
				dataType:'json',
				type:'post',
				data:$('#formConversionPoint').serialize(),
				url: base_url + 'auto_conversion',
				success: function(e){
					if(e.statut == 1){
						$('#montant_obtenu').val(e.montant_obtenu);
					}else if(e.statut == 2){
						$('#montant_obtenu').val(0);
						$('#infoBox').html(e.message).removeClass('alert-success').addClass('alert-warning');
					}else{
						$('#montant_obtenu').val(0);
						$('#infoBox').html('Erreur lors de la conversion').removeClass('alert-success').addClass('alert-warning');;
					}					
				},
				beforeSend: function(){
					$('#infoBox').hide();
				},
				error: function(){
					// notifyError("Erreur lors de du chargement");
				},
			});
			
		}
		
		
		function AnimateQuestionView(){
			
			$('#question').fadeOut();
			$('#btnA').fadeOut();
			$('#btnB').fadeOut();
			$('#btnC').fadeOut();
			
			setTimeout(function(){
				$('#question').fadeIn(function(){
					$("#btnA").fadeIn(500,function(){
						$("#btnB").fadeIn(500,function(){
							$("#btnC").fadeIn(500,function(){
								$("#btnConfirmerReponse").fadeIn(500,function(){
									 StartChrono(categorie_id);
								});
							});
						});
					});
					
					
				});
			},2000);
			
			
		}
		
		
		
		//TAB
		// Popular Products Tabs
    $('.absolute-tabs li').on('click', 'a', function () {
        if ($(this).hasClass('active') || $(this).attr('data-absolutetab') == '')
            return false;
        $(this).parents('.absolute-tabs').find('li a').removeClass('active');
        $(this).addClass('active');

        // mobile
        $('.absolute-tab-mob[data-absolutetab-num=' + $(this).data('absolutetab-num') + ']').parents('.absolute-tab-cont').find('.absolute-tab-mob').removeClass('active');
        $('.absolute-tab-mob[data-absolutetab-num=' + $(this).data('absolutetab-num') + ']').addClass('active');

        $($(this).attr('data-absolutetab')).parents('.absolute-tab-cont').find('.absolute-tab').css('height', '0px');
        $($(this).attr('data-absolutetab')).css('height', 'auto').hide().fadeIn();
        return false;
    });

    // Popular Products Tabs (mobile)
    $('.absolute-tab-cont').on('click', '.absolute-tab-mob', function () {
        if ($(this).hasClass('active') || $(this).attr('data-absolutetab') == '')
            return false;
        $(this).parents('.absolute-tab-cont').find('.absolute-tab-mob').removeClass('active');
        $(this).addClass('active');

        // main
        $('.absolute-tabs li a[data-absolutetab-num=' + $(this).data('absolutetab-num') + ']').parents('.absolute-tabs').find('li a').removeClass('active');
        $('.absolute-tabs li a[data-absolutetab-num=' + $(this).data('absolutetab-num') + ']').addClass('active');

        $($(this).attr('data-absolutetab')).parents('.absolute-tab-cont').find('.absolute-tab').animate({
            'height': '0px'
        }, 350);
        $($(this).attr('data-absolutetab')).animate({
            'height': $($(this).attr('data-absolutetab')).find('.absolute-tab-inner').outerHeight()+'px'
        }, 350);

        return false;
    });
		

	$('#form_add_question #question_').keyup(function(key){
		
		$('#cpt_maxlength').text(160 - $(this).val().length + ' caractères restant(s)');
			
	});
    
	var form_add_question_value = $('#form_add_question #question_').val();
	
	var form_add_question_value_taille = (form_add_question_value == undefined)? 0 : form_add_question_value.length;
	
    $('#cpt_maxlength').text(160 - form_add_question_value_taille + ' caractères restant(s)');


	
	function SendInvitation(to_user_id){
		// alert(to_user_id);
		// console.log('to_user_id',to_user_id);
	}
	// alert();


	});
}(window.jQuery);