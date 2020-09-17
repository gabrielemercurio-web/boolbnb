import tt from '@tomtom-international/web-sdk-maps';
import tts from '@tomtom-international/web-sdk-services';
import sb from '@tomtom-international/web-sdk-plugin-searchbox';
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
    let acSearchBox = new sb(tts.services, {
        minNumberOfCharacters: 2,
        labels: {
            placeholder: "Search"
		},
		searchOptions: {
			key: process.env.MIX_TOMTOM_API_KEY,
			language: 'en-US'
		},
		autocompleteOptions: {
			key: process.env.MIX_TOMTOM_API_KEY,
			language: 'en-US'
		},
        noResultsMessage: "No results found.",
	});

	acSearchBox.on('tomtom.searchbox.resultselected', function(data) {
		console.log(data);
		let longitude = data.data.result.position.lng;
		let latitude = data.data.result.position.lat;
		let address = data.data.text;
		$('input[name=longitude]').attr('value', longitude);
		$('input[name=latitude]').attr('value', latitude);
		$('input[name=address]').attr('value', address);
	});
    $(".house-autosearch").append(acSearchBox.getSearchBoxHTML());
// }