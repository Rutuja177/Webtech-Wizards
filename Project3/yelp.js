var map, marker, bound;
let markers = [];
function initialize () {
};
function myMap(){
   var opt = {
      zoom: 16,
      center: {lat:32.75, lng:-97.13}
   }
   map = new google.maps.Map(document.getElementById("map"), opt);
    
   /* var marker = new google.maps.Marker({
      position:{lat: 32.7292, lng:-97.1152},
      map:map 
   }); */
 }

function addMarker(_json){
   bound = new google.maps.LatLngBounds();
   
   for(i=0;i<_json.businesses.length; i++){
      var a=_json.businesses[i].coordinates.latitude
      var b=_json.businesses[i].coordinates.longitude
      var c=i+1;
      var marker = new google.maps.Marker({
      position: {lat:a, lng:b},
      title: c+")"+ _json.businesses[i].name,
      map:map  
   });
   markers.push(marker);
   bound.extend({lat:a, lng:b});
   }
   map.fitBounds(bound);
}
//https://developers.google.com/maps/documentation/javascript/examples/marker-remove#maps_marker_remove-javascript 
function setMapOnAll(map){
for(var k=0; k<markers.length; k++){
   markers[k].setMap(map);
}
}
function hideMarkers(){
   setMapOnAll(null);
}
function deleteMarkers(){
   hideMarkers();
   markers = [];
}

function sendRequest () {
   deleteMarkers();
   var xhr = new XMLHttpRequest();
   var input = document.getElementById("search").value;
   xhr.open("GET", "proxy.php?term="+ input + "&location=Arlington+Texas&limit=10");
   xhr.setRequestHeader("Accept","application/json");
   xhr.onreadystatechange = function () {
       if (this.readyState == 4) {
          var json = JSON.parse(this.responseText);
          var str = JSON.stringify(json,undefined,2);
          console.log(json);
          var array="";
          for(i =0; i<json.businesses.length; i++){
            array=array+"<br>"+(i+1)+")"+"<br><b>Name:<a href ='" +json.businesses[i].url+"'></b>"+json.businesses[i].name+"</a>"+"</br><img src='"+json.businesses[i].image_url+"' width= 20% height= 20%></br>"+"<b>Ratings:</b>"+json.businesses[i].rating;
            //img.setAttribute("style","width:20%; height:20%");
         }
            document.getElementById("imagica").innerHTML = "<b>List of Restaurants: </b>" +array;
            
            addMarker(json);
         }     
      };
   
   xhr.send(null);
  
}
