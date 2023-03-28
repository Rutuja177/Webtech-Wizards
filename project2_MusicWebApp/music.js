// Put your Last.fm API key here
var api_key = "b1f2399be32251cc67cfcfadb47a1b8e";
function initialize(){

};

function sendRequest () {
    var xhr = new XMLHttpRequest(); 
    var method = "artist.getinfo"; 
    //console.log(method);
    var artist = encodeURI(document.getElementById("form-input").value);
    xhr.open("GET", "proxy.php?method="+method+"&artist="+artist+"&api_key="+api_key+"&format=json", true);
    xhr.setRequestHeader("Accept","application/json"); 
    xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
            var json = JSON.parse(this.responseText);
            var str = JSON.stringify(json,undefined,2);
            console.log(json);

            //1)Name of the Artist
            document.getElementById("name").innerHTML ="<b>Artist Name: </b>" +json.artist.name;
            //2)URL
            document.getElementById("url").innerHTML = json.artist.url;
            document.getElementById("url").href = json.artist.url;
            //3)Bio
            document.getElementById("bio").innerHTML ="<b>Artist Information:  </b>"+json.artist.bio.content;
            //4)Image of Artist
            //var x = document.getElementById("img3").innerHTML = "Image: "+json.artist.image[3]['#text'];
            var x=json.artist.image[2]['#text'];
            document.getElementById("img1").setAttribute("src", x);
            //document.getElementById(y).innerHTML = "Image of an Artist: " ;
            //document.getElementById("img3").getAttribute = ("src", json.artist.image[3]['#text']);
            
           /*//5)Similar Artist
            var array = " ";
             for (i=0; i<json.artist.similar.artist.length; i++ ){
                 array =array+"</br>"+"Artist: "+json.artist.similar.artist[i].name + "</br>"+"Link: "+json.artist.similar.artist[i].url+"</br>"; 
                 //console.log(array);
             }
             document.getElementById("Ar").innerHTML = "<b>Similar Artists:</b>" +array;
             //document.getElementById("Ar").innerHTML = "Similar Artists: "+json.artist.similar.artist[i].name; */
            //document.getElementById("output").innerHTML = "<pre>" + str + "</pre>"; 
             
            }   

        };
    
    xhr.send(null);

    var xhr_1 = new XMLHttpRequest();
    var method_1 = "artist.getTopAlbums";
    //console.log(method_1);
    var artist_1 = encodeURI(document.getElementById("form-input").value);
    xhr_1.open("GET", "proxy.php?method="+method_1+"&artist="+artist_1+"&api_key="+api_key+"&format=json", true);
    xhr_1.setRequestHeader("Accept","application/json"); 
    xhr_1.onreadystatechange = function () {
        if (this.readyState == 4) {
            var json_1 = JSON.parse(this.responseText);
            //console.log(this.responseText);
            var str_1 = JSON.stringify(json_1,undefined,2);
            console.log(json_1);
            
            
        //var y=json_1.artist.image[1]['#text'];
           // document.getElementById("img1").setAttribute("src", x);
        
           var topArray = " ";
           for (i=0; i< json_1.topalbums.album.length; i++ ){
           topArray = topArray+"</br>Album Name: "+json_1.topalbums.album[i].name+"</br>Image: <img src='"+json_1.topalbums.album[i].image[2]['#text']+"'></br>";
           /* document.getElementById("img2").setAttribute(
               function topImage(){
                   var abc=json_1.artist.image[1]['#text'];
                   document.getElementById("img1").setAttribute("src", abc);
               } */
            
          }
        console.log(topArray);
        document.getElementById("topAlbums").innerHTML = "<b>List of Top Albums:</b>" +topArray;

        //document.getElementById("output_1").innerHTML = "<pre>" + str_1 + "</pre>"; 
        }
    };
    xhr_1.send(null);

    var xhr_2 = new XMLHttpRequest();
    var method_2 = "artist.getSimilar";
    console.log(method_2);
    var artist_2 = encodeURI(document.getElementById("form-input").value);
    xhr_2.open("GET", "proxy.php?method="+method_2+"&artist="+artist_2+"&api_key="+api_key+"&format=json", true);
    xhr_2.setRequestHeader("Accept", "application/json");
    xhr_2.onreadystatechange = function(){
        if(this.readyState == 4){
            var json_2 = JSON.parse(this.responseText);
            var str_2 = JSON.stringify(json_2,undefined,2);
            console.log(json_2);
            var arr = " ";
             for (i=0; i<json_2.similarartists.artist.length; i++ ){
                 arr =arr+"</br>"+json_2.similarartists.artist[i].name; 
                 //console.log(arr);
             }
             document.getElementById("output_2").innerHTML = "<b>Similar Artists:</b></br>" +arr;
             //document.getElementById("Ar").innerHTML = "Similar Artists: "+json.artist.similar.artist[i].name;
            //document.getElementById("output_2").innerHTML = "<pre>" + str_2 + "</pre>";
            }
    };
    xhr_2.send(null); 

    
    
}
