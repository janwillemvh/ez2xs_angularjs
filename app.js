// Initialize angularjs app.
var ez2xsApp = angular.module('ez2xsApp', []);

ez2xsApp.controller('ez2xsController', ['$scope', 'jsonService', function($scope, jsonService) {
    jsonService.async('http://localhost/custom/getAddresses.php')
        .then(function(response) {
            $scope.addresses = response;
        });
}]);

// Custom directive for address list display.
ez2xsApp.directive("addressList", function() {
    return {
        restrict: 'E',
        templateUrl: 'directives/addressList.html',
        replace: true
    }
});

// Custom service to fetch JSON data. 
ez2xsApp.service('jsonService', function($http) {
    var jsonService = {
        async: function(url) {
            // $http returns a promise, which has a then function, which also returns a promise.
            var promise = $http({url: url, method: 'GET', headers: {Authorization: 'Bearer TOKEN123456789'}})
                .then(function (response) {
                    // The return value gets picked up by the then in the controller.
                    return response.data;
                });
            // Return the promise to the controller.
            return promise;
        }
    };
    return jsonService;
});
