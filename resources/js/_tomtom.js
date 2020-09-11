import tt from '@tomtom-international/web-sdk-maps';
import tts from '@tomtom-international/web-sdk-services';
// import sb from '@tomtom-international/web-sdk-plugin-searchbox';
// import { use } from 'vue/types/umd';
const Handlebars = require("handlebars");
const template = Handlebars.compile("Name: {{name}}");
// console.log(template({ name: "Nils" }));

const OWN_HOUSES_API_URL = 'http://localhost:8000/api/houses';

/* * * SHOW MAP * * */
// check whether there's a map in the page so as not to call the function everywhere
if ($('#map').length) {
	drawTomTomMap();
}
/* draw map from given coordinates */
function drawTomTomMap() {
	//grab coordinates from view
	let long = $('#my-maps').attr('data-longitude');
	let lat = $('#my-maps').attr('data-latitude');

	//make it so tomtom can read them
	let myCoordinates = [long, lat];

	//grab a map centered on the given coordinates
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


/* tomtom autocomplete through searchbox plugin*/
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


/** search page, search for input from homepage */
if ($('#guest-search').length) {
	let query = $('#guest-search').attr('data-user-query');
	console.log('SP query: ', query);
	callTomTomSearch(query);
}

/* search page - on click on search, get data from tomtom */
//TODO: add search via enter key
$('#guest-search-btn').on('click', function() {
	let query = $('.searchbars').val();
	console.log('HP query', query); //FIXME: change when the actual view is ready
	callTomTomSearch(query);
});

/* call on tomtom API */
function callTomTomSearch(query) {
	tts.services.fuzzySearch({
	key: process.env.MIX_TOMTOM_API_KEY,
	query: query,
	})
	.go()
	.then(handleResults);
}

/* grab starting coordinates */
function handleResults(result) {
	console.log(result);
	if (result) {
		//get latitude and longitude from the results and combine them to be passed on
		let longitude = result.results[0].position.lng;
		let latitude = result.results[0].position.lat;
		let startingCoordinates = [longitude, latitude];
		$('#guest-search').attr('data-coordinates-from', startingCoordinates);
		let radius = 15000;
		;
		//get all houses within a certain radius
		callHousesAPI(startingCoordinates, radius, '');	
	}
};

/* call the internal API that returns a list of houses */
function callHousesAPI(fromCoordinates, radius, query) {
	$.ajax({
		'url': OWN_HOUSES_API_URL + query,
		'method': 'GET',
		'success': function(data) {
			if (data != '[]') {
				console.log('data', data);
				// console.log('id', data.id);
				let previousID = 0;
				let distanceRef = 0;
				for (let i = 0; i < data.data.length; i++) {
					const house = data.data[i];
					let currentID = house.id;
					if (currentID != previousID) {
						previousID = currentID;
						let longitude = house.longitude;
						let latitude = house.latitude;
						
						// console.log('long', house.longitude);
						// console.log('lat', house.latitude);
						let currentCoordinates = [longitude, latitude];
						let currentDistance = get2PointsDistance(fromCoordinates, currentCoordinates);
						console.log('distance: ', currentDistance);
						if (currentDistance < radius ?? 20) {
							console.log('visible house: ', house.id);
							house.distance = currentDistance;

							var sortedData = data.data.sort(compare);
							console.log(data.data);
						}
					}
				}

				let previousSortedID = 0;
				for (let i = 0; i < sortedData.length; i++) {
					
					const sortedHouse = sortedData[i];
					let currentSortedID = sortedHouse.id;
					if (currentSortedID != previousSortedID) {
						previousSortedID = currentSortedID;
					
					var source = $("#house-card").html();
					var template = Handlebars.compile(source);

					var context = {
						image: sortedHouse.image_path,
						route: "http://localhost:8000/houses/" + sortedHouse.id,
						title: sortedHouse.title, 
						description: sortedHouse.description,
						distance: sortedHouse.distance
					};

					var html = template(context);
					$('.houses-grid-results').append(html);
				}
			}
		} else {
			//WRITE STH LIKE 'NO MATCHES FOR UR SRCH' IN PAGE
		};
		
	},
		'error': function() {
			console.log('something went wrong');
		}

	})
}

/* use turf.js to get the distance between two sets of coordinates */
function get2PointsDistance(fromCoordinates, toCoordinates) {
let from = turf.point(fromCoordinates);
let to = turf.point(toCoordinates);
let options = {units: 'kilometers'};

let distance = turf.distance(from, to, options);
console.log('turf distance', distance);
return distance;
}

/** on change
 * prendo le coordinate dall'input nascosto
 * le passo a callHousesAPI
 * prendere l'input cambiato
 * metterlo come chiave/valore in un oggetto
 * far girare .param per costruire la query
 */
let filterQueryObj = {}

 $('.search-filters').on('change', function(e) {
	let coordinates = $('#guest-search').attr('data-coordinates-from').split(',');
	if ($(this).hasClass('checked')) {
		$(this).removeClass('checked');
		delete filterQueryObj[e.target.name];
		console.log('query DEL obj: ', filterQueryObj);
		let queryString = '?' + $.param(filterQueryObj);
		console.log('query -', queryString);
		callHousesAPI(coordinates, '10000', queryString);
	} else {
		$(this).addClass('checked');
		console.log('changed!', e.target);
		// let newFilter = e.target.name;
		// console.log('new filter: ', newFilter);
		filterQueryObj[e.target.name] = 'on';
		console.log('query ADD obj: ', filterQueryObj);
		let queryString = '?' + $.param(filterQueryObj);
		console.log('query +', queryString);
		callHousesAPI(coordinates, '10000', queryString);
	}
 })

 /** sort houses to find the nearest */
 function compare( a, b ) {
	if ( a.distance < b.distance ){
	  return -1;
	}
	if ( a.distance > b.distance ){
	  return 1;
	}
	return 0;
  }
  
 