/*
https://developers.google.com/maps/documentation/javascript/places#place_details
*/

function initialize() {

	var we_position = document.getElementById('webs_events_location_position');
	var we_name = document.getElementById('webs_events_location_name');
	var we_address = document.getElementById('webs_events_location_address');
	
	// Initial setting 
	var mapOptions = {
		center: new google.maps.LatLng(35.893066, 14.473535),
		zoom: 13
	};
	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	
	var input = /** @type {HTMLInputElement} */
	(document.getElementById('pac-input'));
	
	// Align the input form
	map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
	
	// Set some restrictions to the autocomplete results.
	var autocompleteOptions = {
		componentRestrictions: {country: 'mt'}
	};
	var autocomplete = new google.maps.places.Autocomplete(input, autocompleteOptions);
	autocomplete.bindTo('bounds', map);
	
	var infowindow = new google.maps.InfoWindow();
	
	var marker = new google.maps.Marker({
		animation: google.maps.Animation.BOUNCE,
		map: map,
		draggable: true,
		anchorPoint: new google.maps.Point(0, -29)
	});
	google.maps.event.addDomListener(input, 'keydown', function(e) { 
		if (e.keyCode == 13) {
			e.preventDefault();
			google.maps.event.trigger(autocomplete, 'place_changed');
		}
	}); 
	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		
		// Icons and that.
		infowindow.close();
		marker.setVisible(false);
		
		// Get the place!
		var place = autocomplete.getPlace();
		
		// If no positionable place, return
		if (!place.geometry) {
			return;
		}
		
		// If the place has a geometry, then present it on a map.
		if (place.geometry.viewport) {
			map.fitBounds(place.geometry.viewport);
		} else {
			map.setCenter(place.geometry.location);
			map.setZoom(17); // Why 17? Because it looks good.
		}
		
		// Set the icon of the given place.
		marker.setIcon( /** @type {google.maps.Icon} */ ({
			url: place.icon,
			size: new google.maps.Size(71, 71),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(17, 34),
			scaledSize: new google.maps.Size(35, 35)
		}));
		marker.setPosition(place.geometry.location);
		marker.setVisible(true);
		var address = '';
		if (place.address_components) {
			address = [(place.address_components[0] && place.address_components[0].short_name || ''), (place.address_components[1] && place.address_components[1].short_name || ''), (place.address_components[2] && place.address_components[2].short_name || '')].join(' ');
		}
		
		console.debug(place);
		we_position.value = place.geometry.location;
		we_name.value = place.name;
		we_address.value = address;
		
		infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
		infowindow.open(map, marker);
	});
	
	// On drag and drop update the position value.
	google.maps.event.addListener(marker, 'mouseup', function()
	{
		we_position.value = marker.getPosition().toString();
	});
}
google.maps.event.addDomListener(window, 'load', initialize);