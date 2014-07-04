var eassApp = angular.module(
	"eassApp",
	[
		'ngAnimate'
	]
);

eassApp
.controller('HomeImgCtrl',
[
'$scope', '$timeout',
function($scope, $timeout) {
	$scope.slides = [
		{name: 'renhold'},
		{name: 'kantine'},
		{name: 'vaktmesterservice'}
	];

	$scope.id = 1;

	$scope.to = null;

	$scope.change = function( id ) {
		$scope.id = id;

		$timeout.cancel($scope.to);
	};

	$scope.isCurrent = function (index) {
		return $scope.id === index;
	};

	$scope.reset = function() {
		$scope.to = $timeout($scope.tick, 2000);
	};

	$scope.tick = function () {
		if ( $scope.id == 2 ) {
			$scope.id = 0;
		} else {
			$scope.id++;
		}

		$scope.to = $timeout($scope.tick, 2000);
	};

	$scope.tick();
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
