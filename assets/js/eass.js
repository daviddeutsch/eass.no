var eassApp = angular.module(
	"eassApp",
	[
		'ngAnimate'
	]
);

eassApp
.controller('HomeImgCtrl',
[
'$scope',
function($scope) {
	$scope.id = '';

	$scope.$watch('id', function(newVal, oldVal) {
		if (newVal === oldVal) return;

		$scope.left = newVal + '-left.jpg';
		$scope.middle = newVal + '-middle.jpg';
		$scope.right = newVal + '-right.jpg';
	});

	$scope.change = function( id ) {
		if (id === $scope.id) return;

		$scope.id = id;
	};

	$scope.reset = function() {
		$scope.left = 'renhold-left.jpg';
		$scope.middle = 'kantine-middle.jpg';
		$scope.right = 'vaktmesterservice-right.jpg';
	};

	$scope.reset();
}
]
);

eassApp
.directive('loadingFx', function() {
return {
	restrict: 'A',
	scope: {
		ngSrc: '@'
	},

	link: function(scope, element) {
		element.on('load', function() {
			element.addClass('in');
		});
		scope.$watch('ngSrc', function(newVal) {
			element.removeClass('in');
		});
	}
};
});
