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
function($scope, $timeout)
{
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
'$scope', '$location', '$compile',
function($scope, $location, $compile)
{
	var headers = angular.element(".panel-body h3" );

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

	var i = 0;

	angular.forEach(headers, function(value, key){
		i++;

		var element = {
			id: angular.element(value).html().toLowerCase().replace(/[^a-z0-9]/gi,''),
			title: angular.element(value).html()
		};

		if ( !checkExisting(element.id) ) {
			$scope.choices.push(element);
		}

		var content = angular.element(value).nextUntil("h3").andSelf();

		var newhtml = '';

		var replace;

		for ( var j=0; j<content.length; j++ ) {
			newhtml += angular.element(content[j]).clone().wrap('<p>').parent().html();

			if ( j < content.length-1 ) {
				angular.element(content[j]).remove();

				delete content[j];
			} else {
				replace = content[j];
			}
		}

		newhtml = newhtml.replace('<br><br>', '<br>');

		angular.element(replace).replaceWith(
			$compile(
				'<div id="container-' + i + '"'
				+ ' ng-class="{\'am-slide-top-fast\': isDeselected(\''
				+ element.id
				+ '\')}">'
				+ newhtml
				+ '</div>'
			)($scope)
		);
	});

	$scope.change = function( name ) {
		if ( $scope.id === name ) {
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

	$scope.id = $location.hash();

	if ( $scope.id == '' ) {
		$scope.change( $scope.choices[0].id );
	}
}
]
);

eassApp
.controller('SidebarPageListCtrl',
[
'$scope', '$location', '$compile', '$timeout',
function($scope, $location, $compile, $timeout)
{
	var list = angular.element(".panel-body ul li");

	if ( list.length <= 1 ) {
		// Nothing to partition
		return;
	}

	var headers = angular.element(".panel-body h4" );

	if ( headers.length <= 1 ) {
		// Nothing to partition
		return;
	}

	$scope.choices = [];

	angular.forEach(list, function(value, key) {
		$scope.choices.push(
			{
				id: angular.element(value).html().toLowerCase().replace(/[^a-z0-9]/gi,''),
				title: angular.element(value).html()
			}
		);
	});

	angular.element(".panel-body ul" ).remove();

	var i = 0;
	angular.forEach(headers, function(value, key) {
		i++;

		var element = {
			id: angular.element(value).html().toLowerCase().replace(/[^a-z0-9]/gi,''),
			title: angular.element(value).html()
		};

		var content = angular.element(value).nextUntil("h4").andSelf();

		var newhtml = '';

		var id;

		var replace;

		var name = '';

		var inner = '';

		for ( var j=0; j<content.length; j++ ) {
			var el = angular.element(content[j]);

			inner = el.clone().wrap('<p>').parent().html();

			if ( name == '' ) {
				elname = el.html().toLowerCase().replace(/[^a-z0-9]/gi,'');

				angular.forEach($scope.choices, function(value, key) {
					if ( elname == value.id ) {
						name = value.id;

						if ( el.context.localName != 'h4' ) {
							inner = '';
						}
					}
				});
			}

			newhtml += inner;

			if ( j < content.length-1 ) {
				angular.element(content[j]).remove();

				delete content[j];
			} else {
				replace = content[j];
			}
		}

		newhtml = newhtml.split('<br><br>').join('<br>');

		angular.element(replace).replaceWith(
			$compile(
				'<div id="container-' + i + '"'
					+ ' ng-class="{\'am-slide-top\': isDeselected(\''
					+ name
					+ '\')}"'
					+ ' class="col-md-6 kontakt-container"'
					+ '>'
					+ newhtml
					+ '</div>'
				+ '<hr class="fullwidth am-fade-full"/>'
			)($scope)
		);
	});

	$scope.lines = function () {
		var el = angular.element('.kontakt-container:not(.am-slide-top):odd')
			.next('hr');

		el.addClass('ng-enter');

		$timeout(function(){
			el.addClass('ng-enter-active');
		}, 100);
	};

	$scope.change = function( name ) {
		angular.element('hr.fullwidth' ).removeClass('ng-enter ng-enter-active').addClass('ng-leave');

		if ( $scope.id === name ) {
			$scope.id = '';
		} else {
			$scope.id = name;
		}

		$location.hash($scope.id);

		$timeout($scope.lines, 100);
	};

	$scope.isDeselected = function ( name ) {
		return $scope.id !== name && $scope.id != '';
	};

	$scope.isSelected = function ( name ) {
		return $scope.id === name;
	};

	$scope.id = $location.hash();

	$timeout($scope.lines, 100);
}
]
);

eassApp
.controller('ContactCtrl',
[
'$scope',
function($scope) {
	$scope.id = '';

	$scope.change = function( name ) {
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
}
]
);
