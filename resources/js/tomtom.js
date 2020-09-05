/* * Show map in house details page * */
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