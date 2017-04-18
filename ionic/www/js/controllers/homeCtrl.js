angular.module('starter.controllers')
    .controller('HomeCtrl', ['$scope', '$cookies', '$http', function ($scope, $cookies, $http) {
        $scope.user = {};

        var getAccessToken = function () {
            var token = $cookies.get('token');
            token = JSON.parse(token);

            return token.access_token;
        };

        var getAuthenticatedUser = function () {
            var url = 'http://localhost:8000/api/authenticated';

            $http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + getAccessToken()
                }
            }).then(function (response) {
                $scope.user = response.data.data;
            }, function () {
                console.log("Não foi possível obter os dados do usuário logado.");
            });
        };

        getAuthenticatedUser();
    }]);