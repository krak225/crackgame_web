var express = require('express')();
var server 	= require('http').Server(express);
var io 		= require('socket.io')(server);
var mysql 	= require('mysql');



var db = mysql.createConnection({
    host : 'localhost',
    user : 'root',
    password : '',
    database : 'c0cha8936'
});


// Log any errors connected to the db
db.connect(function(err){
    if (err) console.log(err)
});
 

// Define/initialize our global vars
var cout_bonne_reponse_chap = 20;
var questions = [];
var isInitQuestions = false;
var socketCount = 0;

var timerInnactivite = 0;

io.on('connection', function (socket) {
  
  console.log("New client connected");

  //added on 06022020 : chat android
  socket.on('add user', function (username) {
	
	var userData = {numUsers:2,userName:username};
	
	io.emit("login",JSON.stringify(userData));
	
	console.log("user added: ",JSON.stringify(userData));
	
  });
  
  socket.on('android-user-join', function(data) {

	console.log('android-user-join', data);
	
	io.emit('android-user-join', data);
		
	
  });

  //fin chat android
  
  //gestion des invitations aux duels
  socket.on('accepter-invitation', function (data) {
    
	//Créer un duel
	var sql =  'update duel set duel_statut="VALIDE" where duel_id='+data.duel_id;
	db.query(sql);

	io.emit('invitation-accepte', data);
		
	console.log("invitation-accepte: ",JSON.stringify(data));
		
	
  });
  
  //Todo::vérifier qu'il n'y ait pas de duel en cours pour un joueur
  socket.on('send-invitation', function (data) {
    
	//Créer un duel
	var sql_insert_duel =  'insert into duel(user_id,adversaire_id,current_player_id,compteur_question,connected_users,readystate) values('+data.from_user_id+','+data.to_user_id+','+data.from_user_id+',0,0,"NOT READY")';
	db.query(sql_insert_duel);

	
	//Récupérer le duel crée
	var sql_duel = 'select * from duel where user_id = "'+ data.from_user_id +'" order by duel_id desc limit 0,1';
	
	db.query(sql_duel)
	.on('result', function(duel){
		
		//Créer les lignes de score
		var sql =  'insert into duel_score(duel_id,user_id,score) values('+duel.duel_id+','+data.from_user_id+',0)';
		db.query(sql);

		var sql =  'insert into duel_score(duel_id,user_id,score) values('+duel.duel_id+','+data.to_user_id+',0)';
		db.query(sql);

		
		//Créer les lignes de jockers du duel
		var sql =  'insert into duel_jocker(duel_id,user_id,jocker_utilise) values('+duel.duel_id+','+data.from_user_id+',0)';
		db.query(sql);

		var sql =  'insert into duel_jocker(duel_id,user_id,jocker_utilise) values('+duel.duel_id+','+data.to_user_id+',0)';
		db.query(sql);

		data.duel_id = duel.duel_id;
		
		io.emit('send-invitation', data);
		
		console.log("send-invitation: ",JSON.stringify(data));
		
	})
	.on('end', function(){
		
		
	});
	
	
	
	
  });


  socket.on('ask-question', function (data) {

	console.log("ask-question: ",JSON.stringify(data));
		
  	//Added on 12052019: démarer le décompte du temps d'innactivité dans ce duel

  	var time_actuel = 0;
  	timerInnactivite = setInterval(function(tps){

  		time_actuel = new Date().getTime();
  		console.log('time_actuel:',time_actuel);
  		
  		var sql_tps_innactivite = 'select time_actuel, user_id, adversaire_id from duel_question inner join duel using(duel_id) where duel.duel_id = "'+ data.duel_id +'" ORDER BY duel_question_id desc limit 0,1';
	
		
		
		
		db.query(sql_tps_innactivite)
		.on('result', function(result){
			
			var diff = time_actuel - result.time_actuel ;
			
			//1000 * 60 * 2
			if(diff > 2 * 10000){
				
				
				clearInterval(timerInnactivite);

				console.log("Temps d'innactivité de 30min atteint: diff = ", diff);

				//Vérifier s'ils sont connectés
				var sql_user_statuts = 'select count(id) as nbre_connectes from users where id in("'+ result.user_id +'","'+result.adversaire_id+'") and statut_connexion="CONNECTE" ';
				db.query(sql_user_statuts)
				.on('result', function(user){

					//console.log("sql_user_statuts:",sql_user_statuts);
					console.log("users:",JSON.stringify(user));

					
					//si les deux sont connectés
					if(user.nbre_connectes == 2){

						socket.emit("deux_connectes_reprendre_duel",data);
						console.log("deux_connectes_reprendre_duel");


					}else if(user.nbre_connectes == 0){

						socket.emit("aucun_connecte_annuler_duel",data);
						console.log("aucun_connecte_annuler_duel");
						var sql_update_duel_annule = 'update duel set duel_statut = "ANNULE" where duel_id ="'+data.duel_id+'" ';
							db.query(sql_update_duel_annule);


					}else if(user.nbre_connectes == 1){

						

						var sql_user_statuts = 'select id, pseudo, statut_connexion from users where id in("'+ result.user_id +'","'+result.adversaire_id+'") and statut_connexion="CONNECTE" ';
						db.query(sql_user_statuts)
						.on('result', function(user){

							//vainqueur_id = user.id;


							if(user.id == result.user_id){

								vainqueur_id = result.user_id;
								perdant_id = result.adversaire_id;

							}else{

								vainqueur_id = result.adversaire_id;
								perdant_id = result.user_id;

							}

							
							console.log("user_connecté et vainqueur:",JSON.stringify(user));
							//
							socket.emit("seul_connecte_donc_vainqueur",user.id);

							//début action si duel terminé
							var sql_update_duel_termine = 'update duel set duel_statut = "TERMINE",duel_vainqueur_id ="'+ vainqueur_id+'" where duel_id ="'+data.duel_id+'" ';
							db.query(sql_update_duel_termine);
							//console.log('sql_update_duel_termine',sql_update_duel_termine);

							
							//récupérer les points du perdant
							var points_perdant = 0;
							var sql_perdant = 'select * from duel_score where duel_id = "' + data.duel_id + '" and user_id ="' + perdant_id + '" order by score asc limit 0,1';
							db.query(sql_perdant)
							.on('result', function(perdant){
								
								
								var perdant_id = perdant.user_id;
								
								db.query('select * from users where id="'+perdant_id+'"')
								.on('result', function(perdant_info){
								
									
									points_perdant = perdant_info.total_points_duel;
									
									//augmenter les points du gagnant
									var points_perdus = points_perdant;
									var points_gagnes = 0;
									if(points_perdant < 50){
										
										points_gagnes = 50;
										
									}else{
										
										points_gagnes = points_perdant;
										
									}

									console.log('points_gagnes',points_gagnes);
									
									
									
									var sql_update_points_gagnant = 'update users set total_points_duel = total_points_duel + ' + points_gagnes + '  where id ="'+vainqueur_id+'" ';
									db.query(sql_update_points_gagnant);
									console.log('sql_update_points_gagnant',sql_update_points_gagnant);
									
									
									//retirer les points du perdant
									var sql_update_points_perdant = 'update users set total_points_duel = 0  where id ="'+perdant_id+'" ';
									db.query(sql_update_points_perdant);
									console.log('sql_update_points_perdant',sql_update_points_perdant);
									
									
									/*
									var dataDuel = '';
									dataDuel.duel_id = data.duel_id;
									dataDuel.points_gagnes = points_gagnes;
									dataDuel.points_perdus = points_perdus;
									dataDuel.perdant_id    = perdant_id;
									dataDuel.vainqueur_id  = gagnant_id;
									
									
									//Signaler la fin du duel
									
									io.emit('duel_termine', dataDuel);
									
									console.log('dataDuelFin: ',dataDuel);
									
									*/
									

								
								});
								
								
							})
							.on('end',function(){
								
								//
								
								
							});
							
							//fin action quand duel terminé
							


						});
						
						


					}

					

				});


				//
				


			}else{
				
				console.log("Temps d'innactivité de 30min non atteint:  diff = ", diff);

			}
			
			
		})
		.on('end', function(){
			
			// console.log("data: ",JSON.stringify(data));
			//io.emit('tousdeconnectes', data);
			
		});

      	console.log('tempsdinnactivite: ');

      	/**/

    }, 5000);


    
	//Save in DB
	time_actuel = new Date().getTime();
	var sql_insert_question =  'insert into duel_question(duel_id,question_id,from_user_id,to_user_id,time_actuel) values('+data.duel_id+','+data.question_id+','+data.from_user_id+','+data.to_user_id+','+time_actuel+')';
	db.query(sql_insert_question);
	

	//UPDATE current_player_id et le compteur_question
	var update_duel =  'update duel set current_player_id = '+data.to_user_id+', compteur_question = compteur_question + 1 WHERE duel_id='+data.duel_id;
	db.query(update_duel);
	
    // console.log('sql', update_duel);

	//ajouter l'option jocker si celui qui doit répondre a des jocker
	//vérifier si celui qui doit répondre dispose de jocker
	var sql_duel_jocker = 'select * from duel_jocker where duel_id = "'+ data.duel_id +'" AND user_id = "'+ data.to_user_id +'" limit 0,1';
	
	console.log("sql_duel_jocker: ",sql_duel_jocker);
	
	
	db.query(sql_duel_jocker)
	.on('result', function(duel_jocker){
		
		if(parseInt(duel_jocker.jocker_utilise) < 3){
			data.can_use_jocker = 1;
		}else{
			data.can_use_jocker = 0;
		}
		
		console.log("jocker_utilise: ",duel_jocker.jocker_utilise);
		console.log("data.can_use_jocker: ",data.can_use_jocker);
		
	})
	.on('end', function(){
		
		// console.log("data: ",JSON.stringify(data));
		io.emit('ask-question', data);
		
	});
	
	
  });


  socket.on('repondre', function (data) {
    
    var res = data;

    console.log('repondre', JSON.stringify(res));
	
	var statut   = '';
	var score    = '';
	var resultatData = '';
	var reponse_correcte = '';
	var reponse_utilisateur = '';
	var message = '';
	var nouveau_score = '';
	
	var sql_selection_score = 'select * from duel_score where duel_id ="'+data.duel_id+'" AND user_id="'+data.user_id+'"';
	var sql_update_score = 'update duel_score set score = score + 100 where duel_id ="'+data.duel_id+'" AND user_id="'+data.user_id+'"';
	
	var sql_selection_duel = 'SELECT * FROM duel where duel_id="'+data.duel_id+'"';
	
	// Initial app start, run db query
	var sql = 'SELECT * FROM question where id="'+data.question_id+'"';
	  db.query(sql)
		.on('result', function(question){
			
		    reponse_correcte = question.reponse;
		    reponse_utilisateur = data.reponse;
			
			if(question.reponse == reponse_utilisateur){
				
				statut = 1;
				
				//mettre a jour le score et enregistrer la réponse 
				db.query(sql_update_score);
				
				
			}else{
				statut = 0;
			}
			
		})
		.on('end', function(){
			
			db.query(sql_selection_score)
			.on('result', function(duel_score){
				nouveau_score = duel_score.score;
			})
			.on('end', function(){
					
				resultatData = {
					statut:statut,
					nouveau_score:nouveau_score,
					reponse_utilisateur:reponse_utilisateur,
					reponse_correcte:reponse_correcte,
					sql_update_score:sql_update_score,
					sql_selection_score:sql_selection_score,
					repondeur_id:data.user_id,
					duel_id:data.duel_id,
					from_user_id:data.from_user_id,
					to_user_id:data.to_user_id,
				};
				
				io.emit('resultat', resultatData);
				console.log('resultat', JSON.stringify(res));
				
			});
			
			// alert();
			//renvoyer le current_player_id et le compteur_question
			var dataDuel = '';
			
			db.query(sql_selection_duel)
				.on('result', function(duel){
					
					dataDuel = {duel_id:duel.duel_id,current_player_id:duel.current_player_id,compteur_question:duel.compteur_question,connected_users:duel.connected_users,readystate:duel.readystate};	
				
					//Si le compteur_question a atteint 14
					//On met à jour l'id du vainqueur
					if(duel.compteur_question == 14){
						
						console.log('DATADUEL',dataDuel);
						
						//sql gagnant
						var sql_gagnant = 'select user_id from duel_score where duel_id = "'+ duel.duel_id +'" order by score desc limit 0,1';
						db.query(sql_gagnant)
						.on('result', function(gagnant){
							
							var gagnant_id = gagnant.user_id;
							
							//mettre le statut des jeu terminé
							var current_timestamp = '';//new Date().getDate();
							// var sql_update_duel_termine = 'update duel set duel_statut = "TERMINE",duel_vainqueur_id ="'+ gagnant.user_id +'",duel_date_fin="'+ current_timestamp +'" where duel_id ="'+duel.duel_id+'" ';
							var sql_update_duel_termine = 'update duel set duel_statut = "TERMINE",duel_vainqueur_id ="'+ gagnant.user_id +'" where duel_id ="'+duel.duel_id+'" ';
							db.query(sql_update_duel_termine);
							console.log('sql_update_duel_termine',sql_update_duel_termine);
							
							//
							//récupérer les points du perdant
							var points_perdant = 0;
							var sql_perdant = 'select * from duel_score where duel_id = "'+ duel.duel_id +'" order by score asc limit 0,1';
							db.query(sql_perdant)
							.on('result', function(perdant){
								
								var perdant_id = perdant.user_id;
								
								db.query('select * from users where id="'+perdant_id+'"')
								.on('result', function(perdant_info){
								
									
									points_perdant = perdant_info.total_points_duel;
									
									//augmenter les points du gagnant
									var points_perdus = points_perdant;
									var points_gagnes = 0;
									if(points_perdant < 50){
										
										points_gagnes = 50;
										
									}else{
										
										points_gagnes = points_perdant;
										
									}
									
									var sql_update_points_gagnant = 'update users set total_points_duel = total_points_duel + ' + points_gagnes + '  where id ="'+gagnant.user_id+'" ';
									db.query(sql_update_points_gagnant);
									console.log('sql_update_points_gagnant',sql_update_points_gagnant);
									
									
									//retirer les points du perdant
									var sql_update_points_perdant = 'update users set total_points_duel = 0  where id ="'+perdant.user_id+'" ';
									db.query(sql_update_points_perdant);
									console.log('sql_update_points_perdant',sql_update_points_perdant);
									
									
									//
									dataDuel.points_gagnes = points_gagnes;
									dataDuel.points_perdus = points_perdus;
									dataDuel.perdant_id    = perdant_id;
									dataDuel.vainqueur_id  = gagnant_id;
									
									
									//Signaler la fin du duel
									
									io.emit('duel_termine', dataDuel);
									
									console.log('dataDuelFin: ',dataDuel);
									
								
								
								});
								
								
							})
							.on('end',function(){
								
								//
								
								
							});
							
							
							
							
							
						})
						.on('end', function(){
							
						});
						
						
						
					}
					
					
				})
				.on('end', function(){
					
					console.log('get_current_player',dataDuel);
					
					io.emit('get_current_player', dataDuel);
					
				
				});
				
				
			
		});
		

  });


  
  socket.on('use-jocker', function (data) {
    
	//vérifier qu'il dispose de jocker
	var sql_duel_jocker = 'select * from duel_jocker where duel_id = "'+ data.duel_id +'" AND user_id = "'+ data.jocker_user_id +'" limit 0,1';
	
	console.log("sql_duel_jocker: ",sql_duel_jocker);
	
	db.query(sql_duel_jocker)
	.on('result', function(duel_jocker){
		
		data.jocker_utilise = duel_jocker.jocker_utilise;
		
		if(duel_jocker.jocker_utilise < 3){
			
			
			console.log('use-jocker', JSON.stringify(data));

			//le current_player_id ne change pas, mais il pose une autre question
			//Mettre à jour le current_player_id
			var sql = 'update duel set current_player_id = "'+data.question_user_id+'"  where duel_id = "'+data.duel_id+'" ';
			db.query(sql);
			
			//Mettre à jour le nombre de jocker utilisé par ce joueur dans le duel
			var sql_update_jocker_utilise = 'update duel_jocker set jocker_utilise = jocker_utilise + 1  where user_id ="'+data.jocker_user_id+'" ';
			db.query(sql_update_jocker_utilise);
			

			//Décrémenter le nombre de jocker duel du joueur
			var sql_update = 'update users set jocker_question = jocker_question - 1,  jocker_jeu = jocker_jeu - 1 where id ="'+data.jocker_user_id+'" ';
			db.query(sql_update);
			

			io.emit('use-jocker', data);
			
			
		}else{
			
			io.emit('no-jocker', data);
			console.log('No jocker available', JSON.stringify(data));
		
		}
		
	
	});
	
	
	
  });


  socket.on('abandon', function (data) {
    
    console.log('abandon', JSON.stringify(data));

	//update duel 
	var update_abandon =  'update duel set duel_abandonneur_id = "'+data.abandonneur_id+'", duel_statut = "TERMINE" WHERE duel_id = ' + data.duel_id;
	db.query(update_abandon);
	
	
	var points_gagnes = 0;
	
	//diviser les points du perdant en 2 
	var update_points_perdant =  'update users set total_points_duel = total_points_duel/2 WHERE id = ' + data.abandonneur_id;
	db.query(update_points_perdant);
	
	
	var sql = 'select * from users where id = "'+ data.abandonneur_id +'" limit 0,1';
	db.query(sql)
	.on('result', function(user){
		
		var points_abandon = user.total_points_duel;
		
		console.log('points_abandon', points_abandon);
		
		//augmenter les points du gagnant
		var update_points_gagnant =  'update users set total_points_duel = total_points_duel + ' + points_abandon + ' WHERE id = ' + data.gagnant_id;
		db.query(update_points_gagnant);
	
		
	})
	.on('end',function(){
		
		//
	});
	

	
    io.emit('abandon', data);
	
	
  });


  socket.on('chat-message', function (data) {
    
    var res = data;

    console.log('chat-message', JSON.stringify(res));

    io.emit('chat-message', res);

	
  });


  socket.on('user-join', function(data) {

	var sql_update_duel1 = 'update duel inner join duel_score using(duel_id) set connected_users = connected_users + 1, connected = "CONNECTED" where duel_id = "'+data.duel_id+'" and duel_score.user_id = "'+data.user_id+'" and connected_users <> 2 AND connected = "NOT CONNECTED"';
	
	var sql_update_duel2 = 'update duel inner join duel_score using(duel_id) set readystate = "READY" where duel.duel_id = "'+data.duel_id+'" and connected_users = "2" and readystate = "NOT READY" and duel_score.user_id = "'+data.user_id+'"';
	
	db.query(sql_update_duel1);
	
	db.query(sql_update_duel2);
	
	console.log('user-join', data);
	
	io.emit('user-join', data);
		
	
  });



  
  socket.on('disconnect', function(data) {

    console.log('disconnect');
    
    io.emit('user-unjoin', 'Un membre');
	
  });
  
  
  socket.on('get_current_player', function(duel_id) {
	
	var data =  '';
	
	var sql = 'SELECT * FROM duel where duel_id="'+duel_id+'"';
	db.query(sql)
		.on('result', function(duel){
			data = {duel_id:duel_id,current_player_id:duel.current_player_id,compteur_question:duel.compteur_question,connected_users:duel.connected_users,readystate:duel.readystate};	
		})
		.on('end', function(){
			
			console.log('get_current_player',data);
			io.emit('get_current_player', data);
		
		});
	
		
    
  });
  
  
  
    // Check to see if initial query/notes are set
    if (! isInitQuestions) {
        // Initial app start, run db query
        db.query('SELECT * FROM question')
            .on('result', function(data){
                // Push results onto the notes array
                questions.push(data)
            })
            .on('end', function(){
                // Only emit notes after query has been completed
                socket.emit('start', questions)
            })
 
        isInitQuestions = true
    } else {
        // Initial notes already exist, send out
        // socket.emit('initial notes', notes)
    }
	
	
	
	
//SERVER-SIDE SCRIPTS FOR CHAP CHAP

  socket.on('ask-questionChap', function (data) {
    
	console.log('ask-questionChap', JSON.stringify(data));
	
	//vérifier s'il n'a pas épuisé ses 3 question

	//selon l'étape en cours, le nombre de question autorisée varie, donc on en tient compte
	var sql_info_chap = 'select * from chap where chap_id = "'+data.chap_id+'" AND chap_statut = "EN COURS" AND readystate = "READY" ';
	db.query(sql_info_chap)
		.on('result', function(info_chap){

		var chap_etape = info_chap.chap_etape;

		var sql_count_questions_etape_N = 'select cpt_question as nbre_question_posee from chap_score where  chap_id ="'+data.chap_id+'" AND user_id="'+data.to_user_id+'" and chap_etape="'+chap_etape+'"';
		
		var sql_count_questions_etape_1 = 'SELECT count(*) as nbre_question_posee FROM chap_question where chap_id="'+data.chap_id+'" and repondeur_id="'+data.to_user_id+'"';
		
		var sql_count_questions = (chap_etape == 1)? sql_count_questions_etape_1 : sql_count_questions_etape_N;
		var nbre_question_autorisee = (chap_etape == 1)? 1000 : (chap_etape < 4)? 1000 : 1000;

		//console.log('sql_count_questions',sql_count_questions);

		db.query(sql_count_questions)
			.on('result', function(compteur){
				
				
				console.log('nbre_question_posee: ', compteur.nbre_question_posee);
				
				
				if(compteur.nbre_question_posee < nbre_question_autorisee){
					
					console.log('nbre_question_posee < limit :', compteur.nbre_question_posee + " < " + nbre_question_autorisee );

					//vérifier que la question est disponible
					db.query('SELECT * FROM chap_question where chap_id="'+data.chap_id+'" and question_id="'+data.question_id+'"')
					.on('result', function(chap_question){
						
						if(chap_question.statut == "DISPONIBLE"){
							
							//Update current_player_id et le compteur_question
							var update_chap =  'update chap_question set statut = "UTILISE", repondeur_id = "'+ data.to_user_id +'"  WHERE chap_id="'+data.chap_id +'" and question_id="'+data.question_id+'"';
							db.query(update_chap);
							
							io.emit('ask-questionChap', data);

						}else{
							
							io.emit('question-indisponible', data);
							
						}
						
					});
					
				}else{
					
					var sql_score_fin_etape = 'SELECT * FROM chap_score where chap_id="'+data.chap_id+'" and user_id="'+data.to_user_id+'"';
					//console.log('sql_score_fin_etape: ',sql_score_fin_etape);
						
						
					db.query(sql_score_fin_etape)
					.on('result', function(chap_score){
						
						data.score = chap_score.score;
						
						var timer = setInterval(function(){
									
							io.emit('chap_question_end', data);

							console.log('Emit', 'chap_question_end for user#' + JSON.stringify(data));

						},5000);

					});
					
				}
				
			
			
		});
		
	});//fin info_chap
	
  });

	


  socket.on('repondreChap', function (data) {
    

    var res = data;

    //console.log('repondreChap', JSON.stringify(res));

	
	var statut   = '';
	var score    = '';
	var resultatData = '';
	var reponse_correcte = '';
	var reponse_utilisateur = '';
	var message = '';
	var nouveau_score = '';
	
    //vérifier qu'il a le droit de repondre à une question de chap:
    	// il n'a pas repondu à 3 question
    	// 
    //récuperer l'etap du chap
    var sql_info_chap = 'SELECT * FROM chap where chap_id="'+data.chap_id+'" AND chap_statut = "EN COURS" AND readystate = "READY" ';
	  db.query(sql_info_chap)
		.on('result', function(info_chap){
		
		var chap_etape = info_chap.chap_etape;
		//var nombre_participant_etape1 = info_chap.chap_participants;
		
		var nombre_participants = 0;
		var sql_nombre_participant = 'SELECT count(*) as nombre_participants FROM chap_score where chap_id="'+data.chap_id+'" and chap_etape="'+chap_etape+'" ';
		db.query(sql_nombre_participant)
		.on('result', function(cpt_participants){
			
			nombre_participants = cpt_participants.nombre_participants;
			
			//console.log('nombre_participants: ', nombre_participants);

			var sql_selection_score = 'select * from chap_score where  chap_id ="'+data.chap_id+'" AND user_id="'+data.user_id+'" and chap_etape="'+chap_etape+'"';
			var sql_update_score = 'update chap_score set score = score + 100 where chap_id ="'+data.chap_id+'" AND user_id="'+data.user_id+'" and chap_etape="'+chap_etape+'"';
			var sql_update_gain_chap = 'update users set money = money + ' + cout_bonne_reponse_chap + ' where id="'+data.user_id+'" ';
			var sql_update_cpt_question = 'update chap_score set cpt_question = cpt_question + 1 where chap_id ="'+data.chap_id+'" AND user_id="'+data.user_id+'" and chap_etape="'+chap_etape+'"';
			
			db.query(sql_update_cpt_question);
			//console.log('sql_update_cpt_question', JSON.stringify(sql_update_cpt_question));
		
			if(chap_etape > 0){


				//console.log('sql_selection_score: ', JSON.stringify(sql_selection_score));
				//vérifier si l'utilisateur est autoriser à jouer cette etape
				db.query(sql_selection_score)
					.on('result', function(compteur){

					//console.log('sql_selection_score', sql_selection_score);

					var cpt_question = compteur.cpt_question;
					var nbre_question_autorisee = (chap_etape == 1)? 1000 : (chap_etape < 4)? 1000 : 1000;

					var chap_etape_suivante = chap_etape + 1;
					var score_autorise_a_passer = 100 * nbre_question_autorisee;

					//console.log('chap_etape_suivante: ', chap_etape_suivante);
					//console.log('score_autorise_a_passer: ', score_autorise_a_passer);
					//console.log('nbre_question_autorisee: ', nbre_question_autorisee);

					//si max question non atteint
					
					if(cpt_question <= nbre_question_autorisee){


						// Initial app start, run db query
						var sql_question = 'SELECT * FROM question where id="'+data.question_id+'"';
						  db.query(sql_question)
							.on('result', function(question){
								
							    reponse_correcte = question.reponse;
							    reponse_utilisateur = data.reponse;
								
								if(question.reponse == reponse_utilisateur){
									
									statut = 1;
									
									//console.log('sql_update_score', JSON.stringify(sql_update_score));

									//mettre a jour le score et enregistrer la réponse 
									db.query(sql_update_score);

									//mettre a jour le gain 
									db.query(sql_update_gain_chap);

									//enregistrer la réponse du joueur à la question - pour cas de contestation
									db.query('update chap_question set observation="good", reponse="'+reponse_utilisateur+'" where chap_id ="'+data.chap_id+'" AND question_id="'+data.question_id+'"');
									
									
								}else{

									statut = 0;
									
									
									//enregistrer la réponse du joueur à la question - pour cas de contestation
									db.query('update chap_question set observation="bad", reponse="'+reponse_utilisateur+'" where chap_id ="'+data.chap_id+'" AND question_id="'+data.question_id+'"');
									
								}


								//Si'il a atteint la limite de question, notifier le joueur qu'il a répondu à ses questions autorisées pour le niveau en cours
								/*if(cpt_question == nbre_question_autorisee){

									var sql_score_fin_etape = 'SELECT * FROM chap_score where chap_id="'+data.chap_id+'" and user_id="'+data.to_user_id+'"';
									//console.log('sql_score_fin_etape: ',sql_score_fin_etape);
										
									db.query(sql_score_fin_etape)
									.on('result', function(chap_score){
										
										data.score = chap_score.score;
										
										var timer = setTimeout(function(){
									
											io.emit('chap_question_end', data);

											console.log('Emit', 'chap_question_end for user#' + JSON.stringify(data));

										},5000);

									});
									


								}*/


								//Added on 10062019::vérifier si tous les utilisateurs autorisés ont répondu à leurs 3 questions
								//si oui : classer les joueurs et autoriser ceux qui ont obtenu 3/3 à jouer l'étape 2 
								//et faire passer le chap à l'étape 2
								//donner les résultat de chacun
								//console.log('verif_etape', '');
								/*if(info_chap.chap_etape != 4){

									var sql_verif_etape = 'select count(*) as nombre_termine from chap_score where chap_id ="'+data.chap_id+'" and chap_etape="'+chap_etape+'" and cpt_question = "'+ nbre_question_autorisee +'"';
									db.query(sql_verif_etape)
									.on('result', function(verif_etape){
										
										console.log('verif_etape', JSON.stringify(verif_etape.nombre_termine) + " joueurs ont répondu à 3 questions.");

										if(verif_etape.nombre_termine == nombre_participants){

											//mettre à jour l'étape dans le chap (faire passer le chap à l'étape 2)
											db.query('update chap set chap_etape="'+ chap_etape_suivante +'" where chap_id ="'+data.chap_id+'"');
											
											//classer les joueurs et autoriser ceux qui ont obtenu 3/3 à jouer l'étape 2 
											db.query('insert into chap_score (chap_id, chap_etape, cpt_question, user_id, score) select chap_id, "'+ chap_etape_suivante +'", 0, user_id, 0 from chap_score where chap_id ="'+data.chap_id+'" and chap_etape="'+chap_etape+'" and score="'+score_autorise_a_passer+'" ');
										
											//notifier la fin du NIVEAU, mettre les vainqueurs dans le message
											data.chap_etape = chap_etape;

											socket.emit("fin_etape",data);

											console.log('fin_etape',JSON.stringify(data));

										}else{

											console.log('verif_etape', "Certains joueurs n'ont pas encore répondu à "+ nbre_question_autorisee +" questions.");
										
										}

									});

									
								}else{


									*/
									
									//vérifier s'il n'y a plus de question
									var sql_question_restante = 'select count(*) as question_restante from chap_question where statut = "DISPONIBLE" AND chap_id ="'+data.chap_id+'"';
									db.query(sql_question_restante)
									.on('result', function(compteur){
										
										if(compteur.question_restante == 0){

											//mettre à jour l'étape dans le chap (faire passer le chap à l'étape 2)
											db.query('update chap set chap_statut = "TERMINE" where chap_id = "'+data.chap_id+'"');
											
											
											//notifier la fin du NIVEAU, mettre les vainqueurs dans le message
											data.chap_etape = chap_etape;

											socket.emit("fin_etape4",data);

											console.log('fin_etape4',JSON.stringify(data));

										}

									});


									/*
								}
								*/
								
							})
							.on('end', function(){
								
								db.query(sql_selection_score)
								.on('result', function(chap_score){
									nouveau_score = chap_score.score;
								})
								.on('end', function(){
										
									resultatData = {
										statut:statut,
										nouveau_score:nouveau_score,
										reponse_utilisateur:reponse_utilisateur,
										reponse_correcte:reponse_correcte,
										sql_update_score:sql_update_score,
										sql_selection_score:sql_selection_score,
										repondeur_id:data.user_id,
										chap_id:data.chap_id,
										from_user_id:data.from_user_id,
										to_user_id:data.to_user_id,
									};
									
									io.emit('resultatChap', resultatData);

									console.log('Emit', 'resultatChap:' + JSON.stringify(resultatData));
									
								});
								
								
							});

							
							
						}else{ 

							//fin max question non atteint
							
							////Si'il a atteint la limite de question, notifier le joueur qu'il a répondu à ses questions autorisées pour le niveau en cours
							var sql_score_fin_etape = 'SELECT * FROM chap_score where chap_id="'+data.chap_id+'" and user_id="'+data.to_user_id+'"';
							//console.log('sql_score_fin_etape: ',sql_score_fin_etape);
								
							db.query(sql_score_fin_etape)
							.on('result', function(chap_score){
								
								data.score = chap_score.score;
								
								var timer = setInterval(function(){
									
									io.emit('chap_question_end', data);

									console.log('Emit', 'chap_question_end for user#' + JSON.stringify(data));

								},5000);

								clearInterval(timer);

							});
			
						
						}	//fin max question non atteint

						

					  });

					
				}else{
					//chap_etape innexistant
				}
			  	

			  });
			  /*.on('end', function(){
				
				console.log("Erreur: ","Chap innexistant"+sql_info_chap);
			  
			  });*///fin recup recup_info_chap_result_user
			  
		});//fin recup nombre participants


	  });//fin recup etap_chap
	  



	socket.on('demarer-chap',function(data){

		var sql_chap_selection = 'select * from chap where chap_id = "'+data.chap_id+'" ';
		db.query(sql_chap_selection)
		.on('result', function(chap){
			//
			db.query('update chap set readystate = "READY" where chap_id = "'+data.chap_id+'"');
			
			socket.emit("chapReady",data);

			console.log('chapReady',JSON.stringify(data));

		});

	});



	//MESSAGERIE INSTANTANEE
	socket.on('send-message',function(data){
		
		datetime_actuel = getCurrentDateTime();

		var sql_insert_msg = 'insert into message (`from_user_id`, `to_user_id`, `message_message`, `message_date`) VALUES("'+data.from_user_id+'", "'+data.to_user_id+'", "'+data.message+'" , "'+datetime_actuel+'" )';

		db.query(sql_insert_msg);
		
		socket.emit("received-message",data);

		console.log('received-message',data);


	});

	
	function pad(n) {
		return n<10 ? '0'+n : n;
	}
	
	function getCurrentDateTime(){
		
		var today = new Date();
		var date = today.getFullYear()+'-'+pad(today.getMonth()+1)+'-'+pad(today.getDate());
		var time = pad(today.getHours()) + ":" + pad(today.getMinutes()) + ":" + pad(today.getSeconds());
		
		var dateTime = date+' '+time;
		
		return dateTime;
	}

});







//LANCER LE SERVEUR SUR LE PORT 7070
server.listen(3000, function () {

  console.log('krak server listen at 3000');
  
});

