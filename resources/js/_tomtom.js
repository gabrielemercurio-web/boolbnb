import tt from '@tomtom-international/web-sdk-maps';
import tts from '@tomtom-international/web-sdk-services';
// import sb from '@tomtom-international/web-sdk-plugin-searchbox';
// import { use } from 'vue/types/umd';
const Handlebars = require("handlebars");

const OWN_HOUSES_API_URL = 'http://localhost:8000/api/houses';

/* * * DRAW MAP IN SHOW VIEW * * */

/** check whether there's supposed to be a map in the page so as not to call
 * the function everywhere */
if ($('#map').length) {
	drawTomTomMap();
}

/* draw map from stored coordinates */
function drawTomTomMap() {
	//grab coordinates from view
	let long = $('#my-maps').attr('data-longitude');
	let lat = $('#my-maps').attr('data-latitude');
	
	//make it so tomtom can read them
	let myCoordinates = [long, lat];

	//draw a map centered on the given coordinates
	let map = tt.map({
		container: 'map',
		key: process.env.MIX_TOMTOM_API_KEY,
		style: 'tomtom://vector/1/basic-main',
		center: myCoordinates,
		zoom: 15
	});

	//add marker at the given coordinates
	let marker = new tt.Marker().setLngLat(myCoordinates).addTo(map);
}


/* * * ADDRESS SEARCH FUNCTIONALITIES * * */

/** in search views, if redirected from homepage: grab input and start search */
if ($('.searchbars').length && $('.searchbars').attr('data-search-source') == 'guest-homepage' ||
	$('.searchbars').length && $('.searchbars').attr('data-search-source') == 'upr-homepage') {
	console.log('data-search-source: ', $('.searchbars').attr('data-search-source'));
	//grab and execute the query that was inputed in the homepage
	let query = $('.searchbars').attr('data-user-query');
	console.log('SP guest query: ', query);
	callTomTomSearch(query);
}

/* in search views - on click on search icon, start new search */
//TODO: add search via enter key - it's already there somehow?
$('.search-btn').on('click', function() {
	let query = $('.searchbars').val();
	console.log('SP query', query); //FIXME: change when the actual view is ready
	callTomTomSearch(query);
});

/* call tomtom API to get address coordinates */
function callTomTomSearch(query) {
	tts.services.fuzzySearch({
	key: process.env.MIX_TOMTOM_API_KEY,
	query: query,
	})
	.go()
	.then(handleResults);
}

/* manage tomtom api response: grab the coordinates of the provided address */
function handleResults(result) {
	console.log('handleResults argument: ', result);
	if (result) {
		/* get latitude and longitude */
		let longitude = result.results[0].position.lng;
		let latitude = result.results[0].position.lat;
		/* store them in data attributes for later use*/
		$('.searchbars').attr('data-coordinates-long', longitude);
		$('.searchbars').attr('data-coordinates-lat', latitude);
		/* start ajax call*/
		getFiltersValues()
	}
};

/* on click on 'update filters' button, get the values of the filter inputs*/
$('.search-update-btn').on('click', function() {
	getFiltersValues()
})

/* get the value of all filter inputs and combine them in a query string*/
function getFiltersValues() {
	/* create reference object to store query string parameters*/
	let queryStringObject = {};
	/* get all the values from the filters */
	queryStringObject.longitude = $('.searchbars').attr('data-coordinates-long');
	queryStringObject.latitude = $('.searchbars').attr('data-coordinates-lat');
	/* only add optional filters if requested by the user */
	//TODO: figure out whether we need to make these deletable from the query string, too
	if ($('#filter-rooms').val() != '') {
		queryStringObject.rooms = $('#filter-rooms').val();
	}
	if ($('#filter-beds').val() != '') {
		queryStringObject.beds = $('#filter-beds').val();
	}
	if ($('#filter-distance').val() != '') {
		queryStringObject.distance = $('#filter-distance').val();
	}
	/* build string of services in '1,2,3' format*/
	queryStringObject['services'] = '';
	$.each($("input[name='services']:checked"), function(){
		queryStringObject['services'] += $(this).val() + ',';
	});
	/* only pass the services key if at least one service is flagged */
	if(queryStringObject.services.length == ''){
		delete queryStringObject['services'];
	}
	// console.log('services ajax: ', queryStringObject['services']);
	let queryString = '?' + $.param(queryStringObject);
	// console.log('query obj: ', queryStringObject);
	// console.log('query str', queryString);
	callFiltering(queryString)
}


