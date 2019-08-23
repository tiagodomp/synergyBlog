var app = angular.module('blog', [])

app.controller('PostsController', function ($scope) {
	var socket = io();
	var data = this;
	data.post = {};
	data.posts = [];

	data.enviar = enviar;

	init();

	function init() {
		socket.on('posts', function (posts) {
			data.posts = posts;
			$scope.$apply();
		});
		socket.on('post', function (post) {
			var encontrou = false;
			for (var x = 0; x < data.posts.length && !encontrou; x++) {
				if (data.posts[x].stamp === post.stamp) {
					data.posts[x] = post;
					encontrou = true;
				}
				if (!encontrou) {
					data.pedidos.push(pedido);
				}
				$scope.$apply();
			}
		});
	}
	function enviar() {
		socket.emit('post.salvar', data.post);
		data.post = '';
	}
});