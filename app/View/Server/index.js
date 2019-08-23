const SERVER_PORT = 8081;

// const crypto = require('crypto');
// const algorithm = 'aes-256-cbc';
//var server = require('http')
var io = require('socket.io')(SERVER_PORT);
var Redis = require('ioredis');
var ioredis = require('socket.io-redis');
var Mysql = require('mysql');
var env = require('./env');

var connection = 'redis://:' + env.redis.pass + '@' + env.redis.host + ':' + env.redis.port + '/' + env.redis.db;

var redis = new Redis(connection); //url.redis);
console.log('Redis: ' + redis.status);

//redis.set('abc654', 'tiago');
const mysql = Mysql.createConnection({
    host: env.DB.host,
    port: env.DB.port,
    user: env.DB.user,
    password: env.DB.pass,
    database: env.DB.db
});

mysql.connect(function(err) {
    if (err) return console.log(err);
    console.log('mysql: connected');
})

// redis.get('abc654', function (error, result) {
// 	if (error) {
//         console.log(error);
//         throw error;
//     }
//     console.log('GET result -> ' + result);
// });

//Recebe do cakephp2.x através do Pub/Sub Redis e envia para o front via socket.io
redis.on('message', function(channel, message) {
    if (channel == 'notificacoes') {
        var data = JSON.parse(message);
		// gerar lógica para enviar via socket.io-client para a view
		io.on('connection', (socket) => {
			if (data.toRoom) {
				socket.to(data.toRoom).emit(data.event, data.url, data.body);
			}
			socket.broadcast.emit(data.event, data.url, data.body);
		});
	}

	if (channel == 'processos') {
		var data = JSON.parse(message);
		//identificar e exceutar o processo e enviar via socket.io-client para a view

		redis.get(data.path, function (error, result) {
			if (error) {
				console.log(error);
				throw error;
			}
			io.on('connection', (socket) => {
				if (data.toRoom) {
					socket.to(data.toRoom).emit(data.event, data.action, result);
				}
				socket.broadcast.emit(data.event, data.action, result);
			});
		}
	}
});

redis.subscribe('notificacoes', 'processos');