function callFiltering(query) {
	console.log('callFiltering was called!');
	$.ajax({
		'url': OWN_HOUSES_API_URL + query,
		'method': 'GET',
		'traditional': true,
		'success': function(data) {
			console.log('ajax success data: ', data);
			$('.handle-house-card').remove();
			if (data != '[]') {
				// console.log('data', data.data);
				// console.log('id', data.id);
				let previousID = 0;
				for (let i = 0; i < data.data.length; i++) {
					// console.log('data length', data.data.length);
					const house = data.data[i];
						
					/** HANDLEBARS */
					var source = $('.house-card-template').html();
					var template = Handlebars.compile(source);
					var context = {
						image: house.image_path,
						route: 'http://localhost:8000/houses/' + house.id,
						title: house.title, 
						description: house.description,
						distance: house.distance,
						id: house.id,
					};
					var html = template(context);
					$('.houses-grid-results').append(html);
				}
			} else {
				//WRITE STH LIKE 'NO MATCHES FOR UR SRCH' IN PAGE
			};
		},
			'error': function(e) {
				console.log('error? ', e);
				console.log('callFiltering ajax: something went wrong');
		}
	})
}

/* TOMTOM AUTOCOMPLETE THROUGH SEARCHBOX PLUGIN*/

// function tomtomAutocomplete() {
//     let acSearchBox = new sb(tts.services, {
//         minNumberOfCharacters: 2,
//         labels: {
//             placeholder: "Search"
// 		},
// 		searchOptions: {
// 			key: process.env.MIX_TOMTOM_API_KEY,
// 			language: 'en-US'
// 		},
// 		autocompleteOptions: {
// 			key: process.env.MIX_TOMTOM_API_KEY,
// 			language: 'en-US'
// 		},
//         noResultsMessage: "No results found.",
//     });

//     // acSearchBox.on("tomtom.searchbox.resultselected", onSearchBoxResult);
//     document.getElementById("search-panel").append(acSearchBox.getSearchBoxHTML());
// }

// /** FIRST AJAX ATTEMPT, DISTANCE & SORTING DONE IN JS */
// function callHousesAPI(fromCoordinates, radius, query) {
// 	$.ajax({
// 		'url': OWN_HOUSES_API_URL + query,
// 		'method': 'GET',
// 		'data': {
// 			'rooms': '3',
// 			'beds': '2',
// 			'services': '1,6',
// 		},
// 		'success': function(data) {
// 			if (data != '[]') {
// 				console.log('data', data);
// 				// console.log('id', data.id);
// 				let previousID = 0;
// 				for (let i = 0; i < data.data.length; i++) {
// 					const house = data.data[i];
// 					/** make sure you only grab each house once */
// 					let currentID = house.id;
// 					if (currentID != previousID) {
// 						previousID = currentID;
// 						/** grab coordinates and make them readable for turf.js, then feed them to it */
// 						let longitude = house.longitude;
// 						let latitude = house.latitude;
// 						// console.log('long', house.longitude);
// 						// console.log('lat', house.latitude);
// 						let currentCoordinates = [longitude, latitude];
// 						let currentDistance = get2PointsDistance(fromCoordinates, currentCoordinates);
// 						console.log('distance: ', currentDistance);
// 						/** if the current house is within the requested distance, sort houses by distance from starting point */
// 						if (currentDistance < radius ?? 20) {
// 							console.log('visible house: ', house.id);
// 							house.distance = currentDistance;
// 							var sortedData = data.data.sort(compare);
// 							console.log(data.data);
// 						}
// 					}
// 				}
// 				/** once sorted, make sure you only grab the same house once, then print in page through handlebars */
// 				let previousSortedID = 0;
// 				for (let i = 0; i < sortedData.length; i++) {
// 					const sortedHouse = sortedData[i];
// 					let currentSortedID = sortedHouse.id;
// 					if (currentSortedID != previousSortedID) {
// 						previousSortedID = currentSortedID;
					
