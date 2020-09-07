import tt from '@tomtom-international/web-sdk-maps'
import tts from '@tomtom-international/web-sdk-services'

/* * * Show map in house details page * * */
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


/* * * Search for user-given address and get back the coordinates * * */
//when a search button is clicked, check which searchbar it refers to and grab its value
$('.search-icon-hook').click((e) => {
	let searchSource = event.target.attributes['data-placement'].nodeValue;
	//FIXME: switch statement?
	if (searchSource == 'guest-homepage') {
		var userQuery = $('#homepage-house-search').val(); //OK
	} else if (source == 'upr-homepage') {
		console.log("haven't gotten that far yet ^^'");
	} else if (source == 'guest-search') {
		console.log("haven't gotten that far yet ^^'");
	} else if (source == 'upr-search') {
		console.log("haven't gotten that far yet ^^'");
	}
	callTomTomSearch(userQuery);
})

function callTomTomSearch(query) {
	tts.services.fuzzySearch({
	key: process.env.MIX_TOMTOM_API_KEY,
	query: query,
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

callHousesAPI()
function callHousesAPI() {
	$.ajax({
		'url': 'http://localhost:8000/api/houses',
		'method': 'GET',
		'success': function(data) {
			console.log('data', data);
			data.data.forEach(house => {
				let longitude = house.longitude;
				let latitude = house.latitude;
				let currentCoordinates = [longitude, latitude];
				let currentDistance =get2PointsDistance(currentCoordinates);
				if (currentDistance < 20) {
					console.log(house.id);
				}
			});
		},
		'error': function() {
			console.log('something went wrong');
		}

	})
}

function get2PointsDistance(toCoordinates) {
let from = turf.point([9.13566, 45.56163]);
let to = turf.point(toCoordinates);
let options = {units: 'kilometers'};

let distance = turf.distance(from, to, options);
console.log('turf distance', distance);
return distance;
}