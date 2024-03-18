// Create Function Initialize GEO data and Add to the map
var initMap = () => {
    // Fetch GEO data from the requested URL
    fetch('https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_day.geojson')
    .then(response => response.json())
    .then(data => {
        // Create Location Array/List
        let locations = [];

        // Put Desired Information From fetched GEOJSON
        const mapInfo = data["features"];
        mapInfo.forEach((mapData) => { 
            let longitude = mapData["geometry"]["coordinates"][0];
            let latitude = mapData["geometry"]["coordinates"][1];
            let placeName = mapData["properties"]["place"];
            let timeStamp = formatDateTime(mapData["properties"]["time"]);
            
            locations.push( {   
                lng: longitude, 
                lat: latitude, 
                place: placeName, 
                time: timeStamp
            }); 
        });

        // Create Map from locations array and center it from first location
        let map = new google.maps.Map(document.querySelector("#map"), {
            zoom: 3, 
            center: locations[0],
        });

        // Loop through locations array and place annotation on the map
        locations.forEach((location) => {
            let annotation = new google.maps.Marker({
                position: location,
                map: map
            });
            // Create Details Content
            const infoWindowContent = `
                <div>
                    <strong>${location.place}</strong>
                    <p>Latitude: ${location.lat}</p>
                    <p>Longitude: ${location.lng}</p>
                    <p>Time: ${location.time}</p>
                </div>
            `;
            // Create popup and store details data on it
            var infoPopup = new google.maps.InfoWindow({
                content: infoWindowContent // Info window content
            });
            // Open info popup when annotation is clicked
            annotation.addListener('click', () => {
                infoPopup.open(map, annotation  ); 
            });
        });
    })
    .catch(error => {
        console.error('Error From Fetching Data:', error);
    });
}

// Create Function For Date and Time Formatting.
const formatDateTime = (inputTimeStamp) => {
    let date = new Date(inputTimeStamp);
    let year = date.getFullYear();
    let month = String(date.getMonth() + 1).padStart(2, '0');
    let day = String(date.getDate()).padStart(2, '0');
    let hours = String(date.getHours()).padStart(2, '0');
    let minutes = String(date.getMinutes()).padStart(2, '0');
    let seconds = String(date.getSeconds()).padStart(2, '0');
    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}


// Run initMap function as soon as document is loaded.
document.addEventListener("DOMContentLoaded", function() {
    console.log("Map Start!");
    initMap();
});