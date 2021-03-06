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
.controller('SidebarPageCtrl',
[
'$scope', '$location',
function($scope, $location) {
	var headers = $(".panel-body h3" );

	if ( headers.length <= 1 ) {
		// Nothing to partition
		return;
	}

	$scope.choices = [];

	var checkExisting = function( name ) {
		if ( $scope.choices.length == 0 ) return false;

		for ( var i=0; i<$scope.choices.length; i++ ) {
			if ( $scope.choices[i].id == name ) return true;
		}

		return false;
	};

	angular.forEach(headers, function(value, key){
		var heading = value.html();

		var element = {
			id: encodeURIComponent(heading),
			title: heading
		};

		if ( !checkExisting(element.id) ) {
			$scope.choices.push(element);
		}

		var content = value.nextUntil("h1").andSelf();

		content.wrapAll(
			'<div ng-class="{\''
				+ ( $scope.multi ? 'am-slide-top' : 'am-slide-top-fast' )
				+ '\': isDeselected(\''
				+ element.id
				+ '\')}" />'
		);
	});

	$scope.id = $location.hash();

	$scope.multi = false;

	$scope.change = function( name ) {
		if ( $scope.id === name && $scope.multi ) {
			$scope.id = '';
		} else if ( $scope.id === name ) {
			return;
		} else {
			$scope.id = name;
		}

		$location.hash($scope.id);
	};

	$scope.isDeselected = function ( name ) {
		return $scope.id !== name && $scope.id != '';
	};

	$scope.isSelected = function ( name ) {
		return $scope.id === name;
	};
}
]
);

eassApp
.controller('ContactCtrl',
[
'$scope',
function($scope) {
	$scope.id = '';

	$scope.lines = function () {
		angular.element("hr.am-fade").hide();

		angular.element(".kontakt-container:visible:nth-child(2n)").next("hr" ).show();
	};

	$scope.change = function ( name ) {
		if ( $scope.id === name ) {
			$scope.id = '';
		} else {
			$scope.id = name;
		}
	};

	$scope.isDeselected = function ( name ) {
		return $scope.id !== name && $scope.id != '';
	};

	$scope.isSelected = function ( name ) {
		return $scope.id === name;
	};

	angular.element(".kontakt-container").after("<hr class=\"am-fade\"/>");
}
]
);

eassApp
	.controller('TjenesterCtrl',
		[
			'$scope',
			function($scope) {
				$scope.id = 'renhold';

				$scope.change = function( name ) {
					$scope.id = name;
				};

				$scope.isDeselected = function ( name ) {
					return $scope.id !== name && $scope.id != '';
				};

				$scope.isSelected = function ( name ) {
					return $scope.id === name;
				};
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
