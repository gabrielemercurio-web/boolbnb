import tt from '@tomtom-international/web-sdk-maps'
import tts from '@tomtom-international/web-sdk-services'

/* * * Show map in house details page * * */

// check whether there's a map in the page so as not to call the function everywhere
if ($('#map').length) {
	drawTomTomMap();
}

function drawTomTomMap() {
	let long = $('#my-maps').attr('data-longitude');
	let lat = $('#my-maps').attr('data-latitude');

	let myCoordinates = [long, lat];

	let map = tt.map({
		container: 'map',
		key: process.env.MIX_TOMTOM_API_KEY,
		style: 'tomtom://vector/1/basic-main',
		center: myCoordinates,
		zoom: 15
	});

	let marker = new tt.Marker().setLngLat(myCoordinates).addTo(map);
}


/* * * Search function (homepage + search page) * * */
$('.search-icon-hook').click((e) => {
	//check what element was clicked to see whether you need to grab the input
	// from the homepage or search page.
	let searchSource = event.target.attributes['data-placement'].nodeValue;
	callTomTomSearch(searchSource);
})

function callTomTomSearch(source) {
	if (source == 'guest-homepage' || 'upr-homepage') {
		var userQuery = $('#homepage-house-search').val(); //OK
	} else if (source == 'guest-search' || 'upr-search') {
		console.log("haven't gotten that far yet ^^'");
	}

	tts.services.fuzzySearch({
	key: process.env.MIX_TOMTOM_API_KEY,
	query: userQuery,
	})
	.go()
	.then(handleResults);
}

function handleResults(result) {
	console.log(result);
	if (result) {
		console.log(result.results[0].position);
	}
};

var from = turf.point([11.54073, 45.55292]);
var to = turf.point([11.47973, 45.51564]);
var options = {units: 'kilometers'};

var distance = turf.distance(from, to, options);
console.log('turf distance', distance);