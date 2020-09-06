// import tt from '@tomtom-international/web-sdk-maps'
// import tt from '@tomtom-international/web-sdk-services'

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
	// let test = event.target.
	console.log(event.target);
	let searchSource = event.target.attributes['data-placement'].nodeValue;
	callTomTomSearch(searchSource);
})

function callTomTomSearch(source) {
	if (source == 'guest-homepage') {
		var userQuery = $('#homepage-house-search').val(); //OK
	} else {
		console.log('meh');
	}

	tt.services.fuzzySearch({
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