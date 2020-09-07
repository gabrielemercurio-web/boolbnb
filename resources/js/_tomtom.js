import tt from '@tomtom-international/web-sdk-maps'
import tts from '@tomtom-international/web-sdk-services'

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

/* if your searchbar is already filled with a value, use it to call a search */
//XXX: do we really need this for the homepage?
//FIXME: change when the actual view is ready
if ($('#guest-search-query').val() ||
	$('#upr-search-query').val() ||
	$('#guest-home-search').val() ||
	$('#upr-home-search').val()
	){
	let query = $('.snafu').val();
	callTomTomSearch(query);
}

$('#guest-search-button').click(function() {
	let query = $('.snafu').val(); //FIXME: change when the actual view is ready
	callTomTomSearch(query);
});

/* perform a search on tomtom API  */
function callTomTomSearch(query) {
	tts.services.fuzzySearch({
	key: process.env.MIX_TOMTOM_API_KEY,
	query: query,
	})
	.go()
	.then(handleResults);
}

/*  */
function handleResults(result) {
	console.log(result);
	if (result) {
		console.log(result.results[0].position);
		let longitude = result.results[0].position.lng;
		let latitude = result.results[0].position.lat;
		let startingCoordinates = [longitude, latitude];
		let radius = 200;
		callHousesAPI(startingCoordinates, radius);	
	}
};

function callHousesAPI(fromCoordinates, radius) {
	$.ajax({
		'url': 'http://localhost:8000/api/houses',
		'method': 'GET',
		'success': function(data) {
			console.log('data', data);
			// console.log('id', data.id);
			data.data.forEach(house => {
				let longitude = house.longitude;
				let latitude = house.latitude;
				
				// console.log('long', house.longitude);
				// console.log('lat', house.latitude);
				let currentCoordinates = [longitude, latitude];
				let currentDistance = get2PointsDistance(fromCoordinates, currentCoordinates);
				if (currentDistance < radius) {
					console.log('visible house: ', house.id);
				}
			});
		},
		'error': function() {
			console.log('something went wrong');
		}

	})
}

function get2PointsDistance(fromCoordinates, toCoordinates) {
let from = turf.point(fromCoordinates);
let to = turf.point(toCoordinates);
let options = {units: 'kilometers'};

let distance = turf.distance(from, to, options);
console.log('turf distance', distance);
return distance;
}