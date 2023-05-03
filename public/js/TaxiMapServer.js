var express = require('express')();
var server 	= require('http').Server(express);
var io 		= require('socket.io')(server);
var mysql 	= require('mysql');



var db = mysql.createConnection({
    host : 'localhost',
    user : 'root',
    password : '',
    database : 'perception_db'
});


// Log any errors connected to the db
db.connect(function(err){
    if (err) console.log(err)
});
 

// Define/initialize our global vars

var timerInnactivite = 0;

io.on('connection', function (socket) {
  
	console.log("New client connected");
	
  
	//
	socket.on('send-position',function(data){
		
		socket.emit("send-position",data);
		
		console.log('send-position',JSON.stringify(data));
		
		// datetime_actuel = getCurrentDateTime();
		
		// var sql_insert = 'insert into position (`trajet_id`, `position_latitude`, `position_longitude`, position_date_creation) VALUES("'+data.trajet_id+'", "'+data.latitude+'", "'+data.longitude+'" , "'+data.datetime_actuel+'" )';
		
		// db.query(sql_insert);
		
	});

	
	//
	socket.on('user-join', function(data) {

		console.log('user-join', data);

		io.emit('user-join', data);		

	});
	
	
	//
	socket.on('disconnect', function(data) {

		console.log('disconnect');

		io.emit('user-unjoin', 'Un membre');

	});

	
	//
	function pad(n) {
		return n<10 ? '0'+n : n;
	}
	
	//
	function getCurrentDateTime(){
		
		var today = new Date();
		var date = today.getFullYear()+'-'+pad(today.getMonth()+1)+'-'+pad(today.getDate());
		var time = pad(today.getHours()) + ":" + pad(today.getMinutes()) + ":" + pad(today.getSeconds());
		
		var dateTime = date+' '+time;
		
		return dateTime;
		
	}


});







//LANCER LE SERVEUR SUR LE PORT 4000
server.listen(4000, function () {

  console.log('TaxiMap server listen at 4000');
  
});
