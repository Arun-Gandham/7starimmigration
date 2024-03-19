import { Loader } from '@googlemaps/js-api-loader';

const loader = new Loader({
    apiKey: process.env.GOOGLE_MAPS_API_KEY,
    version: "weekly"
});

loader.load().then(() => {
    const mapOptions = {
        center: { lat: YOUR_DEFAULT_LATITUDE, lng: YOUR_DEFAULT_LONGITUDE },
        zoom: YOUR_DEFAULT_ZOOM_LEVEL,
    };

    const map = new google.maps.Map(document.getElementById('map'), mapOptions);

    const locations = [
        {
            lat: CUSTOM_LATITUDE,
            lng: CUSTOM_LONGITUDE,
            title: 'Custom Location 1',
            image: 'path/to/image.jpg',
            content: '<div><h3>Custom Location 1</h3><img src="path/to/image.jpg" alt="Image"></div>',
        },
        // Add more locations as needed
    ];

    locations.forEach(location => {
        const marker = new google.maps.Marker({
            position: { lat: location.lat, lng: location.lng },
            map: map,
            title: location.title,
        });

        const infoWindow = new google.maps.InfoWindow({
            content: location.content,
        });

        marker.addListener('click', function () {
            infoWindow.open(map, marker);
        });
    });
});