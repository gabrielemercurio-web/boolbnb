// let long = Number("{{$house->longitude}}");
// let lat = Number("{{$house->latitude}}");
// let myCoordinates = [long, lat];

let myCoordinates = [9.13568, 45.46163];

// function callTomTom() {
	let map = tt.map({
		container: 'map',
		key: process.env.MIX_TOMTOM_API_KEY, //fill with own key
		style: 'tomtom://vector/1/basic-main',
		center: myCoordinates,
		zoom: 15
	});
	let marker = new tt.Marker().setLngLat(myCoordinates).addTo(map);
// }