// 					var source = $('.house-card').html();
// 					var template = Handlebars.compile(source);
// 					var context = {
// 						image: sortedHouse.image_path,
// 						route: 'http://localhost:8000/houses/' + sortedHouse.id,
// 						title: sortedHouse.title, 
// 						description: sortedHouse.description,
// 						distance: sortedHouse.distance,
// 						id: sortedHouse.id,
// 					};
// 					var html = template(context);
// 					$('.houses-grid-results').append(html);
// 					}
// 				}
// 			} else {
// 				//WRITE STH LIKE 'NO MATCHES FOR UR SRCH' IN PAGE
// 			};
		
// 		},
// 		'error': function() {
// 			console.log('something went wrong');
// 		}

// 	})
// }

// /** TURF.JS FOR GETTING DISTANCE BETWEEN 2 SETS OF COORDINATES IN JS */
// /* use turf.js to get the distance between two sets of coordinates */
// function get2PointsDistance(fromCoordinates, toCoordinates) {
// 	let from = turf.point(fromCoordinates);
// 	let to = turf.point(toCoordinates);
// 	let options = {units: 'kilometers'};

// 	let distance = turf.distance(from, to, options);
// 	console.log('turf distance', distance);
// 	return distance;
// }

// 
//  /** OBJECT SORTING FUNCTION */
//  function compare( a, b ) {
// 	if ( a.distance < b.distance ){
// 	  	return -1;
// 	}
// 	if ( a.distance > b.distance ){
// 	 	return 1;
// 	}
// 	return 0;
// };


// /** QUERY STRING BUILDER REFERENCE - CAN'T USE THIS!! */
// var queryStringObject = {};
// $(".getfilter").on('click', function(){
// 	var name = $(this).attr('name');
// 	queryStringObject[name] = [];
// 	$.each($("input[name='"+$(this).attr('name')+"']:checked"), function(){
// 		queryStringObject[name].push($(this).val());
// 	});
// 	if(queryStringObject[name].length == 0){
// 		delete queryStringObject[name];
// 	}
// 	var queryString = "";
// 	for (var key in queryStringObject) {
// 		if(queryString==''){
// 			queryString +="?"+key+"=";
// 		} else {
// 			queryString +="&"+key+"=";
// 		}
// 		var queryValue = "";
// 		for (var i in queryStringObject[key]) {
// 			if(queryValue==''){
// 				queryValue += queryStringObject[key][i];
// 			} else {
// 				queryValue += "~"+queryStringObject[key][i];
// 			}
// 		}
// 		queryString += queryValue;
// 	}
// 	console.log(queryStringObject);
// 	console.log(queryString);
// 	if (history.pushState) {
// 		var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + queryString;
// 		window.history.pushState({path:newurl},'',newurl);
// 	}
// });
  
// /**QUERY STRING BUILDER ATTEMPT 1 */
// /** on change
//  * prendo le coordinate dall'input nascosto
//  * le passo a callHousesAPI
//  * prendere l'input cambiato
//  * metterlo come chiave/valore in un oggetto
//  * far girare .param per costruire la query
//  */
// let filterQueryObj = {}
// $('.search-filters').on('change', function(e) {
// 	let coordinates = $('#guest-search').attr('data-coordinates-from').split(',');
// 	if ($(this).hasClass('checked')) {
// 		$(this).removeClass('checked');
// 		delete filterQueryObj[e.target.name];
// 		console.log('query DEL obj: ', filterQueryObj);
// 		let queryString = '?' + $.param(filterQueryObj);
// 		console.log('query -', queryString);
// 		callHousesAPI(coordinates, '10000', queryString);
// 	} else {
// 		$(this).addClass('checked');
// 		console.log('changed!', e.target);
// 		// let newFilter = e.target.name;
// 		// console.log('new filter: ', newFilter);
// 		filterQueryObj[e.target.name] = 'on';
// 		console.log('query ADD obj: ', filterQueryObj);
// 		let queryString = '?' + $.param(filterQueryObj);
// 		console.log('query +', queryString);
// 		callHousesAPI(coordinates, '10000', queryString);
// 	}
// 	})

 